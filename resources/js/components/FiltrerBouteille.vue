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
                  <input type="checkbox" :id="aType.type.replace(/[\s\u0300-\u036f]/g, '')" :name="aType.type.replace(/[\s\u0300-\u036f]/g, '')" :value="aType.type" v-model="selectionnerType" @change="filterBouteilles">
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
                  <input type="checkbox" :id="aPays.pays.replace(/[\s\u0300-\u036f]/g, '')" :name="aPays.pays.replace(/[\s\u0300-\u036f]/g, '')" :value="aPays.pays" v-model="selectionnerPays" @change="filterBouteilles">
                  <label :for="aPays.pays.replace(/[\s\u0300-\u036f]/g, '')">{{ aPays.pays }}</label>
                </li>
              </ul>

               <!-- Prix -->
               <div class="label-categorie">
                <h3>Prix</h3>
                <span class="material-symbols-outlined">expand_more</span>
              </div>
              <ul class="liste-choix">
                <li>
                  <input type="checkbox" :id="vingt" :name="vingt" :value="0-20" v-model="selectionnerPrix" @change="filterBouteilles">
                  <label :for="vingt">0-20$</label>
                </li>
                <li>
                  <input type="checkbox" :id="trente" :name="trente" :value="20-30" v-model="selectionnerPrix" @change="filterBouteilles">
                  <label :for="trente">20-30$</label>
                </li>
                <li>
                  <input type="checkbox" :id="quarante" :name="quarante" :value="30-40" v-model="selectionnerPrix" @change="filterBouteilles">
                  <label :for="quarante">30-40$</label>
                </li>
                <li>
                  <input type="checkbox" :id="cinquante" :name="cinquante" :value="40-50" v-model="selectionnerPrix" @change="filterBouteilles">
                  <label :for="cinquante">40-50$</label>
                </li>
                <li>
                  <input type="checkbox" :id="cent" :name="cent" :value="50-100" v-model="selectionnerPrix" @change="filterBouteilles">
                  <label :for="cent">50-100$</label>
                </li>
                <li>
                  <input type="checkbox" :id="plus" :name="plus" :value="100" v-model="selectionnerPrix" @change="filterBouteilles">
                  <label :for="plus">100$ et plus</label>
                </li>
              </ul>
        
            </div>
          </div>
        </nav>
      </aside> <!-- //conteneur-filtre -->
      <section class="px-6 flex flex-col items-center">
        <!-- carte -->
        <div class="mb-2 hover-carte" v-for="bouteille in bouteillesFiltrees" :key="bouteille.id" @click="redirection(bouteille.id)">
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
      selectionnerType: [],
      selectionnerPays: [],
      selectionnerPrix: [],
      bouteillesFiltrees: []
    };
  },
  methods: {
    redirection(bouteille) {
      console.log(window.location.pathname);
      location.href = `${window.location.pathname}/details-bouteille/${bouteille}`;
    },
    filterBouteilles() {
        // Créer un tableau vide pour stocker les bouteilles filtrées
        let bouteillesFiltrees = [];
        let correspondanceType;
        let correspondancePays;

        // Vérifier si tous les filtres sont désélectionnés
        if (this.selectionnerType.length === 0 && this.selectionnerPays.length === 0) {
            // Si tous les filtres sont désélectionnés, afficher toutes les bouteilles
            this.bouteillesFiltrees = this.bouteilles;
            return;
        }
        else {        
            // Boucler sur toutes les bouteilles
            for (let i = 0; i < this.bouteilles.length; i++) {
                let bouteille = this.bouteilles[i];
            
                if(this.selectionnerType.length > 0 && this.selectionnerPays.length > 0) {
                    // Vérifier si la bouteille correspond aux types et pays sélectionnés
                    correspondanceType = this.selectionnerType.includes(bouteille.type);
                    correspondancePays = this.selectionnerPays.includes(bouteille.pays);

                    // Ajouter la bouteille au tableau filtré si elle correspond aux types et pays sélectionnés
                    if (correspondanceType && correspondancePays) {
                        bouteillesFiltrees.push(bouteille);
                    }
                }
                else if (this.selectionnerType.length > 0 && this.selectionnerPays.length ===0){
                    // Vérifier si la bouteille correspond aux types sélectionnés
                    correspondanceType = this.selectionnerType.includes(bouteille.type);

                    // Ajouter la bouteille au tableau filtré si elle correspond aux types et pays sélectionnés
                    if (correspondanceType) {
                        bouteillesFiltrees.push(bouteille);
                    }
                }
                else if (this.selectionnerType.length === 0 && this.selectionnerPays.length >0){
                    // Vérifier si la bouteille correspond aux pays sélectionnés
                    correspondancePays = this.selectionnerPays.includes(bouteille.pays);

                    // Ajouter la bouteille au tableau filtré si elle correspond aux types et pays sélectionnés
                    if (correspondancePays) {
                        bouteillesFiltrees.push(bouteille);
                    }
                }
            }
        }
        // Stocker les bouteilles filtrées dans le data
        this.bouteillesFiltrees = bouteillesFiltrees;
    },
  },
  created() {
    this.bouteillesFiltrees = this.bouteilles;
  }
};
</script>



