<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="da" lang="da">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>JavaScript Keyboard</title>
<script type="text/javascript">
  <!--
  var shiftState = 'lowercase';
  var altGrState = 'off';
  var capsLockState = 'off';

  function keyClick(key)
  {
    shiftToggle('normalKeyClick');
    altGrToggle('normalKeyClick');
    if(key == '&amp;')
    {
      key = '&';
    }
    if(key == '&lt;')
    {
      key = '<';
    }
    if(key == '&gt;')
    {
      key = '>';
    }    
    if(key == 'backsp.')
    {
      var formFieldValue = document.getElementById('echoField').value;
      document.getElementById('echoField').value = formFieldValue.substring(0, formFieldValue.length - 1); // Backspacing over newlines only works in Gecko based browsers
    }
    else
    {
      document.getElementById('echoField').value = document.getElementById('echoField').value + key;
    }
    document.getElementById('echoField').focus();
  }
    
  function shiftToggle(toggleType)
  {
    if((shiftState == 'lowercase') && (toggleType != 'normalKeyClick'))
    {
      document.getElementById('a').innerHTML = 'A';
      document.getElementById('b').innerHTML = 'B';
      document.getElementById('c').innerHTML = 'C';
      document.getElementById('d').innerHTML = 'D';
      document.getElementById('e').innerHTML = 'E';
      document.getElementById('f').innerHTML = 'F';
      document.getElementById('g').innerHTML = 'G';
      document.getElementById('h').innerHTML = 'H';
      document.getElementById('i').innerHTML = 'I';
      document.getElementById('j').innerHTML = 'J';
      document.getElementById('k').innerHTML = 'K';
      document.getElementById('l').innerHTML = 'L';
      document.getElementById('m').innerHTML = 'M';
      document.getElementById('n').innerHTML = 'N';
      document.getElementById('o').innerHTML = 'O';
      document.getElementById('p').innerHTML = 'P';
      document.getElementById('q').innerHTML = 'Q';
      document.getElementById('r').innerHTML = 'R';
      document.getElementById('s').innerHTML = 'S';
      document.getElementById('t').innerHTML = 'T';
      document.getElementById('u').innerHTML = 'U';
      document.getElementById('v').innerHTML = 'V';
      document.getElementById('w').innerHTML = 'W';
      document.getElementById('x').innerHTML = 'X';
      document.getElementById('y').innerHTML = 'Y';
      document.getElementById('z').innerHTML = 'Z';
      document.getElementById('ae').innerHTML = 'Æ';
      document.getElementById('oe').innerHTML = 'Ø';
      document.getElementById('aa').innerHTML = 'Å';
      document.getElementById('oneHalf').innerHTML = '§';
      document.getElementById('n1').innerHTML = '!';
      document.getElementById('n2').innerHTML = '\"';
      document.getElementById('n3').innerHTML = '#';
      document.getElementById('n4').innerHTML = '¤';
      document.getElementById('n5').innerHTML = '%';
      document.getElementById('n6').innerHTML = '&amp;';
      document.getElementById('n7').innerHTML = '\/';
      document.getElementById('n8').innerHTML = '(';
      document.getElementById('n9').innerHTML = ')';
      document.getElementById('n0').innerHTML = '=';
      document.getElementById('plus').innerHTML = '?';
      document.getElementById('forwardSingleQuote').innerHTML = '`';
      document.getElementById('lessThan').innerHTML = '&gt;';
      document.getElementById('comma').innerHTML = '\;';
      document.getElementById('dot').innerHTML = ':';
      document.getElementById('dash').innerHTML = '_';
      document.getElementById('singleQuote').innerHTML = '*';
      document.getElementById('umlaut').innerHTML = '^';
      shiftState = 'uppercase';
    }
    else if (shiftState == 'uppercase')
    {
      if(capsLockState == 'off')
      {
        document.getElementById('a').innerHTML = 'a';
        document.getElementById('b').innerHTML = 'b';
        document.getElementById('c').innerHTML = 'c';
        document.getElementById('d').innerHTML = 'd';
        document.getElementById('e').innerHTML = 'e';
        document.getElementById('f').innerHTML = 'f';
        document.getElementById('g').innerHTML = 'g';
        document.getElementById('h').innerHTML = 'h';
        document.getElementById('i').innerHTML = 'i';
        document.getElementById('j').innerHTML = 'j';
        document.getElementById('k').innerHTML = 'k';
        document.getElementById('l').innerHTML = 'l';
        document.getElementById('m').innerHTML = 'm';
        document.getElementById('n').innerHTML = 'n';
        document.getElementById('o').innerHTML = 'o';
        document.getElementById('p').innerHTML = 'p';
        document.getElementById('q').innerHTML = 'q';
        document.getElementById('r').innerHTML = 'r';
        document.getElementById('s').innerHTML = 's';
        document.getElementById('t').innerHTML = 't';
        document.getElementById('u').innerHTML = 'u';
        document.getElementById('v').innerHTML = 'v';
        document.getElementById('w').innerHTML = 'w';
        document.getElementById('x').innerHTML = 'x';
        document.getElementById('y').innerHTML = 'y';
        document.getElementById('z').innerHTML = 'z';
        document.getElementById('ae').innerHTML = 'æ';
        document.getElementById('oe').innerHTML = 'ø';
        document.getElementById('aa').innerHTML = 'å';
        document.getElementById('oneHalf').innerHTML = '½';
        document.getElementById('n1').innerHTML = '1';
        document.getElementById('n2').innerHTML = '2';
        document.getElementById('n3').innerHTML = '3';
        document.getElementById('n4').innerHTML = '4';
        document.getElementById('n5').innerHTML = '5';
        document.getElementById('n6').innerHTML = '6';
        document.getElementById('n7').innerHTML = '7';
        document.getElementById('n8').innerHTML = '8';
        document.getElementById('n9').innerHTML = '9';
        document.getElementById('n0').innerHTML = '0';
        document.getElementById('plus').innerHTML = '+';
        document.getElementById('forwardSingleQuote').innerHTML = '´';
        document.getElementById('lessThan').innerHTML = '&lt;';
        document.getElementById('comma').innerHTML = ',';
        document.getElementById('dot').innerHTML = '.';
        document.getElementById('dash').innerHTML = '-';
        document.getElementById('singleQuote').innerHTML = '\'';
        document.getElementById('umlaut').innerHTML = '¨';
        shiftState = 'lowercase';
      }
    }
  }

  function altGrToggle(toggleType)
  {
    if((altGrState == 'off') && (toggleType != 'normalKeyClick'))
    {
      document.getElementById('n2').innerHTML = '@';
      document.getElementById('n3').innerHTML = '£';
      document.getElementById('e').innerHTML = '€';
      document.getElementById('n4').innerHTML = '$';
      document.getElementById('n7').innerHTML = '{';
      document.getElementById('n8').innerHTML = '[';
      document.getElementById('n9').innerHTML = ']';
      document.getElementById('n0').innerHTML = '}';
      document.getElementById('forwardSingleQuote').innerHTML = '|';
      document.getElementById('umlaut').innerHTML = '~';
      document.getElementById('lessThan').innerHTML = '\\';
      altGrState = 'on';
    }
    else if (altGrState == 'on')
    {
      document.getElementById('n2').innerHTML = '2';
      document.getElementById('n3').innerHTML = '3';
      document.getElementById('e').innerHTML = 'e';
      document.getElementById('n4').innerHTML = '4';
      document.getElementById('n7').innerHTML = '7';
      document.getElementById('n8').innerHTML = '8';
      document.getElementById('n9').innerHTML = '9';
      document.getElementById('n0').innerHTML = '0';
      document.getElementById('forwardSingleQuote').innerHTML = '´';
      document.getElementById('umlaut').innerHTML = '¨';
      document.getElementById('lessThan').innerHTML = '&lt;';
      altGrState = 'off';
    }
  }

  function toggleCapsLock()
  {
    if(capsLockState == 'off')
    {
      capsLockState = 'on';
      shiftToggle('capsLock')
    }
    else
    {
      capsLockState = 'off';
      shiftToggle('capsLock');
    }
  }
  -->
</script>
<style type="text/css">
body, td {
	font-family: Verdana, Arial, Helvetica, Geneva, Sans-Serif;
	font-size: 13px;
}
.key {
	font-family: monospace;
	font-size: 14px;
	cursor: pointer;
	border: 1px solid #000000;
	background-color: #FFFFFF;
	padding:10pxxxx;
	width:40px;
	height:40px;
	float:left;
}
.key-row {
	float:none;
}
#keyboard {
	font-family: monospace;
	border-collapse: collapse;
	border: 2px solid #000000;
	padding: 12px;
	width: 940px;
	background-color: #000;
}
</style>
</head>
<body>
<textarea id="echoField" rows="7" cols="60" style="width: 445px; height: 100px; font-family: Verdana, Arial, Helvetica, Geneva, Sans-Serif; font-size: 12px;" ></textarea>
<br />
<br />
<div id="keyboard">
<div class="key-row">
  <div class="key" id="oneHalf" onclick="keyClick(this.innerHTML)">½</div>
  <div class="key" id="n1" onclick="keyClick(this.innerHTML)">1</div>
  <div class="key" id="n2" onclick="keyClick(this.innerHTML)">2</div>
  <div class="key" id="n3" onclick="keyClick(this.innerHTML)">3</div>
  <div class="key" id="n4" onclick="keyClick(this.innerHTML)">4</div>
  <div class="key" id="n5" onclick="keyClick(this.innerHTML)">5</div>
  <div class="key" id="n6" onclick="keyClick(this.innerHTML)">6</div>
  <div class="key" id="n7" onclick="keyClick(this.innerHTML)">7</div>
  <div class="key" id="n8" onclick="keyClick(this.innerHTML)">8</div>
  <div class="key" id="n9" onclick="keyClick(this.innerHTML)">9</div>
  <div class="key" id="n0" onclick="keyClick(this.innerHTML)">0</div>
  <div class="key" id="plus" onclick="keyClick(this.innerHTML)">+</div>
  <div class="key" id="forwardSingleQuote" onclick="keyClick(this.innerHTML)">´</div>
  <div class="key" id="backsp" onclick="keyClick(this.innerHTML)">backsp.</div>
</div>
<div class="key-row">
  <div class="key" id="tab" onclick="keyClick('\t')">tab</div>
  <div class="key" id="q" onclick="keyClick(this.innerHTML)">q</div>
  <div class="key" id="w" onclick="keyClick(this.innerHTML)">w</div>
  <div class="key" id="e" onclick="keyClick(this.innerHTML)">e</div>
  <div class="key" id="r" onclick="keyClick(this.innerHTML)">r</div>
  <div class="key" id="t" onclick="keyClick(this.innerHTML)">t</div>
  <div class="key" id="y" onclick="keyClick(this.innerHTML)">y</div>
  <div class="key" id="u" onclick="keyClick(this.innerHTML)">u</div>
  <div class="key" id="i" onclick="keyClick(this.innerHTML)">i</div>
  <div class="key" id="o" onclick="keyClick(this.innerHTML)">o</div>
  <div class="key" id="p" onclick="keyClick(this.innerHTML)">p</div>
  <div class="key" id="aa" onclick="keyClick(this.innerHTML)">å</div>
  <div class="key" id="umlaut" onclick="keyClick(this.innerHTML)">¨</div>
  <div class="key" id="Enter1" onclick="keyClick('\n')">Enter</div>
</div>
<div class="key-row">
  <div class="key" id="capsLock" onclick="toggleCapsLock()">C.L.</div>
  <div class="key" id="a" onclick="keyClick(this.innerHTML)">a</div>
  <div class="key" id="s" onclick="keyClick(this.innerHTML)">s</div>
  <div class="key" id="d" onclick="keyClick(this.innerHTML)">d</div>
  <div class="key" id="f" onclick="keyClick(this.innerHTML)">f</div>
  <div class="key" id="g" onclick="keyClick(this.innerHTML)">g</div>
  <div class="key" id="h" onclick="keyClick(this.innerHTML)">h</div>
  <div class="key" id="j" onclick="keyClick(this.innerHTML)">j</div>
  <div class="key" id="k" onclick="keyClick(this.innerHTML)">k</div>
  <div class="key" id="l" onclick="keyClick(this.innerHTML)">l</div>
  <div class="key" id="ae" onclick="keyClick(this.innerHTML)">æ</div>
  <div class="key" id="oe" onclick="keyClick(this.innerHTML)">ø</div>
  <div class="key" id="singleQuote" onclick="keyClick(this.innerHTML)">'</div>
  <div class="key" id="Enter2" onclick="keyClick('\n')">Ent.</div>
</div>
<div class="key-row">
  <div class="key" id="shift1" onclick="shiftToggle()">shift</div>
  <div class="key" id="lessThan" onclick="keyClick(this.innerHTML)">&lt;</div>
  <div class="key" id="z" onclick="keyClick(this.innerHTML)">z</div>
  <div class="key" id="x" onclick="keyClick(this.innerHTML)">x</div>
  <div class="key" id="c" onclick="keyClick(this.innerHTML)">c</div>
  <div class="key" id="v" onclick="keyClick(this.innerHTML)">v</div>
  <div class="key" id="b" onclick="keyClick(this.innerHTML)">b</div>
  <div class="key" id="n" onclick="keyClick(this.innerHTML)">n</div>
  <div class="key" id="m" onclick="keyClick(this.innerHTML)">m</div>
  <div class="key" id="comma" onclick="keyClick(this.innerHTML)">,</div>
  <div class="key" id="dot" onclick="keyClick(this.innerHTML)">.</div>
  <div class="key" id="dash" onclick="keyClick(this.innerHTML)">-</div>
  <div class="key" id="shift2" onclick="shiftToggle()">shift</div>
</div>
<div class="key-row">
  <div class="key" id="Ctrl1" onclick="keyClick('')">Ctrl</div>
  <div class="key" id="Alt" onclick="keyClick('')">Alt</div>
  <div class="key" id="Space" onclick="keyClick(' ')">Space</div>
  <div class="key" id="AltGr" onclick="altGrToggle()">Alt Gr</div>
  <div class="key" id="Ctrl2" onclick="keyClick('')">Ctrl</div>
</div>
</body>
</html>