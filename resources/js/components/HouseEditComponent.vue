<template>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <h3
            class="text-3xl font-normal leading-normal mt-0 mb-2 text-pink-800"
          >
            Modifier Maison
          </h3>
          <form @submit.prevent="checkForm" method="post">
            <h3
              class="text-1xl font-normal leading-normal mt-0 mb-2 text-black"
            >
              Nom de l'habitation
            </h3>
            <div class="mb-3 pt-0">
              <input
                v-model="name"
                class="
                  px-3
                  py-3
                  placeholder-blueGray-300
                  text-blueGray-600
                  relative
                  bg-white bg-white
                  rounded
                  text-sm
                  border-0
                  shadow
                  outline-none
                  focus:outline-none
                  focus:ring
                  w-full
                "
              />
            </div>
            <h3
              class="text-1xl font-normal leading-normal mt-0 mb-2 text-black"
            >
              Adresse
            </h3>
            <div class="mb-3 pt-0">
              <textarea
                v-model="address"
                class="
                  w-full
                  px-3
                  py-2
                  text-gray-700
                  border
                  rounded-lg
                  focus:outline-none
                "
                rows="4"
              ></textarea>
            </div>
            <h3
              class="text-1xl font-normal leading-normal mt-0 mb-2 text-black"
            >
              Prix affiché
            </h3>
            <div class="mb-3 pt-0">
              <input
                v-model="price"
                type="number"
                class="
                  px-3
                  py-3
                  placeholder-blueGray-300
                  text-blueGray-600
                  relative
                  bg-white bg-white
                  rounded
                  text-sm
                  border-0
                  shadow
                  outline-none
                  focus:outline-none
                  focus:ring
                  w-full
                "
              />
            </div>
            <h3
              class="text-1xl font-normal leading-normal mt-0 mb-2 text-black"
            >
              Surface habitable
            </h3>
            <div class="mb-3 pt-0">
              <input
                v-model="surface"
                type="number"
                class="
                  px-3
                  py-3
                  placeholder-blueGray-300
                  text-blueGray-600
                  relative
                  bg-white bg-white
                  rounded
                  text-sm
                  border-0
                  shadow
                  outline-none
                  focus:outline-none
                  focus:ring
                  w-full
                "
              />
            </div>
            <button
              type="submit"
              class="
                bg-blue-500
                hover:bg-blue-400
                text-white
                font-bold
                py-2
                px-4
                border-b-4 border-blue-700
                hover:border-gray-500
                rounded
              "
            >
              Valider
            </button>
          </form>
          <ul>
            <li class="text-danger" v-for="(e, i) in errors" :key="i">
              {{ e }}
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      name: this.house.name,
      address: this.house.address,
      price: this.house.price,
      surface: this.house.surface,
      errors: [],
    };
  },
  mounted() {
    console.log(this.house);
  },
  methods: {
    checkForm: function (e) {
      if (this.name && this.address && this.price && this.surface) {
        this.postNow();
        return true;
      }

      this.errors = [];

      if (!this.name) {
        this.errors.push("Name required.");
      }
      if (!this.address) {
        this.errors.push("Address required.");
      }
      if (!this.price) {
        this.errors.push("Price required.");
      }
      if (!this.surface) {
        this.errors.push("Surface required.");
      }
      console.log(this.errors);
      e.preventDefault();
    },
    postNow() {
      axios
        .put("/houses/" + this.house.id, {
          name: this.name,
          address: this.address,
          price: this.price,
          surface: this.surface,
        })
        .then((data) => {
          document.location.href = "/houses";
        })
        .catch((err) => {
          this.errors = Object.keys(err.response.data.errors).map(
            (e) => err.response.data.errors[e][0]
          );
        });
    },
  },
  props: ["house"],
};
</script>

<style scoped>
</style>