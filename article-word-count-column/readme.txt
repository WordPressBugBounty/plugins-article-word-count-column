=== Article Word Count ===
Contributors: pk2000
Donate link: https://www.dreamgrow.ee/
Tags: word count, posts, pages
Requires at least: 4.5
Tested up to: 6.7.2
Stable tag: 1.4.1
License: GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Displays the word count for each post and page in the WordPress admin panel.

== New Feature ==
• If a "word_count" postmeta exists, sorting by "Word Count" uses it for precise numeric ordering.
• Otherwise, sorting uses an approximate calculation based on spaces.

Adds the word count of each post to the post list in the admin area and makes the column sortable.

== Description ==

This plugin adds a custom column to the list of posts and pages in the WordPress admin area, and displays the word count for each post and page in the column. It also makes the column sortable, so you can easily sort the posts and pages by their word count.

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. The plugin will automatically add a custom 'Word Count' column to the list of posts and pages in the WordPress admin area, and populate the column with the word count for each post and page.
4. You can sort the posts and pages by their word count by clicking on the 'Word Count' column header.

== Frequently Asked Questions ==

= Can I customize the column header text? =

Yes, you can customize the column header text by using the `__()` function and passing your custom text as the argument. For example, if you want to change the column header text to 'Article Length', you can use the following code in your theme's functions.php file or in a custom plugin:

add_filter('manage_posts_columns', function($columns) {
$columns['word_count'] = __('Article Length');
return $columns;
});

== Screenshots ==

The plugin adds a custom 'Word Count' column to the list of posts and pages in the WordPress admin area.
You can sort the posts and pages by their word count by clicking on the 'Word Count' column header.

== Changelog ==

= 1.4.0 =
* Added fallback sorting method if "word_count" postmeta is missing (approximate count via spaces).

= 1.3.2 =
Initial release.

== Images ==

banner-772x250.png
banner-1544x500.png
icon-128x128.png
icon-256x256.png
icon.svg
