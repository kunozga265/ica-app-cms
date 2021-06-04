/*
|-------------------------------------------------------------------------------
| VUEX modules/Series.js
|-------------------------------------------------------------------------------
| The Vuex data store for the Series
*/

import API from '../api/APISeriesController.js';

export const Series = {
    state: {
        Series:[],
        SeriesLoadStatus:0,
        SeriesAppendStatus:0,
        SeriesStoreStatus:0,
        SeriesUpdateStatus:0,
        SeriesDeleteStatus:0,

        SingleSeries:{},
        SingleSeriesLoadStatus:0,

        SeriesLastPage:0,
        SeriesCurrentPage:0,
    },
    actions:{
        SeriesIndex({commit},data){
            commit('setSeriesLoadStatus',1);

            API.index()
                .then(function (response) {
                    if(response.data.response===204){
                        commit('setSeriesLoadStatus',4);
                    }
                    else{
                        commit('setSeriesLoadStatus',2);
                        commit('setSeries',response.data.series);
                        commit('setSeriesLastPage',response.data.meta.last_page)
                        commit('setSeriesCurrentPage',response.data.meta.current_page)
                    }

                })
                .catch(function () {
                    commit('setSeriesLoadStatus',3);
                });
        },
        AppendSeries({commit,state},data){
            commit('setSeriesAppendStatus',1);

            if(state.SeriesCurrentPage<state.SeriesLastPage) {
                let page = state.SeriesCurrentPage + 1
                API.index(page)
                    .then(function (response) {
                        if (response.status === 204) {
                            commit('setSeriesAppendStatus', 4);
                        } else {
                            commit('setSeriesAppendStatus', 2);
                            commit('appendSeries', response.data.series);
                            commit('setSeriesLastPage', response.data.meta.last_page)
                            commit('setSeriesCurrentPage', response.data.meta.current_page)
                        }

                    })
                    .catch(function () {
                        commit('setSeriesAppendStatus', 3);
                    });
            }
        },
        SeriesShow({commit,state},data){
            commit('setSingleSeriesLoadStatus',1);

            API.show(data.slug)
                .then(function (response) {
                    if (response.status === 204) {
                        commit('setSingleSeriesLoadStatus', 4);
                        commit('setSingleSeries', {});
                    }
                    else{
                        commit('setSingleSeries', response.data);
                        commit('setSingleSeriesLoadStatus', 2);
                    }
                })
                .catch(function () {
                    commit('setSingleSeriesLoadStatus', 3);
                })
        },

        store({commit},data){
            commit('setSeriesStoreStatus',1);
            API.store(data)
                .then(function (response) {
                    if(response.data.response==false){
                        commit('setSeriesStoreStatus',4);
                    }
                    else{
                        commit('setSeriesStoreStatus',2);
                        commit('setSeries',response.Series);
                    }
                })
                .catch(function () {
                    commit('setSeriesStoreStatus',3);
                })
        },
        update({commit},data){
            commit('setSeriesUpdateStatus',1);
            API.update(data)
                .then(function (response) {
                    if(response.data.response==false){
                        commit('setSeriesUpdateStatus',4);
                    }
                    else{
                        commit('setSeriesUpdateStatus',2);
                        commit('setSeries',response.Series);
                    }
                })
                .catch(function () {
                    commit('setSeriesUpdateStatus',3);
                })
        },
        destroy({commit},data){
            commit('setSeriesDeleteStatus',1);
            API.destroy(data)
                .then(function (response) {
                    if(response.data.response==false){
                        commit('setSeriesDeleteStatus',4);
                    }
                    else{
                        commit('setSeriesDeleteStatus',2);
                        commit('setSeries',response.Series);
                    }
                })
                .catch(function () {
                    commit('setSeriesDeleteStatus',3);
                })
        },
    },
    mutations:{
        //Series
        setSeries(state,Series){
            state.Series=Series;
        },
        setSeriesLoadStatus(state,status){
            state.SeriesLoadStatus=status;
        },
        appendSeries(state,Series){
            for(let x in Series){
                (state.Series).push(Series[x]);
            }
        },
        setSeriesAppendStatus(state,status){
            state.SeriesAppendStatus=status;
        },
        //SingleSeries
        setSingleSeries(state,SingleSeries){
            state.SingleSeries=SingleSeries;
        },
        setSingleSeriesLoadStatus(state,status){
            state.SingleSeriesLoadStatus=status;
        },
        setSeriesStoreStatus(state,status){
            state.SeriesStoreStatus=status;
        },
        setSeriesUpdateStatus(state,status){
            state.SeriesUpdateStatus=status;
        },
        setSeriesDeleteStatus(state,status){
            state.SeriesDeleteStatus=status;
        },
        //Pagination
        setSeriesLastPage(state,lastPage){
            state.SeriesLastPage=lastPage;
        },
        setSeriesCurrentPage(state,currentPage){
            state.SeriesCurrentPage=currentPage;
        }

    },
    getters:{
        getSeries(state){
            return state.Series;
        },
        getSeriesLoadStatus(state){
            return state.SeriesLoadStatus;
        },
        getSeriesAppendStatus(state){
            return state.SeriesAppendStatus;
        },
        getSeriesStoreStatus(state){
            return state.SeriesStoreStatus;
        },
        getSeriesUpdateStatus(state){
            return state.SeriesUpdateStatus;
        },
        getSeriesDeleteStatus(state){
            return state.SeriesDeleteStatus;
        },
        getSingleSeries(state){
            return state.SingleSeries;
        },
        getSingleSeriesLoadStatus(state){
            return state.SingleSeriesLoadStatus;
        },
        getMoreSeries(state){
            return state.SeriesCurrentPage<state.SeriesLastPage
        }
    }

};
