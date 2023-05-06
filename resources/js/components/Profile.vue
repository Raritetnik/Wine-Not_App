<template>
    <div class="p-2 relative" style="color: var(--color_text)">
        <h3 class="mt-5" style="color: var(--color_text)">Information personelle</h3>
        <blockquote class="mb-5 p-2 mt-2 border-accent_wine border rounded relative">
            <img @click="modification()" class="absolute top-2 right-2" :src="require('/img/svg/modify.svg')" alt="favoris" width="20">
            <div v-if="!this.afficherForm">
                <h3>Prenom: {{ this.user.prenom }}</h3>
                <h3>Nom: {{ this.user.nom }}</h3>
                <h3>Courriel: {{ this.user.courriel }}</h3>
            </div>
            <div v-if="this.afficherForm">
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
            </div>
        </blockquote>
        <div class="mb-2">
            <label for="oldPassword" style="color: var(--color_text)">Mot de passe</label>
            <input id="oldPassword" type="password" placeholder="Ancien mot de passe" class="appearance-none border rounded w-full py-3 px-3 text-accent_wine leading-tight focus:outline-none border-accent_wine " name="oldPassword" autocomplete="new-password"
            v-model="oldPass"
            >
            <small class="p-1 text-lg">Saisir l'ancien mot de passe pour le modifier...</small>
        </div>
        <div v-if="oldPass !== ''" class="mb-2">
            <label for="password" style="color: var(--color_text)">Nouveau mot de passe</label>
            <input id="password" type="password" placeholder="Nouveau mot de passe" class="appearance-none border rounded w-full py-3 px-3 text-accent_wine leading-tight focus:outline-none border-accent_wine " name="password" autocomplete="new-password" required>
        </div>
        <div v-if="oldPass !== ''" class="">
            <input id="password-confirm" type="password" placeholder="Confirmer votre mot de passe" class="appearance-none border rounded w-full py-3 px-3 text-accent_wine leading-tight focus:outline-none border-accent_wine" name="password_confirmation" autocomplete="new-password" required>
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
            oldPass: '',
        };
    },
    methods: {
        /**
         * Permettre la modification de mot de passe
         */
        modification () {
            this.afficherForm = !this.afficherForm;
        }
    },
};
</script>
