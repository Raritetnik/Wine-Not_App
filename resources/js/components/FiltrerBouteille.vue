<template>
    <div>
      <aside class="conteneur-filtre">
        <span class="material-symbols-outlined fermer">
          close
        </span>
        <nav class="conteneur-nav menu-lateral">
          <div class="liste-categorie accordeon">
            <div class="menu-deroulant">
              <!--Type-->
              <div class="label-categorie">
                <h3>Type</h3>
                <span class="material-symbols-outlined">expand_more</span>
              </div>
              <ul class="liste-choix">
                <li v-for="aType in type">
                  <input type="checkbox" :id="aType.type.replace(/[\s\u0300-\u036f]/g, '')" :name="aType.type.replace(/[\s\u0300-\u036f]/g, '')" :value="aType.id" v-model="selectionner" @change="filterBouteilles">
                  <label :for="aType.type.replace(/[\s\u0300-\u036f]/g, '')">{{ aType.type }}</label>
                </li>
              </ul>
              <!-- Pays -->
              <div class="label-categorie">
                <h3>Pays</h3>
                <span class="material-symbols-outlined">expand_more</span>
              </div>
              <ul class="liste-choix">
                <li v-for="aPays in pays">
                  <input type="checkbox" :id="aPays.pays.replace(/[\s\u0300-\u036f]/g, '')" :name="aPays.pays.replace(/[\s\u0300-\u036f]/g, '')" :value="aPays.id" v-model="selectionner" @change="filterBouteilles">
                  <label :for="aPays.pays.replace(/[\s\u0300-\u036f]/g, '')">{{ aPays.pays }}</label>
                </li>
              </ul>
        
            </div>
          </div>
        </nav>
      </aside> <!-- //conteneur-filtre -->
      <section class="px-6 flex flex-col items-center">
        <!-- carte -->
        <div class="mb-2" v-for="bouteille in bouteillesFiltrees" :key="bouteille.id">
          <v-bouteille :bouteille="bouteille" :liste="liste"/>
        </div>
      </section>
    </div>
  </template>
<script>
export default {
  props: ["type", "pays", "cellier", "bouteilles", "liste"],
  data() {
    return {
      filtres: {
        types: [],
        pays: [],
      },
      selectionner: [],
    };
  },
  computed: {
    bouteillesFiltrees() {
        let bouteillesFiltrees = this.bouteilles;
        if (this.filtres.types.length > 0) {
            bouteillesFiltrees = bouteillesFiltrees.filter((bouteille) =>
            this.filtres.types.includes(bouteille.type_id)
        );
        }
        if (this.filtres.pays.length > 0) {
            bouteillesFiltrees = bouteillesFiltrees.filter((bouteille) =>
            this.filtres.pays.includes(bouteille.pays_id)
        );
        }
        return bouteillesFiltrees;
    },
  },
  methods: {
    filterBouteilles(e) {
    console.log(this.selectionner)

    console.log(JSON.parse(JSON.stringify(this.filtres)));
    },
  },
};
</script>



