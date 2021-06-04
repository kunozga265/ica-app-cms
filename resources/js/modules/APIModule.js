/*
|-------------------------------------------------------------------------------
| VUEX modules/Model.js
|-------------------------------------------------------------------------------
| The Vuex data store for the Models
*/

import API from '../api/APIController.js';

export const Module = {
    state: {
        Models:[],
        ModelsLoadStatus:0,
        ModelsStoreStatus:0,
        ModelsUpdateStatus:0,
        ModelsDeleteStatus:0,

        Model:{},
        ModelLoadStatus:0,

        lastPage:0,
    },
    actions:{
        index({commit},data){
            commit('setModelsLoadStatus',1);

            API.index()
                .then(function (response) {
                    if(response.data.response==false){
                        commit('setModelsLoadStatus',4);
                    }
                    else{
                        commit('setModelsLoadStatus',2);
                        commit('setModels',response.Models);
                    }

                })
                .catch(function () {
                    commit('setModels',[]);
                    commit('setModelsLoadStatus',3);
                });

        },
        show({commit,state},data){
            commit('setModelLoadStatus',1);

            API.show(data.slug)
                .then(function (response) {
                    if (response.data.response == false) {
                        commit('setModelLoadStatus', 4);
                    }
                    else{
                        commit('setModel', response.Model);
                        commit('setModelLoadStatus', 2);
                    }
                })
                .catch(function () {
                    commit('setModel', {});
                    commit('setModelLoadStatus', 3);
                })
        },

        store({commit},data){
            commit('setModelsStoreStatus',1);
            API.store(data)
                .then(function (response) {
                    if(response.data.response==false){
                        commit('setModelsStoreStatus',4);
                    }
                    else{
                        commit('setModelsStoreStatus',2);
                        commit('setModels',response.Models);
                    }
                })
                .catch(function () {
                    commit('setModelsStoreStatus',3);
                })
        },
        update({commit},data){
            commit('setModelsUpdateStatus',1);
            API.update(data)
                .then(function (response) {
                    if(response.data.response==false){
                        commit('setModelsUpdateStatus',4);
                    }
                    else{
                        commit('setModelsUpdateStatus',2);
                        commit('setModels',response.Models);
                    }
                })
                .catch(function () {
                    commit('setModelsUpdateStatus',3);
                })
        },
        destroy({commit},data){
            commit('setModelsDeleteStatus',1);
            API.destroy(data)
                .then(function (response) {
                    if(response.data.response==false){
                        commit('setModelsDeleteStatus',4);
                    }
                    else{
                        commit('setModelsDeleteStatus',2);
                        commit('setModels',response.Models);
                    }
                })
                .catch(function () {
                    commit('setModelsDeleteStatus',3);
                })
        },
    },
    mutations:{
        //Models
        setModels(state,Models){
            state.Models=Models;
        },
        setModelsLoadStatus(state,status){
            state.ModelsLoadStatus=status;
        },
        //Model
        setModel(state,Model){
            state.Model=Model;
        },
        setModelLoadStatus(state,status){
            state.ModelLoadStatus=status;
        },
        setModelsStoreStatus(state,status){
            state.ModelsStoreStatus=status;
        },
        setModelsUpdateStatus(state,status){
            state.ModelsUpdateStatus=status;
        },
        setModelsDeleteStatus(state,status){
            state.ModelsDeleteStatus=status;
        },
        //Pagination
        setLastPage(state,lastPage){
            state.lastPage=lastPage;
        }

    },
    getters:{
        getModels(state){
            return state.Models;
        },
        getModelsLoadStatus(state){
            return state.ModelsLoadStatus;
        },
        getModelsStoreStatus(state){
            return state.ModelsStoreStatus;
        },
        getModelsUpdateStatus(state){
            return state.ModelsUpdateStatus;
        },
        getModelsDeleteStatus(state){
            return state.ModelsDeleteStatus;
        },
        getModel(state){
            return state.Model;
        },
        getModelLoadStatus(state){
            return state.ModelLoadStatus;
        },
        getModelDeleteStatus(state){
            return state.ModelDeleteStatus;
        },

    }

};
