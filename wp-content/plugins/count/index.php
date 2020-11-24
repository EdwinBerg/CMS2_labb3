<?php 
/*
  Plugin Name: Count my string
  Description: Count how many letter there is in a string, returning a true or false statement depending if the string is longer than seven letters.
*/
class Seven_Letters_Long {
  public $is_seven_letters_long;
 
  
  public function __construct(){
    if(isset($_POST["count_letters"])) {
    $this->is_seven_letters_long = filter_var($_POST["count_letters"], FILTER_SANITIZE_STRING);

    echo "<form action=\"\" method=\"post\">
            <label>Skriv in ett ord: </label><br>
            <input type=\"text\" name=\"count_letters\">
          </form>";
      
     echo "<p> Ordet \"$this->is_seven_letters_long\" har " . strlen($this->is_seven_letters_long). "st bokstäver." . $this->counter($this->is_seven_letters_long) . "</p>";
    }
  }
  public function counter($is_seven_letters_long) {
    if(strlen($this->is_seven_letters_long) == 7 ) {
      echo "<p>True</p>";
    } else echo "<p>False</p>";    
  }
  
}
if(class_exists('Seven_Letters_Long') {
  $seven_letters_long = New Seven_Letters_Long
})
?>
