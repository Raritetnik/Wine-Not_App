<<template>
    <div class="w-full">
        <button class="bg-inherit py-2 mt-4 w-full border rounded-md mb-2 text-white border-red-500 bg-red-500" @click="openModal()" type="button">Supprimer</button>
        <!-- Modal Box -->
        <div v-if="afficherModale" tabindex="-1"
            class="bg-black bg-opacity-40 fixed top-0 left-0 right-0 z-50 block p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full ">
            <div
                class="relative w-full max-w-md max-h-full rounded-lg border border-accent_wine top-[50%] translate-y-[-50%] left-[50%] translate-x-[-50%]">
                <div class="relative bg-white rounded-lg">
                    <button type="button" id="close_popup-modal"
                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" @click="hideModale()"
                        data-modal-hide="popup-modal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Fermer</span>
                    </button>
                    <div class="p-6 text-center">
                        <svg aria-hidden="true" class="mx-auto mb-4 text-red-500 w-14 h-14" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-black">Etes-vous sûr(e) de vouloir supprimer votre compte?</h3>
                        <button data-modal-hide="popup-modal"
                            class="p-2 px-4 bg-green-600 text-white rounded" type="button" alt="delete" @click="supprimerCompte()">Oui</button>
                        <button data-modal-hide="popup-modal" class="p-2 px-4 bg-gray-800 text-white rounded" id="no_popup-modal" @click="hideModale()" type="button">No</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    name: 'SupprimerCompte',
    data() {
        return {
            afficherModale: false,
        };
    },
    props: ['user'],

    components: {},

    methods: {
        openModal() {
            console.log('F');
            this.afficherModale = true;
        },
        hideModale() {
            this.afficherModale = false;
        },
        supprimerCompte() {
            axios.post("/api.supprimer-utilisateur", {
                Utilisateur: this.user
            }) .then(response => {
                const baseUrl = window.location.origin;
                if(response.data) {
                    window.location.href = `${baseUrl}/login`
                } else {
                    console.log('Modification est enrégistrée');
                }
            });
        }
    },

};
</script>