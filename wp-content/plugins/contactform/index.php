<?php 
/*
  Plugin Name: Kontaktformulär
  Description: Detta plugin ska kunna skriva ut ett kontaktformulär!
*/
function contact_form() { ?>
  <div>
    <form action="<?php echo admin_url('admin-ajax.php');?>">
      <input type="text" name="name" placeholder="Skriv in namn..">
      <br>
      <input type="textarea" name="message" placeholder="Skriv ditt meddelande..">
      <br>
      <input type="submit" name="submit" value="Skicka">
      <input type="hidden" name="action" value="send_contact_form">
    </form>
  </div>
<?php 
}

function recieve_contact_form(){
  echo "<p> Tack så mycket " . $_REQUEST['name'] . "!</p>" ;
  wp_insert_post(
    [
      'post_title' => $_REQUEST['name'], 
      'post_content' => $_REQUEST['message'],
      'post_type' => 'meddelanden',
      
    ]
    );
  die();
}

add_action('wp_ajax_send_contact_form', 'recieve_contact_form');


function messages() {
  register_post_type('meddelanden', [
    'labels' => [
      'name' => 'Meddelanden',
      'singular_name' => 'Meddelande'
    ],
    'public' => true,
    'has_archive' => true
   ]);
}



add_action('init', 'messages');
add_action('send_contact_form', 'insertpost_from_contact_form');
do_action('save_post_{$post->messages}');
add_action('woocommerce_before_main_content', 'contact_form');
?>