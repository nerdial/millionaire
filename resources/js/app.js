require('./bootstrap');

window.Vue = require('vue').default;

import VueRouter from 'vue-router'

Vue.use(VueRouter)


import TopUsers from '../js/components/TopUserComponent'
import Game from '../js/components/GameComponent'
import UserStat from '../js/components/StatComponent'

const routes = [
    {
        name: 'start',
        path: '/',
        component: Game
    },
    {
        name: 'tops',
        path: '/tops',
        component: TopUsers
    },
    {
        name: 'userStat',
        path: '/stat',
        component: UserStat
    }
]



const router = new VueRouter({
    routes
})

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Vue.component('start-component', require('./components/StartGameComponent.vue').default);
// Vue.component('login-component', require('./components/LoginComponent.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router: router
});
