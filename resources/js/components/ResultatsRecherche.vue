<template>
  <ul>
  <div v-for="vine in closestVineList" :key="vine.id" @click="takeBouteille(vine)" class="mb-3">
    <article class="flex gap-3 bg-gray-100 p-2 rounded-md  justify-between w-full">
      <header>
        <img class="object-cover min-w-[100px] min-h-[150px] max-h-[150px]" :src="vine.url_img" :alt="vine.nom">
      </header>
      <div class="desc flex flex-col justify-between">
        <header>
          <h1 class="font-bold" style="color: var(--color_champ)">{{ vine.nom }}</h1>
          <h3 style="color: var(--color_text)">{{ vine.type }} | {{ vine.format }}</h3>
        </header>
      </div>
    </article>
  </div>
</ul>
</template>
  
  <script>
  export default{
    name: "ResultatsRecherche",
    props: {
      closestVineList: {
        type: Array,
        required: true
      }
    },
    methods: {
      takeBouteille(vine) {
        this.$emit('take-bouteille', vine);
      }
    }
  }
  </script>
  