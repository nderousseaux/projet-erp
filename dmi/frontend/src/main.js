import { createApp } from "vue";
import App from "@/App.vue";
import router from "@/router";
import store from "@/store";
import axios from "axios";
import VueAxios from "vue-axios";

import ApiFunctions from "@/api";

let app = createApp(App);

app.config.globalProperties.axios = axios;
app.config.globalProperties.axios.defaults.baseURL = "http://localhost:3001";
app.config.globalProperties.api = ApiFunctions;

app
	.use(store)
	.use(VueAxios, axios)
	.use(router)
	.mount("#app");