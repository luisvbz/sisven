import "./bootstrap";
import "../css/app.css";
import "../css/uicons/css/uicons-bold-rounded.css"
import "@protonemedia/laravel-splade/dist/style.css";
import CurrencyInput from './components/CurrencyInput.vue';
import InputMask from './components/InputMask.vue';
import ToastPlugin from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css'
import NuevaVenta from './components/NuevaVenta.vue';

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
            CurrencyInput,
            InputMask,
            NuevaVenta
        }
    })
    .use(ToastPlugin)
    .mount(el);
