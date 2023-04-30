<template>
    <article class="carte flex gap-1 border px-4 py-2 rounded-md justify-between w-[400px] sm:w-[500px]">
        <header class="flex items-start relative">
            <img :src="require('/img/svg/close.svg')" width="20" @click="supprimer()" class="absolute" alt="close">
            <img class="object-cover min-w-[100px] min-h-[150px]" :src="this.bouteille.imageSAQ" :alt="this.bouteille.nomSAQ">
        </header>
        <div class="desc flex flex-col justify-between">
            <header>
                <h1 class="font-bold" style="color: var(--color_champ)">{{ this.bouteille.nomSAQ }}</h1>
                <h3 style="color: var(--color_text)">{{ this.bouteille.pays }} | {{ this.bouteille.format }}</h3>
            </header>
            <footer class="flex">
                <Compteur :nbbouteille="this.bouteille.quantiteBouteille" :id="this.bouteille.vino_bouteille_id" />
            </footer>
        </div>
        <footer class="flex flex-col justify-between">
            <ListeSouhaits :bouteille="this.bouteille.vino_bouteille_id" :liste="this.liste" style="width: 40px;"/>
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
            console.log(this.bouteille.id);
            console.log(this.bouteille.quantite);
        },

   
           supprimer () {
            console.log("TESTE")
            // Appel à l'API pour supprimer la bouteille de la base de données
            axios.post('/api/delete-bouteille/' + this.bouteille, {
                bouteille_id: this.bouteille
            }).then(response => {
                console.log('La suppression est enregistrée dans la base de données');
            });
            
            // Suppression de la bouteille du DOM
            this.$el.parentElement.removeChild(this.$el);

            // Suppression de la bouteille du cellier de l'utilisateur dans la base de données
            axios.delete('/api/supprimer-bouteille-utilisateur/' + this.utilisateur_id + '/' + this.cellier_id + '/' + this.bouteille).then(response => {
                console.log('La bouteille a été supprimée du cellier de lutilisateur');
            });
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