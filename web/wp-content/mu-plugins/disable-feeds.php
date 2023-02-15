<?php

if (defined('OHMY_DISABLE_FEEDS') && OHMY_DISABLE_FEEDS)
{
	if ( ! function_exists('ohmy_disable_feeds') )
	{
		function ohmy_disable_feeds()
		{
			wp_die('No feeds available.');
		}
	}

	// Disable feeds
	add_action('do_feed', 'ohmy_disable_feeds', 1);
	add_action('do_feed_rdf', 'ohmy_disable_feeds', 1);
	add_action('do_feed_rss', 'ohmy_disable_feeds', 1);
	add_action('do_feed_rss2', 'ohmy_disable_feeds', 1);
	add_action('do_feed_atom', 'ohmy_disable_feeds', 1);


	// Remove feed links
	remove_action('wp_head', 'feed_links_extra', 3);
	remove_action('wp_head', 'feed_links', 2);
}