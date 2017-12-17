<?php
require('utils/config.php');

//check if is already logged in
if( !$user->is_logged_in() ) { 
	header('Location: login.php'); exit(); 
	}



//page title
$title='Play';

//include start of all documents start.php
require('layout/start.php'); 
?>

<!-- HTML -->
<h1>Devinity</h1>
<div class="play">
	<div class="tools">
		<h3><a href="javascript:window.location.href=window.location.href">REPLAY</a></h3>
		<h3><a href="play.php">BACK</a></h3>
	</div>
	<h2 class="choose">Choose a number</h2>
	<input type="text" name="number" class="numberText" id="number" maxlength="3" onkeypress="return onlyNumber(event)" placeholder="000">
	<input type="button" name="btn" class="button" id="btn" onclick="play()" value="OK">
	<h2 class="correct" id="correct">TRY</h2>

<script type="text/javascript">	
	// Generate the number to find
	function nbAlea(min,max){
		var nb = min + (max-min+1)*Math.random();
		return Math.floor(nb);
	}
	var n = nbAlea(0,1000);

	// accept only numbers in text input
	function onlyNumber(evt){
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
    }

	// init number of attempts
	var nattempts=0;

	// verif
	function verify(i,n){
		if (i==n){
			return true;
		}	
		if (i>n){
			return 'sup';
		}
		if (i<n) {
			return 'inf';
		}
	}

	function play(){
		nattempts++;
		var nmb = document.getElementById('number');
		var result = document.getElementById('result');
		var btn = document.getElementById('btn');
		var correct = document.getElementById('correct');
		var number = nmb.value;
		var attempt = verify(number,n);
		if (attempt==true){
						correct.classList.add('correct-yes');
			correct.innerHTML = 'Correct';

			btn.disabled=true;
			sendValue();
		}
		if (attempt=='sup'){
			correct.innerHTML = 'SUP';
		}
		if (attempt=='inf'){
			correct.innerHTML = 'INF';
		}
		
	}

	// function to create an ajax object
	function createXHR(){
		try {
					return new ActiveXObject("Microsoft.XMLHTTP");
				}
				catch(e) {
					return new XMLHttpRequest();
				}
	}

	function sendValue(){
			var xhr=createXHR();
				xhr.onreadystatechange = function () {
					if (xhr.readyState==4 && xhr.status==200){
						var el=xhr.responseText;
					}
				}
				var url = "attempts.php";
				xhr.open("GET","attempts.php?value="+nattempts+"&level=two",true);
				xhr.send();
	}

</script>


<?php
//include end of all documents end.php
require('layout/end.php'); 
?>