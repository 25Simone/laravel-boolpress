import Vue from "vue";
import VueRouter from "vue-router";
import Home from "./pages/Home";

Vue.use(VueRouter);

const router = new VueRouter({
    routes: [
        {path: "/", component: Home, name:"home.index"},
    ]
});

// Export th einstance (make it public)
export default router;