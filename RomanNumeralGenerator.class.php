<?php

interface RomanNumeralGeneratorInterface {
  public function generate($integer); // convert from integer to Roman numeral
  public function parse($romanNumeral); // convert from Roman numeral to integer
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

  /**
  * Generate a Roman numeral from an integer.
  *
  * @param integer $int
  *
  * @throws InvalidArgumentException if the integer is not between 1 and 3999
  *
  * @return string Returns a Roman numeral.
  */
  public function generate($int) {
    $result = "";

    if($int < 1 || $int > 3999) {
      throw new InvalidArgumentException("Error: expected an integer between 1 and 3999 to generate a Roman numeral.");
    }

    while($int > 0) {
      foreach ($this->conversionTable as $value => $romanNumeralExpression) {
        if($int >= $value) {
          $int -= $value;
          $result .= $romanNumeralExpression;
          break;
        }
      }
    }

    return $result;
  }

  /**
  * Parse a Roman numeral to an integer.
  *
  * @param string $romanNumeral
  *
  * @throws InvalidArgumentException if the integer is not between I and MMMCMXCIX.
  *
  * @return int Returns an integer based on the Roman numeral parsed.
  */
  public function parse($romanNumeral) {
    $result = 0;

    $romanNumeralPattern = '/^M{0,3}(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})$/';
    if(preg_match($romanNumeralPattern, $romanNumeral) !== 1) {
      throw new InvalidArgumentException("Error: expected a Roman numeral between I and MMMCMXCIX to parse.");
    }

    foreach ($this->conversionTable as $value => $romanNumeralExpression) {
      while (strpos($romanNumeral, $romanNumeralExpression) === 0) {
        $romanNumeral = substr($romanNumeral, strlen($romanNumeralExpression));
        $result += $value;
      }
    }
    return $result;
  }
}