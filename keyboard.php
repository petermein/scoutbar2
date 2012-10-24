<script type="text/javascript">
  var shiftState = 'lowercase';
  var altGrState = 'off';
  var capsLockState = 'off';

	$(document).ready(function(){

  
  $('.key:not(.special)').click(function(){
  	key = $(this).html();
  	keyClick(key);
  	$('#search').keyup();
  });
  
  $('.special#tab').click(function(){ keyClick('\t'); });
  $('.special#Enter1').click(function(){ defocus(); });
  $('.special#Enter2').click(function(){ defocus(); });
  $('.special#capslock').click(function(){ toggleCapsLock(); });
  $('.special#Space').click(function(){ keyClick(' '); });
  $('.special#AltGr').click(function(){ altGrToggle(); });
  $('.special#Shift1').click(function(){ shiftToggle(); });
  $('.special#Shift2').click(function(){ shiftToggle(); });

});

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
      var formFieldValue = $('#search').val();
      $('#search').val(formFieldValue.substring(0, formFieldValue.length - 1)); // Backspacing over newlines only works in Gecko based browsers
    }
    else
    {
      $('#search').val($('#search').val() + key);
    }
    $('#search').focus();
  }
  
    
  function shiftToggle(toggleType)
  {
    if((shiftState == 'lowercase') && (toggleType != 'normalKeyClick'))
    {
      $('#a').html('A');
      $('#b').html('B');
      $('#c').html('C');
      $('#d').html('D');
      $('#e').html('E');
      $('#f').html('F');
      $('#g').html('G');
      $('#h').html('H');
      $('#i').html('I');
      $('#j').html('J');
      $('#k').html('K');
      $('#l').html('L');
      $('#m').html('M');
      $('#n').html('N');
      $('#o').html('O');
      $('#p').html('P');
      $('#q').html('Q');
      $('#r').html('R');
      $('#s').html('S');
      $('#t').html('T');
      $('#u').html('U');
      $('#v').html('V');
      $('#w').html('W');
      $('#x').html('X');
      $('#y').html('Y');
      $('#z').html('Z');
      $('#ae').html('�');
      $('#oe').html('�');
      $('#aa').html('�');
      $('#oneHalf').html('�');
      $('#n1').html('!');
      $('#n2').html('\"');
      $('#n3').html('#');
      $('#n4').html('�');
      $('#n5').html('%');
      $('#n6').html('&amp;');
      $('#n7').html('\/');
      $('#n8').html('(');
      $('#n9').html(')');
      $('#n0').html('=');
      $('#plus').html('?');
      $('#forwardSingleQuote').html('`');
      $('#lessThan').html('&gt;');
      $('#comma').html('\;');
      $('#dot').html(':');
      $('#dash').html('_');
      $('#singleQuote').html('*');
      $('#umlaut').html('^');
      shiftState = 'uppercase';
    }
    else if (shiftState == 'uppercase')
    {
      if(capsLockState == 'off')
      {
        $('#a').html('a');
        $('#b').html('b');
        $('#c').html('c');
        $('#d').html('d');
        $('#e').html('e');
        $('#f').html('f');
        $('#g').html('g');
        $('#h').html('h');
        $('#i').html('i');
        $('#j').html('j');
        $('#k').html('k');
        $('#l').html('l');
        $('#m').html('m');
        $('#n').html('n');
        $('#o').html('o');
        $('#p').html('p');
        $('#q').html('q');
        $('#r').html('r');
        $('#s').html('s');
        $('#t').html('t');
        $('#u').html('u');
        $('#v').html('v');
        $('#w').html('w');
        $('#x').html('x');
        $('#y').html('y');
        $('#z').html('z');
        $('#ae').html('�');
        $('#oe').html('�');
        $('#aa').html('�');
        $('#oneHalf').html('�');
        $('#n1').html('1');
        $('#n2').html('2');
        $('#n3').html('3');
        $('#n4').html('4');
        $('#n5').html('5');
        $('#n6').html('6');
        $('#n7').html('7');
        $('#n8').html('8');
        $('#n9').html('9');
        $('#n0').html('0');
        $('#plus').html('+');
        $('#forwardSingleQuote').html('�');
        $('#lessThan').html('&lt;');
        $('#comma').html(',');
        $('#dot').html('.');
        $('#dash').html('-');
        $('#singleQuote').html('\'');
        $('#umlaut').html('�');
        shiftState = 'lowercase';
      }
    }
  }

  function altGrToggle(toggleType)
  {
    if((altGrState == 'off') && (toggleType != 'normalKeyClick'))
    {
      $('#n2').html('@');
      $('#n3').html('�');
      $('#e').html('�');
      $('#n4').html('$');
      $('#n7').html('{');
      $('#n8').html('[');
      $('#n9').html(']');
      $('#n0').html('}');
      $('#forwardSingleQuote').html('|');
      $('#umlaut').html('~');
      $('#lessThan').html('\\');
      altGrState = 'on';
    }
    else if (altGrState == 'on')
    {
      $('#n2').html('2');
      $('#n3').html('3');
      $('#e').html('e');
      $('#n4').html('4');
      $('#n7').html('7');
      $('#n8').html('8');
      $('#n9').html('9');
      $('#n0').html('0');
      $('#forwardSingleQuote').html('�');
      $('#umlaut').html('�');
      $('#lessThan').html('&lt;');
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
<?php
echo '<link href="'. STYLE_DIR.'keyboard.css" rel="stylesheet" type="text/css">';
?>
<div id="keyboard">
<div class="key-row">
  <div class="key" id="oneHalf">�</div>
  <div class="key" id="n1">1</div>
  <div class="key" id="n2">2</div>
  <div class="key" id="n3">3</div>
  <div class="key" id="n4">4</div>
  <div class="key" id="n5">5</div>
  <div class="key" id="n6">6</div>
  <div class="key" id="n7">7</div>
  <div class="key" id="n8">8</div>
  <div class="key" id="n9">9</div>
  <div class="key" id="n0">0</div>
  <div class="key" id="plus">+</div>
  <div class="key" id="forwardSingleQuote" >�</div>
  <div class="key" id="backsp" >backsp.</div>
</div>
<div class="key-row">
  <div class="key special" id="tab">tab</div>
  <div class="key" id="q">q</div>
  <div class="key" id="w">w</div>
  <div class="key" id="e">e</div>
  <div class="key" id="r">r</div>
  <div class="key" id="t">t</div>
  <div class="key" id="y">y</div>
  <div class="key" id="u">u</div>
  <div class="key" id="i">i</div>
  <div class="key" id="o">o</div>
  <div class="key" id="p">p</div>
  <div class="key" id="aa">�</div>
  <div class="key" id="umlaut">�</div>
  <div class="key special" id="Enter1">Enter</div>
</div>
<div class="key-row">
  <div class="key special" id="capsLock">C.L.</div>
  <div class="key" id="a">a</div>
  <div class="key" id="s">s</div>
  <div class="key" id="d">d</div>
  <div class="key" id="f">f</div>
  <div class="key" id="g">g</div>
  <div class="key" id="h">h</div>
  <div class="key" id="j">j</div>
  <div class="key" id="k">k</div>
  <div class="key" id="l">l</div>
  <div class="key" id="ae">�</div>
  <div class="key" id="oe">�</div>
  <div class="key" id="singleQuote">'</div>
  <div class="key special" id="Enter2">Enter</div>
</div>
<div class="key-row">
  <div class="key special" id="shift1">shift</div>
  <div class="key" id="lessThan">&lt;</div>
  <div class="key" id="z">z</div>
  <div class="key" id="x">x</div>
  <div class="key" id="c">c</div>
  <div class="key" id="v">v</div>
  <div class="key" id="b">b</div>
  <div class="key" id="n">n</div>
  <div class="key" id="m">m</div>
  <div class="key" id="comma">,</div>
  <div class="key" id="dot">.</div>
  <div class="key" id="dash">-</div>
  <div class="key special" id="shift2">shift</div>
</div>
<div class="key-row">
  <div class="key special" id="Ctrl1" >Ctrl</div>
  <div class="key special" id="Alt">Alt</div>
  <div class="key special" id="Space">Space</div>
  <div class="key special" id="AltGr">Alt Gr</div>
  <div class="key special" id="Ctrl2">Ctrl</div>
</div>