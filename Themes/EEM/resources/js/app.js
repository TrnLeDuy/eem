require('./bootstrap');
import Vue from "vue";
import helpers from './helpers/helper'
import { BootstrapVue } from 'bootstrap-vue'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import Paginate from 'vuejs-paginate'
import VueQrcode from '@chenfengyuan/vue-qrcode';
import FontAwesomeIcon from "./helpers/fontawesome";
import { ValidationProvider } from "vee-validate";
import TranslationHelper from './mixins/TranslationHelper';

Vue.use(BootstrapVue)

const plugins = {
    install() {
        Vue.helpers = helpers;
        Vue.prototype.$helpers = helpers;
    }
}


Vue.component(VueQrcode.name, VueQrcode);
Vue.use(plugins);
Vue.component('paginate', Paginate)
Vue.component("font-awesome-icon", FontAwesomeIcon);
Vue.component("ValidationProvider", ValidationProvider);

new Vue({
    el: '#app',
});

