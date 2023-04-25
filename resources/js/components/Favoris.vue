<template>
  <button @click="changerFavoris()">
    <img v-if="this.estFavoris" :src="require('/img/svg/like.svg')" alt="favoris" width="20">
    <img v-if="!this.estFavoris" :src="require('/img/svg/unlike.svg')" alt="favoris" width="20">
  </button>
</template>

<script>
export default {
    props: ['bouteille', 'liste'],
    data () {
        return {
            estFavoris: false,
        };
    },
    methods: {
        changerFavoris () {
            this.estFavoris = !this.estFavoris;
            axios.post('/api.listeSouhait/'+this.bouteille, {
                BouteilleID: this.bouteille
            }) .then(response => {
                console.log('Modification est enrégistrée');
            });
        }
    },
    beforeMount() {
        let rep = this.liste.find( a => {
            return a.vino_bouteilles_id === this.bouteille
        });
        this.estFavoris = rep != null;
    },

}
</script>

<style>

</style>