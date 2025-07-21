import axios from 'axios';
import * as htmx from "htmx.org";

window.htmx = htmx;
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Axios interceptor to add CSRF token to every request
axios.interceptors.request.use(function (config) {
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    if (token) {
        config.headers['X-CSRF-TOKEN'] = token;
    }
    return config;
}, function (error) {
    return Promise.reject(error);
});

htmx.defineExtension("ajax-header", {
    onEvent: function (name, evt) {
        if (name === "htmx:configRequest") {
            evt.detail.headers["X-Requested-With"] = "XMLHttpRequest";
        }
    },
});

document.addEventListener("htmx:configRequest", function (event) {
    event.detail.headers["X-CSRF-TOKEN"] = document.querySelector(
        'meta[name="csrf-token"]',
    ).content;
    console.log("Htmx: Added CSRF token.");
});
