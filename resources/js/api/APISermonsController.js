/*
    Imports the API URL from the config.
*/
import { API } from '../config.js';
let controller='sermons';

export default {
    /*
        GET
    */
    index: function(page=1){
        return axios.get( API.API_URL + '/' + controller + '?page='+page);
    },

    /*
        GET
    */
    show: function(slug){
        return axios.get( API.API_URL + '/' + controller + '/'+slug);
    },

    /*
        GET
    */
    search: function(query){
        return axios.get( API.API_URL + '/' + controller + '/search/'+query);
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
