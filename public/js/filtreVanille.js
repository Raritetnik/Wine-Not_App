// Déclencheur pour ouverture de la composante filtre (bouton click + accordéon)

window.addEventListener("load", ()=>{
    let boutonFiltre = document.querySelector('.bouton-filtre');
    let inputFiltre = document.querySelector('.checkbox-filtre');
    let accordeon = document.querySelectorAll(".label-categorie")
    // initialiser pour que puisse se déclencer au premier clic
    inputFiltre.checked = false;
    
        // déclencher la transition pour visualiser les filtres
        boutonFiltre.addEventListener("click", (e) => {
            let conteneur = document.querySelector(".conteneur-filtre");
            let fermer = document.querySelector(".fermer");

            // afficher les filtres
            if (!inputFiltre.checked) {
                conteneur.classList.add("active");
                // déclencher fermeture avec le X
                fermer.addEventListener("click", ()=>{
                    conteneur.classList.remove("active");
                    inputFiltre.checked=false;
                })
            } 
            // déclencher fermeture en cliquant sur le background à l'extérieur des filtres
            else {
                conteneur.classList.remove("active");
                inputFiltre.checked=true;
            }
        });
        // déclencher l'ouverture et fermeture de chaque accordéon de filtres
        accordeon.forEach((unAccordeon)=>{
            console.log(unAccordeon)
            unAccordeon.addEventListener("click", (e)=>{
            let icone = unAccordeon.querySelector(".material-symbols-outlined")
            if(icone.innerText == "expand_more"){
                icone.innerText = "expand_less";
                unAccordeon.nextElementSibling.classList.add("cacher");
            }
            else {
                icone.innerText = "expand_more";
                unAccordeon.nextElementSibling.classList.remove("cacher");
            }
    
        });
    })
})
