<?php

/**
 * CSP nonces
 *  https://content-security-policy.com/nonce/
 * */

if (!defined('CSP_NONCE')) {
    define('CSP_NONCE', (new App\Utils\NonceGenerator)->getNonce());
}

$csp_nonce = CSP_NONCE;
$csp_default_src = "'self' 'unsafe-inline' *.googleapis.com *.googletagmanager.com *.google-analytics.com cdn.ohmyhosting.se *.ohmyhosting.se";
$csp_script_src = "'self' 'unsafe-eval' 'unsafe-inline' 'strict-dynamic' 'nonce-$csp_nonce' http: https: *.youtube.com youtube.com";
$csp_style_src = "'self' https://fonts.googleapis.com  http: https: 'unsafe-inline'";
$csp_font_src = "'self' data: http: https:";
$csp_frame_src = "'self' youtube.com www.youtube.com";
$csp_frame_ancestors = "'none'";
$csp_image_src = "https: data:";

// Skip strict-dynamic on sitemap URLs
if ( preg_match("/(sitemap_index|sitemap)\.xml$/i", $_SERVER['REQUEST_URI']) ) {
    $csp_script_src = str_replace(" 'strict-dynamic' ", ' ', $csp_script_src);
}

if (IS_DEV) {
    $app_url = preg_replace("#^[^:/.]*[:/]+#i", "", getenv('APP_URL'));
    /*
    *** Vite dev-server
  */
    $csp_image_src = "http: https: data:";
    $csp_default_src = "'self' 'unsafe-eval' 'strict-dynamic' http://localhost:3000 ws://localhost:3000 ws://$app_url:3000 *.googleapis.com";
    /*
    *** Thumbor
  */
    // $csp_image_src = "'self' 127.0.0.1:8888";
}

$csp_policy = "base-uri 'self'; script-src $csp_script_src; font-src $csp_font_src; default-src $csp_default_src; style-src $csp_style_src; frame-src $csp_frame_src; img-src $csp_image_src; frame-ancestors $csp_frame_ancestors";

if ( ! defined('DISABLE_CSP') )
{
    define('DISABLE_CSP', false);
}

if (!is_admin()) {
    if ( ! DISABLE_CSP )
    {
        header("Content-Security-Policy: $csp_policy");
        add_filter('script_loader_tag', 'add_nonce_to_script', 10, 3);
        apply_filters('wp_inline_script_attributes', ["nonce" => CSP_NONCE]);
    }

    add_action('init', 'disable_emojis');
}


function disable_emojis()
{
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}

function add_nonce_to_script($tag, $handle, $src)
{
    return str_replace('<script', sprintf('<script nonce="%s"', esc_attr(CSP_NONCE)), $tag);
}


use App\Utils\Vite;

if (!function_exists('vite')) {
    function vite(): Vite
    {
        return new Vite();
    }
}

if (!defined('THEME_DIR')) {
    define('THEME_DIR', get_template_directory());
}

if (!defined('IS_DEV')) {
    define('IS_DEV', getenv('APP_ENV') && getenv('APP_ENV') === 'local');
}

if (!function_exists('array_flatten')) {
    function array_flatten($array = null)
    {
        $result = array();

        if (!is_array($array)) {
            $array = func_get_args();
        }

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result = array_merge($result, array_flatten($value));
            } else {
                $result = array_merge($result, array($key => $value));
            }
        }

        return $result;
    }
}
if (!function_exists('startsWith')) {

    function startsWith($haystack, $needle)
    {
        $length = strlen($needle);
        return substr($haystack, 0, $length) === $needle;
    }
}
if (!function_exists('endsWith')) {
    function endsWith($haystack, $needle)
    {
        $length = strlen($needle);
        if (!$length) {
            return true;
        }
        return substr($haystack, -$length) === $needle;
    }
}
if (!function_exists('array_get')) {

    /**
     * Returns the value from the specified key. If the key doesn't exist, default is returned.
     * @param array $array
     * @param       $key
     * @param null  $default
     * @return mixed
     */
    function array_get(array $array, $key, $default = null)
    {
        return array_key_exists($key, $array) ? $array[$key] : $default;
    }
}

if (!function_exists('arrayify')) {
    /**
     * Returns an array of the specified value if the value isn't an array. If strict is set to false, an empty array is returned if the value evals
     * to boolean false.
     * @param            $value
     * @param bool|false $strict
     * @return array
     */
    function arrayify($value, $strict = false)
    {
        if (!is_array($value)) {
            $value = $value || $strict ? [$value] : [];
        }

        return $value;
    }
}

if (!function_exists('array_only')) {
    /**
     * Returns a new array with only the specified keys. If setMissing is set to true, the value of the key that is missing is set to null.
     * @param array      $array
     * @param array      $keys
     * @param bool|false $setMissing
     * @return array
     */
    function array_only(array $array, array $keys, $setMissing = true)
    {
        $result = [];

        foreach ($keys as $key) {
            $keyExists = array_key_exists($key, $array);

            if ($keyExists || $setMissing) {
                $result[$key] = $keyExists ? $array[$key] : null;
            }
        }

        return $result;
    }
}

if (!function_exists('array_except')) {
    /**
     * Returns a new array with key/values except those that are specified in keys.
     * @param array $array
     * @param       $keys
     * @return array
     */
    function array_except(array $array, $keys)
    {
        $keys = arrayify($keys);

        $result = [];

        foreach ($array as $k => $v) {
            if (!in_array($k, $keys)) {
                $result[$k] = $v;
            }
        }
        return $result;
    }
}

if (!function_exists('array_pluck')) {
    /**
     * Returns a new array that with only values from the specified key.
     * @param array $array
     * @param       $key
     * @param null  $default
     * @return array
     */
    function array_pluck(array $array, $key, $default = null)
    {
        return array_map(function ($v) use ($key, $default) {
            return array_get($v, $key, $default);
        }, $array);
    }
}

if (!function_exists('array_pluck_keys')) {
    /**
     * Pluck the specified keys from the arrays.
     * @param array      $array
     * @param array      $keys
     * @param bool|false $setMissing
     * @return array
     */
    function array_pluck_keys(array $array, array $keys, $setMissing = true)
    {
        return array_map(function ($v) use ($keys, $setMissing) {
            return array_only($v, $keys, $setMissing);
        }, $array);
    }
}

if (!function_exists('array_chunk_groups')) {

    function array_chunk_groups(array $array, $numGroups, $preserveKeys = false)
    {
        $size = intval(ceil(count($array) / $numGroups));

        return array_chunk($array, $size, $preserveKeys);
    }
}

if (!function_exists('array_pop_key')) {
    /**
     * Removes the specified key form the array and returns it's value.
     *
     * @param array $array
     * @param       $key
     * @param null  $default
     * @return mixed
     */
    function array_pop_key(array &$array, $key, $default = null)
    {
        $value = array_get($array, $key, $default);

        unset($array[$key]);

        return $value;
    }
}
