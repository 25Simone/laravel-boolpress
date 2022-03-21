import Vue from "vue";
import VueRouter from "vue-router";
import Home from "./pages/Home";
import Contacts from "./pages/Contacts";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    routes: [
        {path: "/", component: Home, name:"home.index"},
        {path: "/contacts", component: Contacts, name:"contacts.index"},
    ]
});

// Export th einstance (make it public)
export default router;