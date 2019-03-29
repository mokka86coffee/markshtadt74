<?php

// ------------------------------- выборка блюд для конкретнй подкатегории------------------------------

if ( isset($_GET['bluda_id']) ) {

$categ_id = '';
if ( $_GET['bluda_id'] == 'child' ) {
    $categ_id = 206;
} elseif ( $_GET['bluda_id'] == 'banket' ) {
    $categ_id = 204;
} else {
    $categ_id = 202;
} 

$arr = array(
    'title' => get_the_title($categ_id), 
    'img' => get_field('фоновая_картинка', $categ_id), 
    'description' => get_field('краткое_описание', $categ_id) );

$whole_menu = get_field('общее_меню', $categ_id);  

foreach ($whole_menu as $key_zag => $zagolovok) {
        
$one_list =  $zagolovok['список'];
    foreach ( $one_list as $key_podzag => $items ) {
        $arr[$zagolovok['заголовок_меню']][$items['название_блюда']] = $items['стоимость_блюда'];
    }
}

echo json_encode($arr);
exit();


}


if (isset($_GET['rassil'])) {

exit();
}
// ------------------------------- выборка блюд для конкретной подкатегории------------------------------

// ------------------------------- выборка фотографий для конкретнй галереи------------------------------
if ( isset($_GET['halls']) ) {


$pics = [];

$fields = get_field('галереи',241);

foreach ($fields as $key => $value) {
    $pics[$value['название']]=$value['фотографии'];
}

    echo json_encode($pics);
    exit();
}


// ------------------------------- выборка фотографий для конкретнй галереи------------------------------

// --------------------------------------------мои функции-----------------------------------------------


//скрываем визуальный редактор для шаблона главной страницы start
function wph_hide_editor() {
    // $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
    // if(!isset($post_id)) return;
 
    // $template_file = get_post_meta($post_id, '_wp_page_template', true);
    // if( ($template_file == 'front-page.php') || ($template_file == 'sigle.php') ){ 
        remove_post_type_support('post', 'editor');
        remove_post_type_support('page', 'editor');
    // }
}
add_action('admin_init', 'wph_hide_editor');
// add_action( 'init', 'my_remove_post_excerpt_feature' );
// function my_remove_post_excerpt_feature() {
//     remove_post_type_support( 'xxx', 'excerpt' );
// }
//скрываем визуальный редактор для шаблона главной страницы end

function example_dashboard_widget_function(){
    // Показать то, что вы хотите показать
    echo "Привет, мир. Я — великий виджет админки, созданный великими программистами";
}
// Создаем функцию, используя хук действия
function example_add_dashboard_widgets() {
    wp_add_dashboard_widget('example_dashboard_widget', 'Пример виджета админки', 'example_dashboard_widget_function');
}
// Хук в 'wp_dashboard_setup', чтобы зарегистрировать нашу функцию среди других
add_action('wp_dashboard_setup', 'example_add_dashboard_widgets' );


## Удаление виджетов из Консоли WordPress
add_action( 'wp_dashboard_setup', 'clear_dash', 99 );
function clear_dash(){
    $side   = & $GLOBALS['wp_meta_boxes']['dashboard']['side']['core'];
    $normal = & $GLOBALS['wp_meta_boxes']['dashboard']['normal']['core'];

    // die( print_r($GLOBALS['wp_meta_boxes']['dashboard']) ); // смотрим что есть...

    $remove = array(
        //'dashboard_activity', // последняя активность
        'dashboard_primary',  // новости wordpress
        //'dashboard_right_now',  // консоль
    );
    foreach( $remove as $id ){
        if    ( isset($side[$id]) )   unset( $side[$id] );
        elseif( isset($normal[$id]) ) unset( $normal[$id] );
    }

    // remove welcome panel
    remove_action('welcome_panel', 'wp_welcome_panel');
}


add_action('admin_head', 'custom_colors');
function custom_colors() {
    echo '<style type="text/css">
    #wphead{background:#222;}
    </style>';
}//---------------------------------------не работает, админ панель цвет



function my_admin_help($text, $screen) {
    // Проверим, только ли для страницы настроек это применимо
    if (strcmp($screen, MY_PAGEHOOK) == 0 ) {
        $text = 'Вот некоторая полезная информация, которая поможет вам разобраться с плагином...';
        return $text;
    }
    // Пусть по умолчанию штуки с помощью будут и на других страницах панели управления
    return $text;
}
//add_action( 'contextual_help', 'my_admin_help' );//---------------------------------------не работает, админ панель советы

## Произвольный порядок пунктов в главном меню админки
if( is_admin() ){
    add_filter('custom_menu_order', '__return_true'); // включаем ручную сортировку
    add_filter('menu_order', 'custom_menu_order'); // ручная сортировка
    function custom_menu_order( $menu_order ){
        /*
        $menu_order - массив где элементы меню выставлены в нужном порядке.
        Array(
            [0] => index.php
            [1] => separator1
            [2] => edit.php
            [3] => upload.php
            [4] => edit.php?post_type=page
            [5] => edit-comments.php
            [6] => edit.php?post_type=events
            [7] => separator2
            [8] => themes.php
            [9] => plugins.php
            [10] => snippets
            [11] => users.php
            [12] => tools.php
            [13] => options-general.php
            [14] => separator-last
            [15] => edit.php?post_type=cfs
        )
        */
        if( ! $menu_order ) return true;

        return array(
            'index.php', // консоль
            'edit.php?post_type=page', // страницы
            'edit.php', // посты
            'edit.php?post_type=events', // записи типа events
        );
    }
}

//add_action('init', 'registers_post_types');    //  //------новая запись в админку
function registers_post_types(){
    register_post_type('post_type_name', array(
        'label'  => null,
        'labels' => array(
            'name'               => '_ssssss_', // основное название для типа записи
            'singular_name'      => '____', // название для одной записи этого типа
            'add_new'            => 'Добавить ____', // для добавления новой записи
            'add_new_item'       => 'Добавление ____', // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item'          => 'Редактирование ____', // для редактирования типа записи
            'new_item'           => 'Новое ____', // текст новой записи
            'view_item'          => 'Смотреть ____', // для просмотра записи этого типа.
            'search_items'       => 'Искать ____', // для поиска по этим типам записи
            'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
            'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
            'parent_item_colon'  => '', // для родителей (у древовидных типов)
            'menu_name'          => '____', // название меню
        ),
        'description'         => '',
        'public'              => true,
        'publicly_queryable'  => null, // зависит от public
        'exclude_from_search' => null, // зависит от public
        'show_ui'             => null, // зависит от public
        'show_in_menu'        => null, // показывать ли в меню адмнки
        'show_in_admin_bar'   => null, // по умолчанию значение show_in_menu
        'show_in_nav_menus'   => null, // зависит от public
        'show_in_rest'        => null, // добавить в REST API. C WP 4.7
        'rest_base'           => null, // $post_type. C WP 4.7
        'menu_position'       => null,
        'menu_icon'           => null, 
        //'capability_type'   => 'post',
        //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
        //'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
        'hierarchical'        => false,
        'supports'            => array('title','editor'), // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
        'taxonomies'          => array(),
        'has_archive'         => false,
        'rewrite'             => true,
        'query_var'           => true,
    ) );
}




## Добавляем все типы записей в виджет "Прямо сейчас" в консоли
//add_action( 'dashboard_glance_items' , 'add_right_now_info' );
function add_right_now_info( $items ){

    if( ! current_user_can('edit_posts') ) return $items; // выходим

    // типы записей
    $args = array( 'public' => true, '_builtin' => false );

    $post_types = get_post_types( $args, 'object', 'and' );

    foreach( $post_types as $post_type ){
        $num_posts = wp_count_posts( $post_type->name );
        $num       = number_format_i18n( $num_posts->publish );
        $text      = _n( $post_type->labels->singular_name, $post_type->labels->name, intval( $num_posts->publish ) );

        $items[] = "<a href=\"edit.php?post_type=$post_type->name\">$num $text</a>";
    }

    // таксономии
    $taxonomies = get_taxonomies( $args, 'object', 'and' );

    foreach( $taxonomies as $taxonomy ){
        $num_terms = wp_count_terms( $taxonomy->name );
        $num       = number_format_i18n( $num_terms );
        $text      = _n( $taxonomy->labels->singular_name, $taxonomy->labels->name , intval( $num_terms ) );

        $items[] = "<a href='edit-tags.php?taxonomy=$taxonomy->name'>$num $text</a>";
    }

    // пользователи
    global $wpdb;

    $num  = $wpdb->get_var("SELECT COUNT(ID) FROM $wpdb->users");
    $text = _n( 'User', 'Users', $num );

    $items[] = "<a href='users.php'>$num $text</a>";

    return $items;
}


## Удаление табов "Все рубрики" и "Часто используемые" из метабоксов рубрик (таксономий) на странице редактирования записи.
//add_action('admin_print_footer_scripts', 'hide_tax_metabox_tabs_admin_styles', 99);
function hide_tax_metabox_tabs_admin_styles(){
    $cs = get_current_screen();
    if( $cs->base !== 'post' || empty($cs->post_type) ) return; // не страница редактирования записи
    ?>
    <style>
        .postbox div.tabs-panel{ max-height:1200px; border:0; }
        .category-tabs{ display:none; }
    </style>
    <?php
}



// Отключаем все стандартные виджеты WordPress
// add_action('widgets_init', 'unregister_basic_widgets' );
function unregister_basic_widgets() {
    unregister_widget('WP_Widget_Pages');            // Виджет страниц
    unregister_widget('WP_Widget_Calendar');         // Календарь
    unregister_widget('WP_Widget_Archives');         // Архивы
    unregister_widget('WP_Widget_Links');            // Ссылки
    unregister_widget('WP_Widget_Meta');             // Мета виджет
    unregister_widget('WP_Widget_Search');           // Поиск
    unregister_widget('WP_Widget_Text');             // Текст
    unregister_widget('WP_Widget_Categories');       // Категории
    unregister_widget('WP_Widget_Recent_Posts');     // Последние записи
    unregister_widget('WP_Widget_Recent_Comments');  // Последние комментарии
    unregister_widget('WP_Widget_RSS');              // RSS
    unregister_widget('WP_Widget_Tag_Cloud');        // Облако меток
    unregister_widget('WP_Nav_Menu_Widget');         // Меню
}

## заменим слово "записи" на "посты" для типа записей 'post'
add_filter('post_type_labels_post', 'rename_posts_labels');
function rename_posts_labels( $labels ){
    // заменять автоматически нельзя: Запись = Статья, а в тексте получим "Просмотреть статья"

    $new = array(
        'name'                  => 'Объекты',
        'singular_name'         => 'Объект',
        'add_new'               => 'Добавить объект',
        'add_new_item'          => 'Добавить объект',
        'edit_item'             => 'Редактировать объект',
        'new_item'              => 'Новый объект',
        'view_item'             => 'Просмотреть объект',
        'search_items'          => 'Поиск объектов',
        'not_found'             => 'Объекты не найдены.',
        'not_found_in_trash'    => 'Объекты в корзине не найдены.',
        'parent_item_colon'     => '',
        'all_items'             => 'Всё меню',
        'archives'              => 'Архивы объектов',
        'insert_into_item'      => 'Вставить в объект',
        'uploaded_to_this_item' => 'Загруженные для этого объекты',
        'featured_image'        => 'Миниатюра объекта',
        'filter_items_list'     => 'Фильтровать список объектов',
        'items_list_navigation' => 'Навигация по списку объектов',
        'items_list'            => 'Список объектов',
        'menu_name'             => 'Меню',
        'name_admin_bar'        => 'Объекты', // пункте "добавить"
    );

    return (object) array_merge( (array) $labels, $new );
}




## Удаление файлов license.txt и readme.html для защиты
// if( is_admin() && ! defined('DOING_AJAX') ){
//  $license_file = ABSPATH .'/license.txt';
//  $readme_file = ABSPATH .'/readme.html';

//  if( file_exists($license_file) && current_user_can('manage_options') ){
//      $deleted = unlink($license_file) && unlink($readme_file);

//      if( ! $deleted  )
//          $GLOBALS['readmedel'] = 'Не удалось удалить файлы: license.txt и readme.html из папки `'. ABSPATH .'`. Удалите их вручную!';
//      else
//          $GLOBALS['readmedel'] = 'Файлы: license.txt и readme.html удалены из из папки `'. ABSPATH .'`.';

//      add_action( 'admin_notices', function(){  echo '<div class="error is-dismissible"><p>'. $GLOBALS['readmedel'] .'</p></div>'; } );
//  }
// }




## Фильтр элементов таксономии для метабокса таксономий в админке.
## Позволяет удобно фильтровать (искать) элементы таксономии по назанию, когда их очень много
// add_action( 'admin_print_scripts', 'my_admin_term_filter', 99 );
function my_admin_term_filter() {
    $screen = get_current_screen();

    if( 'post' !== $screen->base ) return; // только для страницы редактирвоания любой записи
    ?>
    <script>
    jQuery(document).ready(function($){
        var $categoryDivs = $('.categorydiv');

        $categoryDivs.prepend('<input type="search" class="fc-search-field" placeholder="фильтр..." style="width:100%" />');

        $categoryDivs.on('keyup search', '.fc-search-field', function (event) {

            var searchTerm = event.target.value,
                $listItems = $(this).parent().find('.categorychecklist li');

            if( $.trim(searchTerm) ){
                $listItems.hide().filter(function () {
                    return $(this).text().toLowerCase().indexOf(searchTerm.toLowerCase()) !== -1;
                }).show();
            }
            else {
                $listItems.show();
            }
        });
    });
    </script>
    <?php
}



// Если есть обновления плагинов, то в меню мы видим кружок с числом плагинов. Такие же кружки с номерами можно добавить к любому пункту меню. Например, нам нужно показывать такое уведомление, если есть записи на проверке:

// add_action( 'admin_menu', 'add_user_menu_bubble' );
function add_user_menu_bubble(){
    global $menu;

    // записи
    $count = wp_count_posts()->pending; // на утверждении
    if( $count ){
        foreach( $menu as $key => $value ){
            if( $menu[$key][2] == 'edit.php' ){
                $menu[$key][0] .= ' <span class="awaiting-mod"><span class="pending-count">' . $count . '</span></span>';
                break;
            }
        }
    }
}




// Подключение скрипта html5 для IE с cdn
// add_action('wp_head', 'IEhtml5_shim_func');
function IEhtml5_shim_func(){
    echo '<!--[if lt IE 9]><script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script><![endif]-->';
    // или если нужна еще и поддержка при печати
    // echo '<!--[if lt IE 9]><script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv-printshiv.min.js"></script><![endif]-->';
}


## Полное Удаление версии WP
## Также нужно удалить файл readme.html в корне сайта
remove_action('wp_head', 'wp_generator'); // из заголовка
add_filter('the_generator', '__return_empty_string'); // из фидов и URL


## CSS стили для админ-панели. Нужно создать файл 'wp-admin.css' в папке темы
add_action('admin_enqueue_scripts', 'my_admin_css', 99);
function my_admin_css(){
    wp_enqueue_style('my-wp-admin', get_template_directory_uri() .'/wp-admin.css' );
}


## Изменение текста в подвале админ-панели
add_filter('admin_footer_text', 'footer_admin_func');
function footer_admin_func () {
    echo 'Разработка темы: <a href="#" target="_blank">Вашеssss имя</a>. Работает на <a href="http://wordpress.org" target="_blank">WordPress</a>.';
}
// --------------------------------------------мои функции---------------------------------------



function myfirsttheme_scripts() {
    //jquery
    // wp_deregister_script('jquery');
    // wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js');
    // wp_enqueue_script('jquery');

    wp_enqueue_style( 'main', get_stylesheet_uri() );

    


    //мои
      // скрипт
      wp_enqueue_script( 'js', get_template_directory_uri() . '/js.js', array('jquery'), '1.0.0', true );
    //   wp_enqueue_script( 'slick', get_template_directory_uri() . '/slick.min.js', array('jquery'), '1.0.0', true );

      // шрифт
      // wp_register_script('font', '//fonts.googleapis.com/css?family=Montserrat', false, null, false);
      // wp_enqueue_script('font');

      // стили
    //   wp_enqueue_style( 'slick', get_template_directory_uri() . '/slick.css' );
    //   wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/slick-theme.css' );


   
}
add_action( 'wp_enqueue_scripts', 'myfirsttheme_scripts' );



// ------------------------------создание произвольных полей----------




// ------------------------таксономия и новый тип записей sheensay!!!!!!!!!!!!!!!!!!!!!!!!!!!!
add_action( 'init', 'sheensay_post_type' );
 
function sheensay_post_type() {
 
        // Регистрируем таксономию
        register_taxonomy(
                'sheensay_product_type', 'sheensay_product', array(
            'label' => 'Типы',
            'hierarchical' => true, // Если TRUE, таксономия будет аналогом рубрик (категорий). Если FALSE (по умолчанию), то таксономия станет аналогом меток (тегов).
            'rewrite' => array( 'slug' => 'тип-продукции' ),
                )
        );
 
    // Регистрируем произвольный тип записи (Custom Post Type)
    register_post_type( 'sheensay_product', array(
        'labels' => array(
            'name' => 'Продукция',
            'singular_name' => 'Продукцию',
        ),
        'public' => true,
        'rewrite' => array( 'slug' => 'продукция' ), // Тут определяется ярлык CPT
        'has_archive' => true,
        'supports' => array( 'title', 'editor', 'thumbnail' ), // Включаем поддержку заголовка, редактора, миниатюры
            )
    );
}
// ------------------------таксономия и новый тип записей sheensay!!!!!!!!!!!!!!!!!!!!!!!!!!!!








add_action('init', 'register_post_types');    //  //------новая запись в админку
function register_post_types(){

    // Регистрируем таксономию
        register_taxonomy(
                'moi_posty_taxonomiya', 'posty', array(
            'label' => 'Виды постов',
            'hierarchical' => true, // Если TRUE, таксономия будет аналогом рубрик (категорий). Если FALSE (по умолчанию), то таксономия станет аналогом меток (тегов).
            'rewrite' => array( 'slug' => 'вид-поста' ),
                )
        );

//Регистрируем новые страницы/посты с новой таксономией
    register_post_type('posty', array(
        'label'  => '',
        'labels' => array(
            'name'               => 'Посты', // основное название для типа записи
            'singular_name'      => 'Пост', // название для одной записи этого типа
            'add_new'            => 'Добавить пост', // для добавления новой записи
            'add_new_item'       => 'Добавление поста', // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item'          => 'Редактирование поста', // для редактирования типа записи
            'new_item'           => 'Новое ____', // текст новой записи
            'view_item'          => 'Смотреть запись', // для просмотра записи этого типа.
            'search_items'       => 'Искать пост', // для поиска по этим типам записи
            'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
            'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
            'parent_item_colon'  => '', // для родителей (у древовидных типов)
            'menu_name'          => 'Посты здесь', // название меню
        ),
        'description'         => '',
        'public'              => true,
        'publicly_queryable'  => null, // зависит от public
        'exclude_from_search' => null, // зависит от public
        'show_ui'             => null, // зависит от public
        'show_in_menu'        => true, // показывать ли в меню адмнки
        'show_in_admin_bar'   => null, // по умолчанию значение show_in_menu
        'show_in_nav_menus'   => null, // зависит от public
        'show_in_rest'        => null, // добавить в REST API. C WP 4.7
        'rest_base'           => null, // $post_type. C WP 4.7
        'menu_position'       => null,
        'menu_icon'           => null, 
        //'capability_type'   => 'post',
        //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
        //'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
        'hierarchical'        => false,
        'supports'            => array('title','editor','thumbnail'), // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
        'taxonomies'          => array(),
        'has_archive'         => false,
        'rewrite'             => true,
        'query_var'           => true,
    ) );
}

// Миниатюры для постов
add_theme_support( 'post-thumbnails', array( 'post' ) );
add_theme_support('custom-logo');


// Добавляем дополнительное поле
function my_meta_box() {  
    add_meta_box(  
        'my_meta_box', // Идентификатор(id)
        'My Meta Box', // Заголовок области с мета-полями(title)
        'show_my_metabox', // Вызов(callback)
        'posty', // Где будет отображаться наше поле, в нашем случае в Новой категории 'posty'
        'normal', 
        'high');
}  
add_action('add_meta_boxes', 'my_meta_box'); // Запускаем функцию



add_theme_support( 'html5', array( 'search-form' ) );
add_filter( 'get_search_form', 'my_search_form' );
function my_search_form( $form ) {

    $form = '
    <form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
        <label class="screen-reader-text" for="s">Запрос для поиска:</label>
        <input type="text" value="' . get_search_query() . '" name="s" id="s" />
        <input type="submit" id="searchsubmit" value="Найти" />
    </form>';

    return $form;
}
//поиск






//Описываем(создаем) новые поля

$meta_fields = array(  
    array(  
        'label' => 'Текстовое поле',  
        'desc'  => 'Описание для поля.',  
        'id'    => 'mytextinput', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),  
    array(  
        'label' => 'Большое текстовое поле',  
        'desc'  => 'Описание для поля.',  
        'id'    => 'mytextarea',  // даем идентификатор.
        'type'  => 'textarea'  // Указываем тип поля.
    ),  
    // array(  
    //     'label' => 'Чекбоксы (флажки)',  
    //     'desc'  => 'Описание для поля.Чекбоксы (флажки)',  
    //     'id'    => 'mycheckbox',  // даем идентификатор.
    //     'type'  => 'checkbox'  // Указываем тип поля.
    // ),  
    array(  
        'label' => 'Всплывающий список',  
        'desc'  => 'Описание для поля.',  
        'id'    => 'myselect',  
        'type'  => 'select',  
        'options' => array (  // Параметры, всплывающие данные
            'one' => array (  
                'label' => 'Вариант 1Всплывающий список',  // Название поля
                'value' => '1'  // Значение
            ),  
            'two' => array (  
                'label' => 'Вариант 2Всплывающий список',  // Название поля
                'value' => '2'  // Значение
            ),  
            'three' => array (  
                'label' => 'Вариант 3Всплывающий список',  // Название поля
                'value' => '3'  // Значение
            )  
        )  
    ),
    array(
        'label' => 'Доступные размеры',
        'desc' => '48 - 50 RUS',
        'id' => 'mycheckbox',
        'type' => 'checkbox', // Указываем тип поля.
        'value' => array ('46-48 RUS','48-50 RUS','50-52 RUS','52-54 RUS','54-56 RUS')
    ),  
);

// Вызов метаполей  
function show_my_metabox() {  
global $meta_fields; // Обозначим наш массив с полями глобальным
global $post;  // Глобальный $post для получения id создаваемого/редактируемого поста
// Выводим скрытый input, для верификации. Безопасность прежде всего!
echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';  
 
    // Начинаем выводить таблицу с полями через цикл
    echo '<table class="form-table">';  
    foreach ($meta_fields as $field) {  
        // Получаем значение если оно есть для этого поля 
        $meta = get_post_meta($post->ID, $field['id'], true);  
        // Начинаем выводить таблицу
        echo '<tr> 
                <th><label for="'.$field['id'].'">'.$field['label'].'</label></th> 
                <td>';  
                switch($field['type']) {  
                   // Текстовое поле
                   case 'text':  
                       echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" /> 
                           <br /><span class="description">'.$field['desc'].'</span>';  
                   break;
                   // Зона Текста 
                   case 'textarea':  
                       echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="60" rows="4">'.$meta.'</textarea> 
                           <br /><span class="description">'.$field['desc'].'</span>';  
                   break;
                   // Чекбокс  
                   // case 'checkbox':  
                   //     echo '<input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" ',$meta ? ' checked="checked"' : '','/> 
                   //         <label for="'.$field['id'].'">'.$field['desc'].'</label>';  
                   // break;
                   // Всплывающий список  
                   case 'select':  
                       echo '<select name="'.$field['id'].'" id="'.$field['id'].'">';  
                       foreach ($field['options'] as $option) {  
                           echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';  
                       }  
                       echo '</select><br /><span class="description">'.$field['desc'].'</span>';  
                   break;
                   //Чекбоксы
                   case 'checkbox':
                       foreach ($field['value'] as $value){
                           echo '<input type="checkbox" name="mycheckbox[]" value="'.$value.'" id="mycheckbox['.$value.']" ';
                           foreach($meta as $val){
                           if ($val == $value)
                           echo ' checked="checked";} />';}
                           echo '<label for="mycheckbox['.$value.']">'.$value.'</label>';
                       }
                       break;
                }     
        echo '</td></tr>';  
    }  
    echo '</table>'; 
}
// Пишем функцию для сохранения
function save_my_meta_fields($post_id) {  
    global $meta_fields;  // Массив с нашими полями
 
    // проверяем наш проверочный код 
    if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))   
        return $post_id;  
    // Проверяем авто-сохранение 
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)  
        return $post_id;  
    // Проверяем права доступа  
    if ('page' == $_POST['post_type']) {  
        if (!current_user_can('edit_page', $post_id))  
            return $post_id;  
        } elseif (!current_user_can('edit_post', $post_id)) {  
            return $post_id;  
    }  
 
    // Если все отлично, прогоняем массив через foreach
    foreach ($meta_fields as $field) {  
        $old = get_post_meta($post_id, $field['id'], true); // Получаем старые данные (если они есть), для сверки
        $new = $_POST[$field['id']];  
        if ($new && $new != $old) {  // Если данные новые
            update_post_meta($post_id, $field['id'], $new); // Обновляем данные
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id, $field['id'], $old); // Если данных нету, удаляем мету.
        }  
    } // end foreach  
}  
add_action('save_post', 'save_my_meta_fields'); // Запускаем функцию сохранения


















// подключаем функцию активации мета блока (my_extra_fields)
add_action('add_meta_boxes', 'my_extra_fields', 1);

function my_extra_fields() {
    add_meta_box( 'extra_fields', 'Дополнительные поля', 'extra_fields_box_func', 'ven', 'normal', 'high'  );
}

// код блока
function extra_fields_box_func( $post ){
    ?>
    <p><label><input type="text" name="extra[title]" value="<?php echo get_post_meta($post->ID, 'title', 1); ?>" style="width:50%" /> ? заголовок страницы (title)</label></p>

    <p>Описание статьи (description):
        <textarea type="text" name="extra[description]" style="width:100%;height:50px;"><?php echo get_post_meta($post->ID, 'description', 1); ?></textarea>
    </p>

    <p>Видимость поста: <?php $mark_v = get_post_meta($post->ID, 'robotmeta', 1); ?>
         <label><input type="radio" name="extra[robotmeta]" value="" <?php checked( $mark_v, '' ); ?> /> index,follow</label>
         <label><input type="radio" name="extra[robotmeta]" value="nofollow" <?php checked( $mark_v, 'nofollow' ); ?> /> nofollow</label>
         <label><input type="radio" name="extra[robotmeta]" value="noindex" <?php checked( $mark_v, 'noindex' ); ?> /> noindex</label>
         <label><input type="radio" name="extra[robotmeta]" value="noindex,nofollow" <?php checked( $mark_v, 'noindex,nofollow' ); ?> /> noindex,nofollow</label>
    </p>

    <p><select name="extra[select]">
            <?php $sel_v = get_post_meta($post->ID, 'select', 1); ?>
            <option value="0">----</option>
            <option value="1" <?php selected( $sel_v, '1' )?> >Выбери меня</option>
            <option value="2" <?php selected( $sel_v, '2' )?> >Нет, меня</option>
            <option value="3" <?php selected( $sel_v, '3' )?> >Лучше меня</option>
        </select> ? выбор за вами</p>

    <input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
    <?php
}
// включаем обновление полей при сохранении
add_action('save_post', 'my_extra_fields_update', 0);

/* Сохраняем данные, при сохранении поста */
function my_extra_fields_update( $post_id ){
    if ( ! wp_verify_nonce($_POST['extra_fields_nonce'], __FILE__) ) return false; // проверка
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE  ) return false; // выходим если это автосохранение
    if ( !current_user_can('edit_post', $post_id) ) return false; // выходим если юзер не имеет право редактировать запись

    if( !isset($_POST['extra']) ) return false; // выходим если данных нет

    // Все ОК! Теперь, нужно сохранить/удалить данные
    $_POST['extra'] = array_map('trim', $_POST['extra']); // чистим все данные от пробелов по краям
    foreach( $_POST['extra'] as $key=>$value ){
        if( empty($value) ){
            delete_post_meta($post_id, $key); // удаляем поле если значение пустое
            continue;
        }

        update_post_meta($post_id, $key, $value); // add_post_meta() работает автоматически
    }
    return $post_id;
}

// Вывод формы добавления комментариев

