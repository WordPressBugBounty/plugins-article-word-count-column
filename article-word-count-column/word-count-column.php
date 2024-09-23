<?php

/**
 * Plugin Name:       Article Word Count Column
 * Plugin URI:        https://wordpress.org/plugins/article-word-count-column
 * Description:       Description: Adds the word count of each post and page to the list in the admin area and makes the column sortable. No settings.
 * Version:           1.3.2
 * Author:            Priit Kallas
 * Author URI:        https://dreamgrow.ee/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       my-basics-plugin
 * Domain Path:       /languages
 */

// Add a custom column to the post and page lists
add_filter('manage_posts_columns', function($columns) {
    $columns['word_count'] = __('Word Count');
    return $columns;
});
add_filter('manage_pages_columns', function($columns) {
    $columns['word_count'] = __('Word Count');
    return $columns;
});

// Populate the custom column with the word count for each post and page
add_action('manage_posts_custom_column', function($column_name, $post_id) {
    if ($column_name == 'word_count') {
        // Get the post or page content
        $content = get_post_field('post_content', $post_id);

        // Count the number of words in the post or page
        $word_count = str_word_count(strip_tags($content));

        // Display the word count in the column
        echo esc_html($word_count);
    }
}, 10, 2);
add_action('manage_pages_custom_column', function($column_name, $post_id) {
    if ($column_name == 'word_count') {
        // Get the post or page content
        $content = get_post_field('post_content', $post_id);

        // Count the number of words in the post or page
        $word_count = str_word_count(strip_tags($content));

        // Display the word count in the column
        echo esc_html($word_count);
    }
}, 10, 2);

// Make the word count column sortable
add_filter('manage_edit-post_sortable_columns', function($columns) {
    $columns['word_count'] = 'word_count';
    return $columns;
});
add_filter('manage_edit-page_sortable_columns', function($columns) {
    $columns['word_count'] = 'word_count';
    return $columns;
});

/*done*/