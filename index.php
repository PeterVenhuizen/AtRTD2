<!DOCTYPE html>

<?php
    require_once('assets/config.php');
    ini_set('display_errors', 1);error_reporting(E_ALL);
?>

<!--
    To-do:
        * Make it a two step thing: retrieve data in json object using PHP and draw models and do PCR with javascript
        * Auto scaling of models upon window resize
        * Download options (genomic sequence, transcript sequence, PCR products, etc.)
        * Model image download (HTML5 Canvas)
        * Proper form validation
        * Settings reset
        * Settings cookie
        * Transcript ordering (drag-and-drop)
        * Intron/exon numbering (based on the longest transcript)
        * Make sequence rectangle dragable, similar to the sequence scroll
        * exon-exon junction primer visualisation support
        * ...
    Dreams:
        * primer design options (primer3)
        * Virtual gel
        * SUPPA event annotation
        * Gene id completion suggestions
        * Add x-axis to the models
        * arabidopsis.org linking
-->

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Arabidopsis thaliana Real-time Transcript Drawing</title>


        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/models.css">
    </head>
    <body>

        <div id="isoforms"></div>
        <div id="sequences"></div>
        <div id="scale">400</div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="assets/js/draw_html_models.js"></script>
    </body>
</html>