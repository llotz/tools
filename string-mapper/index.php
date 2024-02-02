<!doctype html>
<head>
	<title>🖹 string mapper</title>
	<?include("../meta.php");?>
	<style>.highlight{ background-color: yellow; }</style>
	<script>
	function clearAll(){
		document.getElementById('a').value="";
		document.getElementById("b").value="";
		document.getElementById("input").value="";
		document.getElementById("result").value="";
	}
		
	function mapShit (){
		let input = document.getElementById("input").value;
		let a = document.getElementById('a').value.split("\n");
		let b = document.getElementById('b').value.split("\n");
		let result = "";
		a.forEach(function(aline, index){
			if(aline.trim() == "")
				return;
			let r = input.replaceAll("%a%", aline);
			if(input.includes("%b%") && b.length > index)
				r = r.replaceAll("%b%", b[index]);
			result+=r;
			if(index < a.length-1)
				result += "\n";
		});
		document.getElementById("result").value = result;
	}
		
	function addVariable(name){
		document.getElementById("input").value = document.getElementById("input").value+"%"+name+"%";
	}
		
	function clearBreaks(){
		document.getElementById("result").value = document.getElementById("result").value.replaceAll("\n", "");
	}
		
	function takePreset(preset){
		document.getElementById("input").value = document.getElementById(preset).value;
	}
		
	function searchbina(){
		let a = document.getElementById('a').value.split("\n");
		let b = document.getElementById('b').value.split("\n");
		let result = "";
		let count = 0;
		a.forEach(function(aline,index){
			if(b.includes(aline)){
				let idx = b.indexOf(aline)+1
				result +="<span class='highlight'>"+aline+"</span> <-- Line "+idx+"<br/>";
				count++;
			}
			else
				result +=aline+"<br/>";
		});
		
		document.getElementById('searchresult').innerHTML = count+" in "+a.length+" found<br/>------------------<br/>"+result+"------------------";
	}
		
	function countlines(c){
		document.getElementById('count'+c).innerHTML = 	document.getElementById(c).value.split("\n").length;
	}
		
	function clearSearchResult(){
		document.getElementById('searchresult').innerHTML = "";
	}
		
	window.onload = function foo(){
	countlines('a');
	countlines('b');
	};
	</script>
</head>

<body>
<?include("../backlink.php");?>
<div style="display:flex">
	<div>
		variable a:<br>
		<textarea id="a" name="a" rows="25" cols="15" oninput="countlines('a')">
first
second
third</textarea>
lines:<div id="counta">0</div>
	</div>
	<div>
		variable b:<br>
		<textarea id="b" name="b" rows="25" cols="15" oninput="countlines('b')">
tsrif
dnoces
driht</textarea>
lines:<div id="countb">0</div>
	</div>
	<div>
		<div style="display:flex; justify-content:space-between">
			<div>
				<button id="clear" onclick="clearAll();">❌ clear all</button>
				<button id="adda" onclick="addVariable('a');">⬇️ add %a%</button>
				<button id="addb" onclick="addVariable('b');">⬇️ add %b%</button>
			</div>
			<div>
				<button id="work" onclick="mapShit();"><b>🤘 map this shit</b></button>
				<button id="clearbreaks" onclick="clearBreaks();">↩️ remove line breaks</button>
			</div>
		</div>
		input string: <br><textarea id="input" name="input" rows="1" cols="80">%a% backwards is %b%</textarea><br>
		result:<br>
		<textarea id="result" name="result" rows="20" cols="80"></textarea>
	</div>
</div>
<button id="searchbina" onclick="searchbina();">🔎 Search b in a</button>
<button id="clearsearchresult" onclick="clearSearchResult();">❌ clear search result</button>
<br>
<div id="searchresult">
	
</div>
<br>
<b>How To:</b><br>
- Variables are <b>%a%</b> and <b>%b%</b><br>
- if you dont need <b>%b%</b>, ignore the input field, don't use the variable.<br>
<br>
<b>Search</b><br>
Lists all occurences of <b>%b%</b> in <b>%a%</b><br>
<br>
<b>Templates:</b><br>
<br>Mapping SQL <b>IN('a', 'b', ...)</b> content
<br><div>Preset:<input id="preset1" type="text" value="'%a%',"/><button onclick="takePreset('preset1')">take</button></div>
<br>Mapping SQL <b>UPDATE table SET variable='value', variable2='value2'</b> Values to Fieldnames
<br><div>Preset:<input id="preset2" type="text" value="%a%='%b%',"/><button onclick="takePreset('preset2')">take</button></div>

<br>
Other Presets:<br>
<div><input id="presetOther1" type="text" value="%a%=%b%"/><button onclick="takePreset('presetOther1')">take</button></div>
</body>
