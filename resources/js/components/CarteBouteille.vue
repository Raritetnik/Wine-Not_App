<template>
    <article class="carte flex gap-1 border px-4 py-2 rounded-md justify-between w-[400px] sm:w-[500px]">
        <header class="flex items-start relative">
            <img :src="require('/img/svg/close.svg')" width="20" @click="supprimer()" class="absolute" alt="close">
            <img class="object-cover min-w-[100px] min-h-[150px]" :src="this.bouteille.url_img" :alt="this.bouteille.nom">
        </header>
        <div class="desc flex flex-col justify-between">
            <header>
                <h1 class="font-bold" style="color: var(--color_champ)">{{ this.bouteille.nom }}</h1>
                <h3 style="color: var(--color_text)">{{ this.bouteille.pays.pays }} | {{ this.bouteille.format.format }}</h3>
            </header>
            <footer class="flex">
                <Compteur :nbbouteille="bouteille.quantite" :id="this.bouteille.id" />
            </footer>
        </div>
        <footer class="flex flex-col justify-between">
            <ListeSouhaits :bouteille="this.bouteille.id" :liste="this.liste" style="width: 40px;"/>
            <p @click="changeBottle()">
                <img v-if="!this.estVide" :src="require('/img/svg/bottle.svg')" style="height: 40px;" alt="">
                <img v-if="this.estVide" :src="require('/img/svg/empty_bottle.svg')" style="height: 40px;" height="30" alt="">
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
            console.log(this.liste);
        },
        // Supprimer l'element de la liste DOM
        supprimer () {
            axios.post('/api.delete-bouteille/'+this.bouteille, {
                BouteilleID: this.bouteille
            }) .then(response => {
                console.log('Modification est enrégistrée');
            });
            this.$el.parentElement.removeChild(this.$el)
        }
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