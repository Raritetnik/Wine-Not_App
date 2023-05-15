// Déclencheur pour ouverture de la composante filtre (bouton click + accordéon)

window.addEventListener("load", ()=>{
    let boutonFiltre = document.querySelector('.bouton-filtre');
    let inputFiltre = document.querySelector('.checkbox-filtre');
    let accordeon = document.querySelectorAll(".label-categorie");

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
})
