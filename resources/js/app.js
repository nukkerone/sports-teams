import Vue from 'vue';
import Vuetify from 'vuetify';
import VueRouter from 'vue-router';
import colors from 'vuetify/es5/util/colors';

import router from './routes';


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('base-component', require('./components/BaseComponent').default);
Vue.component('navigation-component', require('./components/NavigationComponent').default);
Vue.component('teams-component', require('./components/TeamsComponent').default);
Vue.component('players-component', require('./components/PlayersComponent').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.use(Vuetify);

console.log('Vue router ', router);

Vue.use(VueRouter);

const app = new Vue({
    el: '#app',
    data: {
        currentRoute: window.location.pathname
    },
    router,
    theme: {
        primary: colors.red.darken1, // #E53935
        secondary: colors.red.lighten4, // #FFCDD2
        accent: colors.indigo.base // #3F51B5
    }
});
