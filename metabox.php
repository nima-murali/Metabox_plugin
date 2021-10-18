<?php
/**
* Plugin Name: Custom Metabox Plugin
* Plugin URI: https://in.linkedin.com/
* Description: Display input field on front end using checkbox
* Version: 1.0
* Author: Nima
* Author URI: https://twitter.com/?lang=en
**/
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( !class_exists( 'WpMetabox' )) {

	class WpMetabox{
		public function __construct(){
			add_action( 'add_meta_boxes',array($this, 'wp_add_author_name'));
			add_action( 'save_post', array($this, 'wp_author_name_save' ));
			add_filter( 'the_content', array($this, 'wp_author_name_get' ) );
		}

		/** 
			create meta box and specify on which post type it should be available and were to display.
		*/

		public function wp_add_author_name(){
			add_meta_box( 'author-details-id', 'Display author details',array($this, 'wp_add_author_form'), 'post', 'side', 'high');
		}
		public function wp_add_author_form($post){
			include plugin_dir_path(__FILE__).'form.php';		
		}

		/** 
		 *save the data collected from meta boxes to db 
		 */

		public function wp_author_name_save( $post_id ){
			$inputs = [
	        'author-name-input',
	        'author-enable-check',
	    	];
	    	foreach ( $inputs as $input ) {
	    		if (!isset($_POST['author_name_nonce_field']) || !wp_verify_nonce($_POST['author_name_nonce_field'], 'save_author_name')) {
	    			wp_nonce_ays( '' );
 				} 	
				else{
					if ( !current_user_can( 'edit_post', $post->ID )) {
	    				return $post_id;
	    			}
					if(isset($_POST['author-enable-check'])){
	            		update_post_meta( $post_id, $input,sanitize_text_field( $_POST[$input] ));
	        		}
	        		if(isset($_POST['author-name-input'])){
	        			update_post_meta( $post_id, $input,sanitize_text_field( $_POST[$input] ));
	        		}
				}				
	    	}
		}

		/** 
		 *retrieve data stored in db and display in front end
		 * @return type content
		 */

		public function wp_author_name_get($content){
	    	$id 				= get_the_ID();							
	    	$check_box_value 	= get_post_meta( $id, 'author-enable-check', true );
			if($check_box_value == 'True'){
				$author_name 	= get_post_meta( $id, 'author-name-input', true );
				return "Author Name :  ".$author_name.$content;
			}else{
				return $content;
			}
		}
	}
	$objcheckbox	= new WpMetabox();

}else{
	exit();
}

?>







