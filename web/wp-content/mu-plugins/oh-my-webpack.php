<?php

if (! function_exists('asset')) {
    function asset($path) {
        $themePath = get_template_directory();
        $buildPath = $themePath . '/build';
        $hotFile = $buildPath . '/hot';
        $manifestPath = PROJECT_WEBROOT . '/mix-manifest.json';
        $assetPath = str_replace(PROJECT_WEBROOT, '', $buildPath) . '/' . $path;

        if (file_exists($hotFile)) {
            $url = rtrim(file_get_contents($hotFile));
            return $url.$path;
        }

        if (! file_exists($manifestPath)) {
            throw new Exception('A mix-manifest.json does not exist in ' . PROJECT_WEBROOT . '.');
        }


        $manifest = json_decode(file_get_contents($manifestPath), true);

        $asset = $manifest[$assetPath] ?? null;

        if (! $asset) {
            throw new Exception('Unable to locate asset: '.$assetPath);
        }

        return $asset;
    }
}