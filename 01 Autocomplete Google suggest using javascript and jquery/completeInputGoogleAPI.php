<!--     
    Get suggestion for complete input field from google sreach query API.
-->
<!DOCTYPE html>
<html>
<head>
	<title>Auto-complete</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<body>
	<div class="container">
		<br><h1>Get suggestion for complete input field from <br><b>google search query API</b>	</h1><br>
		<div class="ui-widget">
			<label for="tags">Search :</label>
			<input type="text" id="tags">
			
			<br><br>
			<h3>Google query response:</h3>
			<div id="output"></div>
			<!--
			<br>
			<div id="out1"></div>
			<br>
			<div id="out2"></div>
			<br>
			<div id="out3"></div>
			<br>
			<div id="out4"></div>
			<br>
			<div id="out5"></div>
			-->
		</div>
	</div>
</body>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script >
	
// Used to remove <b> tag taht is present in response of data[1][i][0] th elements
function strip(html)
{
	html = html.replace(/<b>/g, "");
	html = html.replace(/<\/b>/g, "");
	return html;
}

/* this function shows the raw data */
function suggestion(data){
	
    document.getElementById('output').innerHTML = data;
    /*
    document.getElementById('out1').innerHTML = data[0];
    document.getElementById('out2').innerHTML = data[1];
    document.getElementById('out3').innerHTML = data[1][0][0];
    document.getElementById('out4').innerHTML = data[1][1][0];
    document.getElementById('out5').innerHTML = data[1][2][0];
    */
    var availableTags = [strip(data[1][0][0]),strip(data[1][1][0]),strip(data[1][2][0]),strip(data[1][3][0]),strip(data[1][4][0]),strip(data[1][5][0]),strip(data[1][6][0]),strip(data[1][7][0]),strip(data[1][8][0]),strip(data[1][9][0])];
    $( "#tags" ).autocomplete({
        source: availableTags
    });
}

/* this variable will hold the script tag with your desired data */
var myScript = '';

/* this section handles what happens after a key is pressed inside your input text box */
document.getElementById('tags').onkeyup = function(){

	/* this variable stores whatever is in the input text box */
	var stuff_in_text_box = document.getElementById('tags').value;

	/* this is the script that will hold the data we're trying to get */
	myScript = document.createElement('script');

	/* this sets the src of the script equal to the url of the data */
	myScript.src = 'https://www.google.com/complete/search?client=hp&q='+stuff_in_text_box+'&callback=suggestion';

	/* this attaches the script to the body of the page */
	document.body.appendChild(myScript);

	/* if an old version of your script is on the page, this code removes it */
	if(myScript!==''){
		document.body.removeChild(myScript);
	}
};
</script>
</html>