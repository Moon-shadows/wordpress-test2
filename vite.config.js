import path from 'path'
import vue from '@vitejs/plugin-vue'
import legacy from '@vitejs/plugin-legacy'
import liveReload from 'vite-plugin-live-reload'
import WindiCSS from 'vite-plugin-windicss'
export const themePath = 'web/wp-content/themes/wordpress-test2'
export const themeDir = 'wp-content/themes/wordpress-test2'
// IMPORTANT image urls in CSS works fine
// BUT you need to create a symlink on dev server to map this folder during dev
// ln -s {path_to_project}/resources/ {path_to_project}/resources
// on production everything will work just fine
export default {
     base: process.env.NODE_ENV === 'development'
    ? '/'
    : '/' + themeDir + '/build/',
    resolve: {
        alias: {
          vue: 'vue/dist/vue.esm-bundler.js',
          "@": path.resolve(__dirname),
          "@WP_theme": path.resolve(themePath),
          "@assets": path.join(__dirname, 'assets'),
        }
    },
    server: {
        // required to load scripts from custom host
        cors: true,

        // we need a strict port to match on PHP side
        // change freely, but update on PHP to match the same port
        strictPort: true,
        port: 3000
    },
    build: {
        outDir: themePath + '/build',
        emptyOutDir: true,
        // generate manifest.json in outDir
        manifest: true,
        target: 'es2018',
        rollupOptions: {
          // overwrite default .html entry
          input: {
            app: '/resources/js/app.js'

          }
        }
    },
    plugins: [
        vue(),
        WindiCSS({
            /**
             * Whitelist
             */
            //safelist: 'prose prose-sm m-auto'
            scan: {
                fileExtensions: ['html', 'vue', 'js', 'ts', 'php'],
                dirs: [
                    'resources/js/',
                    `${themePath}/`
                ]
            }
        }),
        legacy({
          targets: ['defaults', 'not IE 11']
        }),
        liveReload('web/wp-content/**/*.php')
    ]
}
