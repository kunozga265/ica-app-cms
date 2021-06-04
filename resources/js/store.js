/*
  Adds the promise polyfill for IE 11
*/
require('es6-promise').polyfill();

/*
    Imports Vue and Vuex
*/
import Vue from 'vue'
import Vuex from 'vuex'
// import VuexPersist from 'vuex-persist'

/*
    Initializes Vuex on Vue.
*/
Vue.use( Vuex );

// //Sets up Vuex Persist
// const vuexLocalStorage=new VuexPersist({
//     key:        'vuex', //The key to store the state on in the storage provider.
//     storage:    window.localStorage, //or window.sessionStorage or localForage
//
//     //Function that passes the state and returns the state with only the objects you want to store
//     // reducer:state=>({
//     //     Sermons:state.Sermons.Sermons,
//     //     Series:state.Series.Series,
//     //     Authors:state.Authors.Authors,
//     // }),
//     // //Function that passes a mutation and lets you decide if it should update the state in localStorage
//     filter:   mutation=> (
//         mutation.type === "setSermons" ||
//         mutation.type === "appendSermons" ||
//         mutation.type === "setSeries" ||
//         mutation.type === "appendSeries" ||
//         mutation.type === "setAuthors"
//     )
// });

/*


/*
    Imports all of the modules used in the application to build the data store.
*/
import { Sermons } from './modules/APISermonsModule.js'
import { Series } from './modules/APISeriesModule.js'
import { Authors } from "./modules/APIAuthorsModule";


/*
  Exports our data store.
*/
export default new Vuex.Store({
    modules: {
        Sermons,
        Series,
        Authors
    },
    // plugins:[vuexLocalStorage.plugin]
});
