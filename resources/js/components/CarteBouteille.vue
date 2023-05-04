<template>
   <article class="mx-auto bg-gray-100 flex gap-1 border px-4 py-3 rounded-md justify-between max-w-[560px] w-full" style="padding: 16px;">
    <header class="flex items-start relative">
        <img :src="require('/img/svg/close.svg')" width="25" @click="supprimer()" class="relative" alt="close">
        <img class="object-cover w-full max-h-[150px] hover-carte" :src="this.bouteille.url_img" :alt="this.bouteille.nomSAQ">
    </header>
    <div class="desc flex flex-col justify-between">
        <header class="hover-carte" @click="redirection(bouteille.id)">
            <h1 class="font-extrabold text-xl text-accent_wine">{{ this.bouteille.nomSAQ }}</h1>
            <h3 class="font-medium text-section_title text-lg">{{ this.bouteille.pays }} | {{ this.bouteille.format }}</h3>
        </header>
        <h1 class="font-medium text-section_title text-lg">${{ this.bouteille.prix_saq }} CAD</h1>
        <footer class="flex">
            <Compteur :nbbouteille="this.bouteille.quantiteBouteille" :id="this.bouteille.vino_bouteille_id" />
        </footer>
    </div>
    <footer>
        <div class="flex justify-end items-start gap-2">
            <!--<img :src="require('/img/svg/modify.svg')" width="20" @click="modifier(bouteille.vino_bouteille_id)" class="hover:cursor-pointer" alt="modify">-->
            <ListeSouhaits :bouteille="this.bouteille.vino_bouteille_id" :liste="this.liste" style="width: 40px;"/>
        </div>
        <div class="flex justify-between items-end">
            <!--<p @click="changeBottle()" class="ml-auto mt-16">
                <img v-if="!this.estVide" :src="require('/img/svg/bottle.svg')" style="height: 50px;" alt="">
                <img v-if="this.estVide" :src="require('/img/svg/empty_bottle.svg')" style="height: 50px;" height="30" alt="">
            </p>-->
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
            console.log(this.bouteille.id);
            console.log(this.bouteille.quantite);
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
        redirection(bouteille) {
            // rediriger en passant le id de la bouteille qui vient du @click sur la carte
            location.href = `${window.location.pathname}/details-bouteille/${bouteille}`;
        },
        modifier(idBouteille) {
            // Récupérer l'URL de base de l'application Laravel
            const baseUrl = window.location.origin;
            // Rediriger vers le formulaire de modification en passant le ID de la bouteille
            window.location.href = `${baseUrl}/modifier-bouteille/${idBouteille}`;
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