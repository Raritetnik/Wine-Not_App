<template>
    <div class="p-2 relative" style="color: var(--color_text)">
        <img @click="modification()" class="absolute top-2 right-2" :src="require('/img/svg/modify.svg')" alt="favoris" width="20">
        <div v-if="!this.afficherForm">
            <h3>Nom: {{ this.user.nom }}</h3>
            <h3>Prenom: {{ this.user.prenom }}</h3>
            <h3>Courriel: {{ this.user.courriel }}</h3>
        </div>
        <div v-if="this.afficherForm">
            <form action="">
                <input type="hidden" name="_token" v-bind:value="csrf">
                <div class="mb-4">
                    <label for="nom" style="color: var(--color_text)">Nom</label>
                    <input id="nom" type="text" :value="this.user.nom" placeholder="Votre nom" class="appearance-none border rounded w-full py-3 px-3 text-accent_wine leading-tight focus:outline-none border-accent_wine" name="nom" required>
                </div>
                <div class="mb-4">
                    <label for="prenom" style="color: var(--color_text)">Prenom</label>
                    <input id="prenom" type="text" :value="this.user.prenom" placeholder="Votre prenom" class="appearance-none border rounded w-full py-3 px-3 text-accent_wine leading-tight focus:outline-none border-accent_wine" name="prenom" required>
                </div>
                <div class="mb-4">
                    <label for="courriel" style="color: var(--color_text)">Courriel</label>
                    <input id="courriel" type="text" placeholder="Votre courriel" :value="this.user.courriel" class="appearance-none border rounded w-full py-3 px-3 text-accent_wine leading-tight focus:outline-none border-accent_wine" name="courriel" required>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Profile',
    props: ['user'],
    data() {
        return {
            afficherForm: false,
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        };
    },
    mounted() {
        console.log(this.user);
    },
    methods: {
        modification () {
            this.afficherForm = !this.afficherForm;
        }
    },
};
</script>
