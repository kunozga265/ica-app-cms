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
                title:data.title,
                subtitle:data.subtitle,
                body:data.body,
                author_id:data.author_id,
                series_id:data.series_id,
                video_url:data.video_url,
                published_at:data.published_at
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
                subtitle:data.subtitle,
                body:data.body,
                author_id:data.author_id,
                series_id:data.series_id,
                video_url:data.video_url,
                published_at:data.published_at
            }
        );
    },
    /*
      DELETE
    */
    destroy: function(data){
        return axios.delete( API.API_URL + '/' + controller + '/'+data.slug);
    },

}
