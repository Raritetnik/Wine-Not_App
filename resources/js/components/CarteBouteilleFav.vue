<template>
    <article class="mx-auto bg-gray-100 flex gap-1 border px-4 py-3 rounded-md justify-between max-w-[560px] w-100">
        <header class="flex items-start relative">
            <img class="object-cover min-w-[100px] min-h-[150px] max-h-[150px] hover-carte"
            :src="(this.bouteille.url_img) ? this.bouteille.url_img : ('/storage/' + (this.bouteille.imageSAQ || 'uploads/placeholder.png'))"
            :alt="this.bouteille.nomSAQ">
        </header>
        <div class="desc flex flex-col justify-between">
            <header class="hover-carte">
                <h1 class="font-extrabold text-xl text-accent_wine">{{ this.bouteille.nom }}</h1>
                <h3 class="font-medium text-section_title text-lg">{{ this.bouteille.pays }} | {{ this.bouteille.format }}</h3>
            </header>
            <h1 class="font-medium text-section_title text-lg">${{ this.bouteille.prix_saq }} CAD</h1>
            <h2>Date d'ajout: {{ this.formatDate(this.bouteille.date) }}</h2>
            <footer class="flex">
            </footer>
        </div>
        <footer>
            <div class="flex justify-end items-start gap-2">
                <!-- Split 3: modification de la bouteille -->
                <ListeSouhaits v-if="this.liste !== undefined" :bouteille="this.bouteille.id" :liste="this.liste" style="width: 40px;"/>
            </div>
            <div class="flex justify-between items-end">
            </div>
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
            bouteilleSouhatais: {}
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
        formatDate (date) {
            let dt = new Date(date);
            return dt.toLocaleDateString()+' à ' +dt.toLocaleTimeString();
        },
        // Supprimer l'element de la liste DOM
        supprimer () {
            axios.delete('/api.delete-bouteille', { params: {
                'BouteilleID': this.bouteille.id
            }}) .then(response => {
                console.log('Modification est enrégistrée');
            });
            this.$el.parentElement.removeChild(this.$el)
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
        max-width: 30ch;
    }
    .carte {
        background-color: #DCDCDC;
    }
</style>