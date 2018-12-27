import VueRouter from 'vue-router';
import TeamsComponent from './components/TeamsComponent';

const routes = [
    { path: '/', component: TeamsComponent },
];

const router = new VueRouter({
    routes // short for `routes: routes`
});

export default router;
