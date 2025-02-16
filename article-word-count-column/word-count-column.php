<?php

/**
 * Plugin Name:       Article Word Count Column
 * Plugin URI:        https://wordpress.org/plugins/article-word-count-column
 * Description:       Description: Adds the word count of each post and page to the list in the admin area and makes the column sortable. No settings.
 * Version:           1.4.1
 * Author:            Priit Kallas
 * Author URI:        https://dreamgrow.ee/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       my-basics-plugin
 * Domain Path:       /languages
 */

// Add a custom column to the post and page lists
function my_add_word_count_column($columns) {
    $columns['word_count'] = __('Word Count');
    return $columns;
}
add_filter('manage_posts_columns', 'my_add_word_count_column');
add_filter('manage_pages_columns', 'my_add_word_count_column');

// Populate the custom column with the word count for each post and page
function my_display_word_count($column_name, $post_id) {
    if ($column_name === 'word_count') {
        $content = get_post_field('post_content', $post_id);
        $word_count = str_word_count(strip_tags($content));
        echo esc_html($word_count);
    }
}
add_action('manage_posts_custom_column', 'my_display_word_count', 10, 2);
add_action('manage_pages_custom_column', 'my_display_word_count', 10, 2);

// Make the word count column sortable
function my_word_count_sortable($columns) {
    $columns['word_count'] = 'word_count';
    return $columns;
}
add_filter('manage_edit-post_sortable_columns', 'my_word_count_sortable');
add_filter('manage_edit-page_sortable_columns', 'my_word_count_sortable');
add_filter('manage_edit-wp_block_sortable_columns', 'my_word_count_sortable');

// Add sorting functionality
add_action('pre_get_posts', function($query) {
    if (is_admin() && $query->is_main_query() && $query->get('orderby') === 'word_count') {
        // Prevent default WordPress ordering
        $query->set('orderby', 'none');

        // Ensure we have the correct sorting join
        add_filter('posts_join', 'my_wc_join');
        // Ensure we have the correct sorting order
        add_filter('posts_orderby', function($orderby_sql) use ($query) {
            return my_wc_orderby($orderby_sql, $query->get('order'));
        });
    }
}, 15);

function my_wc_join($join) {
    global $wpdb;
    $join .= " LEFT JOIN {$wpdb->postmeta} as wcmeta ON ( {$wpdb->posts}.ID = wcmeta.post_id AND wcmeta.meta_key = 'word_count' )";
    return $join;
}

function my_wc_orderby($orderby_sql, $order) {
    global $wpdb;
    $order = (strtoupper($order) === 'ASC') ? 'ASC' : 'DESC';
    $orderby_sql = " COALESCE(NULLIF(wcmeta.meta_value, '')+0, LENGTH({$wpdb->posts}.post_content) - LENGTH(REPLACE({$wpdb->posts}.post_content, ' ', ''))) $order ";
    return $orderby_sql;
}
/*done*/
