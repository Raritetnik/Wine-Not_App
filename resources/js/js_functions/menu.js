window.addEventListener('DOMContentLoaded', function() {

const btnMobileMenu = document.getElementById("mobile-menu-button");
const mobileMenu = document.getElementById("mobile-menu");
const logoWn = document.querySelector("#logo");




btnMobileMenu.addEventListener("click", function () {
  const mobileMenu = document.getElementById("mobile-menu");
  const logoWn = document.querySelector("#logo");
  mobileMenu.classList.toggle("hidden");
  if (!mobileMenu.classList.contains("hidden")) {
    logoWn.style.opacity = 0;
  } else {
    logoWn.style.opacity = 1;
   
  }
});
 
//modification de couleur de burger menu
const svgElement = document.querySelector('#mobile-menu-button svg');
btnMobileMenu.addEventListener('click', () =>{
  const strokeColor = svgElement.getAttribute('stroke');
  if (strokeColor === '#67375C') { 
  svgElement.setAttribute('stroke', 'white');
  }
  else {
    svgElement.setAttribute('stroke', '#67375C');
  }
})



  

// Close mobile menu when link is clicked
const mobileMenuLinks = document.querySelectorAll("#mobile-menu a");

mobileMenuLinks.forEach(function (link) {
  link.addEventListener("click", function () {
    mobileMenu.classList.add("hidden");
  });
});


// afficher le nom d'une image choisi
const imgForm = document.getElementById('#imgForm');
if(imgForm){
  imgForm.addEventListener('change', function() {
    let file_name = this.value.split('\\').pop();
    document.getElementById('file-name').textContent = file_name;
  });
}


/*
// control affichage de formulaires bouteille
const formSAQ = document.querySelector('#form-saq');
const formPersonal = document.querySelector('#form-personal');
const btnForm = document.querySelector('#btn-form');
const plus = document.querySelector('#plus');
const formP = document.querySelector('#form-p-p');
const formPsaq = document.querySelector('#form-p-saq');


if(btnForm){
  btnForm.addEventListener('click', () => {
    plus.classList.toggle('rotate-45');
    formP.classList.toggle('hidden');
    formPsaq.classList.toggle('hidden');
    formSAQ.classList.toggle('hidden');
    formPersonal.classList.toggle('hidden');
    formPersonal.classList.toggle('flex');
  });
}
*/
});

  





