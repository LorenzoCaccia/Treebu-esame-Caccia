<template>
  <div class="w-full max-w-screen-lg mx-auto py-8 px-3">
    <div class="flex items-end">
      <h1 class="font-bold text-3xl">Comune: {{ land.comune }}</h1>
      <h2 class="ml-auto text-green-600 font-bold text-2xl">
        {{ land.canone_offerta }} €
      </h2>
    </div>
    <div class="flex mt-5 items-stretch">
      <div class="h-72 w-96 w-full bg-white cursor-pointer mr-8">
        <img class="w-full h-full" :src="land.foto" alt="" />
      </div>
      <div class="flex flex-col justify-between flex-grow">
            <div class="border-b border-gray-600 flex items-center">
            <span>
             Dimensione (in ettari)
          </span>
          <span class="ml-auto font-bold">
            {{ land.dimensione}} ha
          </span>
        </div>
        <div
          v-for="field in fields"
          :key="field.code"
          class="border-b border-gray-600 flex items-center"
        >
          <span>
            {{ field.label }}
          </span>
          <span class="ml-auto font-bold">
            {{ land[field.code] }}
          </span>
        </div>
        <div class="border-b border-gray-600 flex items-center">
            <span>
             Disponibile fin da subito:
          </span>
          <span v-if="land.disponibile == false" class="ml-auto font-bold">
            No
          </span>
        <span v-if="land.disponibile == true" class="ml-auto font-bold">
            Si
          </span>
        </div>
 
      </div>
    </div>
    <div>
      <button
        @click="goToList()"
        class="text-gray-500 text-sm cursor-pointer mt-5"
      >
        Torna indietro
      </button>
    </div>
  </div>
</template>
<script>
import axios from "axios";

export default {
  name: "ViewLand",
  data() {
    return {
      land: {},
      fields: [
        {
          label: "Foglio catastale",
          code: "foglio_catastale",
          type: "text",
        },
        {
          label: "Mappale catastale",
          code: "mappale_catastale",
          type: "text",
        },
        {
          label: "Parcella Catastale",
          code: "parcella_catastale",
          type: "text",
        },
        {
          label: "Tipologia di terreno",
          code: "tipo_terreno",
          type: "select",
          options: [
            {
              label: "Argilloso",
              code: "Argilloso",
            },
            {
              label: "Sabbioso",
              code: "Sabbioso",
            },
            {
              label: "Ghiaioso",
              code: "Ghiaioso",
            },
            {
              label: "Tufo",
              code: "Tufo",
            },
          ],
        },
        {
          label: "Tipo di irrigazione",
          code: "tipo_irrigazione",
          type: "select",
          options: [
            {
              label: "A scorrimento",
              code: "A scorrimento",
            },
            {
              label: "Pozzo",
              code: "Pozzo",
            },
            {
              label: "Canale",
              code: "Canale",
            },
            {
              label: "Senz'acqua",
              code: "No acqua",
            },
          ],
        },
        {
          label: "Tipo di offerta",
          code: "tipo_offerta",
          type: "select",
          options: [
            {
              label: "Vendita",
              code: "Vendita",
            },
            {
              label: "Affitto",
              code: "Affitto",
            },
            {
              label: "Affido gratuito",
              code: "Affido gratuito",
            },
          ],
        },
      ],
    };
  },
  async mounted() {
    let landId = this.$route.params.id;

    let response = await axios.get(
      "http://localhost:8000/api/lands/" + landId
    );
    console.log(response);
    this.land = response.data;
  },
  methods: {
    goToList() {
      this.$router.push("/");
    },
  },
};
</script>
