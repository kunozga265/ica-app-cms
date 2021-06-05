import Vue from 'vue';
import VueRouter from 'vue-router';

import Dashboard from './pages/Dashboard.vue';
import Sermons from './pages/Sermons.vue';
import Series from "./pages/Series";
import Pastors from "./pages/Pastors";
import Sermon from "./pages/SermonView";
import SeriesView from "./pages/SeriesView";
import Pastor from "./pages/Pastor";
import Search from "./pages/Search";
import SermonNew from "./pages/SermonNew";
import SermonEdit from "./pages/SermonEdit";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        {
            path: '/',
            name: 'dashboard',
            component: Dashboard
        },
        {
            path: '/sermons',
            name: 'sermons',
            component: Sermons
        },
        {
            path: '/sermons/view/:slug',
            name: 'sermon-view',
            props:true,
            component: Sermon
        },
        {
            path: '/sermons/new',
            name: 'sermon-new',
            component: SermonNew
        },
        {
            path: '/sermons/edit/:slug',
            name: 'sermon-edit',
            props:true,
            component: SermonEdit
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

