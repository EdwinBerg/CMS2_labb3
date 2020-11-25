<?php 
/*
  Plugin Name: Testplugin/Addon
  Description: Testar plugin "Counter".
*/

class test_counter_class {
  public $test_seven_letters_long;
  public $sex;
  public $sju;
  public $nio;
  public $expected_value_6;
  public $expected_value_7;
  public $expected_value_9;


  public function __construct() {
    add_action('init', array($this, 'test_init'), 20);
  }

  public function testCounter($string_to_be_tested, $expected_value) {
    $this->test_seven_letters_long = new Seven_Letters_Long();
    $expected_value_string = $expected_value? 'True' : 'False';

    if($this->test_seven_letters_long->counter($string_to_be_tested) === $expected_value) {
        echo "<p style=\"color: green\">lyckat test</p>";
      } else {
        echo "<p style=\"color: red\">Misslyckat test</p>";
        }
      echo "<p> Testad sträng: $string_to_be_tested | Förväntat värde: $expected_value_string</p>";
    }


  public function test_init() { 
      $this->sex = 'hejsan';
      $this->sju = 'hejsans';
      $this->nio = 'hejsansan';
      $this->expected_value_6 = false;
      $this->expected_value_7 = true;
      $this->expected_value_9 = true; //tokigt test

      $this->testcounter($this->sex, $this->expected_value_6);  
      $this->testcounter($this->sju, $this->expected_value_7);  
      $this->testcounter($this->nio, $this->expected_value_9);  
  }
}
  if(class_exists('test_counter_class')) {
    $test_counter_class = New test_counter_class();
  }
?>
