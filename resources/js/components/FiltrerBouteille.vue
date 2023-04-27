<template>
    <aside class="conteneur-filtre">
        <span class="material-symbols-outlined fermer">
        close
        </span>
        <nav class="conteneur-nav menu-lateral">
            <div class="liste-categorie accordeon">
                <div class="menu-deroulant">
                    <div class="label-categorie">
                        <h3>Pays</h3>
                        <span class="material-symbols-outlined">expand_more</span>
                    </div>
                    <ul class="liste-choix">
                        <li>
                            <input type="checkbox" id="Espagne" name="Espagne">
                            <label for="Espagne">Espagne</label>
                        </li>
                        <li>
                            <input type="checkbox" id="Italie" name="Italie">
                            <label for="Italie">Italie</label>
                        </li>
                        <li>
                            <input type="checkbox" id="États-Unis" name="États-Unis">
                            <label for="États-Unis">États-Unis</label>
                        </li>
                    </ul>
                    
                    <!--Type-->
                    <div class="label-categorie">
                        <h3>Type</h3>
                        <span class="material-symbols-outlined">expand_more</span>
                    </div>
                    <ul class="liste-choix">
                        <li>
                            <input type="checkbox" id="rouge" name="rouge">
                            <label for="rouge">Vin rouge</label>
                        </li>
                        <li>
                            <input type="checkbox" id="rose" name="rose">
                            <label for="rose">Vin rosé</label>
                        </li>
                        <li>
                            <input type="checkbox" id="blanc" name="blanc">
                            <label for="blanc">Vin blanc</label>
                        </li>
                    </ul>
                
                    <!--Prix-->
                    <div class="label-categorie">
                        <h3>Prix</h3>
                        <span class="material-symbols-outlined">expand_more</span>
                    </div>
                    <ul class="liste-choix">
                        <li>
                            <input type="checkbox" id="vingt" name="vingt">
                            <label for="vingt">20$ et moins</label>
                        </li>
                        <li>
                            <input type="checkbox" id="trente" name="trente">
                            <label for="trente">20$ - 30$</label>
                        </li>
                        <li>
                            <input type="checkbox" id="blanc" name="blanc">
                            <label for="blanc">30$ - 40$</label>
                        </li>
                        <li>
                            <input type="checkbox" id="blanc" name="blanc">
                            <label for="blanc">40$ - 50$</label>
                        </li>
                        <li>
                            <input type="checkbox" id="blanc" name="blanc">
                            <label for="blanc">50$ - 100$</label>
                        </li>
                        <li>
                            <input type="checkbox" id="blanc" name="blanc">
                            <label for="blanc">100$ - 200$</label>
                        </li>
                        <li>
                            <input type="checkbox" id="blanc" name="blanc">
                            <label for="blanc">200$ - 500$</label>
                        </li>
                        <li>
                            <input type="checkbox" id="blanc" name="blanc">
                            <label for="blanc">1000$ et plus</label>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </aside> <!-- //conteneur-filtre -->
<!-- Reste du doc pour visualiser -->
    <div class="conteneur-de-toute-la-page">
        <!-- Bouton pour filtrer carte -->
        <div class="filtrer-cartes">
            <label>
                <div class="bouton-filtre">Filtre</div>
                <input type="checkbox" name="filtre" class="checkbox-filtre">
            </label>  
        </div>
    </div>
</template>
