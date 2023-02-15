<?php

if (defined('OHMY_DISABLE_XMLRPC') && OHMY_DISABLE_XMLRPC)
{
	// Disable XML-RPC
	add_filter('xmlrpc_enabled', '__return_false');
}