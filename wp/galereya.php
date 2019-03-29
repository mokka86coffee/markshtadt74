<?php 
/*Template name: Галерея*/
?>
<?php get_header(); ?>

<div class="gallery">
        <!-- <h1>Фотогалерея</h1> -->
	<div class="container">
		<div class="leftSide">
			<h2>Фотогалерея</h2>
			<p>Мы всегда выкладываем фото и видео материалы в галерею. Мы всегда выкладываем фото и видео материалы в галерею.</p>
		</div>
        <div class="wrap">
        	
        		<?php 
                 $fields = get_field('для_отображения'); $i=0;
                 foreach ($fields as $key => $value) {
                 	echo '<div class="wrap_ins" name="' . $i . '">' . 
                 	'<img src="' . $value['фото'] . '" alt="">' . 
                 	'<p>' . $value['название'] . '</p></div>'; $i++;
                 }
	        	?>
	        	<!-- <div class="dop_ins"> -->
	        	<!-- 	<img src="" alt="">
	        		<img src="" alt="">
	        		<img src="" alt="">
		        	<img src="" alt="">
		        	<img src="" alt="">
	        		<img src="" alt="">
		        	<img src="" alt="">
		        	<img src="" alt="">
		        	<img src="" alt="">
		        	<img src="" alt=""> -->
	        	<!-- </div> -->
        	</div>
        </div>
		
	</div>
	<!-- /.container -->

<div class="gal_modul">
	<a></a><div class='cssload-loader'>
     <div class='cssload-inner cssload-one'></div>
     <div class='cssload-inner cssload-two'></div>
     <div class='cssload-inner cssload-three'></div>
  </div>
   <div class="vyrav">
	  <div class="ins"></div>
   </div>
</div>

</div>
<!-- /.gallery -->



<?php get_footer(); ?>