<?php

namespace App;

use SponsoMetaBox;

//fonctionalites supportées par le theme
function montheme_supports()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    register_nav_menu('header', 'En tête du menu');
    register_nav_menu('footer', 'Pied de page');

    add_image_size('card-header','300','215',true);
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
        if($pages ===null){
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
        echo '<li class="' . $class .'">';
        echo str_replace('page-numbers', 'page-link', $page);
        echo '</li>';
    }
    echo '</ul>';
    echo '</nav>';
}



/**  actions */
add_action('after_setup_theme', 'App\montheme_supports');
add_action('wp_enqueue_scripts', 'App\montheme_register_assets');
add_filter('document_title_separator', 'App\mon_theme_title_separator');
add_filter('document_title_parts', 'App\montheme_document_title_parts');
add_filter('nav_menu_css_class', 'App\montheme_menu_class');
add_filter('nav_menu_link_attributes', 'App\montheme_menu_link_class');

require_once('metaboxes/sponso.php');
SponsoMetaBox::register();
