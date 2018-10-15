import "babel-polyfill"
window.Vue = require('vue')
window.axios = require("axios")
import { cacheAdapterEnhancer, throttleAdapterEnhancer } from 'axios-extensions';

window.http = axios.create({
	baseURL: '/',
	headers: { 'Cache-Control': 'no-cache' },
	adapter: throttleAdapterEnhancer(axios.defaults.adapter, { threshold: 2 * 1000 })
});

require('./load-components')

import {VueMasonryPlugin} from 'vue-masonry';
Vue.use(VueMasonryPlugin)

const app = new Vue({
    el: '#app',

    data: {
        clientHeight: 0,
        windowHeight: 0,
        windowWidth: 0,
        isScrolling: false,
        scrollPosition: 0,
        footerStuck: false,
        mobileMenuOpen: false,
        textSize: 0,
        videoPlaying: false
    },

    methods: {
        handleScroll () {
            this.scrollPosition = window.scrollY;
            this.isScrolling = this.scrollPosition > 40;
        },
        toggleMenu() {
            this.mobileMenuOpen = ! this.mobileMenuOpen;
        },
        increaseTextSize() {
            this.textSize = (this.textSize < 3 ? this.textSize + 1 : this.textSize);
        },
        decreaseTextSize() {
            this.textSize = (this.textSize > 0 ? this.textSize - 1 : this.textSize);
        },
        resetTextSize() {
            this.textSize = 0;
        },
        playVideo() {
            let player = this.$refs.videoplayer;
            let playbutton = this.$refs.videobutton;

            this.videoPlaying = true;
        },
        itemClicked() {
            this.mobileMenuOpen = false;
        }
    },

    mounted () {
        this.footerStuck = window.innerHeight > this.$root.$el.children[0].clientHeight;
        this.clientHeight = this.$root.$el.children[0].clientHeight;
        this.windowHeight = window.innerHeight;
        this.windowWidth = window.innerWidth;
        this.handleScroll();
    },

    created () {
        window.addEventListener('scroll', this.handleScroll)
    },

    destroyed () {
        window.removeEventListener('scroll', this.handleScroll)
    }

})
