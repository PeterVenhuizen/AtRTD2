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

	    <!-- Bootstrap -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
        
        <!-- Colorpicker -->
        <link rel="stylesheet" href="assets/css/bootstrap-colorpicker.css">

        <!--<link rel="stylesheet" href="assets/css/style.css">-->
        <style>

        </style>
    </head>
  	<body>


  	</body>
</html>