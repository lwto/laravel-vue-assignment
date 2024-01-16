
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
                   
            <div class="mx-8">
                <!-- Title -->
                <div class="mt-5">
                    <p class="">
                        Categories
                        <i class="fa-solid fa-angle-right text-gray text-sm"></i> 
                        <span class="text-blue"> Add Categories</span>
                    </p>
                </div>
                <!-- Add Categories -->
                <div class="bg-lightBlue p-1 px-2 mt-5 rounded">
                    <p>Add Categories</p>
                </div>
                <!-- Form -->
                <div class="md:max-w-md">
                    <form @submit.prevent="saveCategory" >
                        <!-- Category Name -->
                        <div class="mt-3">
                            <label for="category" class="block mb-2 text-sm">Category <span class="text-red">*</span></label>
                            <input  v-model="categories.name"  type="text" id="category" required class=" border border-lightGray text-sm rounded block w-full px-2.5 py-1.5 focus:outline-none text-gray" placeholder="Your Name" >
                        </div>
                        <!-- Upload Photo -->
                        <p for="category" class="block mb-2 text-sm mt-3">Category Photo <span class="text-red">*</span></p>
                        <div class="flex items-center justify-center w-full">
                           
                            <label for="file-upload" class="flex flex-col items-center justify-center w-full h-64 border-lightGray border rounded cursor-pointer ">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-4 text-gray" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                    </svg>
                                    <div id="file-name" >
                                        <p class="text-sm text-gray">Drag and drop here</p>
                                        <p class="mb-2 text-sm text-gray text-center">or</p>
                                        <div class="text-white bg-blue font-medium rounded text-sm px-5 py-1.5 focus:outline-none text-sm" >Choose Files</div>
                                    </div>
                                </div>
                                <input id="file-upload"   type="file" name="photo" class="hidden" required/>
                            </label>
                        </div> 
                        
                        <!-- Status -->
                        <p class="mt-3 text-sm mb-2">Status</p>
                        <div class="flex items-center me-4">
                            <input id="status" v-model="categories.status"  type="checkbox" value="1" class="text-blue w-4 h-4 border-gray rounded bg-blue" />
                            <label for="status" class="block ml-2 text-sm">Publish</label>
                        </div>
                        <!-- Buttons -->
                        <div class="mt-6 flex space-x-5 items-center justify-end">
                            <router-link :to="{name: 'categories'}" class="text-blue">Cancel</router-link>
                            <button type="submit" class="text-white bg-blue hover:bg-blue-800  font-medium rounded text-sm px-5 py-1.5 focus:outline-none">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import axios from 'axios'
import $ from 'jquery';
import { required } from '@vuelidate/validators'
export default {
    name:"AddCategory",
    data(){
        return {
            categories:{},
            name: '',
            photo: '',
            status: 1,
            showMenu: false,
            
        }
    },
    validations () {
        return {
            name: { required }, 
            photo: { required }, 
            }
        },
    computed: {
        currentRouteName() {
            return this.$route.name;
            },
    },
    methods:{
        toggleNav: function () {
        this.showMenu = !this.showMenu;
        },
       async saveCategory(){
        let formData = new FormData();
        formData.append('name', this.categories.name);
        formData.append('photo', this.categories.photo);
        formData.append('status', this.status);
        await axios.post('/api/save-category', formData).then(response=>{
                this.$router.push({ name: 'categories' });
                }).catch(error=>{
                    console.log(error)

                })
       }
    },
    mounted(){
        $("#file-upload").change(function(){
        $("#file-name").text(this.files[0].name);
        });
    }
}
</script>