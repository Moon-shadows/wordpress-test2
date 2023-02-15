<?php

if (defined('OHMY_DISABLE_PINGS') && OHMY_DISABLE_PINGS)
{
	// Disabled pingbacks
	add_filter('pings_open', function ($open, $postId)
	{
		return false;
	}, 20, 2);
}