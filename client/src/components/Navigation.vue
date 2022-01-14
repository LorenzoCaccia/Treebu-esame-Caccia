<template>
  <div class="flex items-center p-5 bg-green-300">
    <div @click="goToList()" class="cursor-pointer">
      <span class="text-green-900 font-bold text-4xl pl-5"> Banca della Terra </span>
    </div>
    <div class="ml-auto">
      <button @click="createLand()" class="p-2 text-black font-semibold">
        Inserisci Terreno
      </button>
    </div>
  </div>
</template>
<script>
export default {
  name: "Navigation",
  methods: {
    createLand() {
      this.$router.push({
        name: "create_land",
      });
    },
    goToList() {
      this.$router.push({
        name: "list_lands",
      });
    },
  },
};
</script>
