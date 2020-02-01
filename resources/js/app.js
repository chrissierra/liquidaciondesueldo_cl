/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('liquidoa-base', require('./components/liquidoabaseComponent.vue').default);
Vue.component('procesado-importable', require('./components/ProcesadoCsv.vue').default);
Vue.component('liquidacion-plana', require('./components/liquidacionPlanaComponent.vue').default);
Vue.component('liquidacion-full', require('./components/liquidacionFullComponent.vue').default);
Vue.component('base-a-liquido', require('./components/baseAliquidoComponent.vue').default);

Vue.component('liquidacion-pdf', require('./components/liquidacion_vista_pdf.vue').default);

Vue.component('get-impuestos', require('./components/impuestos/getImpuestosComponent.vue').default);
Vue.component('get-afp', require('./components/afps/getAfpsComponent.vue').default);
Vue.component('get-parametros', require('./components/parametros/getParametrosComponent.vue').default);


Vue.filter('aproximar', function (monto, limite) {
    return new Intl.NumberFormat().format(monto.toFixed(limite));
});

Vue.filter('aproximarConPeso', function (monto, limite) {
    return "$" + new  Intl.NumberFormat("de-DE").format(monto.toFixed(limite));
});
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
