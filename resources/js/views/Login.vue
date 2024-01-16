<template>
    <div class="h-lvh w-full flex justify-center items-center">
        <!-- login container -->
        <div class="p-5 shadow-md rounded mx-3 my-5">
            <!-- logo -->
            <div class="flex justify-center">
                <div class="text-center p-2 px-4 bg-logo rounded-lg inline-block leading-5 font-semibold tracking-widest text-lg text-white">LO<br>GO</div>
            </div>
            <!-- Title -->
            <div class="space-y-1 mt-5 text-center px-4">
                <h2 class=" text-3xl font-semibold">Log in to your account</h2>
                <p class="text-gray">welcome Back!</p>
            </div>
            <!-- Login Form -->
            <form class="mt-5" method="get"  @submit="login">
                <!-- Email -->
                <div>
                    <label for="email" class="block mb-2 text-sm">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email"
                        placeholder="admin@ps.com" 
                        required
                        class=" border border-lightGray text-sm rounded block w-full px-2.5 py-1.5 focus:outline-none text-gray" >
                 </div>
                 <!-- Password -->
                 <div class="mt-3 relative">
                    <label for="password" class="block mb-2 text-sm">Password</label>
                    <input 
                        type="password" 
                        id="password"
                        name="password"
                        required
                        class=" border border-lightGray text-sm rounded block w-full px-2.5 py-1.5 focus:outline-none text-gray"  
                        >
                    <div class="absolute right-3 bottom-2 cursor-pointer text-gray text-sm">
                        <i v-if="showpassword" class="fa-regular fa-eye text-primary" @click="showlogpass"></i>
                        <i v-else class="fa-regular fa-eye-slash text-primary" @click="showlogpass"></i>
                    </div>
                 </div>
                 <!-- Sign in Button -->
                 <router-link :to="{name: 'item'}"
                   
                 >
                    <div  class="block bg-blue p-1 text-center rounded w-full text-white mt-5 "
                   >Sign In</div>
                 </router-link>
            </form>
        </div>
    </div>
</template>

<script >
import { required, email } from '@vuelidate/validators'
    export default{
        name:'Login',
        data() {
            return {
                email: "",
                password: "",
                showpassword: false
            };
        },
        validations () {
        return {
        email: { required, email }, 
        password: { required }, 
        }
        },
        methods:{
            async login() {
            this.$store
                .dispatch("login", {
                    email: this.email,
                    password: this.password,

                })
                .then((response) => {
                    this.$router.push({ name: 'item' });

                })
                .catch((err) => {
                    if(err.response != undefined){
                        displayError(err.response.data.message)
                    }
                });
            },
            showlogpass(){
                this.showpassword=!this.showpassword
                var elem= document.querySelector('#password')
                const type = elem.getAttribute('type') === 'password' ? 'text' : 'password';
                elem.setAttribute('type', type);
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>