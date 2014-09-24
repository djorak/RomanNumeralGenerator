<?php

interface RomanNumeralGeneratorInterface {
  public function generate($integer); // convert from integer to Roman numeral
  public function parse($string); // convert from Roman numeral to integer
}

class RomanNumeralGenerator implements RomanNumeralGeneratorInterface {
  private $conversionTable = array(
    1000 => "M",
    900 => "CM",
    500 => "D",
    400 => "CD",
    100 => "C",
    90 => "XC",
    50 => "L",
    40 => "XL",
    10 => "X",
    9 => "IX",
    5 => "V",
    4 => "IV",
    1 => "I"
    );

  public function generate($int) {
    $result = "";

    if($int < 1 || $int > 3999) {
      throw new InvalidArgumentException("Error: expected an integer between 1 and 3999 to generate a Roman numeral.");
    }

    while($int > 0) {
      foreach ($this->conversionTable as $value => $romanNumeral) {
        if($int >= $value) {
          $int -= $value;
          $result .= $romanNumeral;
          break;
        }
      }
    }

    return $result;
  }

  public function parse($string) {
    $result = 0;

    $romanNumeralPattern = '/^M{0,3}(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})$/';
    if(preg_match($romanNumeralPattern, $string) !== 1) {
      throw new InvalidArgumentException("Error: expected a Roman numeral between I and MMMCMXCIX to parse.");
    }

    foreach ($this->conversionTable as $value => $romanNumeral) {
      while (strpos($string, $romanNumeral) === 0) {
        $string = substr($string, strlen($romanNumeral));
        $result += $value;
      }
    }
    return $result;
  }
}