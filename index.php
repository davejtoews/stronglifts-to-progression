<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>StrongLifts to Progression</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <link rel="stylesheet" href="dist/bundle.css">
    </head>
    <body>
		<h1>StrongLifts to Progression</h1>

		<p>This tool can be used to import data from StrongLifts into the Android app Progression. It requires the paid version of StrongLifts which is capable of exporting data. It also requires being able to browse add and remove files from your device's internal storage, either by connecting it to a PC or by using one of many file manager applications available in the Play Store. This method presumes you have not yet begun using Progression but would like to make the switch. If you are already using Progression, the method below will destroy your Progression data.</p>

		<p>This worked for me, it might not work for you. I take no responsibility for anything you do messing with the files on your device.</p>

		<h2>Instructions</h2>
		<ol>
			<li>Export a CSV from the StrongLifts app. This is a feature of the paid app.</li>
			<li>Select the file using the input below.</li>
			<li>Submit the file. If successfull, you should see text appear in both of the text boxes below. There may be a slight delay, particularly if you have a lot of data in StrongLifts.</li>
			<li>Click "Download fws.json". In most browsers this should begin downloading a file called <code>fws.json</code>. If it opens a new browser window, save the resulting text as <code>fws.json</code>.</li>
			<li>Click "Download up.json". In most browsers this should begin downloading a file called <code>up.json</code>. If it opens a new browser window, save the resulting text as <code>up.json</code>.</li>
			<li>Copy the two downloaded files to the directory <code>Android/data/workout.progression/</code> on your Android device where Progression is installed. If files of the same name already exist, they need to be replaced. Note that this will destroy any workout data you had saved in Progression.</li>
		</ol>

		<p>If you are already using Progression, it should be possible to combine the JSON data from the existing fieles and the files generated from a StrongLifts import. However, I have not tried this and some trial and error may be necessary to ensure that the workout history is assigned to the correct program.</p>

 		<form action="ajax.php" method="post" enctype="multipart/form-data">
 			<h3>Steps 2, 3: Select and submit StrongLifts csv</h3>
 			<input name="slCsv" id="file" type="file">
 			<button>Submit</button>
 		</form>
 		<form id="saveFws">
 			<h3>Step 4: Save Workouts</h3>
	 		<textarea name="fws" id="fws"></textarea>
	 		<button>Download fws.json</button> 			
 		</form>
 		<form id="saveUp">
 			<h3>Step 5: Save Program</h3>
	 		<textarea name="up" id="up"></textarea>
	 		<button>Download up.json</button> 			
 		</form>
 		<script src="dist/bundle.js"></script>
    </body>
</html>