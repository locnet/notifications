/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import VueRouter from 'vue-router';
import { routes } from './routes';

window.Vue = require('vue');
Vue.use(VueRouter);

// configuracion global de la direccion http, se usa sin el dolar ($) delante de http
axios.options.root = '';

// router
const router = new VueRouter({
    routes: routes
});


// event bus
export const eventBus = new Vue();


/**
 * Componentes varios
 */

Vue.component('app-main-component', require('./MainComponent.vue'));
Vue.component('app-left-menu-component', require('./components/LeftMenuComponent.vue'));
Vue.component('app-form-header', require('./components/itineraries/FormHeader.vue'));
Vue.component('app-form-outbound-direct-fly', require('./components/itineraries/OutboundDirectFly.vue'));
Vue.component('app-form-outbound-scale-fly', require('./components/itineraries/OutboundScaleFly.vue'));
Vue.component('app-form-return-direct-fly', require('./components/itineraries/ReturnDirectFly.vue'));
Vue.component('app-form-return-scale-fly', require('./components/itineraries/ReturnScaleFly.vue'));

/**
 * componentes vista de cambios
 */
Vue.component('app-change-pnr-component', require('./components/changes/ChangePnrComponent.vue'));
Vue.component('app-change-departure-component', require('./components/changes/ChangeDepartureComponent.vue'));
Vue.component('app-change-return-component', require('./components/changes/ChangeReturnComponent.vue'));
Vue.component('app-change-departure-scale-component', require('./components/changes/ChangeDepartureScaleComponent.vue'));
Vue.component('app-change-return-scale-component', require('./components/changes/ChangeReturnScaleComponent.vue'));
Vue.component('app-change-comments-component', require('./components/changes/ChangeCommentsComponent.vue'));

/**
 * componentes vista pasageros
 */
Vue.component('app-passengers-component', require('./components/passengers/PassengersComponent.vue'));
Vue.component('app-pnr-component', require('./components/passengers/PnrComponent.vue'));

const app = new Vue({
    el: '#app',
    router: router,
    components: {

    }
});