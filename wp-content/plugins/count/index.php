<?php 
/*
  Plugin Name: Count my string
  Description: Count how many letter there is in a string, returning a true or false statement depending if the string is longer than seven letters.
*/
?>

<?php 
// remove this later ****

// ********
$is_seven_letters_long = '';
if(isset($_POST["count_letters"])) {
  $is_seven_letters_long = filter_var($_POST["count_letters"], FILTER_SANITIZE_STRING);

}
function counter($is_seven_letters_long) {
  if(strlen($is_seven_letters_long) == 7 ) {
     echo "<p>True</p>";
  } else echo "<p>False</p>"; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form action="" method="post">
    <label>Skriv in ett ord: </label><br>
    <input type="text" name="count_letters">
  </form>
  <?php echo "<p> Ordet \"$is_seven_letters_long\" har " . strlen($is_seven_letters_long). "st bokstäver." . counter($is_seven_letters_long); ?> 
</body>
</html>

