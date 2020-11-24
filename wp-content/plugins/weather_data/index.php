<?php 
/*
  Plugin Name: weather data
*/

function option_page() {
  if(function_exists('acf_add_options_page')) {
      acf_add_options_page([
    'page_title' => 'Weather data',
    'meny_title' => 'Weather Data',
    'menu_slug' => 'weather-data',
    'capability' => 'edit_posts',
    'redirect' => false
  ]);
  }
}
add_action('acf/init', 'option_page') ;

class Weather_Forecast {
  public $weather_url;
  public $retrieve_weather; 
  public $weather_object;
  public $page;


  public function __construct() {
    add_action('template_redirect', array($this, 'display_on_page'));   
  }

  public function get_weather_forecast() {
  $this->weather_url = wp_remote_get('http://api.openweathermap.org/data/2.5/weather?q=Gothenburg&units=metric&appid=0addebba9e0d711c043d49af30e343c6&lang=sv');
  $this->retrieve_weather = get_transient('weatherForecast');

  if($this->retrieve_weather === false) {
    set_transient('weatherForecast', $this->weather_url, 3600);
  }

  $this->weather_object = json_decode($this->weather_url['body'], true);
     echo "<p> I " . $this->weather_object['name'] . " är det " . $this->weather_object['weather'][0]['description'] . " och ". $this->weather_object['main']['temp'] . "°C. </p>";
  }

  public function display_on_page() {
    $this->page = get_field('plats', 'option'); 
      if($this->page === 'specifik-produkt' && is_product()) {
        if(get_field('product', 'option') === wc_get_product()->get_id()) {
          add_action('woocommerce_before_single_product', array($this, 'get_weather_forecast'), 5);
        }
      } else if ($this->page === 'cart' && is_cart()) {
        add_action('woocommerce_cart_is_empty', array($this,'get_weather_forecast'), 5);
      } else if ($this->page === 'shop-sida' && is_shop()) {
        add_action('woocommerce_before_main_content', array($this,'get_weather_forecast'), 20);
      } else if ($this->page === 'checkout' && is_checkout()) {
        add_action('woocommerce_before_checkout_form', array($this,'get_weather_forecast'), 5);
      } else if ($this->page === 'produktsida' && is_product()) {
        add_action('woocommerce_before_single_product', array($this, 'get_weather_forecast'), 5);
      } 
  }  
}

if(class_exists('Weather_Forecast')) {
  $Weather_Forecast = New Weather_Forecast();
}
      
?>
