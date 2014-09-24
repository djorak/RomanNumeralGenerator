<?php

include 'RomanNumeralGenerator.class.php';

$converter = new RomanNumeralGenerator();

$outputIntToRoman = "";
$outputRomanToInt = "";
for($i=1; $i<=3999; $i++) {
  $roman = $converter->generate($i);
  $outputIntToRoman .= $i . " > " . $roman . "<br>";
  $outputRomanToInt .= $roman . " > " . $converter->parse($roman) . "<br>";
}

?>

<div style="float:left; width: 300px;">
  <h1>Int to Roman</h1>
 <?php echo $outputIntToRoman; ?>
</div>

<div style="float:left; width: 300px;">
  <h1>Roman to Int</h1>
 <?php echo $outputRomanToInt; ?>
</div>