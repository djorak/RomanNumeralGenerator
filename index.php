<?php 
include 'RomanNumeralGenerator.class.php';

$results = array();
$errors = array();

$converter = new RomanNumeralGenerator();

// Check for form inputs, the class handle the exceptions
if (isset($_POST["intToRoman"]) && $_POST["intToRoman"] !== "") {
  try {
    $results["intToRoman"] = $converter->generate((integer) $_POST["intToRoman"]);
  } catch (Exception $e) {
    $errors[] = $e->getMessage();
  }
}

if (isset($_POST["romanToInt"]) && $_POST["romanToInt"] !== "") {
  try {
    $results["romanToInt"] = $converter->parse(htmlspecialchars($_POST["romanToInt"]));
  } catch (Exception $e) {
    $errors[] = $e->getMessage();
  }
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Coding Kata: Roman Numerals</title>
    <link rel="stylesheet" href="index.css">
  </head>
  <body>
    <h1>Roman numerals converter</h1>
    <?php if(count($errors) > 0): ?>
    <ul class="errors">
      <?php foreach ($errors as $error) {
        echo '<li class="error">' . $error . '</li>';
      }
      ?>
    </ul>
    <?php endif; ?>
    <form action="" method="post" id="roman-numerals-converter" class="clear">
      <label for="intToRoman">Integer to Roman Numerals:</label>
      <input type="text" name="intToRoman" id="int-to-roman" value="<?php echo $_POST["intToRoman"]; ?>">
      <?php echo isset($results["intToRoman"]) ? '<span class="result"> > ' . $results["intToRoman"] . '</span>' : ''; ?>
      
      <br class="clear">

      <label for="romanToInt">Roman Numerals to integer:</label>
      <input type="text" name="romanToInt" id="roman-to-int" value="<?php echo $_POST["romanToInt"]; ?>">
      <?php echo isset($results["romanToInt"]) ? '<span class="result"> > ' . $results["romanToInt"] . '</span>' : ''; ?>

      <input type="submit" value="Convert" class="submit-button clear">
    </form>
  </body>
</html>