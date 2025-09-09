import { createApp, h } from 'vue';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { library } from '@fortawesome/fontawesome-svg-core';
import { faUtensils, faCheese, faCake, faLeaf, faNewspaper, faKitchenSet, faClock, faStar, faArrowLeft, faFire } from '@fortawesome/free-solid-svg-icons';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from 'ziggy-js';
import { initializeTheme } from './composables/useAppearance';
import '../css/app.css';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

library.add(faUtensils, faCheese, faCake, faLeaf, faNewspaper, faKitchenSet, faClock, faStar, faArrowLeft, faFire);

createInertiaApp({
    title: (title) => (title ? `${title} - ${appName}` : appName),
    resolve: (name) =>
        resolvePageComponent(`./pages/${name}.vue`, import.meta.glob('./pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .component('font-awesome-icon', FontAwesomeIcon) // <-- enregistrement global
            .mount(el);
    },
    progress: { color: '#4B5563' },
});

initializeTheme();
