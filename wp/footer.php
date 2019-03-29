
<div class="footer-wrap">
    <footer class="footer">
        <div class="footer-logo">
			<?php the_custom_logo(); ?>
        </div>
        <div class="footer-nav">
            <ul class="footer-nav__column">
                <li><a data-href="gallery" href="#">Фотогалерея</a></li>
                <li><a data-href="offers" href="#">Акции</a></li>
                <li><a data-href="news" href="#">Новости</a></li>
                <li><a href="#" data-href="contacts">Контакты</a></li>
            </ul>
            <ul class="footer-nav__column footer-nav__column--menu">
                <li><a data-menu="main" href="#"><?php echo get_the_title(204) ?></a> </li>
                <li><a data-menu="banket" href="#"><?php echo esc_html( get_the_title(202) ) ?></a></li>
                <li><a data-menu="child" href="#"><?php echo get_the_title(206) ?></a></li>
            </ul>
        </div> 
        <div class="footer-contacts">
            <p class="footer-contacts__address"><?php echo get_field('адрес', 46) ?></p>
            <p class="footer-contacts__phone"><?php echo get_field('телефон', 46) ?></p>
            <p class="footer-contacts__email"><?php echo get_field('email', 46) ?></p>
        </div>
    </footer>
</div> <!--footer-wrap-->

<div class="modal modal--info">
    <div class="modal-info">
        <div class="modal-info__content">
            <h2>О ресторане</h2>
            <p><?php echo get_field('информация_о_ресторане', 46) ?></p>
        </div>
        <div class="modal-info__border"></div>
        <i class="modal__close">x</i>
    </div>
</div>
<!-- modal-info -->

<div class="modal modal--info modal--contacts">
    <div class="modal-info">
        <div class="modal-info__content">
            <h2>Контакты</h2>
            <p><?php echo get_field('адрес', 46) ?></p>
            <p>Телефон: <?php echo get_field('телефон', 46) ?></p>
            <p><a href="mailto:markshtadt@mail.ru">E-mail: <?php echo get_field('email', 46) ?></a></p>
            <iframe data-src="https://yandex.ru/map-widget/v1/-/CCa~VZmY" width="" height="" frameborder="1" allowfullscreen="true"></iframe>    
        </div>
        <div class="modal-info__border"></div>
        <i class="modal__close">x</i>
    </div>
</div>
<!-- modal-info -->

<div class="modal modal--menu">
    <div class="modal-menu">
        <div class="modal-menu__img-wrap">
            <img class="modal-menu__img" data-src="osnovnoe_menu.png" alt="">
        </div>
        <div class="modal-menu__info">
            <h3 class="modal-menu__info-title">Основное меню</h3>
            <p class="modal-menu__info-text"> своем стремлении улучшить пользовательский опыт мы упускаем, что явные признаки победы институциализации </p>
            <div class="modal-menu__content"></div> 
        </div>
        <i class="modal__close">x</i>
    </div>
</div>
<!-- modal-menu -->

<div class="modal modal--photos modal--photos-halls">
    <div class="modal-photos">
        <div class="modal-photos__slider">
            <div class="modal-photos__slide"></div>

            <?php 
                $fields = get_field('галереи', 241);  
                echo '<ul class="modal-photos__tabs">';
                foreach ($fields as $key => $value) {
                   echo "<lI data-text='" . $value['название'] . "'>" . $value['название'] . "</li>"; 
                }
                echo '</ul>'
            ?>
        </div>
        <span class="modal-photos__arrow modal-photos__arrow--left"></span>
        <span class="modal-photos__arrow modal-photos__arrow--right"></span>
        <i class="modal__close">x</i>
    </div>
</div>
<!-- modal-photos-halls -->

<div class="modal modal--photos modal--photos-news">
    <div class="modal-photos">
        <div class="modal-photos__slider">
            <div class="modal-photos__slide">
            <?php 
                $fields = get_field('новости', 46);  
                $i=0;
                foreach ($fields as $key => $value) {
                    if ($i==0) { echo "<img class='modal-photos__img modal-photos__img--active' data-src=" . $value['картинка_для_новости'] . " />"; $i++;}
                    else {  echo "<img class='modal-photos__img' data-src=" . $value['картинка_для_новости'] . " />"; }
                }
                
            ?>
            </div>
        </div>
        <span class="modal-photos__arrow modal-photos__arrow--left"></span>
        <span class="modal-photos__arrow modal-photos__arrow--right"></span>
        <i class="modal__close">x</i>
    </div>
</div>
<!-- modal-photos-news -->

<div class="modal modal--photos modal--photos-offers">
    <div class="modal-photos">
        <div class="modal-photos__slider">
            <div class="modal-photos__slide">
            <?php 
                $fields = get_field('акции', 46);  
                $i=0;
                foreach ($fields as $key => $value) {
                    if ($i==0) { echo "<img class='modal-photos__img modal-photos__img--active' data-src=" . $value['картинка_для_акции'] . " />"; $i++;}
                    else {  echo "<img class='modal-photos__img' data-src=" . $value['картинка_для_акции'] . " />"; }
                }
                
            ?>
            </div>
        </div>
        <span class="modal-photos__arrow modal-photos__arrow--left"></span>
        <span class="modal-photos__arrow modal-photos__arrow--right"></span>
        <i class="modal__close">x</i>
    </div>
</div>
<!-- modal-photos-news -->
<?php wp_footer(); ?>

</body>
</html>