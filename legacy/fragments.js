
const _ = require('lodash')

var fs = require('fs');
var words = fs.readFileSync('all6-sonnets.txt').toString().split("\n");




////// get the list of words from sonnets (updates global variable 'words')

var reader = new FileReader();

var blob = null;
var xhr = new XMLHttpRequest(); 
xhr.open("GET", "all6-sonnets.txt"); 
xhr.responseType = "blob"; //force the HTTP response, response-type header to be blob
xhr.onload = function() 
{
    blob = xhr.response;//xhr.response is now a blob object
    reader.readAsText(blob);
}
xhr.send();


reader.onload = function(e) {
// split the text into words

  var text = reader.result.split("\n");
  text = text.filter( function(elt) { return elt.length > 10 } );
  
  for (var i in text) {
    	var line_words = text[i].split(" ");
	for (var w in line_words) {
		var despaced = line_words[w].replace(/\W/g, '').toLowerCase();
		words.push(despaced);
		}
	};
 };
  

function randomspot () {
 return Math.floor (Math.random() * words.length);
}

var current_word;
var current_spot = 0; 

var min_frag_length = 5;

var is_red = false;

function clear_text () {
	$("#text").text("")
}

function add_word(w) {
	var color;
	
	if (is_red) { color = "red" } else { color = "blue" };
	
	 $("#text").append("<font color=\"" + color + "\">" + w + "</font> ")
}
	
function all_indeces_for (word) {
	return words.map((val, idx)=>[idx,val])
		    .filter(a=>a[1]==word)
		    .map(a=>a[0])
}


var source_length = 15
var segment1_length = 5
var fragment_length = 7

function get_mode() {
	return $("#replace_insert").val()
}


function onbtn() {

  // initialization
  var link_spot = -1
  
  while (link_spot == -1 || all_indeces_for(words[link_spot]).length == 1) {
  	link_spot = _.random(segment1_length, words.length - (source_length - segment1_length) - 1); 
  }
  
  console.log( all_indeces_for( words[link_spot] ) )
  
  
  var fragment_start = _.sample(_.without(all_indeces_for ( words[link_spot] ), link_spot)) 
  
  var orig_start = link_spot - (segment1_length - 1)
  var orig = words.slice(orig_start, orig_start + source_length)

  var orig_seg1 = words.slice(orig_start, orig_start + segment1_length - 1)
  var fragment = words.slice(fragment_start, fragment_start + fragment_length)
  
  var orig_seg2_start = (get_mode() == "replace") 
  			? link_spot + fragment_length 
  			: link_spot
  
  var orig_seg2 = words.slice(orig_seg2_start, orig_start + source_length)
  
  console.log(words.length)
  console.log(orig_start, link_spot, fragment_start, orig_seg2_start)
  

  
  is_red = false
  orig_seg1.forEach(add_word)
  
  is_red = true
  fragment.forEach(add_word)
  
  is_red = false
  orig_seg2.forEach(add_word)
  
    $("#text").append("<br>")
}

</script>



</head>

<body>

<div class="container">

<h2> test of fragement replacement / insertion </h2>

<button id="btn" onclick="onbtn()">GENERATE</button>

<select id="replace_insert">
  <option value="replace">REPLACE</option>
  <option value="insert">INSERT</option>
</select>

<br>

  <div class="panel panel-default">
    <div class="panel-body" id="text"></div>
  </div>

</div>
