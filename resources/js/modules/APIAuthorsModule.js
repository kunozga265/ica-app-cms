/*
|-------------------------------------------------------------------------------
| VUEX modules/Author.js
|-------------------------------------------------------------------------------
| The Vuex data store for the Authors
*/

import API from '../api/APIAuthorsController.js';

export const Authors = {
    state: {
        Authors:[],
        AuthorsLoadStatus:0,
        AuthorsStoreStatus:0,
        AuthorsUpdateStatus:0,
        AuthorsDeleteStatus:0,

        Author:{},
        AuthorLoadStatus:0,
        AuthorSermons:[],
        AuthorSermonsLoadStatus:0,
        AuthorSermonsAppendStatus:0,

        lastPage:0,
        currentPage:0,
    },
    actions:{
        AuthorsIndex({commit},data){
            commit('setAuthorsLoadStatus',1);

            API.index()
                .then(function (response) {
                    if(response.data.response===false){
                        commit('setAuthorsLoadStatus',4);
                    }
                    else{
                        commit('setAuthorsLoadStatus',2);
                        commit('setAuthors',response.data.authors);
                    }

                })
                .catch(function () {
                    commit('setAuthorsLoadStatus',3);
                });

        },
        AuthorShow({commit,state},data){
            commit('setAuthorLoadStatus',1);

            API.show(data.slug)
                .then(function (response) {
                    if (response.status === 204) {
                        commit('setAuthorLoadStatus', 4);
                    }
                    else{
                        commit('setAuthor', response.data.author);
                        commit('setAuthorSermons', response.data.sermons.sermons);
                        commit('setLastPage',response.data.sermons.meta.last_page)
                        commit('setCurrentPage',response.data.sermons.meta.current_page)
                        commit('setAuthorLoadStatus', 2);
                    }
                })
                .catch(function () {
                    commit('setAuthorSermons', []);
                    commit('setAuthorLoadStatus', 3);
                })
        },
        AuthorAppendSermons({commit,state}){
            commit('setAuthorAppendStatus',1);

            if(state.currentPage<state.lastPage && !(state.Author).isEmpty) {
                let page = state.currentPage + 1
                API.show(state.Author.slug,page)
                    .then(function (response) {
                        if (response.status === 204) {
                            commit('setAuthorAppendStatus', 4);
                        } else {
                            commit('appendAuthorSermons', response.data.sermons.sermons);
                            commit('setLastPage', response.data.sermons.meta.last_page)
                            commit('setCurrentPage', response.data.sermons.meta.current_page)
                            commit('setAuthorAppendStatus', 2);
                        }
                    })
                    .catch(function () {
                        commit('setAuthorSermons', []);
                        commit('setAuthorAppendStatus', 3);
                    })
            }
        },

        store({commit},data){
            commit('setAuthorsStoreStatus',1);
            API.store(data)
                .then(function (response) {
                    if(response.data.response==false){
                        commit('setAuthorsStoreStatus',4);
                    }
                    else{
                        commit('setAuthorsStoreStatus',2);
                        commit('setAuthors',response.Authors);
                    }
                })
                .catch(function () {
                    commit('setAuthorsStoreStatus',3);
                })
        },
        update({commit},data){
            commit('setAuthorsUpdateStatus',1);
            API.update(data)
                .then(function (response) {
                    if(response.data.response==false){
                        commit('setAuthorsUpdateStatus',4);
                    }
                    else{
                        commit('setAuthorsUpdateStatus',2);
                        commit('setAuthors',response.Authors);
                    }
                })
                .catch(function () {
                    commit('setAuthorsUpdateStatus',3);
                })
        },
        destroy({commit},data){
            commit('setAuthorsDeleteStatus',1);
            API.destroy(data)
                .then(function (response) {
                    if(response.data.response==false){
                        commit('setAuthorsDeleteStatus',4);
                    }
                    else{
                        commit('setAuthorsDeleteStatus',2);
                        commit('setAuthors',response.Authors);
                    }
                })
                .catch(function () {
                    commit('setAuthorsDeleteStatus',3);
                })
        },
    },
    mutations:{
        //Authors
        setAuthors(state,Authors){
            state.Authors=Authors;
        },
        setAuthorsLoadStatus(state,status){
            state.AuthorsLoadStatus=status;
        },
        //Author
        setAuthor(state,Author){
            state.Author=Author;
        },
        setAuthorLoadStatus(state,status){
            state.AuthorLoadStatus=status;
        },
        setAuthorAppendStatus(state,status){
            state.AuthorAppendStatus=status;
        },
        setAuthorSermons(state,AuthorSermons){
            state.AuthorSermons=AuthorSermons;
        },
        setAuthorSermonsLoadStatus(state,status){
            state.AuthorSermonsLoadStatus=status;
        },
        appendAuthorSermons(state,AuthorSermons){
            for(let x in AuthorSermons){
                (state.AuthorSermons).push(AuthorSermons[x]);
            }
        },
        appendAuthorSermonsLoadStatus(state,status){
            state.AuthorSermonsAppendStatus=status;
        },
        setAuthorsStoreStatus(state,status){
            state.AuthorsStoreStatus=status;
        },
        setAuthorsUpdateStatus(state,status){
            state.AuthorsUpdateStatus=status;
        },
        setAuthorsDeleteStatus(state,status){
            state.AuthorsDeleteStatus=status;
        },
        //Pagination
        setLastPage(state,lastPage){
            state.lastPage=lastPage;
        },
        setCurrentPage(state,currentPage){
            state.currentPage=currentPage;
        }

    },
    getters:{
        getAuthors(state){
            return state.Authors;
        },
        getAuthorsLoadStatus(state){
            return state.AuthorsLoadStatus;
        },
        getAuthorsStoreStatus(state){
            return state.AuthorsStoreStatus;
        },
        getAuthorsUpdateStatus(state){
            return state.AuthorsUpdateStatus;
        },
        getAuthorsDeleteStatus(state){
            return state.AuthorsDeleteStatus;
        },
        getAuthor(state){
            return state.Author;
        },
        getAuthorLoadStatus(state){
            return state.AuthorLoadStatus;
        },
        getAuthorSermons(state){
            return state.AuthorSermons;
        },
        getAuthorSermonsLoadStatus(state){
            return state.AuthorSermonsLoadStatus;
        },
        getAuthorSermonsAppendStatus(state){
            return state.AuthorSermonsAppendStatus;
        },
        getMoreAuthorSermons(state){
            return state.currentPage<state.lastPage
        }
    }

};
