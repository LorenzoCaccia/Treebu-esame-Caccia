<template>
  <div class="w-full max-w-screen-md mx-auto pt-8">
    <div class="flex items-center mb-5">
      <div class="ml-auto mr-3">Ordina per data di pubblicazione:</div>
        <button
        class="rounded-lg p-2 uppercase text-xs mr-2 cursor-pointer"
        :class="{
          'bg-green-300 text-black': sortMethod == 'desc',
          'bg-gray-300 text-gray-800': sortMethod != 'desc',
        }"
        @click="sort('desc')"
        >Più recente</button
      >
      <button
        class="rounded-lg p-2 uppercase text-xs  cursor-pointer"
        :class="{
          'bg-green-300 text-black': sortMethod == 'asc',
          'bg-gray-300 text-gray-800': sortMethod != 'asc',
        }"
        @click="sort('asc')"
        >Meno recente</button
      >

    </div>
        <div class="flex items-center mb-5">
      <div class="ml-auto mr-3">Ordina per dimensione:</div>
        <button
        class="rounded-lg p-2 uppercase text-xs mr-2 cursor-pointer"
        :class="{
          'bg-green-300 text-black': sortMethodD == 'desc',
          'bg-gray-300 text-gray-800': sortMethodD != 'desc',
        }"
        @click="sortD('desc')"
        >Più grande</button
      >
      <button
        class="rounded-lg p-2 uppercase text-xs  cursor-pointer"
        :class="{
          'bg-green-300 text-black': sortMethodD == 'asc',
          'bg-gray-300 text-gray-800': sortMethodD != 'asc',
        }"
        @click="sortD('asc')"
        >Meno grande</button
      >

    </div>
    <div class="grid grid-cols-2 gap-x-5 gap-y-5">
      <div
        class="bg-gray-200 rounded flex flex-col p-3"
        v-for="land in lands"
        :key="land.id"
      >
        <div
          class="h-56 w-full bg-white cursor-pointer"
          @click="goToDetail(land)"
        >
          <img class="w-full h-full" :src="land.foto" alt="" />
        </div>
        <div class="flex flex-row items-center text-lg font-semibold pt-3">
          <div class="flex-grow">
            {{ land.comune }}
          </div>
          <div class="flex">
            <h2 class="ml-auto text-green-600 font-bold text-xl">
              {{ land.canone_offerta }} €
            </h2>
          </div>
        </div>
        <div class="flex flex-row items-center pt-3">
          <div class="flex-grow">
            Dimensione: {{ land.dimensione }} ettari
          </div>
        </div>
        <div class="flex flex-row items-center pt-3">
          <div class="flex-grow">
            Tipo di offerta: {{ land.tipo_offerta }}
          </div>
        </div>
        <div class="mt-3 ml-auto space-x-3">
          <button
            class="text-green-600 text-sm font-bold"
            @click="edit(land)"
          >
            Modifica
          </button>
          <button
            class="text-red-600 text-sm font-bold"
            @click="deleteLand(land)"
          >
            Elimina
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";

export default {
  name: "ListLands",
  data() {
    return {
      lands: [],
      sortMethod: "desc",
      sortMethodD: "",
    };
  },
  async mounted() {
    await this.getLands();
  },
  methods: {
    async getLands() {
      let response = await axios.get(
        "http://localhost:8000/api/lands?sort=" + this.sortMethod
      );
      this.lands = response.data;
    },
    async getLandsD() {
      let response = await axios.get(
        "http://localhost:8000/api/landsDimension?sort=" + this.sortMethodD
      );
      this.lands = response.data;
    },
    edit(land) {
      this.$router.push("/edit/" + land.id);
    },
    goToDetail(land) {
      this.$router.push("/view/" + land.id);
    },
    async deleteLand(land) {
      if (
        confirm(
          "Vuoi davvero eliminare questo terreno",
          "Si",
          "No"
        )
      ) {
        await axios.delete("http://localhost:8000/api/lands/" + land.id);
        await this.getLands();
      }
    },
    sort(direction) {
      if (this.sortMethod != direction) {
        this.sortMethodD = "";
        this.sortMethod = direction;
        this.getLands();
      }
    },
    sortD(direction) {
      if (this.sortMethodD != direction) {
        this.sortMethod = "";
        this.sortMethodD = direction;
        this.getLandsD();
      }
    },
  },
};
</script>
