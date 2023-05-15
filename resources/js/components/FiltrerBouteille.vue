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
              <input type="checkbox" id="reinitialiserFiltre" v-model="reinitialiserFiltre">
              <label for="reinitialiseFiltre" class="text-xs text-gray-500">Réinitialiser</label>
            </div>
            <div class="label-categorie">
              <h3>Type de vin</h3>
              <span class="material-symbols-outlined">add</span>
            </div>
            <ul class="liste-choix cacher">
              <li v-for="aType in type" :key="aType.id">
                <input type="checkbox" :id="aType.type.replace(/[\s\u0300-\u036f]/g, '')"
                  :name="aType.type.replace(/[\s\u0300-\u036f]/g, '')" :value="aType.type" v-model="selectionnerType"
                  @change="filterBouteilles">
                <label :for="aType.type.replace(/[\s\u0300-\u036f]/g, '')">{{ aType.type }}</label>
              </li>
            </ul>
            <!-- Prix -->
            <div class="label-categorie">
              <h3>Prix de la bouteille</h3>
              <span class="material-symbols-outlined">add</span>
            </div>
            <ul class="liste-choix cacher">
              <li>
                <input type="checkbox" id="vingt" name="vingt" :value="[0, 20]" v-model="selectionnerPrix"
                  @change="filterBouteilles">
                <label for="vingt">0-20$</label>
              </li>
              <li>
                <input type="checkbox" id="trente" name="trente" :value="[20, 30]" v-model="selectionnerPrix"
                  @change="filterBouteilles">
                <label for="trente">20-30$</label>
              </li>
              <li>
                <input type="checkbox" id="quarante" name="quarante" :value="[30, 40]" v-model="selectionnerPrix"
                  @change="filterBouteilles">
                <label for="quarante">30-40$</label>
              </li>
              <li>
                <input type="checkbox" id="cinquante" name="cinquante" :value="[40, 50]" v-model="selectionnerPrix"
                  @change="filterBouteilles">
                <label for="cinquante">40-50$</label>
              </li>
              <li>
                <input type="checkbox" id="cent" name="cent" :value="[50, 100]" v-model="selectionnerPrix"
                  @change="filterBouteilles">
                <label for="cent">50-100$</label>
              </li>
              <li>
                <input type="checkbox" id="plus" name="plus" :value="[100, Infinity]" v-model="selectionnerPrix"
                  @change="filterBouteilles">
                <label for="plus">100$ et plus</label>
              </li>
            </ul>

            <!-- Pays -->
            <div class="label-categorie">
              <h3>Pays d'origine</h3>
              <span class="material-symbols-outlined rotation-huitieme">add</span>
            </div>
            <ul class="liste-choix cacher">
              <li v-for="aPays in pays" :key="aPays.id">
                <input type="checkbox" :id="aPays.pays.replace(/[\s\u0300-\u036f]/g, '')"
                  :name="aPays.pays.replace(/[\s\u0300-\u036f]/g, '')" :value="aPays.pays" v-model="selectionnerPays"
                  @change="filterBouteilles">
                <label :for="aPays.pays.replace(/[\s\u0300-\u036f]/g, '')">{{ aPays.pays }}</label>
              </li>
            </ul>

            <!-- Date de péremption -->
            <div class="label-categorie">
              <h3>Date de péremption</h3>
              <span class="material-symbols-outlined">add</span>
            </div>
            <ul class="liste-choix cacher">
              <li class="dateFiltre">
                <label for="dateDebut">Entre le :</label>
                <input type="date" name ="dateDebut" id="dateDebut" v-model="dateDebut" @change="filterBouteilles">
              </li>
              <li class="dateFiltre">
                <label for="dateFin">Et le :</label>
                <input type="date" name="dateFin" id="dateFin" v-model="dateFin" @change="filterBouteilles">
              </li>
            </ul>


          </div>
        </div>
      </nav>
    </aside> <!-- //conteneur-filtre -->
    <section id="section-bouteilles" class="px-6 flex flex-col items-center justify-center mx-auto">
      <!-- carte -->
      <div class="mb-2 w-full" v-for="bouteille in bouteillesFiltrees" :key="bouteille.id">
        <v-bouteille :bouteille="bouteille" :liste="liste" />
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
      dateDebut: null,
      dateFin: null,
      selectionnerType: [],
      selectionnerPays: [],
      selectionnerPrix: [],
      bouteillesFiltrees: [],
      reinitialiserFiltre: false,
    };
  },
  methods: {
    filterBouteilles() {
      console.log(this.dateDebut)
      // Créer un tableau vide pour stocker les bouteilles filtrées
      let bouteillesFiltrees = [];

      // Vérifier si tous les filtres sont désélectionnés 
      if (this.selectionnerType.length === 0 && this.selectionnerPays.length === 0 && this.selectionnerPrix.length === 0 && this.dateDebut === null && this.dateFin === null) {
        // Si tous les filtres sont désélectionnés, afficher toutes les bouteilles
        this.bouteillesFiltrees = this.bouteilles;
        return;
      }

      // Filtrer les bouteilles selon les critères de sélection
      console.log(this.bouteilles);
      bouteillesFiltrees = this.bouteilles.filter(bouteille => {
        let correspondanceType = false;
        let correspondancePays = false;
        let correspondancePrix = false;
        let correspondanceDate = false;
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
          this.selectionnerPrix.forEach((unPrix) => {
            if (parseFloat(bouteille.prix_saq) >= unPrix[0] && parseFloat(bouteille.prix_saq) <= unPrix[1]) {
              correspondancePrix = true;
            }
          })
        } else {
          correspondancePrix = true;
        }
        // traiter le cas oû il n'y a pas de date de péremption.  Automatiquement les vins sont gardé 1 années
        if (this.dateDebut && this.dateFin) {
          console.log("hello")
          const dateDebut = new Date(this.dateDebut);
          const dateFin = new Date(this.dateFin);
          let bouteilleDate;
          if(bouteille.garde_jusqua===null){
            // -1 car les mois sont indexés à partir de 0
            let date = new Date(bouteille.date_achat); 

            // Ajouter 1 an à la date car certains vins comme les beaujolais se concervent entre 1 et 2 ans au maximum s'ils sont de bonne qualité
            date.setFullYear(date.getFullYear() + 1);

            // Extraire les nouvelles composantes de la date
            let nouvelleAnnee = date.getFullYear();
            let nouveauMois = date.getMonth() + 1; // +1 car les mois sont indexés à partir de 0
            let nouveauJour = date.getDate();

            // Formater la nouvelle date au format 'aaaa-mm-jj'
            let nouvelleDate = nouvelleAnnee + '-' + (nouveauMois < 10 ? '0' : '') + nouveauMois + '-' + (nouveauJour < 10 ? '0' : '') + nouveauJour;
            bouteilleDate = new Date(nouvelleDate);
          }
          else {
            bouteilleDate = new Date(bouteille.garde_jusqua);
          }
          correspondanceDate = bouteilleDate >= dateDebut && bouteilleDate <= dateFin;
        } else {
          correspondanceDate = true;
        }
        // Ajouter la bouteille au tableau filtré si elle correspond aux critères sélectionnés
        return correspondanceType && correspondancePays && correspondancePrix && correspondanceDate;
      });

      // Stocker les bouteilles filtrées dans le data
      this.bouteillesFiltrees = bouteillesFiltrees;
    },
    reinitialiserFiltre() {
      this.selectionnerType = [];
      this.selectionnerPays = [];
      this.selectionnerPrix = [];
      this.dateDebut = null;
      this.dateFin = null;
      this.filterBouteilles();
    },
  },
  created() {
    this.bouteillesFiltrees = this.bouteilles;
  }
};
</script>



