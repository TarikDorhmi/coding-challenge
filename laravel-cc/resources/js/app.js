// import { createApp } from "vue";
import { createApp } from "vue/dist/vue.esm-bundler";
import { createRouter, createWebHistory } from "vue-router";

import Products from "./components/Products.vue";

const routes = [
    { path: "/products-spa", component: Products },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

const app = createApp({
    components: {
        Products,
    },
});

app.use(router);
app.mount("#app");
