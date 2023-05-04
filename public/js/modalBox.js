window.addEventListener('DOMContentLoaded', function() {
    console.log('LOADED PAGE WITH MODAL');
    const modal = document.getElementById('popup-modal');
    const btnCallModal = document.getElementById('open_popup-modal');
    const btnCloseModal = document.getElementById('close_popup-modal');
    const btnNoModal = document.getElementById('no_popup-modal');

    if(btnCallModal !== null && modal !== null && btnCloseModal !== null){
        btnCallModal.addEventListener('click', (e) => {
            modal.style.display = "block";
        });

        btnCloseModal.addEventListener('click', (e) => {
            modal.style.display = "none";
        })
        btnNoModal.addEventListener('click', (e) => {
            modal.style.display = "none";
        })
    }
});