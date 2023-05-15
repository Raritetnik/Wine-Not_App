<div id="modal-view" tabindex="-1" class="bg-black bg-opacity-40 fixed top-0  left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)]">
    <div class="relative w-full max-w-md max-h-full rounded-lg border border-accent_wine top-[25%] translate-y-[-50%] left-[50%] translate-x-[-50%]">
        <div class="relative bg-white rounded-lg">
            <button type="button" id="close_modal" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="popup-modal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>

            </button>

            <div class="p-6 text-center">

                <form action="{{ route('deplacer.bouteille', ['vino_cellier' => $bouteille->vino_cellier_id, 'bouteille_par_cellier' => $bouteille->id]) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="flex justify-center flex-col gap-3">
                        <input type="hidden" name="vino_bouteille_id" value="{{$bouteille->vino_bouteille_id}}">
                        <label for="qty" class="mt-3 text-lg font-semibold text-gray-600 ">Combien voulez-vous déplacer?</label>
                        <div class="flex flex-col justify-center items-center">
                            
                                <input class="[appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none w-full text-center font-bold text-3xl cursor-text select-all focus:outline-none text-gray-600" id="qtyDep" type="number" name="quantite" value="0" min="1" max="{{ $bouteille->quantite ?? ''}}"autofocus/>
                           
                            <span class="text-accent_wine font-semibold text-sm">De {{ $bouteille->quantite ?? ''}} bouteilles</span>
                        </div>

                        <label for="cellier" class="text-lg font-semibold text-gray-600">Ou voulez-vous déplacer?</label>
                        <select name="nouveau_cellier" id="cellier" class="w-full block py-3 px-3 bg-transparent  bg-gray-50 rounded-md border border-accent_wine focus:border-accent_wine focus:outline-none">
                            @foreach($celliers as $index => $cellier)
                            @if($index === 0) <!-- verifier si index 0, 1er element du array -->
                            <option value="{{$cellier->id}}" selected>{{$cellier->nom}}</option>
                            @else
                            <option value="{{$cellier->id}}">{{$cellier->nom}}</option>
                            @endif
                            @endforeach
                        </select>
                        <div class="mt-5 flex justify-between gap-10">
                            <button type="submit" id="btnDep" class="py-2 px-4 rounded-md transition-colors duration-200 bg-accent_wine text-main font-medium hover:bg-transparent hover:border-accent_wine border hover:text-accent_wine" type="button" alt="Déplacer">Déplacer</button>
                            <button class="py-2 px-4 rounded-md transition-colors border-accent_wine duration-200  text-accent_wine font-medium hover:bg-accent_wine  border hover:text-main" type="button" id="no_modal">Retourner</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>