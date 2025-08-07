import axios from 'axios';

let locale = document.documentElement.lang || 'ro';

axios.defaults.baseURL = import.meta.env.VITE_API_URL || window.location.origin + `/` + locale;
axios.defaults.headers.common['Accept'] = 'application/json';
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.headers.common['Accept-Language'] = locale;
axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;

window.axios = axios;
