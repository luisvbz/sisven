import "./bootstrap";
import "../css/app.css";
import "../css/uicons/css/uicons-bold-rounded.css"
import "@protonemedia/laravel-splade/dist/style.css";
import CurrencyInput from './components/CurrencyInput.vue';

import { createApp } from "vue/dist/vue.esm-bundler.js";
import { renderSpladeApp, SpladePlugin } from "@protonemedia/laravel-splade";

const el = document.getElementById("app");

createApp({
    render: renderSpladeApp({ el })
})
    .use(SpladePlugin, {
        "max_keep_alive": 10,
        "transform_anchors": false,
        "progress_bar": true,
        "components": {
            CurrencyInput
        }
    })
    .mount(el);
