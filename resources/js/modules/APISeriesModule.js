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
        SeriesRestoreStatus:0,

        SingleSeries:{},
        SingleSeriesLoadStatus:0,

        SeriesLastPage:0,
        SeriesCurrentPage:0,

        SeriesSearchResults:[],
        SeriesSearchResultsStatus:0,

        SeriesOptions:[],
        SeriesOptionsStatus:0

    },
    actions:{
        SeriesIndex({commit},data){
            commit('setSeriesLoadStatus',1);

            API.index(data)
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

            API.show(data)
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
        SeriesSearch({commit}, data){
            commit('setSeriesSearchResultsStatus',1);

            API.search(data.query)
                .then(function (response) {
                    if(response.status===204){
                        commit('setSeriesSearchResultsStatus',4);
                    }
                    else{
                        commit('setSeriesSearchResultsStatus',2);
                        commit('setSeriesSearchResults',response.data.series)
                    }

                })
                .catch(function () {
                    commit('setSearchResults',[]);
                    commit('setSeriesSearchResultsStatus',3);
                });
        },
        SeriesOptions({commit}, data){
            commit('setSeriesOptionsStatus',1);

            API.options()
                .then(function (response) {
                    if(response.status===204){
                        commit('setSeriesOptionsStatus',4);
                    }
                    else{
                        commit('setSeriesOptionsStatus',2);
                        commit('setSeriesOptions',response.data)
                    }

                })
                .catch(function () {
                    commit('setSeriesOptionsStatus',3);
                });
        },
        SeriesClear({commit},data){
            commit('setSeriesLoadStatus',0);
            commit('setSeries',[]);
            commit('setSeriesLastPage',0)
            commit('setSeriesCurrentPage',0)
        },

        SeriesStore({commit},data){
            commit('setSeriesStoreStatus',1);
            API.store(data)
                .then(function (response) {
                    if(response.status===204){
                        commit('setSeriesStoreStatus',4);
                    }
                    else if(response.status===200){
                        commit('setSeriesStoreStatus',2);
                    }
                })
                .catch(function () {
                    commit('setSeriesStoreStatus',3);
                })
        },
        SeriesUpdate({commit},data){
            commit('setSeriesUpdateStatus',1);
            API.update(data)
                .then(function (response) {
                    if(response.status===204){
                        commit('setSeriesUpdateStatus',4);
                    }
                    else if(response.status===200){
                        commit('setSeriesUpdateStatus',2);
                    }
                })
                .catch(function () {
                    commit('setSeriesUpdateStatus',3);
                })
        },
        SeriesTrash({commit},data){
            commit('setSeriesDeleteStatus',1);
            API.trash(data)
                .then(function (response) {
                    if(response.status===204){
                        commit('setSeriesDeleteStatus',response);
                    }
                    else{
                        commit('setSeriesDeleteStatus',2);
                    }
                })
                .catch(function () {
                    commit('setSeriesDeleteStatus',3);
                })
        },
        SeriesRestore({commit},data){
            commit('setSeriesRestoreStatus',1);
            API.restore(data)
                .then(function (response) {
                    if(response.status===204){
                        commit('setSeriesRestoreStatus',4);
                    }
                    else{
                        commit('setSeriesRestoreStatus',2);
                    }
                })
                .catch(function () {
                    commit('setSeriesRestoreStatus',3);
                })
        },
        SeriesDestroy({commit},data){
            commit('setSeriesDeleteStatus',1);
            API.destroy(data)
                .then(function (response) {
                    if(response.status===204){
                        commit('setSeriesDeleteStatus',4);
                    }
                    else{
                        commit('setSeriesDeleteStatus',2);
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
        setSeriesRestoreStatus(state,status){
            state.SeriesRestoreStatus=status;
        },
        //Pagination
        setSeriesLastPage(state,lastPage){
            state.SeriesLastPage=lastPage;
        },
        setSeriesCurrentPage(state,currentPage){
            state.SeriesCurrentPage=currentPage;
        },

        //search

        setSeriesSearchResults(state,SearchResults){
            state.SeriesSearchResults=SearchResults
        },
        setSeriesSearchResultsStatus(state,status){
            state.SeriesSearchResultsStatus=status;
        },

        setSeriesOptions(state,SearchResults){
            state.SeriesOptions=SearchResults
        },
        setSeriesOptionsStatus(state,status){
            state.SeriesOptionsStatus=status;
        },


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
        getSeriesRestoreStatus(state){
            return state.SeriesRestoreStatus;
        },
        getSingleSeries(state){
            return state.SingleSeries;
        },
        getSingleSeriesLoadStatus(state){
            return state.SingleSeriesLoadStatus;
        },
        getMoreSeries(state){
            return state.SeriesCurrentPage<state.SeriesLastPage
        },
        getSeriesLastPage(state){
            return state.SeriesLastPage
        },
        getSeriesSearchResults(state){
            return state.SeriesSearchResults;
        },
        getSeriesSearchResultsStatus(state){
            return state.SeriesSearchResultsStatus;
        },
        getSeriesOptions(state){
            return state.SeriesOptions;
        },
        getSeriesOptionsStatus(state){
            return state.SeriesOptionsStatus;
        },
    }

};
