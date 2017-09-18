<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> 

<script>


// Check for the various File API support.
if (window.File && window.FileReader && window.FileList && window.Blob) {
   //alert( "Great success! All the File APIs are supported.");
} else {
  alert('The File APIs are not fully supported in this browser.');
}

var blob = null;
var xhr = new XMLHttpRequest(); 
xhr.open("GET", "sonnet-23.txt"); 
xhr.responseType = "blob";//force the HTTP response, response-type header to be blob
xhr.onload = function() 
{
    blob = xhr.response;//xhr.response is now a blob object
    reader.readAsText(blob);
}
xhr.send();

var reader = new FileReader();

var words = [];

reader.onload = function(e) {

  var text = reader.result.split("\n");
  

  
  // text = text.map( function(elt) { return elt.replace(/\W/g, '') } );
  text = text.filter( function(elt) { return elt.length > 10 } );
  
  for (var i in text) {
  
  	var line_words = text[i].split(" ");
	for (var w in line_words) {
		var despaced = line_words[w].replace(/\W/g, '').toLowerCase();
		words.push(despaced);
		}
	};
	
  current_spot = randomspot();
  update_spot();	
	
	  /// still some spaces
  
  /*
  for (var w in words) {
  alert(words[w]);
  }
  */
    
 };
  

function randomspot () {
 return Math.floor (Math.random() * words.length);
}

var current_word;
var current_spot; 

var frag_length = 4;

function add_word(w) {
	 $("#text").append(w + " ")
	}
	
function update_spot() {
	 $("#spot").text(current_spot)
	}


function getAllIndexes(arr, val) {
    var indexes = [], i;
    for(i = 0; i < arr.length; i++)
        if (arr[i] === val)
            indexes.push(i);
    return indexes;
}

function random_elt(arr) {
   return arr[ Math.floor (Math.random() * arr.length) ];
}

function onbtn () {

  var occ = getAllIndexes(words, words[current_spot]);

  if (occ.length > 1)
  {
  	current_spot = (random_elt(occ) + 1) % words.length;
  }
  else
  {
  current_spot = (current_spot + 1) % words.length;  
  };
   

  add_word( words[current_spot] );
  update_spot();

}


</script>



</head>

<body>

<button id="btn" onclick="onbtn()">add word</button>

<div>current spot:</div>
<div id="spot"></div>
<br>
<div id="text"></div>




</body>