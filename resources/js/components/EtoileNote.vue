<template>
    <div class="gap-1.5 star-rating">
        <svg v-for="star in totalStars" :key="star" :class="['star', { 'filled': star <= noteDonnee }]" @click="updateRating(star)"
            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <polygon :class="{ 'filled': star <= noteDonnee }" points="12 1.955 15.245 8.579 22.558 9.642 17.255 14.817 18.507 22.11 12 18.692 5.493 22.11 6.745 14.817 1.442 9.642 8.755 8.579 12 1.955" />
        </svg>

    </div>
</template>

  
<script>
export default {
    props: {
        note: {
            type: Number,
        },
        totalStars: {
            type: Number,
            default: 5,
        },
        bouteille: {
            type: Number
        }
    },
    data() {
        return {
            noteDonnee: this.note
        }
    },
    methods: {
        updateRating(star) {
            this.noteDonnee = star;
            // envoyer vers la route de modification vers webd.php
            let url = window.location.origin + "/bouteille-note/" + this.bouteille;
            console.log(url)
            axios
            .put(url, { note: this.noteDonnee })
            .then((response) => {
                console.log(response.data);
            })
            .catch((error) => {
                console.log(error);
            });
        },
    },
};
</script>
