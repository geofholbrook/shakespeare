<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


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
var current_spot = 0; 

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


function get_first_occurrence_after(word, index) {
// find the first occurence of word in global variable 'words' AFTER index
    for(n = index+1; n < words.length; n++)
    {
        if (words[n] == word)
            return n
    }
    return null
}


function onbtn() {

  // initialization
  current_spot = 0;
  add_word( words[0] )
  
  var occ
  
  while (current_spot < words.length)
  {
	 occ = get_first_occurrence_after(words[current_spot], current_spot);
	
	  if (occ)
	  {
	  	current_spot = occ + 1;
	  	is_red = !is_red;
	  }
	  else
	  {
	  current_spot++
	  } 
	
	  add_word( words[current_spot] );
	  update_spot();
	  }
 
}

</script>



</head>

<body>

<div class="container">

<h2> a free associative sonnet </h2>

<button id="btn" onclick="onbtn()">add a line</button>
<div>current spot:</div>
<div id="spot"></div>
<br>

  <div class="panel panel-default">
    <div class="panel-body" id="text"></div>
  </div>

</div>


<script>
sonnets="Music to hear, why hear'st thou music sadly? Sweets with sweets war not, joy delights in joy. Why lov'st thou that which thou receiv'st not gladly, Or else receiv'st with pleasure thine annoy? If the true concord of well-tuned sounds, By unions married, do offend thine ear, They do but sweetly chide thee, who confounds In singleness the parts that thou shouldst bear. Mark how one string, sweet husband to another, Strikes each in each by mutual ordering, Resembling sire and child and happy mother Who all in one, one pleasing note do sing: Whose speechless song, being many, seeming one, Sings this to thee: 'Thou single wilt prove none.'As an unperfect actor on the stage Who with his fear is put besides his part, Or some fierce thing replete with too much rage, Whose strength's abundance weakens his own heart. So I, for fear of trust, forget to say The perfect ceremony of love's rite, And in mine own love's strength seem to decay, O'ercharged with burden of mine own love's might. O, let my books be then the eloquence And dumb presagers of my speaking breast, Who plead for love and look for recompense More than that tongue that more hath more express'd.     O, learn to read what silent love hath writ:     To hear with eyes belongs to love's fine wit. If there be nothing new, but that which is Hath been before, how are our brains beguiled, Which, labouring for invention, bear amiss The second burden of a former child! O, that record could with a backward look, Even of five hundred courses of the sun, Show me your image in some antique book, Since mind at first in character was done! That I might see what the old world could say To this composed wonder of your frame; Whether we are mended, or whether better they, Or whether revolution be the same.     O, sure I am, the wits of former days     To subjects worse have given admiring praise. No longer mourn for me when I am dead Then you shall hear the surly sullen bell Give warning to the world that I am fled From this vile world, with vilest worms to dwell: Nay, if you read this line, remember not The hand that writ it; for I love you so That I in your sweet thoughts would be forgot If thinking on me then should make you woe. O, if, I say, you look upon this verse When I perhaps compounded am with clay, Do not so much as my poor name rehearse. But let your love even with my life decay,     Lest the wise world should look into your moan     And mock you with me after I am gone. Thus is his cheek the map of days outworn, When beauty lived and died as flowers do now, Before the bastard signs of fair were born, Or durst inhabit on a living brow; Before the golden tresses of the dead, The right of sepulchres, were shorn away, To live a second life on second head; Ere beauty's dead fleece made another gay: In him those holy antique hours are seen, Without all ornament, itself and true, Making no summer of another's green, Robbing no old to dress his beauty new;     And him as for a map doth Nature store,     To show false Art what beauty was of yore. How oft, when thou, my music, music play'st, Upon that blessed wood whose motion sounds With thy sweet fingers, when thou gently sway'st The wiry concord that mine ear confounds, Do I envy those jacks that nimble leap To kiss the tender inward of thy hand, Whilst my poor lips, which should that harvest reap, At the wood's boldness by thee blushing stand! To be so tickled, they would change their state And situation with those dancing chips, O'er whom thy fingers walk with gentle gait, Making dead wood more blest than living lips.     Since saucy jacks so happy are in this,     Give them thy fingers, me thy lips to kiss. "
</script>
