<?php

	require_once('../config.php');

    if (isset($_POST['gene'])) {

        $chr = '';
        $strand = '';
        $transcripts = array();
    	$g_id = $_POST['gene'];
        
    	try {
    		$stmt = $db->prepare("SELECT t_id, chr, start, end, cds_start, cds_end, strand, seq FROM rtd2_transcripts WHERE g_id = :g_id ORDER BY start, end DESC");
    		$stmt->bindValue('g_id', $g_id);
    		$stmt->execute();
    		if ($stmt->rowCount() > 0) {
    			foreach ($stmt as $row) {
                    $chr = $row['chr'];
    				$strand = $row['strand'];
                    $transcripts[$row['t_id']] = array( 
                        "start" => (int)$row["start"],
                        "end" => (int)$row["end"],
                        "exons" => array(),
                        "introns" => array(),
                        "CDS" => array("start" => (int)$row["cds_start"], "end" => (int)$row["cds_end"]),
                        "sequence" => $row["seq"]
                    ); 
    			}

            # Gene not found
    		} else {
                echo json_encode(array( "okay" => False, "messages" => $g_id . " not found!" ));
                exit;
            }

    	} catch (PDOException $ex) {
    		echo json_encode(array( "okay" => False, "messages" => $ex ));
    		exit;
    	}
        
        # Fetch exons
        try {
            
            $all_trs = "'" . implode("','", array_keys($transcripts)) . "'";
            $query = " SELECT t_id, start, end FROM rtd2_exons WHERE t_id in (" . $all_trs . ") ORDER BY start";
            $stmt = $db->prepare($query);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                foreach ($stmt as $row) {
                    array_push($transcripts[$row['t_id']]['exons'], array( (int)$row['start'], (int)$row['end'] ));
                }
            } else {
                echo json_encode(array( "okay" => False, "messages" => "Error fetching exons." ));
                exit;               
            }
            
        } catch (PDOException $ex) {
            echo json_encode(array( "okay" => False, "messages" => $ex ));
            exit;
        }
        
        # Fetch introns
        try {
            
            $all_trs = "'" . implode("','", array_keys($transcripts)) . "'";
            $query = " SELECT t_id, start, end FROM rtd2_introns WHERE t_id in (" . $all_trs . ") ORDER BY start";
            $stmt = $db->prepare($query);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                foreach ($stmt as $row) {
                    array_push($transcripts[$row['t_id']]['introns'], array( (int)$row['start'], (int)$row['end'] ));
                }
            } else {
                echo json_encode(array( "okay" => False, "messages" => "Error fetching introns." ));
                exit;
            }
            
        } catch (PDOException $ex) {
            echo json_encode(array( "okay" => False, "messages" => $ex ));
            exit;
        }

        # Get the 'gene' start and end
        $all_trs = array_keys($transcripts);

        # Get the earliest transcript start
        $min = PHP_INT_MAX;
        foreach ($all_trs as $t) { $min = min($min, $transcripts[$t]['start']); }
        
        # Get the latest transcript end
        $max = 0;
        foreach ($all_trs as $t) { $max = max($max, $transcripts[$t]['end']); }
        
        # Determine the longest transcript size
        $longest = 0;
        foreach ($all_trs as $t) { $longest = max($longest, ( $transcripts[$t]['end'] - $transcripts[$t]['start'] )); }

        # Return json array
        echo json_encode(array(
            "okay" => True,
            "messages" => "Everything seems fine! :)",
            "gene" => array(
                "name" => $g_id,
                "chr" => $chr,
                "strand" => $strand,
                "start" => $min,
                "end" => $max,
                "longest" => $longest
            ),
            "transcripts" => $transcripts
        ));
        exit;

    # No gene id entered
    } else {
	    echo json_encode(array( "okay" => False, "messages" => "No gene id entered. Please try again." ));
	    exit;
    }

?>