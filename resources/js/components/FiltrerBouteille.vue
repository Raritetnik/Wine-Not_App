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
                  <input type="checkbox" :id="aType.type.replace(/[\s\u0300-\u036f]/g, '')" :name="aType.type.replace(/[\s\u0300-\u036f]/g, '')" :value="aType.type" v-model="selectionner" @change="filterBouteilles">
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
                  <input type="checkbox" :id="aPays.pays.replace(/[\s\u0300-\u036f]/g, '')" :name="aPays.pays.replace(/[\s\u0300-\u036f]/g, '')" :value="aPays.pays" v-model="selectionner" @change="filterBouteilles">
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
      bouteillesFiltrees: []
    };
  },
  methods: {
    filterBouteilles() {
    // Créer un tableau vide pour stocker les bouteilles filtrées
    let bouteillesFiltrees = [];
    let correspondanceType;
    let correspondancePays;

      // Vérifier si tous les filtres sont désélectionnés
    if (this.selectionner.length === 0) {
        // Si tous les filtres sont désélectionnés, afficher toutes les bouteilles
        this.bouteillesFiltrees = this.bouteilles;
        return;
    }
    
    // Boucler sur toutes les bouteilles
    for (let i = 0; i < this.bouteilles.length; i++) {
        let bouteille = this.bouteilles[i];

        // Vérifier si la bouteille correspond aux types et pays sélectionnés
        correspondanceType = this.selectionner.includes(bouteille.type);
        correspondancePays = this.selectionner.includes(bouteille.pays);
        console.log(correspondanceType)

        // Ajouter la bouteille au tableau filtré si elle correspond aux types et pays sélectionnés
        if (correspondanceType || correspondancePays) {
        bouteillesFiltrees.push(bouteille);
        }
    }
    // ajouter condition que s'il n'y a aucun filtre sélectionner d'afficher toutes les bouteilles


    // Stocker les bouteilles filtrées dans le data

    this.bouteillesFiltrees = bouteillesFiltrees;
    
    
    },

  },
  created() {
    this.bouteillesFiltrees = this.bouteilles;
  }
};
</script>



