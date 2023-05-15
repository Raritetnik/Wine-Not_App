/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import './js_functions/menu';


require("./bootstrap");

window.Vue = require("vue").default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component("v-recherche", require("./components/Recherche.vue").default);
Vue.component("v-compteur", require("./components/Compteur.vue").default);
Vue.component("v-souhaits", require("./components/ListeSouhaits.vue").default);
Vue.component("v-filtre", require("./components/FiltrerBouteille.vue").default);
Vue.component("v-bouteille", require("./components/CarteBouteille.vue").default);
Vue.component("v-bouteille-fav", require("./components/CarteBouteilleFav.vue").default);
Vue.component("v-cellier", require("./components/CarteCellier.vue").default);
Vue.component("v-profile", require("./components/Profile.vue").default);
Vue.component("v-note", require("./components/EtoileNote.vue").default);
Vue.component("v-bouton-filtre", require("./components/BoutonFiltre.vue").default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
});
