import axios from 'axios';

export const api = axios.create({
    baseURL: '/api', // utilise le proxy Vite
    withCredentials: true, // important pour envoyer les cookies
});

