<template>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-3xl font-normal leading-normal mt-0 mb-2 text-pink-800">
                        Maison numero 1
                    </h3>
                    <form v-on:submit.prevent="postNow" method="post">
                        <h3 class="text-1xl font-normal leading-normal mt-0 mb-2 text-black">
                            Entrez le nom
                        </h3>
                        <div class="mb-3 pt-0">
                            <input name="name" type="text"  class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm border-0 shadow outline-none focus:outline-none focus:ring w-full"/>
                        </div>
                        <h3 class="text-1xl font-normal leading-normal mt-0 mb-2 text-black">
                            Entrez l'adresse
                        </h3>
                        <div class="mb-3 pt-0">
                            <textarea name="address" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" rows="4"></textarea>
                        </div>
                        <h3 class="text-1xl font-normal leading-normal mt-0 mb-2 text-black">
                            Entrez le prix affiché
                        </h3>
                        <div class="mb-3 pt-0">
                            <input name="price" type="number"  class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm border-0 shadow outline-none focus:outline-none focus:ring w-full"/>
                        </div><h3 class="text-1xl font-normal leading-normal mt-0 mb-2 text-black">
                            Entrez la surface habitable
                        </h3>
                        <div class="mb-3 pt-0">
                            <input name="surface" type="number"  class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm border-0 shadow outline-none focus:outline-none focus:ring w-full"/>
                        </div>
                        <input name="id" type="hidden"/>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
                            Validez
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Vue from 'vue'
export default {
    name: "formEdit",
    data() {
        return {
            houses: {},
        }
    },
    methods: {
        getUser(){
            axios.get('/houses/33')
                .then((response)=>{
                this.houses = response.data.houses
            })
        }
        
    },
    created() {
        this.getUser()
    }
}
</script>