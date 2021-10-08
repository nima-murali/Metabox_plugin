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
		add_meta_box( 'author-details-id', 'Display author details',array($this, 'wp_add_author_form'), 'post', 'side', 'high');																							// creating custom meta box which are only applied to posts
	}

	public function wp_add_author_form($post){
		include plugin_dir_path(__FILE__).'form.php';		// includes html file
	}

	public function wp_author_name_save( $post_id ){
		$inputs = [
        'author-name-input',
        'author-enable-check',
    	];
    	foreach ( $inputs as $input ) {
    		if (! isset( $_POST['author_name_nonce_field'] )|| ! wp_verify_nonce( $_POST['author_name_nonce_field'], 'save_author_name' ))
    		{
   				wp_nonce_ays( '' );
			} 
			else{
				if(isset($_POST['author-enable-check'])){
            		update_post_meta( $post_id, $input,$_POST[$input]);
        		}
        		else{
        			update_post_meta( $post_id, $input,sanitize_text_field( $_POST[$input] ));
        		}
			}			
    		
    	}
	}

	public function wp_author_name_get($content){
    	$id = get_the_ID();								// taking postid
    	$check_box_value = get_post_meta( $id, 'author-enable-check', true );
		if($check_box_value == 'True'){
			$author_name = get_post_meta( $id, 'author-name-input', true );
			return "Author Name :  ".$author_name.$content;
		}
		else{
			return $content;
		}
	}
}


$objcheckbox	= new Wpmetabox();








