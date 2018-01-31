$(function() {

    /*
    jQuery.extend({
        getData: function(url, param) {
            var result = null;
            $.ajax({
                'async': false,
                'type': "POST",
                'dataType': "json",
                'url': url,
                'data': param,
                'success': function(data) {
                    result = data;
                }

            })
            return result;
        }
    });
    var data = $.getData("assets/ajax/get_data.php", { gene: 'AT1G01010' });
    console.log(data);
    */

    $.post( 'assets/ajax/get_data.php', { gene: 'AT1G01010' } ).done(function(output) {

        data = $.parseJSON(output);
        console.log(data);

        var size = $("#scale").html(),
            scale = size/data["gene"]["longest"],
            earliest_start = data["gene"]["start"];

        for (var t in data["transcripts"]) {
            if (data["transcripts"].hasOwnProperty(t)) {
                var trs_html = "<div class='trs_wrapper' id='"+t+"'><div class='t_id'>"+t+"</div><div class='transcript'>";
                
                // Iterate over all exons and introns
                var trs_start = data["transcripts"][t]["start"],
                    extra_offset = trs_start - earliest_start,
                    exons = data["transcripts"][t]["exons"],
                    introns = data["transcripts"][t]["introns"];

                var everything = $.map(exons, function(v, i) { return [v, introns[i]]; }),
                    s = 1;
                console.log(everything);
                for (var i = 0; i < everything.length; i++) {
                    try {
                        console.log(i, everything[i]);
                        var size = Math.abs(everything[i][1] - everything[i][0]),
                            width = Math.round(size * scale)+1,
                            offset = ((everything[i][0] - trs_start) + extra_offset) * scale;
                        trs_html += '<div class="' + (i % 2 == 0 ? "exon" : "intron") + '" data-toggle="tooltip" title="start:&nbsp;' + everything[i][0] + '&nbsp;(' + (i == 0 ? s : s+1) + ')<br>end:&nbsp;' + everything[i][1] + '&nbsp;(' + (s+size) + ')" data-html="true" data-placement="bottom"' + ' style="width: ' + width + 'px; left: ' + offset + 'px;"></div>';

                        s += size;
                    } catch(error) {
                        // Nothing to do here
                    }
                }

                $("#isoforms").append(trs_html);

            }
        }

        $('[data-toggle="tooltip"]').tooltip({
            container: 'body'
        });

        // Enable bootstrap tooltip
        //$('body').tooltip({
        //    selector: '[data-toggle="tooltip"]'
        //});

    });

});