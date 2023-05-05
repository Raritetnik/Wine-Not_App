window.addEventListener('DOMContentLoaded', function() {
    const sectionBouteilles = this.document.getElementById('section-bouteilles');
    const sectionCelliers = this.document.getElementById('section-celliers');
    const modal = document.getElementById('popup-modal');

    const btnCloseModal = document.getElementById('close_popup-modal');
    const btnNoModal = document.getElementById('no_popup-modal');

    if(sectionBouteilles !== null){
        sectionBouteilles.addEventListener('click', (e) => {
            if(e.target.dataset.idbouteille !== undefined){
                console.log(e.target.dataset.idbouteille);
                modal.querySelector('#BouteilleID').value = e.target.dataset.idbouteille
                modal.style.display = "block";
            }
        });

        btnNoModal.addEventListener('click', (e) => {
            modal.style.display = "none";
        });
        btnCloseModal.addEventListener('click', (e) => {
            modal.style.display = "none";
        });
    }


    if(sectionCelliers !== null){
        sectionCelliers.addEventListener('click', (e) => {
            if(e.target.dataset.idcellier !== undefined){
                console.log(modal.querySelector('#CellierID').value);
                modal.querySelector('#CellierID').value = e.target.dataset.idcellier
                modal.style.display = "block";
            }
        });

        btnNoModal.addEventListener('click', (e) => {
            modal.style.display = "none";
        });
        btnCloseModal.addEventListener('click', (e) => {
            modal.style.display = "none";
        });
    }
});