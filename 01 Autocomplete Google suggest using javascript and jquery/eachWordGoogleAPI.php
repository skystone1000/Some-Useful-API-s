<!--     
    Get suggestion for each word in input field from Google query suggestion API.
-->
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Autocomplete - Multiple values Google API</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">    
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<body>
    <div class="container">
        <br><h1>Get suggestion for each word in input field from <br><b>Google query suggestion API.</b></h1><br>
        <div class="ui-widget">
            <label for="tags">Tag programming languages: </label>
            <input id="tags" type="text" size="50">
            <div class="output"></div>
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>

    //Google API
    function strip(html) {
        html = html.replace(/<b>/g, "");
        html = html.replace(/<\/b>/g, "");
        return html;
    }

    /* this function shows the raw data */
    function suggestion(data){
        /*
        document.getElementById('output').innerHTML = data;
        document.getElementById('out1').innerHTML = data[0];
        document.getElementById('out2').innerHTML = data[1];
        document.getElementById('out3').innerHTML = data[1][0][0];
        document.getElementById('out4').innerHTML = data[1][1][0];
        document.getElementById('out5').innerHTML = data[1][2][0];
        */
        var availableTags = [strip(data[1][0][0]),strip(data[1][1][0]),strip(data[1][2][0]),strip(data[1][3][0]),strip(data[1][4][0]),strip(data[1][5][0]),strip(data[1][6][0]),strip(data[1][7][0]),strip(data[1][8][0]),strip(data[1][9][0])];
        
        $( "#tags" )
        // don't navigate away from the field on tab when selecting an item
        .on( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB &&
                $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }
        })
        .autocomplete({
            minLength: 0,
            source: function( request, response ) {
            // delegate back to autocomplete, but extract the last term
            response( $.ui.autocomplete.filter(
                availableTags, extractLast( request.term ) ) );
            },
            focus: function() {
            // prevent value inserted on focus
            return false;
            },
            select: function( event, ui ) {
                var terms = split( this.value );
                // remove the current input
                terms.pop();
                // add the selected item
                terms.push( ui.item.value );
                // add placeholder to get the space at the end
                terms.push( "" );
                this.value = terms.join( " " );
                return false;
            }
        });
    }

    //eachWord.php code
    function split( val ) { return val.split( / \s*/ ); }

    function extractLast( term ) { return split( term ).pop(); }

    /* this variable will hold the script tag with your desired data */
    var myScript = '';
    
    /* this section handles what happens after a key is pressed inside your input text box */
    document.getElementById('tags').onkeyup = function(){
    
        /* this variable stores whatever is in the input text box */
        var stuff_in_text_box = document.getElementById('tags').value;

        //var terms = split(stuff_in_text_box);
        var term = extractLast(stuff_in_text_box);

        /* this is the script that will hold the data we're trying to get */
        myScript = document.createElement('script');

        /* this sets the src of the script equal to the url of the data */
        myScript.src = 'https://www.google.com/complete/search?client=hp&q='+term+'&callback=suggestion';

        /* this attaches the script to the body of the page */
        if(term !== " ")
            document.body.appendChild(myScript);
        /* if an old version of your script is on the page, this code removes it */

        if(myScript!==' '){
            document.body.removeChild(myScript);
        }
    };
</script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</html>