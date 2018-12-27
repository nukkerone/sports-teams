import VueRouter from 'vue-router';
import TeamsComponent from './components/TeamsComponent';
import PlayersComponent from './components/PlayersComponent';

const routes = [
    { path: '/', redirect: '/teams' },
    { path: '/teams', component: TeamsComponent },
    { path: '/players', component: PlayersComponent },
];

const router = new VueRouter({
    routes // short for `routes: routes`
});

export default router;
