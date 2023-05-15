window.addEventListener('DOMContentLoaded', function() {
    const sectionBouteilles = this.document.getElementById('section-bouteilles');
    const sectionCelliers = this.document.getElementById('section-celliers');
    const modal = document.getElementById('popup-modal');

    const btnCloseModal = document.getElementById('close_popup-modal');
    const btnNoModal = document.getElementById('no_popup-modal');

    const btnOpenModal = document.getElementById('open_popup-modal');

    /**
     * Gestion de la boite modale pour chaque element de page bouteilles de cellier
     */
    if(sectionBouteilles !== null){
        sectionBouteilles.addEventListener('click', (e) => {
            if(e.target.dataset.idbouteille !== undefined){
                console.log(e.target.dataset.idbouteille);
                modal.querySelector('#BouteilleID').value = e.target.dataset.idbouteille
                modal.querySelector('#CellierID').value = e.target.dataset.idcellier
                modal.style.display = "block";
            }
        });
        // Fermer la boite modale
        btnNoModal.addEventListener('click', (e) => {
            modal.style.display = "none";
        });
        btnCloseModal.addEventListener('click', (e) => {
            modal.style.display = "none";
        });
    }

    /**
     * Gestion de la boite modale pour chaque element de page cellier
     */
    if(sectionCelliers !== null){
        sectionCelliers.addEventListener('click', (e) => {
            if(e.target.dataset.idcellier !== undefined){
                console.log(modal.querySelector('#CellierID').value);
                modal.querySelector('#CellierID').value = e.target.dataset.idcellier
                modal.style.display = "block";
            }
        });
        // Fermer la boite modale
        btnNoModal.addEventListener('click', (e) => {
            modal.style.display = "none";
        });
        btnCloseModal.addEventListener('click', (e) => {
            modal.style.display = "none";
        });
    }

    /**
     * Supprimer sur fiche bouteille
     */
    if(btnOpenModal !== null) {
        btnOpenModal.addEventListener('click', e => {
            modal.style.display = "block";
        })
        // Fermer la boite modale
        btnNoModal.addEventListener('click', (e) => {
            modal.style.display = "none";
        });
        btnCloseModal.addEventListener('click', (e) => {
            modal.style.display = "none";
        });
    }

});