<template>
  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 bg-white border-b border-gray-200">
                  <h3 class="text-3xl font-normal leading-normal mt-0 mb-2 text-pink-800">
                    Nouvelle Maison
                  </h3>
                  <form v-on:submit.prevent="postNow" method="post">
                      <h3 class="text-1xl font-normal leading-normal mt-0 mb-2 text-black">
                        Nom de l'habitation
                      </h3>
                      <div class="mb-3 pt-0">
                          <input v-model="names" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm border-0 shadow outline-none focus:outline-none focus:ring w-full"/>
                      </div>
                      <h3 class="text-1xl font-normal leading-normal mt-0 mb-2 text-black">
                        Adresse
                      </h3>
                      <div class="mb-3 pt-0">
                          <textarea v-model="adresse" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" rows="4"></textarea>
                      </div>
                      <h3 class="text-1xl font-normal leading-normal mt-0 mb-2 text-black">
                        Prix affiché
                      </h3>
                      <div class="mb-3 pt-0">
                          <input v-model="price" type="number"  class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm border-0 shadow outline-none focus:outline-none focus:ring w-full"/>
                      </div><h3 class="text-1xl font-normal leading-normal mt-0 mb-2 text-black">
                        Surface habitable
                      </h3>
                      <div class="mb-3 pt-0">
                          <input v-model="surface" type="number"  class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm border-0 shadow outline-none focus:outline-none focus:ring w-full"/>
                      </div>
                      <button type="submit" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-gray-500 rounded">
                        Valider
                      </button>
                  </form>
              </div>
          </div>
      </div>
  </div>
</template>

<script>
import Vue from 'vue'
import Button from "../../../vendor/laravel/breeze/stubs/inertia-vue/resources/js/Components/Button.vue";
export default {
  name: 'formPost',
  data() {
    return {
      names: '',
      adresse: '',
      price: '',
      surface: '',
    };
  },
  methods: {
    postNow() {
      axios.post('/houses', {
        name: this.names,
        address: this.adresse,
        price: this.price,
        surface: this.surface,
        })
      .then((data) => {
        document.location.href = "/houses";
      })
      .catch((err) => {
        console.log("heyyyyyy !!!!")
      });
    },
  }
}
</script>