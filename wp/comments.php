<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">Книга отзывов и предложений
			<?php
				// $comments_number = get_comments_number();
				// if ( '1' === $comments_number ) {
				// 	/* translators: %s: post title */
				// 	printf( _x( 'One thought on &ldquo;%s&rdquo;', 'comments title', 'twentyfifteen' ), get_the_title() );
				// } else {
				// 	printf(
				// 		 translators: 1: number of comments, 2: post title 
				// 		_nx(
				// 			'%1$s thought on &ldquo;%2$s&rdquo;',
				// 			'%1$s thoughts on &ldquo;%2$s&rdquo;',
				// 			$comments_number,
				// 			'comments title',
				// 			'twentyfifteen'
				// 		),
				// 		number_format_i18n( $comments_number ),
				// 		get_the_title()
				// 	);
				// }
			?>
		</h2>

		<?php //twentyfifteen_comment_nav(); ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ol',
					'short_ping'  => true,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php //twentyfifteen_comment_nav(); ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		//if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<!-- <p class="no-comments"><?php _e( 'Comments are closed.', 'twentyfifteen' ); ?></p> -->
	<?php// endif; ?>

	<?php 
    $defaults = array(
	'fields'               => array(
								'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name' ) . '<br>' . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
											'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $html_req . ' /></p>',
								'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> <br><em></em>	' .
											'<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-describedby="email-notes"' . $aria_req . $html_req  . ' /></p>',
								'url'    => '',
							),
	'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><br> <textarea id="comment" name="comment" cols="45" rows="8"  aria-required="true" required="required"></textarea></p>',
	
	'comment_notes_before' => '',//'<p class="comment-notes"><span id="email-notes">' . __( 'Your email address will not be published.' ) . '</span>'. ( $req ? $required_text : '' ) . '</p>',
	'comment_notes_after'  => '',
	'id_form'              => 'commentform',
	'id_submit'            => 'submit',
	'class_form'           => 'comment-form',
	'class_submit'         => 'submit',
	'name_submit'          => 'submit',
	'title_reply'          => 'Оставить отзыв',  //__( 'Leave a Reply' ),
	'title_reply_to'       => __( 'Leave a Reply to %s' ),
	'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title">',
	'title_reply_after'    => '</h3>',
	'cancel_reply_before'  => ' <small>',
	'cancel_reply_after'   => '</small>',
	'cancel_reply_link'    => __( 'Cancel reply' ),
	'label_submit'         => 'Оставить отзыв',//__( 'Post Comment' ),
	'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',
	'submit_field'         => '<p class="form-submit">%1$s %2$s</p>',
	'format'               => 'xhtml',
);
echo "<span class='span'>Показать еще</span>";
comment_form( $defaults ); ?>

</div><!-- .comments-area -->
