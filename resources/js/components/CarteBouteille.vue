<template>
    <article v-if="afficherCarte" class="mx-auto bg-gray-100 flex gap-1 border px-4 py-3 rounded-md justify-between max-w-[560px] w-100">
        <header class="flex items-start relative">
            <button data-modal-target="defaultModal" data-modal-toggle="defaultModal">
                <img id="open_popup-modal" :src="require('/img/svg/close.svg')" style="width: 25px; min-width: 25px;" class="relative" alt="close"
                :data-idBouteille="this.bouteille.id"
                :data-idCellier="this.bouteille.vino_cellier_id">
            </button>
            <img class="object-cover min-w-[100px] min-h-[150px] max-h-[150px] hover-carte"
            :src="(this.bouteille.url_img) ? this.bouteille.url_img : (`/storage/uploads/${this.bouteille.imageSAQ || 'placeholder.png'}`)"
            :alt="this.bouteille.nomSAQ">
        </header>
        <div class="desc flex flex-col justify-between">
            <header class="hover-carte" @click="redirection(bouteille.id)">
                <h1 class="font-extrabold text-xl text-accent_wine">{{ this.bouteille.nomSAQ }}</h1>
                <h3 class="font-medium text-section_title text-lg">{{ this.bouteille.pays ? this.bouteille.pays : 'Pays indéfini'}} | {{ this.bouteille.format ? this.bouteille.format : 'Format indéfini' }}</h3>
            </header>
            <h1 class="font-medium text-section_title text-lg">${{ this.bouteille.prix_saq }} CAD</h1>
            <footer class="flex">
                <Compteur :nbbouteille="this.bouteille.quantiteBouteille" :id="this.bouteille.vino_bouteille_id" :idcellier="this.bouteille.vino_cellier_id" :historique="this.historique"/>
            </footer>
        </div>
        <footer class="flex flex-col justify-between items-center pb-4">
            <ListeSouhaits :bouteille="this.bouteille.vino_bouteille_id" :liste="this.liste" style="width: 40px;"/>
            <!-- Split 3: modification de la bouteille-->
            <div v-if="this.bouteille.utilisateur_id !== null">
                <img :src="require('/img/svg/modify.svg')" width="20" @click="modifier(bouteille.vino_cellier_id, bouteille.vino_bouteille_id)" class="hover:cursor-pointer" alt="modify">
            </div>
            <!-- Split 3: fonctionnalité de historique
            <p @click="historique()" class="ml-auto mt-16">
                <img :src="require('/img/svg/bottle.svg')" style="height: 50px;" alt="">
            </p>-->
        </footer>
    </article>
</template>

<script>
import ListeSouhaits from './ListeSouhaits.vue';
import Compteur from './Compteur.vue';

export default {
    data() {
        return {
            estVide: false,
            bouteilleSouhatais: {},
            afficherCarte: true
        };
    },
    props: ['bouteille', 'liste'],
    components: {
        Compteur,
        ListeSouhaits
    },
    methods: {
        changeBottle () {
            this.estVide = !this.estVide;
        },

        // Supprimer l'element de la liste DOM
        historique () {
            axios.post('/api.save-historique', { params: {
                'bouteilleID': this.bouteille.vino_bouteille_id,
                'cellierID': this.bouteille.vino_cellier_id
            }}) .then(response => {
                console.log('Modification est enrégistrée');
            });
            this.afficherCarte = false;
        },
        redirection(bouteille) {
            // rediriger en passant le id de la bouteille qui vient du @click sur la carte
            location.href = `${window.location.pathname}/details-bouteille/${bouteille}`;
        },
        modifier(idCellier, idBouteille) {
            // Récupérer l'URL de base de l'application Laravel
            const baseUrl = window.location.origin;
            // Rediriger vers le formulaire de modification en passant le ID de la bouteille
            window.location.href = `${baseUrl}/${idCellier}/modifier-bouteille/${idBouteille}`;
        },
    },

    computed: {},
};

</script>

<style lang="scss" scoped>
    .desc {
        width: 30ch;
    }
    .carte {
        background-color: #DCDCDC;
    }
</style>