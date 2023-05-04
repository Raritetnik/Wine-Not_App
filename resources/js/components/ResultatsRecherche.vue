<template>
  <ul>
  <div v-for="vine in closestVineList" :key="vine.id" @click="takeBouteille(vine)" class="mb-3">
    <article class="flex gap-3 cursor-pointer bg-gray-100 p-2 rounded-md hover:border-secondary border-2 hover:shadow-sm justify-left w-full">
      <header>
        <img class="object-cover min-w-[100px] min-h-[150px] max-h-[150px]" :src="vine.url_img" :alt="vine.nom">
      </header>
      <section class="flex flex-col gap-2 w-full">
      <h1 class="font-bold text-accent_wine">{{ vine.nom }}</h1>
        <div class="flex items-center justify-between">
          <div class="flex flex-col justify-between">
            <h3 style="color: var(--color_text)">{{ vine.type }} | {{ vine.format }}</h3>
            <h3 style="color: var(--color_text)">{{ vine.pays }}</h3>
            <h3 style="color: var(--color_text)">${{ vine.prix_saq }} CAD</h3>
          </div>
          <!-- <img class="pe-6 hover:opacity-75" :src="require('/img/svg/select.svg')" alt="select"> -->
        </div>
      </section>
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
