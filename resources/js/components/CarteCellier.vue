<template>
    <article class="mx-auto bg-gray-100 flex gap-1 border px-4 py-3 rounded-md justify-between max-w-[560px] w-100">
        <header class="flex items-start relative">
            <img id="open_popup-modal" :src="require('/img/svg/close.svg')" width="25" class="relative" alt="close">
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
                <img :src="require('/img/svg/modify.svg')" alt="modify" width="25">
            </a>
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
