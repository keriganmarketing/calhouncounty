// Vue.component('component-name', require('path/to/component'))

//navigation menus
Vue.component('main-menu', require('./components/navigation/MainNavigationMenu.vue'));
Vue.component('mobile-menu', require('./components/navigation/MobileNavigationMenu.vue'));
Vue.component('footer-menu', require('./components/navigation/FooterNavigationMenu.vue'));

//plugins
Vue.component('social-icons', require('./components/SocialMediaIcons.vue'));
Vue.component('kma-slider', require('./components/KMASliderModule.vue'));
Vue.component('fit-text', require('./components/FitText.vue'));
Vue.component('search-box', require('./components/SearchBox.vue'));