<?php 
/*Template name: Главная*/
?>
<?php get_header(); ?>
<?php  
	// $fields = get_field('акции');  $i = 0;
	// 			foreach ($fields as $key => $value) {
	// 				echo '<img src="' . $value['картинка_для_акции'] . '" alt="" class="b1img' . $i . '">'; $i++;
	// 			}
?>
	<div class="dishes">
		<div class="dishes__item"  data-menu="main">
				<p  data-menu="main"><?php echo get_field('заголовок_блюдо_1', 46) ?></p>
				<img  data-menu="main" data-src=<?php echo get_field('картинка_блюдо_1', 46) ?> alt="">
		</div>
		<div class="dishes__item dishes__item--main"  data-menu="banket">
				<p  data-menu="banket"><?php echo get_field('заголовок_блюдо_2', 46) ?></p>
				<img  data-menu="banket" data-src=<?php echo get_field('картинка_блюдо_2', 46) ?> alt="">
		</div>
		<div class="dishes__item"  data-menu="child">
				<p  data-menu="child"><?php echo get_field('заголовок_блюдо_3', 46) ?></p>
				<img  data-menu="child" data-src=<?php echo get_field('картинка_блюдо_3', 46) ?> alt="">
		</div> 
	</div> 
	<section class="line-wrap">
		<div class="services">
						<div class="services__item services__item--gallery">
								<p>фотогалерея</p>
								<img data-src="wp-content/uploads/2018/07/slide5.jpg" alt="">
						</div>
						<div class="services__item services__item--about">
								<p>о нас</p>
								<img data-src="wp-content/uploads/2018/07/slide6.jpg" alt="">
						</div>
						<div class="services__item services__item--booking">
								<a href="/гостевая/">
										<p>гостевая книга</p>
										<img data-src="wp-content/uploads/2018/07/slide2.jpg" alt="">
								</a>
						</div>
		</div>
	</section>
</section>

<section class="info-wrap">
    <div class="info info--hidden">
        <div class="info-border"></div>
    </div>
</section><!--info-wrap-->

<?php get_footer(); ?>