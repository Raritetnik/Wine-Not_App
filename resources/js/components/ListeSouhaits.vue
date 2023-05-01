<template>
  <button @click="changerFavoris()" class="flex justify-end">
    <img v-if="this.estFavoris" :src="require('/img/svg/like.svg')" alt="favoris" width="30">
    <img v-if="!this.estFavoris" :src="require('/img/svg/unlike.svg')" alt="favoris" width="30">
  </button>
</template>

<script>
export default {
    name: 'ListeSouhaits',
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
            console.log(a.vino_bouteilles_id === this.bouteille);
            return a.vino_bouteilles_id === this.bouteille
        });
        this.estFavoris = rep != null;
    },

}
</script>

ALTER TABLE `vino_bouteilles` ADD `utilisateur_id` INT(11) NOT NULL AFTER `updated_at`;