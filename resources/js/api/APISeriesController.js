/*
    Imports the API URL from the config.
*/
import { API } from '../config.js';
let controller='series';

export default {
    /*
        GET
    */
    index: function(data){
        return axios.get( API.API_URL + '/' + controller + '/filter/'+data.filter + '/' + data.query +'?page='+data.page);
    },

    /*
        GET
    */
    show: function(data){
        return axios.get( API.API_URL + '/' + controller + '/view/'+data.slug+ '/'+data.filter);
    },
    /*
        GET
    */
    search: function(query){
        return axios.get( API.API_URL + '/' + controller + '/search/'+query);
    },
    /*
        GET
    */
    options: function(){
        return axios.get( API.API_URL + '/' + controller + '/options');
    },

    /*
      POST
    */
    store: function(data){
        return axios.post( API.API_URL + '/' + controller + '/',
            {
                title:data.title,
                description:data.description,
            }
        );
    },

    /*
      POST
    */
    update: function( data){
        return axios.post( API.API_URL + '/' + controller + '/' + data.slug,
            {
                title:data.title,
                description:data.description,
            }
        );
    },
    /*
      DELETE
    */
    trash: function(data){
        return axios.delete( API.API_URL + '/' + controller + '/trash/'+data.slug);
    },
    /*
      DELETE
    */
    restore: function(data){
        return axios.delete( API.API_URL + '/' + controller + '/restore/'+data.slug);
    },
    /*
      DELETE
    */
    destroy: function(data){
        return axios.delete( API.API_URL + '/' + controller + '/destroy/'+data.slug);
    },

}
