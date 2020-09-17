import ExampleComponent from './components/ExampleComponent.vue';
import ChangesComponent from './components/ChangesComponent.vue';

export const routes = [
    { path: '/example', component: ExampleComponent },
    { path: '/itinerary/:pnr', component: ChangesComponent }
];