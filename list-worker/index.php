<!doctype html>
<head>
	<title>string list worker</title>
	<?include("../meta.php");?>
	<script>
	function clearAll(){
		document.getElementById('a').value="";
		document.getElementById("input").value="";
		document.getElementById("result").value="";
	}
		
	function clearBreaks(){
		document.getElementById("result").value = document.getElementById("result").value.replaceAll("\n", "");
	}
		
	function countlines(c){
		document.getElementById('count'+c).innerHTML = 	document.getElementById(c).value.split("\n").length;
	}

	function trim(mode){
		let input = document.getElementById("input").value;
		let a = document.getElementById('a').value.split("\n");
		let result = "";
		let regex;
		
		if(mode=='end')
			regex = new RegExp(`(${input}$)`, 'g');
		else if (mode == 'start')
			regex = new RegExp(`(^${input})`, 'g');
		
		console.log(mode);
		console.log(regex);
		a.forEach(function(aline, index){
			let r = aline.replace(regex, '');
			result += r+"\n";
		});
		result = result.replace(/\\n$/, '');
		document.getElementById("result").value = result;
	}
		
	window.onload = function foo(){
	countlines('a');
	countlines('result');
	};
	</script>
</head>

<body>
<?include("../backlink.php");?>
<div style="display:flex">
	<div>
		input a:<br>
		<textarea id="a" name="a" rows="25" cols="35" oninput="countlines('a')"></textarea><br>
lines:<div id="counta">0</div>
	</div>
	<div>
		<div style="display:flex; justify-content:space-between">
			<div>
				<button id="clear" onclick="clearAll();">❌ clear all</button>
			</div>
			<div>
				<button id="trimstart" onclick="trim('start');">trim start</button>
				<button id="trimend" onclick="trim('end');">trim end</button>
			</div>
		</div>
		input string: <br><textarea id="input" name="input" rows="1" cols="80"></textarea>
		<br>
		result:<br>
		<textarea id="result" name="result" rows="20" cols="80"></textarea><br>
		lines:<div id="countresult">0</div>
	</div>
</div>
</body>
