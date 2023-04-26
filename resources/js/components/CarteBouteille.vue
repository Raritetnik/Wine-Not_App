<template>
    <article class="carte flex gap-1 border px-4 py-2 rounded-md">
        <header class="flex">
            <h1>X</h1>
            <img class="object-fill min-w-[100px] min-h-[150px]" :src="this.bouteille.image" :alt="this.bouteille.nom">
        </header>
        <div class="desc flex flex-col justify-between">
            <header>
                <h1>{{ this.bouteille.nom }}</h1>
                <h3>{{ this.bouteille.pays_id }} | {{ this.bouteille.vino_format_id }}</h3>
            </header>
            <footer>
                <p>Quantite</p>
            </footer>
        </div>
        <footer class="flex flex-col justify-between">
            <div><ListeSouhaits :bouteille="this.bouteille" :liste="this.liste"/></div>
            <p>Etat</p>
        </footer>
    </article>
</template>

<script>
import ListeSouhaits from './ListeSouhaits.vue';

export default {
    data() {
        return {
            liste: []
        };
    },
    props: ['bouteille'],
    components: {
        ListeSouhaits
    },

    methods: {
        beforeMount () {

        }
    },

    computed: {},
};
</script>

<style lang="scss" scoped>
    .desc {
        max-width: 20ch;
    }
    .carte {
        background-color: #DCDCDC;
    }
</style>