<template>
  <div class="flex flex-col lg:pe-6">
    <div class="grid">
      <div class="flex flex-col relative mb-4">
        <div class="flex justify-between items-center rounded shadow-sm border-2 border-secondary ">
        <input type="text" class="w-full font-medium tracking-wide px-6  h-12 text-accent_wine transition duration-200  focus:outline-none" placeholder="Recherche" @keyup="showSearchOptions($event.target.value);"
        :value="this.textInput"><img :src="require('/img/svg/loop.svg')" alt="loop" class="px-2">
      </div>
        <input name="vino_bouteille_id" type="hidden" :value="this.choixBouteille.id">
        <input name="vino_bouteille_prix" type="hidden" :value="this.choixBouteille.prix">
        <!--<button type="submit" @submit.prevent="onSubmit()" class="bg-accent_wine hover:accent_wine-80 text-main font-bold ml-2 py-2 px-4 rounded focus:outline-none focus:shadow-outline">Recherche</button>
        Code de la barre de recherche ICI -->
      </div>
      <!-- le composant Vue ResultatsRecherche va ici -->
      <ResultatsRecherche :closest-vine-list="closestVineList" @take-bouteille="takeBouteille"></ResultatsRecherche>
       
    </div>
    <div>
      <div class="flex gap-3 bg-gray-100 rounded-md  max-w-[320px] sm:w-[500px] p-2 border-2 border-secondary" v-if="selectedVine">
        <header>
          <img :src="this.choixBouteille.url_img" :alt="this.choixBouteille.nom" class="max-w-none h-[150px]">
        </header>
        <div>
          <h2 class="font-bold text-md text-section_title">{{ this.choixBouteille.nom }}</h2>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
import ResultatsRecherche from './ResultatsRecherche.vue';

export default {
  components: {
    ResultatsRecherche
  },
  data() {
    return {
      isMenuOpen: false,
      textInput: '',
      vineList: [],
      closestVineList: [],
      choixBouteille: {},
      selectedVine: false
    };
  },
  methods: {
    showSearchOptions (text) {
      this.selectedVine = false;
      this.textInput = text;
      // Code pour filtrer la recherche
      this.closestVineList = [];
      if(text !== "") {
        // Only START WITH NAME ELEMENTS --- FIRST
        this.vineList.forEach( (vine) => {
          if(String(vine.nom.toLowerCase()).startsWith(text.toLowerCase())) {
            this.closestVineList.push(vine)
          }
        })
        // Only CONTAINS && NOT START WITH --- AFTER
        this.vineList.forEach( (vine) => {
          if(!String(vine.nom.toLowerCase()).startsWith(text.toLowerCase())
          && String(vine.nom.toLowerCase()).includes(text.toLowerCase())) {
            this.closestVineList.push(vine);
          }
        })
        this.closestVineList = this.closestVineList.slice(0, 4);
      }
    },
    takeBouteille (vine) {
      this.textInput = vine.nom
      this.choixBouteille = vine;
      this.selectedVine = true;
      this.closestVineList = [];
    }
  },
  async beforeMount () {
    axios.get('/api.bouteilles')
      .then(response => {
          this.vineList = response.data
      })
  }
};
</script>