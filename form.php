<label for="author-name-input">Author's Name</label>
<input type="text" name="author-name-input" id="author-name-input" value="<?php $id = get_the_ID(); $input_value = get_post_meta( $id, 'author-name-input', true ); echo $input_value ?>">
<label for="meta-box-check">Apply</label>
<?php
	$checkbox_value = get_post_meta( $id, 'author-enable-check', true );
	if($checkbox_value == 'True'){ ?>
		<input type="checkbox" id="author-enable-check" name="author-enable-check" value="True" checked>
	<?php
	}
	else{ ?>
		<input type="checkbox" id="author-enable-check" name="author-enable-check" value="True">
	<?php
	}

	wp_nonce_field( 'save_author_name', 'author_name_nonce_field' ); ?>


	


