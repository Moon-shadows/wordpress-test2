<?php

if (defined('OHMY_DISABLE_COMMENTS') && OHMY_DISABLE_COMMENTS)
{
	// Disable comments
	add_filter('comments_open', function ($open, $postId)
	{
		return false;
	}, 20, 2);
}