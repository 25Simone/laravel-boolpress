import Vue from "vue";
import VueRouter from "vue-router";
import Home from "./pages/Home";
import Contacts from "./pages/Contacts";
import Show from "./pages/posts/Show";
import ErrorPage from "./pages/ErrorPage";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "//",
            component: Home,
            name:"home.index",
            meta: {title: "Boolpress | Homepage", linkTxt: "Home",},
        },
        {
            path: "/contacts",
            component: Contacts,
            name:"contacts.index",
            meta: {title: "Boolpress | Contacts", linkTxt: "Contact Us",},
        },
        {
            path: "/posts/:post",
            component: Show,
            name:"posts.show",
            meta: {title: "Dettagli"},
        },
        {
            path: "/not-found",
            alias: "*",
            component: ErrorPage,
            name: "error",
        },
    ]
});

// Change the page title before loading each route
router.beforeEach((to, from, next) => {
    document.title = to.meta.title;
    next()
});

// Export th einstance (make it public)
export default router;