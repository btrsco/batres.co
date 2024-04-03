import axios from 'axios';

export default {
  install: function (app) {
    app.config.globalProperties.$axios = axios;
    axios.defaults.headers.common[ 'X-CSRF-TOKEN' ]
      = document.querySelector('meta[name="csrf-token"]').
      getAttribute('content');
  },
};