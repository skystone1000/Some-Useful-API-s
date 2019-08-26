<!--     
    Get suggestion for each word in input field from given list.
-->
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Autocomplete - Multiple values</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">        
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>

<body>
    <div class="container">
        <br><h1>Get suggestion for each word in input field from given list.</h1><br>
        <p>List: ["ActionScript","AppleScript","Asp","BASIC","C","C++","Clojure","COBOL","ColdFusion",<br>"Erlang","Fortran","Groovy","Haskell","Java","JavaScript","Lisp","Perl","PHP","Python","Ruby","Scala","Scheme"]</p><br>
        <div class="ui-widget">
            <label for="tags">Tag programming languages: </label>
            <input id="tags" size="50">
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $( function() {
            var availableTags = ["ActionScript","AppleScript","Asp","BASIC","C","C++","Clojure","COBOL","ColdFusion","Erlang","Fortran","Groovy","Haskell","Java","JavaScript","Lisp","Perl","PHP","Python","Ruby","Scala","Scheme"];

            function split( val ) {
                return val.split( / \s*/ );
            }
            function extractLast( term ) {
                return split( term ).pop();
            }

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
        });
    </script>
</html>