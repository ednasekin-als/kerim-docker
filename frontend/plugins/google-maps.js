import Vue from "vue";
import * as VueGoogleMaps from "vue2-google-maps";

Vue.use(VueGoogleMaps, {
    load: {
        key: "AIzaSyB7qB-Rc_Zovei0r7OBXX1clCHgxgY7Yzc",
        libraries: "places",
    },
});
