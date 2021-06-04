import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from './pages/Home.vue';
import Sermons from './pages/Sermons.vue';
import Series from "./pages/Series";
import Pastors from "./pages/Pastors";
import Sermon from "./pages/Sermon";
import SeriesView from "./pages/SeriesView";
import Pastor from "./pages/Pastor";
import Search from "./pages/Search";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/sermons',
            name: 'sermons',
            component: Sermons
        },
        {
            path: '/sermons/:slug',
            name: 'sermon',
            props:true,
            component: Sermon
        },
        {
            path: '/series',
            name: 'series',
            component: Series
        },
        {
            path: '/series/:slug',
            name: 'series-view',
            props: true,
            component: SeriesView
        },
        {
            path: '/pastors',
            name: 'pastors',
            component: Pastors
        },
        {
            path: '/pastors/:slug',
            name: 'pastor',
            props:true,
            component: Pastor
        },
        {
            path: '/search',
            name: 'search',
            component: Search
        },
    ]
});

export default router;

