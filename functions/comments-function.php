<?php
/**
 * @author Jegbagus
 */

function jeg_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
?>
<li <?php comment_class(); ?>>
	<div id="comment-<?php comment_ID(); ?>">
		<div class="coment-box">
			<div class="coment-box-inner">
			<div class="comment-autor">
				<?php echo get_avatar($comment,$size='80',$default='' ); ?>
			</div>
			<div class="comment-meta portfolio-meta blog-meta">
				<ul>			
					<li class="addby"><i class="icon-user"></i><?php comment_author_link(); ?></li>
					<li class="addtime"><i class="icon-time"></i><?php echo get_comment_date('F j, Y'); ?></li>
					<li class="replycomment" data-comment-id="<?php comment_ID(); ?>"><?php j_e('reply_comment_lang', 'Reply');?></li>
					<li class="closecommentform"><?php j_e('cancel_reply_comment_lang', 'Cancel Reply');?></li>
				</ul>
			</div>
			<div class="comment-text">
				<?php 
					if($comment->comment_approved == '0') :
						j_e('comment_moderation_lang');
					endif; 
					echo '<p>' . get_comment_text() . '</p>';
				?>				
			</div>
			<div style="clear: both;"></div>
		</div>
		</div>
	</div>
</li>
<?php
}
?>