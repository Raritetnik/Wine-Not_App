<template>
    <article class="carte flex gap-1 border px-4 py-3 rounded-md justify-between w-[400px] sm:w-[500px]">
        <header class="flex items-start relative">
            <img :src="require('/img/svg/close.svg')" width="20" @click="supprimer()" class="absolute" alt="close">
            <img class="object-cover min-w-[100px] min-h-[150px] hover-carte" :src="this.bouteille.url_img" :alt="this.bouteille.nomSAQ">
        </header>
        <div class="desc flex flex-col justify-between">
            <header class="hover-carte" @click="redirection(bouteille.id)">
                <h1 class="font-bold" style="color: var(--color_champ)">{{ this.bouteille.nomSAQ }}</h1>
                <h3 style="color: var(--color_text)">{{ this.bouteille.pays }} | {{ this.bouteille.format }}</h3>
            </header>
            <h1 class="p-2 font-medium bg-slate-500 text-white max-w-[120px] flex justify-center">CAD${{ this.bouteille.prix_saq }}</h1>
            <footer class="flex">
                <Compteur :nbbouteille="this.bouteille.quantiteBouteille" :id="this.bouteille.vino_bouteille_id" />
            </footer>
        </div>
        <footer class="flex flex-col justify-between items-end">
            <ListeSouhaits :bouteille="this.bouteille.vino_bouteille_id" :liste="this.liste" style="width: 40px;"/>
            <p @click="changeBottle()">
                <img v-if="!this.estVide" :src="require('/img/svg/bottle.svg')" style="height: 50px;" alt="">
                <img v-if="this.estVide" :src="require('/img/svg/empty_bottle.svg')" style="height: 50px;" height="30" alt="">
            </p>
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