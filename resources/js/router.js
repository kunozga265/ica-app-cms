import Vue from 'vue';
import VueRouter from 'vue-router';

import Dashboard from './pages/Dashboard.vue';
import Sermons from './pages/Sermons/Sermons.vue';
import Series from "./pages/Series/Series";
import Pastors from "./pages/Pastors/Pastors";
import Sermon from "./pages/SermonView";
import SeriesView from "./pages/Series/SeriesView";
import Pastor from "./pages/Pastors/Pastor";
import Search from "./pages/Search";
import SermonNew from "./pages/Sermons/SermonNew";
import SermonEdit from "./pages/Sermons/SermonEdit";
import SeriesNew from "./pages/Series/SeriesNew";
import SeriesEdit from "./pages/Series/SeriesEdit";
import PastorNew from "./pages/Pastors/PastorNew";
import PastorEdit from "./pages/Pastors/PastorEdit";

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
            path: '/series/view/:slug',
            name: 'series-view',
            props: true,
            component: SeriesView
        },
        {
            path: '/series/new',
            name: 'series-new',
            component: SeriesNew
        },
        {
            path: '/series/edit/:slug',
            name: 'series-edit',
            props: true,
            component: SeriesEdit
        },
        {
            path: '/pastors',
            name: 'pastors',
            component: Pastors
        },
        {
            path: '/pastors/view/:slug',
            name: 'pastor-view',
            props:true,
            component: Pastor
        },
        {
            path: '/pastors/new',
            name: 'pastor-new',
            props:true,
            component: PastorNew
        },
        {
            path: '/pastors/edit/:slug',
            name: 'pastor-edit',
            props:true,
            component: PastorEdit
        },
        {
            path: '/search',
            name: 'search',
            component: Search
        },
    ]
});

export default router;

