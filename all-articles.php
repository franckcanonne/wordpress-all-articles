<?php
/*
Plugin Name: Liste des articles
Plugin URI: https://factotum.bzh/boutique-wordpress/
Description: Plugin WordPress pour afficher les titres de tous les articles du blog.
Version: 1.0
Author: Franck Canonne
Author URI: https://factotum.bzh
License: GPL2
*/

// Ajout du shortcode [article_titles]
add_shortcode('article_titles', 'article_titles_shortcode');

// Fonction du shortcode
function article_titles_shortcode() {
    ob_start();

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => -1, // Récupérer tous les articles
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        echo '<ul>';
        while ($query->have_posts()) {
            $query->the_post();
            echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
        }
        echo '</ul>';
        wp_reset_postdata();
    } else {
        echo 'Aucun article trouvé.';
    }

    return ob_get_clean();
}
