/*
|-------------------------------------------------------------------------------
| VUEX modules/Sermon.js
|-------------------------------------------------------------------------------
| The Vuex data store for the Sermons
*/

import API from '../api/APISermonsController.js';

export const Sermons = {
    state: {
        Sermons:[],
        SermonsLoadStatus:0,
        SermonsAppendStatus:0,
        SermonsStoreStatus:0,
        SermonsUpdateStatus:0,
        SermonsDeleteStatus:0,
        SermonsRestoreStatus:0,

        Sermon:{},
        SermonLoadStatus:0,

        SermonsLastPage:0,
        SermonsCurrentPage:0,

        SearchResults:[],
        SearchResultsStatus:0,

        ScheduledSermons:[],
        ScheduledSermonsLoadStatus:0,
    },
    actions:{
        SermonsIndex({commit}, data){
            commit('setSermonsLoadStatus',1);

            API.index(data)
                .then(function (response) {
                    if(response.status===204){
                        commit('setSermonsLoadStatus',4);
                    }
                    else if (response.status===200){
                        commit('setSermonsLoadStatus',2);
                        commit('setSermons',response.data.sermons)
                        commit('setSermonsLastPage',response.data.meta.last_page)
                        commit('setSermonsCurrentPage',response.data.meta.current_page)
                    }

                })
                .catch(function () {
                    commit('setSermonsLoadStatus',3);
                });
        },
        AppendSermons({commit,state}, data){
            commit('setSermonsAppendStatus',1);

            if(state.SermonsCurrentPage<state.SermonsLastPage){
                let page=state.SermonsCurrentPage+1
                API.index(page)
                    .then(function (response) {
                        if(response.data.response===false){
                            commit('setSermonsAppendStatus',4);
                        }
                        else{
                            commit('setSermonsAppendStatus',2);
                            commit('appendSermons',response.data.sermons);
                            commit('setSermonsLastPage',response.data.meta.last_page)
                            commit('setSermonsCurrentPage',response.data.meta.current_page)
                        }

                    })
                    .catch(function () {
                        commit('setSermonsAppendStatus',3);
                    });
            }
        },
        SermonsScheduled({commit}, data){
            commit('setScheduledSermonsLoadStatus',1);

            API.scheduled()
                .then(function (response) {
                    if(response.status===204){
                        commit('setScheduledSermonsLoadStatus',4);
                    }
                    else if (response.status===200){
                        commit('setScheduledSermonsLoadStatus',2);
                        commit('setScheduledSermons',response.data)
                    }

                })
                .catch(function () {
                    commit('setScheduledSermonsLoadStatus',3);
                });
        },
        SermonShow({commit,state},data){
            commit('setSermonLoadStatus',1);

            API.show(data.slug)
                .then(function (response) {
                    if (response.status === 204) {
                        commit('setSermonLoadStatus', 4);
                    }
                    else{
                        commit('setSermon', response.data);
                        commit('setSermonLoadStatus', 2);
                    }
                })
                .catch(function () {
                    commit('setSermonLoadStatus', 3);
                })
        },
        SermonsSearch({commit}, data){
            commit('setSearchResultsStatus',1);

            API.search(data.query)
                .then(function (response) {
                    if(response.status===204){
                        commit('setSearchResultsStatus',4);
                    }
                    else{
                        commit('setSearchResultsStatus',2);
                        commit('setSearchResults',response.data)
                    }

                })
                .catch(function () {
                    commit('setSearchResults',[]);
                    commit('setSearchResultsStatus',3);
                });
        },
        SermonsClear({commit}, data){
            commit('setSermonsLoadStatus',0);
            commit('setSermons',[])
            commit('setSermonsLastPage',0)
            commit('setSermonsCurrentPage',0)
        },
        SermonsClearSearch({commit}, data){
            commit('setSearchResultsStatus',0);
            commit('setSearchResults',[])
        },
        SermonStore({commit},data){
            commit('setSermonsStoreStatus',1);
            API.store(data)
                .then(function (response) {
                    if(response.status===204){
                        commit('setSermonsStoreStatus',4);
                    }
                    else if (response.status===200){
                        commit('setSermonsStoreStatus',2);
                        // commit('setSermons',response.Sermons);
                    }
                })
                .catch(function (response) {
                    commit('setSermonsStoreStatus',response);
                })
        },
        SermonUpdate({commit},data){
            commit('setSermonsUpdateStatus',1);
            API.update(data)
                .then(function (response) {
                    if(response.status===204){
                        commit('setSermonsUpdateStatus',4);
                    }
                    else if(response.status===200){
                        commit('setSermonsUpdateStatus',2);
                        // commit('setSermons',response.Sermons);
                    }
                })
                .catch(function () {
                    commit('setSermonsUpdateStatus',3);
                })
        },
        SermonTrash({commit},data){
            commit('setSermonsDeleteStatus',1);
            API.trash(data)
                .then(function (response) {
                    if(response.status===204){
                        commit('setSermonsDeleteStatus',4);
                    }
                    else if(response.status===200){
                        commit('setSermonsDeleteStatus',2);
                    }
                })
                .catch(function () {
                    commit('setSermonsDeleteStatus',3);
                })
        },
        SermonRestore({commit},data){
            commit('setSermonsRestoreStatus',1);
            API.restore(data)
                .then(function (response) {
                    if(response.status===204){
                        commit('setSermonsRestoreStatus',4);
                    }
                    else if(response.status===200){
                        commit('setSermonsRestoreStatus',2);
                    }
                })
                .catch(function () {
                    commit('setSermonsRestoreStatus',3);
                })
        },
        SermonDestroy({commit},data){
            commit('setSermonsDeleteStatus',1);
            API.destroy(data)
                .then(function (response) {
                    if(response.status===204){
                        commit('setSermonsDeleteStatus',4);
                    }
                    else if(response.status===200){
                        commit('setSermonsDeleteStatus',2);
                    }
                })
                .catch(function () {
                    commit('setSermonsDeleteStatus',3);
                })
        },
    },
    mutations:{
        //Sermons
        setSermons(state,Sermons){
            state.Sermons=Sermons;
            // state.AppSermons=Sermons;
        },
        setSermonsLoadStatus(state,status){
            state.SermonsLoadStatus=status;
        },
        setScheduledSermons(state,Sermons){
            state.ScheduledSermons=Sermons;
            // state.AppSermons=Sermons;
        },
        setScheduledSermonsLoadStatus(state,status){
            state.ScheduledSermonsLoadStatus=status;
        },
        appendSermons(state,Sermons){
            for(let x in Sermons){
                (state.Sermons).push(Sermons[x]);
            }
        },
        setSermonsAppendStatus(state,status){
            state.SermonsAppendStatus=status;
        },
        //Sermon
        setSermon(state,Sermon){
            state.Sermon=Sermon;
        },
        setSermonLoadStatus(state,status){
            state.SermonLoadStatus=status;
        },
        setSermonsStoreStatus(state,status){
            state.SermonsStoreStatus=status;
        },
        setSermonsUpdateStatus(state,status){
            state.SermonsUpdateStatus=status;
        },
        setSermonsDeleteStatus(state,status){
            state.SermonsDeleteStatus=status;
        },
        setSermonsRestoreStatus(state,status){
            state.SermonsRestoreStatus=status;
        },
        //Pagination
        setSermonsLastPage(state,lastPage){
            state.SermonsLastPage=lastPage;
        },
        setSermonsCurrentPage(state,currentPage){
            state.SermonsCurrentPage=currentPage;
        },
        //search

        setSearchResults(state,SearchResults){
            state.SearchResults=SearchResults
        },
        setSearchResultsStatus(state,status){
            state.SearchResultsStatus=status;
        },

    },
    getters:{
        getSermons(state){
            return state.Sermons;
        },
        getSermonsLoadStatus(state){
            return state.SermonsLoadStatus;
        },
        getScheduledSermons(state){
            return state.ScheduledSermons;
        },
        getScheduledSermonsLoadStatus(state){
            return state.ScheduledSermonsLoadStatus;
        },
        getSermonsAppendStatus(state){
            return state.SermonsAppendStatus;
        },
        getSermonsStoreStatus(state){
            return state.SermonsStoreStatus;
        },
        getSermonsUpdateStatus(state){
            return state.SermonsUpdateStatus;
        },
        getSermonsDeleteStatus(state){
            return state.SermonsDeleteStatus;
        },
        getSermonsRestoreStatus(state){
            return state.SermonsRestoreStatus;
        },
        getSermon(state){
            return state.Sermon;
        },
        getSermonLoadStatus(state){
            return state.SermonLoadStatus;
        },
        getMoreSermons(state){
            return state.SermonsCurrentPage<state.SermonsLastPage
        },
        getSermonsLastPage(state){
            return state.SermonsLastPage
        },
        getSermonsCurrentPage(state){
            return state.SermonsCurrentPage
        },
        getSearchResults(state){
            return state.SearchResults;
        },
        getSearchResultsStatus(state){
            return state.SearchResultsStatus;
        },
    }

};
