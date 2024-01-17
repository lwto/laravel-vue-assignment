
<template>
     <!-- Container -->
     <div class="flex">
        <!-- left Side -->
        <div :class="showMenu ? 'block lg:w-1/6 ' : 'hidden'">
            <div class="fixed bg-lightBlue min-h-screen px-4 pt-2 pb-16  z-50 w-2/3 sm:w-1/3 lg:w-1/6">
            <!-- close button -->
            <div class="cursor-pointer text-right lg:hidden" @click="toggleNav">
                <i class="fa-solid fa-times text-xl"></i>
            </div>

            <div class="flex flex-col space-y-80  lg:space-y-[500px]">
                <div class="flex flex-col lg:space-y-8">
                
                    <!-- Heading Container -->
                    <div class="flex items-center">
                
                        <!-- logo -->
                        <div class="flex justify-center">
                            <div class="text-center p-2 px-3 bg-logo rounded-lg inline-block leading-4 font-semibold tracking-widest text-medium text-white">LO<br>GO</div>
                        </div>
                        <h2 class="font-medium text-lg ml-4">Admin Panel</h2>
                    </div>
                    <!-- menu -->
                    <div class="flex flex-col space-y-3 mt-8 lg:mt-0">
                        <router-link :to="{ name: 'item' }" :class="(currentRouteName === 'item' || currentRouteName === 'add-item' ? ' bg-blue text-white' : '' )" class="flex space-x-3 items-center px-2 py-1 rounded" exact>
                            <i class="fa-solid fa-list"></i>
                            <p>Item</p>
                        </router-link>
                        <router-link :to="{ name: 'categories' }" :class="(currentRouteName === 'categories' || currentRouteName === 'add-categories' ? ' bg-blue text-white' : '' )" class="flex space-x-3 items-center px-2 py-1 rounded" exact>
                            <i class="fa-solid fa-list"></i>
                            <p>Category</p>
                        </router-link>
                    </div>
                
                </div>
                <div class="flex space-x-3 items-center px-2 h-full">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <p>Logout</p>
                </div>
            </div>
        </div>
        </div>
        <!-- Right Side -->
        <div :class="showMenu ? 'lg:w-5/6' : 'w-full'"  class="w-full">
            <!-- Top Nav -->
           <div class="border-b border-lightGray">
                <div class="flex justify-between items-center p-4 px-8 w-full" >
                    <div class="cursor-pointer" id="toggle-menu" @click="toggleNav">
                        <i class="fa-solid fa-bars text-xl"></i>
                    </div>
                <img :src="'./images/default.png'" class="rounded-full w-10 h-10 object-cover" />
                </div>
            </div>
            <!-- Main -->
            <div class="mx-8">
                <!-- Title -->
                <div class="mt-5">
                    <p class="text-blue">Items List</p>
                </div>
                <!-- Add Items -->
                <div class="text-right mt-5">
                    <router-link :to="{name : 'add-item'}" class="px-4 py-2 rounded bg-blue text-white">+ Add Items</router-link>
                </div>
                <!-- Table -->
                <div class="flex mt-5 space-x-3 items-center ">
                    <p>Show:</p>
                    <select v-model="per_page" class="text-gray border border-lightGray text-sm rounded p-2 " @change="getItems">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                    </select>
                </div>
                <div class="relative overflow-x-auto mt-6">
                    <table class="w-full text-sm text-left rtl:text-left">
                        <thead  class="text-xs text-white uppercase bg-blue">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    No
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Item
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Category
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Description
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Price
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Owner
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Publish
                                </th>
                            </tr>
                        </thead>
                        <tbody v-if="items.length > 0">
                            <tr v-for="(item,key) in items" :key="key" class="bg-white border-b border-lightGray">
                                <td scope="row" class="px-6 py-3 font-medium whitespace-nowrap">
                                    <div class="flex space-x-1">
                                        <router-link to="#" class="bg-green rounded p-1 px-2">
                                            <i class="fa-solid fa-pen text-white text-sm"></i> 
                                        </router-link>
                                        <button type="button" @click.prevent="deleteItem(item.id)" class="bg-red rounded p-1 px-2">
                                            <i class="fa-solid fa-trash text-white text-sm"></i> 
                                        </button>
                                    </div>
                                </td>
                                <td class="px-6 py-3">
                                    {{ item.id}}
                                </td>
                                <td class="px-6 py-3">
                                    {{ item.item_name }}
                                </td>
                                <td class="px-6 py-3">
                                    {{ item.category }}
                                </td>
                                <td class="px-6 py-3">
                                    <div v-html="item.description"></div>
                                </td>
                                <td class="px-6 py-3">
                                    {{ item.price }}

                                </td>
                                <td class="px-6 py-3">
                                    {{ item.owner_name }}

                                </td>
                                <td class="px-6 py-3 ">
                                    <div>
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" class="sr-only peer" :checked="item.status == 1" disabled="disabled">
                                            <div class="w-11 h-6 bg-lightGray peer-focus:outline-none  rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-lightGray after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue"></div>
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            
                        </tbody>
                        <tbody v-else>
                            <tr>
                                <td colspan="8" align="center" class="px-6 py-3">No Items Found.</td>
                            </tr>
                        </tbody>
                    </table>

                   
                </div>
                <!-- Pagination -->
                    <div class="mt-4 flex flex-col space-y-3 justify-between items-center md:flex-row">
                    <p class="text-sm">Showing {{ pageInfo.per_page }} to {{ pageInfo.total }} entries</p>
                    <Page :total="pageInfo.total" :current="pageInfo.current_page" :page-size="parseInt(pageInfo.per_page)" @on-change="getItems" v-if="pageInfo" />
                </div>

            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';

export default {
    name:'items',

    data(){
        return {
            items:[],
            showMenu: false,
            total:1,
            pageInfo:null,
            per_page: 10
        }
    },
    computed: {
        currentRouteName() {
            return this.$route.name;
            },
    },
    created(){
        this.getItems();
    },
    methods:{
        toggleNav: function () {
        this.showMenu = !this.showMenu;
        },
        async getItems(page = 1){
            await axios.get(`/api/item-list?page=${page}&total=${this.per_page}`).then(response=>{
                this.items = response.data.items.data;
                this.pageInfo = response.data.items

            }).catch(error=>{
                console.log(error)
                this.items = []
            })
        },
        async deleteItem(id){
            if(confirm("Are you sure to delete this item ?")){
                await axios.delete(`/api/delete-item/${id}`).then(response=>{
                    if(response.data.code == 200){

                        this.getItems();
                    }
                }).catch(error=>{
                    console.log(error)
                this.categories = []

                })
            }
        },
    },
    mounted(){
        console.log('Item List Mounted')
        
    },
}
</script>