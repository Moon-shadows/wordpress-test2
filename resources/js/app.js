
import 'virtual:windi.css'
import 'lazysizes'
// Our main CSS
import '../css/app.css'

/**
 * Let's first load and setup axios for all your XMLHttpRequest needs.
 */

import axios from 'axios'
window.axios = axios

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
}

/**
 * Vue is ready for you, if you need it.
 */

/**
* The following block of code automatically registers your Vue components.
* It will recursively scan this directory for the Vue components and
* automatically register them with their "basename".
*
* Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
*
* Feel free to remove this block if you don't like black magic fuckery,
* or you want to register your Vue components manually.
*/
/*
*** https://v3.vuejs.org/
*/
// const vueSingleFileComponents = import.meta.globEager('./**/*.vue')
// import { createApp } from 'vue'
// const app = createApp({})
// for (const path in vueSingleFileComponents) {
//     const importedModule = vueSingleFileComponents[path].default
//     const name = path.split('/').pop().split('.')[0]
//     app.component(name, importedModule)
// }
// app.mount('#vue-app')

/**
 * 🦄: Now do your magic.
 */
