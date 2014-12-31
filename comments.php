<?php 	
	if ( post_password_required() ) {
		echo '<p class="nopassword">' . j__( 'comment_password_protected_lang') . '</p>';
		return ;
	}
	
	
	function j_comment_form($i) {
		
		$commenter = wp_get_current_commenter();
		$user = wp_get_current_user();
		$user_identity = $user->exists() ? $user->display_name : '';
		
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		
		$i['author'] =  '<p class="comment-form-author"><span class="comment-author-wrapper">' . '<label for="author">' . j__( 'name_lang' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
		                '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></span></p>';
		$i['email']  =  '<p class="comment-form-email"><label for="email">' . j__( 'comment_email_lang' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
		            	'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>';
		$i['url']    =  '<p class="comment-form-url"><label for="url">' . j__( 'comment_website_lang' ) . '</label>' .
		            	'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>';
		 
		return $i;
	}
	
	add_action('comment_form_default_fields', 'j_comment_form');
	
	
	function j_comment_default_form($defaults)
	{
		
		global $id;
		$post_id = $id;
				
		$commenter = wp_get_current_commenter();
		$user = wp_get_current_user();
		$user_identity = $user->exists() ? $user->display_name : '';
		
		$req = get_option( 'require_name_email' );
		$required_text = sprintf( ' ' . j__( 'comment_required_field_lang' , 'Required fields are marked %s' ) , '<span class="required">*</span>' );
		
		$newdefaults = array(
			'fields'               => $defaults['fields'],
			'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . j__('comment_textarea_lang', 'Comment') . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
			'must_log_in'          => '<p class="must-log-in">' . sprintf( j__( 'login_to_comment_lang' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
			'logged_in_as'         => '<p class="logged-in-as">' . sprintf( j__( 'new_login_as_lang' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',			
			'comment_notes_before' => '<p class="comment-notes">' . j__( 'comment_email_not_publish_lang' ) . ( $req ? $required_text : '' ) . '</p>',
			'comment_notes_after'  => '<p class="form-allowed-tags">' . sprintf( j__( 'comment_markup_lang' ), ' <code>' . allowed_tags() . '</code>' ) . '</p>',
			'id_form'              => 'commentform',
			'id_submit'            => 'submit',
			'title_reply'          => j__( 'comment_leave_reply_lang' ),
			'title_reply_to'       => j__( 'comment_leave_reply_to_lang' ),
			'cancel_reply_link'    => j__( 'comment_cancel_reply_lang' ),
			'label_submit'         => j__( 'comment_post_comment_lang' ),
		);
		
		return $newdefaults;
	}
	
	add_action('comment_form_defaults', 'j_comment_default_form');
	
	if ( comments_open() ) :
?>
<div class="comment-container" id="comments">
<?php 	if(have_comments()) :	?>
	<h2><?php comments_number(j__( 'no_comment_lang' ), j__( 'one_comment_lang' ), j__( 'more_comment_lang' ) ); ?></h2>
	<hr/>
	<div id="comment-content-container">
		<ul class="commentlist">
			<?php wp_list_comments(array(
				'type'			=> 'all',
				'callback'		=> apply_filters('jeg_comment_callback', 'jeg_comment'),
				'avatar_size'	=> '80'
			)); ?>
		</ul>
		
		<div class="comment-navigation navigation" >
			<div class='alignleft' style="margin-bottom: 20px;">
				<?php next_comments_link('<span>&laquo;</span> Previous') ?>
			</div>
			<div class='alignright' style="margin-bottom: 20px;">
				<?php previous_comments_link('Next<span>&raquo;</span>') ?>
			</div>
		</div>
		
	</div>
<?php 	
	endif; // comment list
	
	if ( get_option('comment_registration') && !is_user_logged_in() ) :
		j_e('login_comment_lang'); 
	else :  		
		comment_form();
	endif; // comment form
?>
</div>
<?php 			
	endif; // if comment open
?>
