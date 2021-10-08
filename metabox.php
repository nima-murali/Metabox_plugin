<?php
/**
* Plugin Name: Custom Metabox Plugin
* Plugin URI: https://in.linkedin.com/
* Description: Display input field on front end using checkbox
* Version: 1.0
* Author: Nima
* Author URI: https://twitter.com/?lang=en
**/

class Wpmetabox{
	public function __construct(){
		add_action( 'add_meta_boxes',array($this, 'wp_add_author_name'));
		add_action( 'save_post', array($this, 'wp_author_name_save' ));
		add_filter( 'the_content', array($this, 'wp_author_name_get' ) );
	}

	public function wp_add_author_name(){
		add_meta_box( 'author-details-id', 'custom_metabox',array($this, 'wp_add_author_form'), 'post', 'side', 'high');	
	}

	public function wp_add_author_form($post){
		include plugin_dir_path(__FILE__).'form.php';
	}
	public function wp_author_name_save( $post_id ){
		#if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
		$inputs = [
        'author-name-input',
        'author-enable-check',
    	];
    	foreach ( $inputs as $input ) {
    		#if ( array_key_exists( $input, $_POST ) ) {			// checks whether $input is 															present in the corresponding array
    		if(isset($_POST)){
            	update_post_meta( $post_id, $input,$_POST[$input]);
            	#write_log($abc);
        	}
        
    	}
		#$this->wp_meta_box_get();     				// php oop method calling

	}
	public function wp_author_name_get($content){
		/*$id = get_the_ID();							// Function used to get the post id of each post
		$x = get_post_meta( $id, 'meta-box-input', true );
		if(isset($_POST['meta-box-check'])){
			#write_log($x);
			echo "";	
		



		$postype = get_post_type();
		if ( $postype == 'page' ) {
        // Do something to $content
			if(isset($_POST['meta-box-check'])){
				$id = get_the_ID();
				$x = get_post_meta( $id, 'meta-box-input', true );
        		#return $content;
        		$GLOBALS['a'] = $content;
      
        	}
        	return $GLOBALS['a'];
    	}
    	else{
    		return $content;
    	}
		*/
    	$id = get_the_ID();
    	$check_box_value = get_post_meta( $id, 'author-enable-check', true );
		if($check_box_value == 'True'){
			$author_name = get_post_meta( $id, 'author-name-input', true );
			return "Author Name :  ".$author_name.$content;
		}
		else{
			return $content;
		}
		#$postype = get_post_type();
		#if ( $postype == 'page' ) {
			
			#$x = get_post_meta( $id, 'meta-box-input', true );
			#return $x.$content;
			#$a = $x.$content;
			#return $a;
		#}
		#else{
		#	return $content;
		#}
	}


}


$objcheckbox	= new Wpmetabox();









/*

add_action( 'add_meta_boxes', 'wp_add_metabox' );
add_action( 'save_post', 'wp_meta_box_save' );
function wp_add_metabox(){
	add_meta_box( 'metabox-id', 'custom_metabox','wp_custom_checkbox', 'page', 'side', 'high');	
}

function wp_custom_checkbox($post){
	#echo "Hai";
	#$content= '<label for="meta-box-input">Authors Name</label>\r\n';
	#$content .= '<input type="text" name="meta-box-input" id="meta-box-input"/>';
	
	#return $content;
	#$values	 	= get_post_custom($post->ID);
	#$text		= isset($values['meta-box-input']) ? $values['meta-box-input'] : '';
	#$selected	= isset($values['meta-box-select']) ? esc_attr($values['meta-box-select'][0]) : '';
	#$check 		= isset($values['meta-box-check']) ? esc_attr($values['meta-box-check'][0]) : '';
	#wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
	include plugin_dir_path(__FILE__).'form.php';
}

function wp_meta_box_save( $post_id )
{
    $inputs = [
        'meta-box-input',
    ];
    foreach ( $inputs as $input ) {
    	
    	if ( array_key_exists( $input, $_POST ) ) {
            $abc = update_post_meta( $post_id, $input,$_POST[$input]);
            write_log($abc);
        }
        
    }
	wp_meta_box_get();    

}

function wp_meta_box_get(){
	$id = get_the_ID();
	$x = get_post_meta( $id, 'meta-box-input', true );
	if(isset($_POST['meta-box-check'])){
		write_log($x);	
	}
}






















if (!function_exists('write_log')) {
	function write_log ( $log )  {
		if ( true === WP_DEBUG ) {
			if ( is_array( $log ) || is_object( $log ) ) {
				error_log( print_r( $log, true ) );
			} else {
				error_log( $log );
			}
		}
	}
}

*/
