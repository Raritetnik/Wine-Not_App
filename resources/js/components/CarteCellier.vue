<template>
    <article class="bg-gray-100 flex gap-1 border px-4 py-3 rounded-md justify-between w-[400px] sm:w-[500px]">
        <header class="flex items-start relative">
            <img :src="require('/img/svg/close.svg')" alt="close" width="20" @click="supprimer()">
        </header>
        <a :href="'/celliers/'+this.cellier.id" class="desc flex flex-col justify-between py-4 gap-2">
            <header class="hover-carte" @click="redirection(this.cellier.id)">
                <h1 class="font-extrabold text-xl text-accent_wine">{{ this.cellier.nom }}</h1>
            </header>
            <span class="flex justify-between"><h3>Quantite totale bouteilles:</h3> <h3>{{ this.cellier.quantiteBouteilles }}/{{ this.cellier.quantite_max }}</h3></span>
            <h1 class="font-medium text-section_title text-lg"></h1>
            <footer class="flex">
                <span class="flex">Description: Residence principale
                </span>
            </footer>
        </a>
        <footer class="flex flex-col justify-between items-end">
            <a :href="'/celliers-modifier/'+this.cellier.id">
                <img :src="require('/img/svg/modify.svg')" alt="modify" width="20">
            </a>
        </footer>
    </article>
</template>

<script>

export default {
    data() {
        return {
            estVide: false
        };
    },
    props: ['cellier'],
    methods: {
        // Supprimer l'element de la liste DOM
        supprimer () {
            axios.delete('/api.delete-cellier', { params: {
                    'CellierID': this.cellier.id
                }}) .then(response => {
                console.log('Modification est enrégistrée');
            });
            this.$el.parentElement.removeChild(this.$el)
        },
        redirection(cellier) {
            // rediriger en passant le id de la bouteille qui vient du @click sur la carte
            location.href = `${window.location.pathname}/cellier/${cellier}`;
        },
    },
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
