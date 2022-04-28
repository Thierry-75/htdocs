<?php

namespace App;

use AgenceMenuPage;
use SponsoMetaBox;
use WP_Query;

function montheme_supports()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    register_nav_menu('header', 'En tête du menu');
    register_nav_menu('footer', 'Pied de page');

    add_image_size('card-header', '300', '215', true);
}
function montheme_register_assets()
{
    wp_register_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css');
    wp_register_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js', ['popper'], false, true);
    wp_register_script('popper', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js', [], false, true);
    //wp_deregister_script('jquery');
    wp_enqueue_style('bootstrap');
    wp_enqueue_script('bootstrap');
}
function mon_theme_title_separator()
{
    return '|';
}
function montheme_document_title_parts($title)
{
    unset($title['tagline']);
    return $title;
}
function montheme_menu_class(array $classes): array
{
    $classes[] = 'nav-item';
    return $classes;
}
function montheme_menu_link_class(array $attrs): array
{
    $attrs['class'] = 'nav-link';
    return $attrs;
}
function montheme_pagination()
{
    $pages = paginate_links(['type' => 'array']);
    if ($pages === null) {
        return;
    }
    echo '<nav aria-label="Pagination" class="my-4">';
    echo '<ul class="pagination">';

    foreach ($pages as $page) {
        $active = strpos($page, 'current') !== false;
        $class = 'page-item';
        if ($active) {
            $class .= ' active';
        }
        echo '<li class="' . $class . '">';
        echo str_replace('page-numbers', 'page-link', $page);
        echo '</li>';
    }
    echo '</ul>';
    echo '</nav>';
}

function montheme_init()
{
    register_taxonomy('science', 'post', [
        'labels' => [
            'name' => 'Science',
            'singular_name'     => 'Science',
            'plural_name'       => 'Sciences',
            'search_items'      => 'Rechercher des sciences',
            'all_items'         => 'Toutes les sciences',
            'edit_item'         => 'Editer la science',
            'update_item'       => 'Mettre à jour la science',
            'add_new_item'      => 'Ajouter une science nouvelle',
            'new_item_name'     => 'Ajouter une science nouvelle',
            'menu_name'         => 'Science',
        ],
        'show_in_rest' => true,
        'hierarchical' => true,
        'show_admin_column' => true,

    ]);
    register_post_type('chalet',
        ['label'=>'Chalet',
        'public'=>true,
        'menu_position'=> 3,
        'menu_icon'=>'dashicons-admin-multisite',
        'supports'=>['title','editor','thumbnail','comments','author'],
        'show_in_rest'=>true,
        'has_archive'=>true,

        ]);
}


/**  actions */
add_action('init', 'App\montheme_init');
add_action('after_setup_theme', 'App\montheme_supports');
add_action('wp_enqueue_scripts', 'App\montheme_register_assets');
add_filter('document_title_separator', 'App\mon_theme_title_separator');
add_filter('document_title_parts', 'App\montheme_document_title_parts');
add_filter('nav_menu_css_class', 'App\montheme_menu_class');
add_filter('nav_menu_link_attributes', 'App\montheme_menu_link_class');

require_once('metaboxes/sponso.php');
require_once('options/agence.php');

SponsoMetaBox::register();
AgenceMenuPage::register();

add_filter('manage_chalet_posts_columns', function($columns){
       return [
           'cb'=>$columns['cb'],
           'thumbnail'=> 'Miniature',
           'title'=>$columns['title'],
           'date'=>$columns['date']
       ];
});

add_filter('manage_chalet_posts_custom_column', function($column, $postId){
        if ($column === 'thumbnail') {
            the_post_thumbnail('thumbnail', $postId);
        }
},10,2);

add_action('admin_enqueue_scripts', function (){
    wp_enqueue_style('admin_montheme', get_template_directory_uri() . '/assets/admin.css');
});


add_filter('manage_posts_columns', function ($columns){
    $newColumns = [];
    foreach($columns as $key => $value){
        if($key ==='date'){
            $newColumns['sponso'] = 'Article sponsorisé ?';
        }
        $newColumns[$key] = $value;
    }
    return $newColumns;
});

add_filter('manage_post_posts_custom_column', function($column, $postId){
    if ($column === 'sponso') {
        if(!empty(get_post_meta($postId,SponsoMetaBox::META_KEY,true))){
                $class='yes';
        }else{
                $class='no';
        }
        echo '<div class="bullet bullet-' . $class . '"></div>';
      
    }
},10,2);

function montheme_register_widget () {
    register_sidebar([
        'id' => 'homepage',
        'name' => 'Sidebar Accueil',
        'before_widget' => '<div class="p-4 %2$s" id="%1$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="font-italic">',
        'after_title' => '</h4>'
    ]);
}
add_action('widgets_init', 'montheme_register_widget'); 

/* 
Dans ce chapitre nous allons parler du hook pre_get_posts. Ce hook permet d'altérer une requête avant son éxécution 
et va notamment permettre d'altérer la requête principale de WordPress pour y ajouter des filtres spécifiques.

function montheme_pre_get_posts ($query) {
    if (is_admin() || !is_search() || !$query->is_main_query()) {
        return;
    }
    if (get_query_var('sponso') === '1') {
        $meta_query = $query->get('meta_query', []);
        $meta_query[] = [
            'key' => SponsoMetaBox::META_KEY,
            'compare' => 'EXISTS',
        ];
        $query->set('meta_query', $meta_query);
    }
}
add_action('pre_get_posts', 'montheme_pre_get_posts');
 * 
 *  UTILISER LE FITRE query_vars pour permettre de gérer de nouveaux mots clef au niveau de l'url
 *  function montheme_query_vars ($params) {
    $params[] = 'sponso';
    return $params;
}
add_filter('query_vars', 'montheme_query_vars');
*/

