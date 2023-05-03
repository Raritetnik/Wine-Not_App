 <!-- Form d'ajout de bouteilles dans ce cellier-->

 <form id="form-saq" action="{{ route('bouteille.saq') }}" method="post" enctype="multipart/form-data" class="w-full px-6 pt-3">
   <!-- passer la méthode PUT et aussi le token expired réémission du token-->
   @csrf
   @method('PUT')
   <div class="pb-3">
   <h2 class="text-section_title text-xl font-extrabold">
     Recherche SAQ
   </h2>
 </div>
   <section class="flex flex-col lg:flex-row pb-6 justify-center">

     <div class="w-full sm:w-[500px] mb-3">
       <v-recherche :bouteilles="{{ $bouteilles }}"/>
     </div>
     <div class="w-full sm:w-[500px] flex flex-col">
       <h5 class="text-secondary font-semibold text-md mb-5 bg-gray-100 rounded-md px-3 py-3">Remplisser le formulaire afin d'ajouter le vin à votre colection </h5>
       <div class="mb-2 flex justify-between gap-3">

         <div class="w-full mb-3">

           <label for="cellier" class="block text-section_title font-bold mb-2">Celliers</label>
           <select name="vino_cellier_id" id="cellier" class="w-full block py-3 px-3 bg-transparent bg-gray-50  rounded-md border border-gray-300 focus:border-secondary focus:outline-none">
             @foreach($celliers as $index => $cellier)
             @if($index === 0)
             <option value="{{$cellier->id}}" selected>{{$cellier->nom}}</option>
             @else
             <option value="{{$cellier->id}}">{{$cellier->nom}}</option>
             @endif
             @endforeach
           </select>
         </div>
       </div>
       <div class="mb-2 flex justify-between gap-3">
         <div class="w-1/2 mb-3">
           <label for="quantite" class="block text-section_title font-bold mb-2">Quantité</label>
           <input class="block w-full py-3 px-3 placeholder-section_title rounded-md border border-gray-300 focus:border-secondary focus:outline-none appearance-none" name="quantite" id="quantite" min="1" placeholder="Quantité de bouteilles">
           </input>
         </div>
         <div class="w-1/2 mb-3">
           <label for="millesime" class="block text-section_title font-bold mb-2">Millésime</label>
           <input class="block w-full py-3 px-3 placeholder-section_title rounded-md border border-gray-300 focus:border-secondary focus:outline-none appearance-none" name="millesime" id="millesime" min="1" placeholder="Entrer l'année du vin">
           </input>
         </div>
       </div>
       <div class="mb-2 flex flex-wrap md:flex-nowrap gap-3">
         <div class="w-full mb-3">
           <label for="date_achat" class="block text-section_title font-bold mb-2">Date d'achat</label>
           <div class="flex flex-col md:flex-row md:space-x-4">
             <input type="date" name="date_achat" id="date_achat" placeholder="Date d'achat" class="block w-full placeholder-section_title py-3 px-3 rounded-md border border-gray-300 focus:border-secondary focus:outline-none" />
           </div>
         </div>
         <div class="w-full mb-3">
           <label for="date_exp" class="block text-section_title font-bold mb-2">Date de péremption</label>
           <div class="flex flex-col md:flex-row md:space-x-4">
             <input type="date" name="garde_jusqua" id="date_exp" placeholder="Garde jusqu'à quand" class="block w-full py-3 px-3 rounded-md border border-gray-300 placeholder-section_title focus:border-secondary focus:outline-none" />
           </div>
         </div>
       </div>
       <div class="mt-7 flex">
         <button type="submit" class="w-1/2 px-7 py-2.5 rounded-md bg-secondary text-lg font-medium text-main hover:bg-transparent border hover:border-secondary hover:text-secondary transition duration-300 ease-in-out">Ajouter</button>
       </div>
     </div>


   </section>
 </form>
