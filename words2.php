<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



  <style>
    span {
    margin-right:10px;

	line-height: 1.8;
  word-wrap: normal;
  display: inline-block;

    }
   </style>

<script>


// Check for the various File API support.
if (window.File && window.FileReader && window.FileList && window.Blob) {
   //alert( "Great success! All the File APIs are supported.");
} else {
  alert('The File APIs are not fully supported in this browser.');
}

var blob = null;
var xhr = new XMLHttpRequest(); 
xhr.open("GET", "all6-sonnets.txt"); 
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

var min_frag_length = 5;

var is_red = false;

function add_word(w) {
	var color;
	
	if (is_red) { color = "red" } else { color = "blue" };
	
	 $("#text").append("<font color=\"" + color + "\">" + w + "</font> ")
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

var fragment_length = 1;

function single_word () {

  var occ = getAllIndexes(words, words[current_spot]);

  if (occ.length > 1 && fragment_length > min_frag_length)
  {
  	current_spot = (random_elt(occ) + 1) % words.length;
  	fragment_length = 1;
  	is_red = !is_red;
  }
  else
  {
  current_spot = (current_spot + 1) % words.length; 
  fragment_length++; 
  };
   

  add_word( words[current_spot] );
  update_spot();

}

function append (x) { $("#text").html(x) }

var thresh = 5;


function pair_search () {
  
  for (k=0; k<words.length-1; k++) {
  
  var matches1 = getAllIndexes( words, words[k]) ;
  var matches2 = getAllIndexes( words, words[k+1]);
  
  
  for (i in matches1) {
  	for (j in matches2) {
  		var diff = matches2[j] - matches1[i];
  		if (diff > 1  && diff < thresh) {
  		
  			console.log( diff + " words apart: " + words.slice(matches1[i], matches2[j+1]).join(" "));
  			}
  		}
  	}
  
  }
 }


function span_factory () {

	words.forEach( (w, i)=> {
		var elt = $("<span>"+w+"</span>")
		elt.attr("id", "word-"+i)
		$("#text").append(elt)
	})
		
	$("span").click((e)=>{
	console.log(e.target);
	$(e.target).css("background-color", "red");
})

		
}





function onbtn() {

	span_factory();
}


</script>



</head>

<body>

<div class="container">

<h2> a free associative sonnet </h2>

<button id="btn" onclick="onbtn()">RUN</button>
<div>current spot:</div>
<div id="spot"></div>
<br>

  <div class="panel panel-default">
    <div class="panel-body" id="text"></div>
  </div>

</div>