<template>
  <div class="flex items-center filtrer-cartes">
    <div class="cursor-pointer ml-auto hover:opacity-70 transition-opacity duration-200 ease-in-out">
      <svg class="bouton-filtre" width="30" height="26" viewBox="0 0 30 26" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M28.8413 1H1.84131L12.6413 13.6133V22.3333L18.0413 25V13.6133L28.8413 1Z" stroke="#ABA08D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
      <!-- checkbox pour déclencher ouverture du filtre -->
      <label>
        <input type="checkbox" name="filtre" class="checkbox-filtre" v-model="filtreActif" hidden>
      </label>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      filtreActif: false,
    };
  },
  mounted() {
    const boutonFiltre = document.querySelector('.bouton-filtre');
    const inputFiltre = document.querySelector('.checkbox-filtre');
    const accordeon = document.querySelectorAll(".label-categorie");

    // initialiser pour que puisse se déclencer au premier clic
    if(boutonFiltre !== null) {
        inputFiltre.checked = false;
        //inputFiltre.checked = false;
        // déclencher la transition pour visualiser les filtres
        boutonFiltre.addEventListener("click", (e) => {
            let conteneur = document.querySelector(".conteneur-filtre");
            let fermer = document.querySelector(".fermer"); // bouton x pour fermer filtre

            // afficher les filtres
            if (!inputFiltre.checked) {
                conteneur.classList.add("active");
                inputFiltre.checked = true;
                // déclencher fermeture avec le X
                fermer.addEventListener("click", ()=>{
                    conteneur.classList.remove("active");
                    inputFiltre.checked=false;
                })
            }
            // déclencher fermeture en cliquant sur le background à l'extérieur des filtres
            else {
                conteneur.classList.remove("active");
                inputFiltre.checked=false;
            }

            // fermer en cliquant ailleurs que sur le conteneur
            window.addEventListener("click", (e) => {
                const clicDansConteneur = conteneur.contains(e.target); 
                if (!clicDansConteneur && e.target.classList.contains("bouton-filtre") ===false) {
                    // Le clic est en dehors du conteneur, exécutez votre logique de fermeture ici
                    conteneur.classList.remove("active");
                    inputFiltre.checked = false;
                }
            });

            // fermer en glissant le menu des filtres vers la gauche
            let initialX = null; 
            conteneur.addEventListener("mousedown", (e) => {
                initialX = e.clientX;
                conteneur.addEventListener("mousemove", (e) => {
                    if (initialX !== null) {
                        // distance nécessaire pour fermer le conteneur doit pas être trop "sensible" mais aussi responsive
                        const distance = e.clientX - initialX;
                        if (distance < -50) { 
                            conteneur.classList.remove("active");
                            inputFiltre.checked = false;
                        }
                    }
                });
            });
            // pour réinitialiser
            window.addEventListener("mouseup", () => {
                // console.log("test")
                initialX = null;
            });

            initialX = null;
            conteneur.addEventListener("touchstart", (e) => {
              initialX = e.touches[0].clientX;
            });

            conteneur.addEventListener("touchmove", (e) => {
              if (initialX !== null) {
                const distance = e.touches[0].clientX - initialX;
                if (distance < -50) {
                  conteneur.classList.remove("active");
                  inputFiltre.checked = false;
                  initialX = null;
                }
              }
            });
            conteneur.addEventListener("touchend", () => {
              initialX = null;
            });
           
        });
        
        // déclencher l'ouverture et fermeture de chaque accordéon de filtres
        accordeon.forEach((unAccordeon)=>{
            unAccordeon.addEventListener("click", (e)=>{
            let icone = unAccordeon.querySelector(".material-symbols-outlined")
            if(icone.innerText == "remove"){
                icone.innerText = "add";
                unAccordeon.nextElementSibling.classList.add("cacher");
            } else if (icone.innerText == "add") {
                icone.innerText = "remove";
                unAccordeon.nextElementSibling.classList.remove("cacher");
            }
            });
        })
    }
  },
};
</script>

