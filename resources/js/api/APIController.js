/*
    Imports the API URL from the config.
*/
import { API } from '../config.js';
let controller='';

export default {
    /*
        GET
    */
    index: function(){
        return axios.get( API.API_URL + '/' + controller + '/');
    },

    /*
        GET
    */
    show: function(id){
        return axios.get( API.API_URL + '/' + controller + '/'+id);
    },

    /*
      POST
    */
    store: function(data){
        return axios.post( API.API_URL + '/' + controller + '/',
            {

            }
        );
    },

    /*
      POST
    */
    update: function( data,id){
        return axios.post( API.API_URL + '/' + controller + '/' + id,
            {

            }
        );
    },
    /*
      DELETE
    */
    destroy: function( id){
        return axios.delete( API.API_URL + '/' + controller + '/'+id);
    },

}
