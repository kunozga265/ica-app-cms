/*
    Defines the API route we are using.
*/
let url = '';

switch( process.env.NODE_ENV ){
    case 'development':
        url = 'http://localhost:8000/';
        break;
    case 'production':
        url = 'https://ica.ovationadagency.com/';
        break;
}

export const API = {
    API_URL: url+"api",
    URL: url
};
