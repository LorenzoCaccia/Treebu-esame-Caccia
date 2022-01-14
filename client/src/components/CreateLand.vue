<template>
  <div class="w-full max-w-screen-md mx-auto py-8 px-3">
    <div class="flex flex-col mb-3" v-for="field in fields" :key="field.code">
      <label class="mb-2 font-bold text-red-900" :for="field.code">{{
        field.label
      }}</label>
      <input
        v-if="field.type == 'text'"
        class="border border-gray-200 p-2 rounded"
        type="text"
        :id="field.code"
        v-model="newLand[field.code]"
      />
      <input
        v-if="field.type == 'number'"
        class="border border-gray-200 p-2 rounded"
        type="number"
        :id="field.code"
        v-model="newLand[field.code]"
      />
    <input
        v-if="field.type == 'checkbox'"
        class="border border-gray-200 p-2 rounded"
        type="checkbox"
        :id="field.code"
        v-model="newLand[field.code]"
      />
      <select
        v-if="field.type == 'select'"
        class="border border-gray-200 p-2 rounded bg-white"
        :name="field.code"
        :id="field.code"
        v-model="newLand[field.code]"
      >
        <option
          v-for="option in field.options"
          :key="option.code"
          :value="option.code"
        >
          {{ option.label }}
        </option>
      </select>
      <textarea
        v-if="field.type == 'textarea'"
        v-model="newLand[field.code]"
        class="border border-gray-200 p-2 rounded bg-white"
        :id="field.code"
        cols="30"
        rows="10"
      >
      </textarea>
    </div>
    <div class="pt-3">
      <button
        @click="createLand()"
        :disabled="!formIsValid"
        class="disabled:bg-gray-300 disabled:cursor-not-allowed p-2 px-3 rounded bg-red-800 text-white"
      >
        {{ $route.name == "edit_land" ? "Salva" : "Crea" }}
      </button>
    </div>
  </div>
</template>
<script>
import axios from "axios";

export default {
  name: "CreateLand",
  data() {
    return {
      fields: [
        {
          label: "Comune",
          code: "comune",
          type: "text",
        },
        {
          label: "Foto",
          code: "foto",
          type: "text",
        },
        {
          label: "Dimensione",
          code: "dimensione",
          type: "number",
        },
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
        {
          label: "Canone dell'offerta",
          code: "canone_offerta",
          type: "number",
        },
        {
          label: "Disponibile",
          code: "disponibile",
          type: "checkbox",
        },
      ],
      newLand: {
        comune: "",
        foto: "",
        dimensione: 0,
        foglio_catastale: "",
        mappale_catastale: "",
        parcella_catastale: "",
        tipo_terreno: "",
        tipo_irrigazione: "",
        tipo_offerta: "",
        canone_offerta: 0,
        disponibile: true,
      },
    };
  },
  async mounted() {
    if (this.$route.name == "edit_land") {
      let response = await axios.get(
        "http://localhost:8000/api/lands/" + this.$route.params.id
      );
      this.newLand = response.data;
    }
  },
  methods: {
    async createLand() {
      if (this.$route.name == "edit_land") {
        let response = await axios.put(
          "http://localhost:8000/api/lands/" + this.$route.params.id,
          this.newLand
        );

        if (response.status == 200) {
          this.$router.push("/");
        }
      } else {
        let response = await axios.post(
          "http://localhost:8000/api/lands",
          this.newLand
        );

        if (response.status == 201) {
          this.$router.push("/");
        }
      }
    },
  },
  computed: {
    formIsValid() {
      return (
        this.newLand.comune != "" &&
        this.newLand.foto != "" &&
        this.newLand.dimensione > 0 &&
        this.newLand.foglio_catastale != "" &&
        this.newLand.mappale_catastale != "" &&
        this.newLand.parcella_catastale > "" &&
        this.newLand.tipo_terreno != "" &&
        this.newLand.tipo_irrigazione != "" &&
        this.newLand.tipo_offerta > "" &&
        this.newLand.canone_offerta >= 0
      );
    },
  },
};
</script>
