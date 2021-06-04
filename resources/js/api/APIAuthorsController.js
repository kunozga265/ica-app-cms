/*
    Imports the API URL from the config.
*/
import { API } from '../config.js';
let controller='authors';

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
    show: function(slug,page){
        return axios.get( API.API_URL + '/' + controller + '/'+slug+ '?page='+page);
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
    update: function( data,slug){
        return axios.post( API.API_URL + '/' + controller + '/' + slug,
            {

            }
        );
    },
    /*
      DELETE
    */
    destroy: function( slug){
        return axios.delete( API.API_URL + '/' + controller + '/'+slug);
    },

}
