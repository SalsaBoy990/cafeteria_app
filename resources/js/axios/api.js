import axios from "axios";

// Add a request interceptor
axios.interceptors.request.use(function (config) {
    //config.baseURL = REST_URL;
    config.headers['Accept'] = 'application/json';
    config.headers['Content-Type'] = 'application/json';
    return config;
});

export default axios;
