<template>
    <article class="mx-auto bg-gray-100 flex gap-1 border px-4 py-3 rounded-md justify-between max-w-[560px] w-100">
        <header class="flex items-start relative">
            <button data-modal-target="defaultModal" data-modal-toggle="defaultModal">
                <!--<button id="open_popup-modal" type="button" class="transition-opacity duration-300 hover:opacity-75"><img :src="require('/img/svg/trash.svg')" alt="delete"></button>-->
                <img id="open_popup-modal" :src="require('/img/svg/close.svg')" width="25" class="relative" alt="close">
            </button>
            <img class="object-cover min-w-[100px] min-h-[150px] max-h-[150px] hover-carte" :src="this.bouteille.url_img" :alt="this.bouteille.nomSAQ">
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
                <img :src="require('/img/svg/modify.svg')" width="20" @click="modifier(bouteille.vino_bouteille_id)" class="hover:cursor-pointer" alt="modify">
                <ListeSouhaits :bouteille="this.bouteille.vino_bouteille_id" :liste="this.liste" style="width: 40px;"/>
            </div>
            <div class="flex justify-between items-end">
                <!--<p @click="changeBottle()" class="ml-auto mt-16">
                    <img v-if="!this.estVide" :src="require('/img/svg/bottle.svg')" style="height: 50px;" alt="">
                    <img v-if="this.estVide" :src="require('/img/svg/empty_bottle.svg')" style="height: 50px;" height="30" alt="">
                </p>-->
            </div>
        </footer>

        <!-- Modal box -->
        <div id="popup-modal" tabindex="-1" class="bg-black bg-opacity-40 fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full ">
            <div class="relative w-full max-w-md max-h-full rounded-lg border border-accent_wine top-[50%] translate-y-[-50%] left-[50%] translate-x-[-50%]">
                <div class="relative bg-white rounded-lg">
                    <button type="button" id="close_popup-modal" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="popup-modal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Fermer</span>
                    </button>
                    <div class="p-6 text-center">
                        <svg aria-hidden="true" class="mx-auto mb-4 text-red-500 w-14 h-14" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <h3 class="mb-5 text-lg font-normal text-black">Etes-vous sûr(e) de vouloir supprimer?</h3>
                        <button @click="supprimer()" type="submit" data-modal-hide="popup-modal" class="p-2 px-4 bg-green-600 text-white rounded" alt="delete">Oui</button>
                        <button data-modal-hide="popup-modal" class="p-2 px-4 bg-gray-800 text-white rounded" type="button" id="no_popup-modal">No</button>
                    </div>
                </div>
            </div>
        </div>
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