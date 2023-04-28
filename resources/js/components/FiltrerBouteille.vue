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
                  <input type="checkbox" :id="aType.type" :name="aType.type" :value="aType.id" @change="filterBouteilles">
                  <label :for="aType.type">{{ aType.type }}</label>
                </li>
              </ul>
              <!-- Pays -->
              <div class="label-categorie">
                <h3>Pays</h3>
                <span class="material-symbols-outlined">expand_more</span>
              </div>
              <ul class="liste-choix">
                <li v-for="aPays in pays">
                  <input type="checkbox" :id="aPays.pays" :name="aPays.pays" :value="aPays.id" @change="filterBouteilles">
                  <label :for="aPays.pays">{{ aPays.pays }}</label>
                </li>
              </ul>
              <!--Prix-->
            <div class="label-categorie">
                <h3>Prix</h3>
                <span class="material-symbols-outlined">expand_more</span>
            </div>
            <ul class="liste-choix">
                <li>
                    <input type="checkbox" id="vingt" name="vingt" value="20">
                    <label for="vingt">20$ et moins</label>
                </li>
                <li>
                    <input type="checkbox" id="trente" name="trente" value="30">
                    <label for="trente">20$ - 30$</label>
                </li>
                <li>
                    <input type="checkbox" id="quarante" name="quarante" value="40">
                    <label for="quarante">30$ - 40$</label>
                </li>
                <li>
                    <input type="checkbox" id="cinquante" name="cinquante" value="50">
                    <label for="cinquante">40$ - 50$</label>
                </li>
                <li>
                    <input type="checkbox" id="cent" name="cent" value="100">
                    <label for="cent">50$ - 100$</label>
                </li>
                <li>
                    <input type="checkbox" id="deuxcent" name="deuxcent" value="200">
                    <label for="deuxcent">100$ - 200$</label>
                </li>
                <li>
                    <input type="checkbox" id="cinqcent" name="cinqcent" value="500">
                    <label for="cinqcent">200$ - 500$</label>
                </li>
                <li>
                    <input type="checkbox" id="cinqcentplus" name="cinqcentplus" value="501">
                    <label for="cinqcentplus">500$ et plus</label>
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
    props: ["type", "pays", "cellier", "bouteilles"],
    data() {
      return {
        filtres: {
          types: [],
          pays: [],
        },
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
      filterBouteilles() {
        this.filtres.types = Array.from(
          document.querySelectorAll('input[name="type"]:checked')
        ).map((input) => parseInt(input.value));
        this.filtres.pays = Array.from(
          document.querySelectorAll('input[name="pays"]:checked')
        ).map((input) => parseInt(input.value));
      },
    },
  };
  </script>


