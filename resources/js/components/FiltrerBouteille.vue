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
                <h3>Type de vin</h3>
                <span class="material-symbols-outlined">expand_more</span>
              </div>
              <ul class="liste-choix">
                <li v-for="aType in type">
                  <input type="checkbox" :id="aType.type.replace(/[\s\u0300-\u036f]/g, '')" :name="aType.type.replace(/[\s\u0300-\u036f]/g, '')" :value="aType.type" v-model="selectionnerType" @change="filterBouteilles">
                  <label :for="aType.type.replace(/[\s\u0300-\u036f]/g, '')">{{ aType.type }}</label>
                </li>
              </ul>
              <!-- Prix -->
              <div class="label-categorie">
                <h3>Prix de la bouteille</h3>
                <span class="material-symbols-outlined">expand_more</span>
              </div>
              <ul class="liste-choix">
                <li>
                  <input type="checkbox" id="vingt" name="vingt" :value="[0, 20]" v-model="selectionnerPrix" @change="filterBouteilles">
                  <label for="vingt">0-20$</label>
                </li>
                <li>
                  <input type="checkbox" id="trente" name="trente" :value="[20, 30]" v-model="selectionnerPrix" @change="filterBouteilles">
                  <label for="trente">20-30$</label>
                </li>
                <li>
                  <input type="checkbox" id="quarante" name="quarante" :value="[30, 40]" v-model="selectionnerPrix" @change="filterBouteilles">
                  <label for="quarante">30-40$</label>
                </li>
                <li>
                  <input type="checkbox" id="cinquante" name="cinquante" :value="[40, 50]" v-model="selectionnerPrix" @change="filterBouteilles">
                  <label for="cinquante">40-50$</label>
                </li>
                <li>
                  <input type="checkbox" id="cent" name="cent" :value="[50, 100]" v-model="selectionnerPrix" @change="filterBouteilles">
                  <label for="cent">50-100$</label>
                </li>
                <li>
                  <input type="checkbox" id="plus" name="plus" :value="[100, Infinity]" v-model="selectionnerPrix" @change="filterBouteilles">
                  <label for="plus">100$ et plus</label>
                </li>
              </ul>

              <!-- Pays -->
              <div class="label-categorie">
                <h3>Pays d'origine</h3>
                <span class="material-symbols-outlined">expand_more</span>
              </div>
              <ul class="liste-choix">
                <li v-for="aPays in pays">
                  <input type="checkbox" :id="aPays.pays.replace(/[\s\u0300-\u036f]/g, '')" :name="aPays.pays.replace(/[\s\u0300-\u036f]/g, '')" :value="aPays.pays" v-model="selectionnerPays" @change="filterBouteilles">
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
      selectionnerType: [],
      selectionnerPays: [],
      selectionnerPrix: [],
      bouteillesFiltrees: []
    };
  },
  methods: {
    filterBouteilles() {
    // Créer un tableau vide pour stocker les bouteilles filtrées
    let bouteillesFiltrees = [];

    // Vérifier si tous les filtres sont désélectionnés
    if (this.selectionnerType.length === 0 && this.selectionnerPays.length === 0 && this.selectionnerPrix.length === 0) {
        // Si tous les filtres sont désélectionnés, afficher toutes les bouteilles
        this.bouteillesFiltrees = this.bouteilles;
        return;
    }

    // Filtrer les bouteilles selon les critères de sélection
    bouteillesFiltrees = this.bouteilles.filter(bouteille => {
        let correspondanceType = false;
        let correspondancePays = false;
        let correspondancePrix = false;

        if (this.selectionnerType.length > 0) {
            // Vérifier si la bouteille correspond aux types sélectionnés
            correspondanceType = this.selectionnerType.includes(bouteille.type);
        } else {
            // Si aucun type n'est sélectionné, toutes les bouteilles correspondent
            correspondanceType = true;
        }

        if (this.selectionnerPays.length > 0) {
            // Vérifier si la bouteille correspond aux pays sélectionnés
            correspondancePays = this.selectionnerPays.includes(bouteille.pays);
        } else {
            // Si aucun pays n'est sélectionné, toutes les bouteilles correspondent
            correspondancePays = true;
        }
        // Vérifier si le prix d'une bouteille (convertit en nombre) est compris entre le min et max des prix sélectionnés
        if (this.selectionnerPrix.length > 0) {
          this.selectionnerPrix.forEach((unPrix)=>{
            if(parseFloat(bouteille.prix_saq)>= unPrix[0] && parseFloat(bouteille.prix_saq)<= unPrix[1]){
              correspondancePrix = true;
              console.log(bouteille.prix_saq)
            }
          })
        } else {
          correspondancePays = true;
        }
        // Ajouter la bouteille au tableau filtré si elle correspond aux critères sélectionnés
        return correspondanceType && correspondancePays && correspondancePrix;
    });

    // Stocker les bouteilles filtrées dans le data
    this.bouteillesFiltrees = bouteillesFiltrees;
},
  },
  created() {
    this.bouteillesFiltrees = this.bouteilles;
  }
};
</script>



