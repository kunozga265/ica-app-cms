/*
    Imports the API URL from the config.
*/
import { API } from '../config.js';
let controller='authors';

export default {
    /*
        GET
    */
    index: function(data){
        return axios.get( API.API_URL + '/' + controller + '/filter/'+data.filter + '/' + data.query);
    },
    /*
        GET
    */
    getSermonsByAuthor: function(data){
        return axios.get( API.API_URL + '/' + controller + '/'+data.slug + '/sermons?page=' + data.page);
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
                name:data.name,
                suffix:data.suffix,
                title:data.title,
                avatar:data.avatar,
                ica_pastor:data.ica_pastor,
                biography:data.biography
            }
        );
    },

    /*
      POST
    */
    update: function(data){
        return axios.post( API.API_URL + '/' + controller + '/' + data.slug,
            {
                name:data.name,
                suffix:data.suffix,
                title:data.title,
                avatar:data.avatar,
                ica_pastor:data.ica_pastor,
                biography:data.biography
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
