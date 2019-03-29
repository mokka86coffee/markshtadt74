<?php 
/*Template name: Гостевая*/
?>
<?php get_header(); ?>
<?php 
/*Template name: Главная*/
?>
<?php get_header(); ?>
<div class="dishes">
	<?php comments_template( '/comments.php' ); ?>
</div> 
</section>
<section class="info-wrap" style="margin-top: -80px;">
    <div class="info info--hidden">
        <div class="info-border"></div>
    </div>
</section><!--info-wrap-->

<?php get_footer(); ?> 




	<?php
	// $args = array(
	// 	'walker'            => null,
	// 	'max_depth'         => 0,
	// 	'style'             => 'ul',
	// 	'callback'          => null,
	// 	'end-callback'      => null,
	// 	'type'              => 'all',
	// 	'reply_text'        => 'Reply',
	// 	'page'              => '',
	// 	'per_page'          => '',
	// 	'avatar_size'       => 0,
	// 	'reverse_top_level' => null,
	// 	'reverse_children'  => '',
	// 	'format'            => 'html5', // или xhtml, если HTML5 не поддерживается темой
	// 	'short_ping'        => false,    // С версии 3.6,
	// 	'echo'              => true,     // true или false
	// );

	// wp_list_commentscomments( $args ); 
	?>
