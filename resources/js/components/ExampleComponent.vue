<template>
  <div>
    <p>Hello World.</p>
    <ul>
      <li v-for="(l, i) in listHouse" :key="i">{{ l }}</li>
    </ul>
    <button @click="onClick">TEST</button>
  </div>
</template>

<script>
import Button from "../../../vendor/laravel/breeze/stubs/inertia-vue/resources/js/Components/Button.vue";
export default {
  components: { Button },
  data() {
    return { listHouse: ["Maison", "Appart"] };
  },
  mounted() {
    console.log("Example component mounted");
  },
  methods: {
    onClick() {
      this.listHouse.push("Maison" + new Date())
    },
  },
};
</script>