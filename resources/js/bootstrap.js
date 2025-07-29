import axios from 'axios';

window.axios = axios;
axios.defaults.baseURL = import.meta.env.APP_URL || window.location.origin;
axios.defaults.headers.common['Accept'] = 'application/json';
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.headers.common['Accept-Language'] = document.documentElement.lang || 'ro';
axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;
