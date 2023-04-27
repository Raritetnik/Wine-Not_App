// Déclencheur pour ouverture de la composante filtre (bouton click + accordéon)

window.addEventListener("load", ()=>{
    let boutonFiltre = document.querySelector('.checkbox-filtre');
    let accordeon = document.querySelectorAll(".label-categorie")
    
        // déclencher la transition pour visualiser les filtres
        boutonFiltre.addEventListener("click", (e) => {
            let conteneur = document.querySelector(".conteneur-filtre");
            let fermer = document.querySelector(".fermer");
            if (boutonFiltre.checked) {
                conteneur.classList.add("active");
                // déclencher fermeture avec le X
                fermer.addEventListener("click", ()=>{
                    conteneur.classList.remove("active");
                    boutonFiltre.checked = false;
                })
            } 
            // déclencher fermeture en cliquant sur le background à l'extérieur des filtres
            else {
                conteneur.classList.remove("active");
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
