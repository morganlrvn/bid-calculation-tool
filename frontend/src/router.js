import BidPrice from './components/BidPrice.vue'
import { createRouter, createWebHistory } from 'vue-router'

const routes = [

    {
        path: '/bid-price',
        name: 'bidPrice',
        component: BidPrice
    },
    // Ajoutez vos autres routes ici
]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})

export default router