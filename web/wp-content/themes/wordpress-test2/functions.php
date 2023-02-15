<?php

//adding the CSS and JS files

function marias_setup(){
    wp_enqueue_style('google-fonts', '//fonts.googleapis.com', 
  '//fonts.gstatic.com', '//fonts.googleapis.com/css2?family=Roboto&family=Roboto+Condensed:ital@1&family=Roboto+Slab&display=swap');

    wp_enqueue_style('fontawesome', '//kit.fontawesome.com/715227954d.css');
    wp_enqueue_style('style', get_stylesheet_uri(), NULL, microtime(), 'all');
    wp_enqueue_script('main', get_theme_file_uri('/js/main.js'), NULL, microtime(), true);
}

add_action('wp_enqueue_scripts', 'marias_setup');

// Adding Theme Support

function marias_init() {
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('html5',
    array('comment-list', 'comment-form', 'search-form')
 );
}

add_action('after_setup_theme', 'marias_init');

// Projecrs Post Type

function marias_custom_post_type() {
  register_post_type('project', 
  array(
    'rewrite' => array('slug' => 'projects'),  //url for our custom post type
    'labels'  => array(
      'name' => 'Projects',
      'singular_name' => 'Project',
      'add_new_item' => 'Add New Project Now!!',
      'edit_item' => 'Edit Project'
    ),
    'meny-icon' => 'dashicons-clipboard',
    'public' => true,
    'has_archive' => true,
    'supports' => array(
      'title', 'thumbnail', 'editor', 'excerpt', 'comments' 
    )
   )   
 );
}

add_action('init', 'marias_custom_post_type');