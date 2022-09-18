require('./bootstrap');

import { createApp } from 'vue'
import ExampleComponent from './components/ExampleComponent.vue'
import TaskComponent from './components/TaskComponent.vue'

createApp({
    components: {
        ExampleComponent,
        TaskComponent
    }
}).mount('#app')