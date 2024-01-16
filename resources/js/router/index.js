import { createRouter, createWebHistory } from "vue-router";
import Login from '../views/Login.vue'
import ItemList from '../views/ItemList.vue'
import CategoryList from '../views/CategoryList.vue'
import AddItem from '../views/AddItem.vue'
import AddCategories from '../views/AddCategories.vue'


const routes = [
    {
        path: '/',
        name: 'login',
        component: Login
    },
    {
        path: '/itemlist',
        name: 'item',
        component: ItemList
    },
    {
        path: '/add-item',
        name: 'add-item',
        component: AddItem
    },
    {
        path: '/categories',
        name: 'categories',
        component: CategoryList
    },
    {
        path: '/add-categories',
        name: 'add-categories',
        component: AddCategories
    },
    
   
   
];
const router = createRouter({
    history: createWebHistory(),
    routes
});
export default router;