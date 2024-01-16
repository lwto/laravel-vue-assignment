
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
                    <p class="">
                        Items List 
                        <i class="fa-solid fa-angle-right text-gray text-sm"></i> 
                        <span class="text-blue"> Add Items</span>
                    </p>
                </div>
                <!-- Add Items -->
                <div class="bg-lightBlue p-1 px-2 mt-5 rounded">
                    <p>Add Items</p>
                </div>
                <!-- Form -->
                <div class="mt-4 b-4">
                    <form  @submit.prevent="saveItem">
                        <div class="flex flex-col md:flex-row px-2">
                            <div class="md:w-1/2">
                                <p>Item Information</p>
                                <!-- Item Name -->
                                <div class="mt-3">
                                    <label for="name" class="block mb-2 text-sm">Item Name <span class="text-red">*</span></label>
                                    <input v-model="items.item_name" type="text" id="name" class=" border border-lightGray text-sm rounded block w-full px-2.5 py-1.5 focus:outline-none text-gray" placeholder="Your Name" required>
                                </div>
                                <!-- Select Category -->
                                <div class="mt-3">
                                    <label for="categories" class="block mb-2 text-sm">Select Category <span class="text-red">*</span></label>
                                    <select v-model="items.category" id="categories" class="text-gray border border-lightGray text-sm rounded p-2 w-full">
                                        <option selected>Select Category</option>
                                        <option v-for="category in categories" :value="category.name">{{ category.name }}</option>
                                    </select>                                
                                </div>
                                <!-- Price -->
                                <div class="mt-3">
                                    <label for="price" class="block mb-2 text-sm">Price <span class="text-red">*</span></label>
                                    <input type="price" v-model="items.price" id="price" class=" border border-lightGray text-sm rounded block w-full px-2.5 py-1.5 focus:outline-none text-gray" placeholder="Enter Price" required>
                                </div>
                                <!-- text editor -->
                                <div class="mt-3 z-0">
                                    <label for="description" class="block mb-2 text-sm">Description <span class="text-red">*</span></label>
                                    <ckeditor :editor="editor" v-model="items.description" :config="editorConfig"></ckeditor>
                                </div>
                                <!-- Item condition -->
                                <div class="mt-3">
                                    <label for="condition" class="block mb-2 text-sm">Select Item Condition <span class="text-red">*</span></label>
                                    <select v-model="items.condition" id="condition" class="text-gray border border-lightGray text-sm rounded p-2 w-full">
                                        <option selected>Select Item Condition</option>
                                        <option value="New">New</option>
                                        <option value="Used">Used</option>
                                        <option value="Good Second Hand">Good Second Hand</option>
                                    </select>                                
                                </div>
                                <!-- Item Type -->
                                <div class="mt-3">
                                    <label for="type" class="block mb-2 text-sm">Select Item Type <span class="text-red">*</span></label>
                                    <select id="type" v-model="items.type" class="text-gray border border-lightGray text-sm rounded p-2 w-full">
                                        <option selected>Select Item Type</option>
                                        <option value="For Sell">For Sell</option>
                                        <option value="For Buy">For Buy</option>
                                        <option value="For Exchange">For Exchange</option>
                                    </select>                                
                                </div>
                                <!-- Status -->
                                <p class="mt-3 text-sm mb-2">Status</p>
                                <div class="flex items-center me-4">
                                    <input id="status" type="checkbox" value="publish" class="text-blue w-4 h-4 border-gray rounded bg-blue">
                                    <label for="status" class="ms-2 text-sm hover:cursor-pointer">Publish</label>
                                </div>
                                <!-- Upload Photo -->
                                <p for="category" class="block mb-1 text-sm mt-3">Category Photo <span class="text-red">*</span></p>
                                <p class="text-gray text-xs mb-2">Recommended size 400 x 200</p>
                                <div class="flex items-center justify-center w-full">
                                
                                    <label for="file_upload" class="flex flex-col items-center justify-center w-full h-64 border-lightGray border rounded cursor-pointer ">
                                        <div id="file_name" class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg class="w-8 h-8 mb-4 text-gray" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                            </svg>
                                            <p class="text-sm text-gray">Drag and drop here</p>
                                            <p class="mb-2 text-sm text-gray">or</p>
                                            <div class="text-white bg-blue font-medium rounded px-5 py-1.5 focus:outline-none text-sm">Choose Files</div>
                                        </div>
                                        <input id="file_upload" type="file" class="hidden" name="photo"  />
                                    </label>
                                </div> 
                                
                            </div>
                            <div class="md:w-1/2 px-2">
                                <p>Owner Information</p>
                                <div class="mt-3">
                                    <label for="owner-name" class="block mb-2 text-sm">Owner Name <span class="text-red">*</span></label>
                                    <input v-model="items.owner_name" type="owner-name" id="owner-name" class=" border border-lightGray text-sm rounded block w-full px-2.5 py-1.5 focus:outline-none text-gray" placeholder="Your Name" required>
                                </div>
                                <div class="mt-3">
                                    <p class="block mb-2 text-sm">Contact Number</p>
                                    <div class=" flex">
                                        <select  id="country-code" class="text-sm p-2 px-4 items-center min-w-fit rounded-s-md border border-e-0 border-lightGray">
                                            <option selected>+ 95</option>
                                            
                                        </select>                                        
                                        <input v-model="items.contact" type="text" id="number" class="py-2 px-3 pe-11 block w-full border border-lightGray shadow-sm rounded-e-lg text-sm focus:outline-none " placeholder="Add Number">
                                    </div>                               
                                </div>
                                <div class="mt-3 ">
                                    <label for="address" class="block mb-2 text-sm">Address</label>
                                    <textarea v-model="items.address" name="address" id="address"  rows="3" class=" border border-lightGray w-full rounded"></textarea>
                                </div>
                                <!-- Map -->
                                <div id="map" class="mt-3">
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 flex space-x-5 items-center justify-end px-2 pb-6">
                            <router-link :to="{name: 'item'}" class="text-blue">Cancel</router-link>
                            <button type="submit" class="text-white bg-blue hover:bg-blue-800  font-medium rounded text-sm px-5 py-1.5 focus:outline-none">Save</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
     
</template>

<script>
    import axios from 'axios';
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    import jQuery from 'jquery';
    import $ from 'jquery';
    import L from 'leaflet';
        let map;
        let mapInitialized;
        
        export default {  
            data() {
                return {
                    editor: ClassicEditor,
                    editorData: 'Enter Description',
                    editorConfig: {
                        // The configuration of the editor.
                    }, 
                    showMenu: false,
                    items:{},
                    categories:{},
                    item_name: '',
                    category: '',
                    status: 0,
                    description: '',
                    condition: '',
                    type: '',
                    photo: '',
                    price: '',
                    owner_name: '',
                    contact: '',
                    address: '',

                    
                          
                };
            },
            computed: {
                currentRouteName() {
                    return this.$route.name;
                    },
            },
            created(){
            this.getCategories();
             },
            methods:{
                toggleNav: function () {
                this.showMenu = !this.showMenu;
                },
                async getCategories(){
                await axios.get('/api/category-list').then(response=>{
                    this.categories = response.data.categories;
                    console.log(this.categories);
                }).catch(error=>{
                    console.log(error)
                    this.categories = []
                })
            },
                async saveItem(){
                let formData = new FormData();
                formData.append('item_name', this.items.name);
                formData.append('category', this.items.category);
                formData.append('price', this.items.price);
                formData.append('description', this.items.description);
                formData.append('condition', this.items.condition);
                formData.append('type', this.items.type);
                formData.append('status', this.items.status);
                formData.append('photo', this.items.photo);
                formData.append('owner_name', this.items.owner_name);
                formData.append('contact', this.items.contact);
                formData.append('address', this.items.address);
                await axios.post('/api/save-item', formData).then(response=>{
                console.log(response);
                if(response.data.code == 200){
                    this.$router.push({ name: 'item' });
                }
                }).catch(error=>{
                    console.log(error)

                })
                }
                },
                mounted(){
                    $("#file-upload").change(function(){
                    $("#file-name").text(this.files[0].name);
                    });

                    map = L.map('map').setView([16.871311, 96.199379], 13);
                    L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                    maxZoom: 20,
                    id: 'streets-v12',
                    accessToken: 'pk.eyJ1IjoibGlud2F0aGFuIiwiYSI6ImNscmV3bHBmZzFqOGUybG13dnNtNzcxeWIifQ.q9lvX62JZGoZ9elRZNtAGw',
                    attribution: '&copy; <a href="https://stadiamaps.com/" target="_blank">Stadia Maps</a>, &copy; <a href="https://openmaptiles.org/" target="_blank">OpenMapTiles</a> &copy; <a href="https://www.openstreetmap.org/copyright" target="_blank">OpenStreetMap</a>',
                }).addTo(map);
             
            }

        }
</script>
<style>
#map { height: 615px; }

</style>
