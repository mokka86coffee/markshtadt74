<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ресторан "Маркштадт"</title>
    <style>
        /*-------------------------------------preloader---------------------------------------------------------*/

.preloader {
	position: fixed;
  top: 0; left: 0;
	width: 100%;
	height: 100%;
	background: #212227;
  z-index: 1000;
  overflow: hidden;
}

.preloader.hidden {
  opacity: 0;
  width: 0;
  height: 0;
  transition: opacity 1s 0s, width 0s 1s, height 0s 1s;
}

.cssload-loader {
  position: absolute;
  left: calc(50% - 31px);
  width: 100px;
  height: 100px;
  /* margin: 130px 0; */
  -webkit-perspective: 780px;
  perspective: 780px;
  top: calc(50% - 50px);
}

.cssload-inner {
  position: absolute;
  width: 100%;
  height: 100%;
  box-sizing: border-box;
  -o-box-sizing: border-box;
  -ms-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  border-radius: 50%;
  -o-border-radius: 50%;
  -ms-border-radius: 50%;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
}
.cssload-inner.cssload-one {
  left: 0%;
  top: 0%;
  animation: cssload-rotate-one 1.15s linear infinite;
  -o-animation: cssload-rotate-one 1.15s linear infinite;
  -ms-animation: cssload-rotate-one 1.15s linear infinite;
  -webkit-animation: cssload-rotate-one 1.15s linear infinite;
  -moz-animation: cssload-rotate-one 1.15s linear infinite;
  border-bottom: 3px solid #5C5EDC;
}
.cssload-inner.cssload-two {
  right: 0%;
  top: 0%;
  animation: cssload-rotate-two 1.15s linear infinite;
  -o-animation: cssload-rotate-two 1.15s linear infinite;
  -ms-animation: cssload-rotate-two 1.15s linear infinite;
  -webkit-animation: cssload-rotate-two 1.15s linear infinite;
  -moz-animation: cssload-rotate-two 1.15s linear infinite;
  border-right: 3px solid rgba(76, 70, 101, 0.99);
}
.cssload-inner.cssload-three {
  right: 0%;
  bottom: 0%;
  animation: cssload-rotate-three 1.15s linear infinite;
  -o-animation: cssload-rotate-three 1.15s linear infinite;
  -ms-animation: cssload-rotate-three 1.15s linear infinite;
  -webkit-animation: cssload-rotate-three 1.15s linear infinite;
  -moz-animation: cssload-rotate-three 1.15s linear infinite;
  border-top: 3px solid #e9908a;
}

@keyframes cssload-rotate-one {
  0% {
    -webkit-transform: rotateX(35deg) rotateY(-45deg) rotateZ(0deg);
            transform: rotateX(35deg) rotateY(-45deg) rotateZ(0deg);
  }
  100% {
    -webkit-transform: rotateX(35deg) rotateY(-45deg) rotateZ(360deg);
            transform: rotateX(35deg) rotateY(-45deg) rotateZ(360deg);
  }
}
@-webkit-keyframes cssload-rotate-one {
  0% {
    -webkit-transform: rotateX(35deg) rotateY(-45deg) rotateZ(0deg);
  }
  100% {
    -webkit-transform: rotateX(35deg) rotateY(-45deg) rotateZ(360deg);
  }
}
@keyframes cssload-rotate-two {
  0% {
    -webkit-transform: rotateX(50deg) rotateY(10deg) rotateZ(0deg);
            transform: rotateX(50deg) rotateY(10deg) rotateZ(0deg);
  }
  100% {
    -webkit-transform: rotateX(50deg) rotateY(10deg) rotateZ(360deg);
            transform: rotateX(50deg) rotateY(10deg) rotateZ(360deg);
  }
}
@-webkit-keyframes cssload-rotate-two {
  0% {
    -webkit-transform: rotateX(50deg) rotateY(10deg) rotateZ(0deg);
  }
  100% {
    -webkit-transform: rotateX(50deg) rotateY(10deg) rotateZ(360deg);
  }
}
@keyframes cssload-rotate-three {
  0% {
    -webkit-transform: rotateX(35deg) rotateY(55deg) rotateZ(0deg);
            transform: rotateX(35deg) rotateY(55deg) rotateZ(0deg);
  }
  100% {
    -webkit-transform: rotateX(35deg) rotateY(55deg) rotateZ(360deg);
            transform: rotateX(35deg) rotateY(55deg) rotateZ(360deg);
  }
}
@-webkit-keyframes cssload-rotate-three {
  0% {
    -webkit-transform: rotateX(35deg) rotateY(55deg) rotateZ(0deg);
  }
  100% {
    -webkit-transform: rotateX(35deg) rotateY(55deg) rotateZ(360deg);
  }
}
/*-------------------------------------preloader---------------------------------------------------------*/

</style>
</head>
<body>
<div class="preloader">
   <div class='cssload-loader'>
     <div class='cssload-inner cssload-one'></div>
     <div class='cssload-inner cssload-two'></div>
     <div class='cssload-inner cssload-three'></div>
  </div>
</div>
<section class="nav-wrap">
    <nav class="nav">
        <div class="nav__social-icons">
            <a href="<?php echo get_field('инстаграм', 46) ?>"> <img data-src="/wp-content/uploads/2019/03/instagram-manifest-station.png" alt=""> </a>
            <a href="<?php echo get_field('вконтакте', 46) ?>"> <img data-src="/wp-content/uploads/2019/03/woodicon006.png" alt=""> </a>
            <a href="<?php echo get_field('facebook', 46) ?>"> <img data-src="/wp-content/uploads/2019/03/woodicon028.png" alt=""> </a>
            <a href="<?php echo get_field('twitter', 46) ?>"> <img data-src="/wp-content/uploads/2019/03/woodicon100.png" alt=""> </a>
        </div>
        <ul class="nav__navigation">
            <li><a href="/">Главная</a></li>
            <li><a href="#" data-href="gallery">Фотогалерея</a></li>
            <li><a href="#" data-href="offers">Акции</a></li>
            <li><a href="#" data-href="news">Новости</a></li>
			      <li><a href="#" data-href="contacts">Контакты</a></li>
            <?php /*wp_nav_menu(array(
              'theme_location'  => '',
              'menu'            => '', 
              'container'       => '',) ); */
            ?>
        </ul>
    </nav>
</section>

<section class="content-wrap">
    <header class="header">
        <div class="header-contacts">
            <div class="header-contacts__chip header-contacts__chip--phone">
                <img data-src="/wp-content/uploads/2019/03/phone.png" alt="">
                <p>
                    <?php echo get_field('телефон', 46) ?><br />
                    <span><?php echo get_field('email', 46) ?></span> 
                </p>   
            </div>
        </div>
        <div class="header-title">
            <div class="header-title__square">
                <div></div>
            </div>
            <h1 class="h1"><?php echo get_field('заголовок_левая_часть', 46) . ' <b>' . get_field('заголовок_правая_часть', 46) . '</b>'  ?></h1>
        </div>
        <div class="header-logo">
			  <?php the_custom_logo(); ?>
        </div>
    </header>
    <div class="callback">
        <?php echo do_shortcode('[contact-form-7 id="457" title="Маркштадт форма"]'); ?>
    </div>

			

	
	<?php wp_head(); ?>