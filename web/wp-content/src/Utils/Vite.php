<?php

namespace App\Utils;

class Vite
{
    protected string $themeDir = THEME_DIR;
    protected string $buildDir = "build";
    protected string $entry = 'resources/js/app.js';

    protected string $hostname = 'http://localhost';
    protected int $port = 3000;
    protected string $nonce = CSP_NONCE;

    public function __construct()
    {
    }

    public function __toString(): string
    {
        return $this->preloadAssets('woff2')
            . $this->jsTag()
            . $this->jsPreloadImports()
            . $this->cssTag();
    }


    public function isDev(): bool
    {
        return defined('IS_DEV') && IS_DEV === true;
    }
    protected function transformBuildUrl(string $url): string
    {
        return str_replace(PROJECT_WEBROOT, '', $url);
    }

    public function entry(string $entry): self
    {
        $this->entry = $entry;
        return $this;
    }

    public function hostname(string $hostname)
    {
        $this->hostname = $hostname;
        return $this;
    }

    public function port(int $port): self
    {
        $this->port = $port;
        return $this;
    }

    public function buildDir(string $dir): self
    {
        $this->out_dir = $dir;
        return $this;
    }

    public function jsUrl(): string
    {
        return $this->assetUrl($this->entry);
    }

    public function cssUrls(): array
    {
        return $this->assetsUrls($this->entry, 'css');
    }
    public function assetUrl(string $entry): string
    {
        $manifest = $this->manifest();

        if (!isset($manifest[$entry])) {
            return '';
        }
        $url = $this->themeDir
            . '/' . $this->buildDir
            . '/' . ($manifest[$entry]['file']);

        return $this->transformBuildUrl($url);
    }

    public function assetsUrls(string $entry, string $path = 'assets'): array
    {
        $urls = [];
        $manifest = $this->manifest();

        if (!empty($manifest[$entry][$path])) {
            foreach ($manifest[$entry][$path] as $file) {
                $fileUrl = $this->themeDir
                    . '/' . $this->buildDir
                    . '/' . $file;

                $urls[] = $this->transformBuildUrl($fileUrl);
            }
        }

        return $urls;
    }

    public function importsUrls(string $entry): array
    {
        $urls = [];
        $manifest = $this->manifest();

        if (!empty($manifest[$entry]['imports'])) {
            foreach ($manifest[$entry]['imports'] as $imports) {
                $url =  $this->themeDir . '/' . $this->buildDir
                    . '/' . $manifest[$imports]['file'];

                $urls[] = $this->transformBuildUrl($url);
            }
        }

        return $urls;
    }

    // Helper to output the script tag
    protected function jsTag(): string
    {

        $url = $this->isDev()
            ? $this->host() . '/' . $this->entry
            : $this->jsUrl();
        if (!$url) {
            return '';
        }
        $devScript = '';
        if ($this->isDev()) :
            $devscript = '<script type="module" crossorigin nonce="' . $this->nonce . '"  src="'
                . $this->host() . '/@vite/client'
                . '"></script>';
        endif;
        return $devScript . '<script type="module" async nonce="' . $this->nonce . '" crossorigin src="'
            . $url
            . '"></script>';
    }

    protected function jsPreloadImports(): string
    {
        if ($this->isDev()) {
            return '';
        }

        $res = '';
        foreach ($this->importsUrls($this->entry) as $url) {
            $res .= '<link rel="modulepreload" nonce="' . $this->nonce . '"  href="'
                . $this->transformBuildUrl($url)
                . '">';
        }
        return $res;
    }
    // Helper to output style tag
    protected function cssTag(): string
    {
        // not needed on dev, it's inject by Vite
        if ($this->isDev()) {
            return '';
        }

        $tags = '';
        foreach ($this->cssUrls() as $url) {
            $tags .= '<link rel="stylesheet" nonce="' . $this->nonce . '"  href="'
                . $this->transformBuildUrl($url)
                . '">';
        }
        return $tags;
    }

    protected function preloadAssets(string $type): string
    {
        if ($this->isDev()) {
            return '';
        }

        $res = '';
        foreach ($this->assetsUrls($this->entry) as $url) {

            if (!endsWith($url, '.' . $type)) {
                continue;
            }
            if ($type === 'woff2') {
                $res .= '<link rel="preload" nonce="' . $this->nonce . '"  href="' . $this->transformBuildUrl($url) . '" as="font" type="font/woff2" crossorigin="anonymous">';
            }
        }
        return $res;
    }


    public function legacy(): string
    {
        if ($this->isDev()) {
            return '';
        }

        $url = $this->assetUrl(str_replace(
            '.js',
            '-legacy.js',
            $this->entry
        ));

        $polyfill_url = $this->assetUrl('vite/legacy-polyfills');
        if (!$polyfill_url) {
            $polyfill_url = $this->assetUrl('../vite/legacy-polyfills');
        }

        if (!$url || !$polyfill_url) {
            return '';
        }

        $script = '<script nomodule nonce="' . $this->nonce . '" >!function(){var e=document,t=e.createElement("script");if(!("noModule"in t)&&"onbeforeload"in t){var n=!1;e.addEventListener("beforeload",(function(e){if(e.target===t)n=!0;else if(!e.target.hasAttribute("nomodule")||!n)return;e.preventDefault()}),!0),t.type="module",t.src=".",e.head.appendChild(t),t.remove()}}();</script>';

        $script .= '<script nomodule src="' . $polyfill_url . '" nonce="' . $this->nonce . '" ></script>';

        $script .= '<script nomodule id="vite-legacy-entry" data-src="' . $url . '" nonce="' . $this->nonce . '" >System.import(document.getElementById(\'vite-legacy-entry\').getAttribute(\'data-src\'))</script>';

        return $script;
    }


    protected function host(): string
    {
        return $this->hostname . ':' . $this->port;
    }

    protected function manifest(): array
    {

        $content = file_get_contents(
            $this->themeDir
                . '/' . $this->buildDir
                . '/manifest.json'
        );

        return $content
            ? json_decode($content, true)
            : [];
    }
}
