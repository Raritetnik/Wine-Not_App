<?php

namespace App\Http\Controllers;

use App\Jobs\LoaderDataSAQ;
use App\Models\SAQ;
use App\Models\Vino_Bouteille;
use Illuminate\Http\Request;

class SAQController extends Controller
{
    public function uploadVins() {
        LoaderDataSAQ::dispatch();
    }

    public function show(SAQ $saq) {
        $listeBouteilles = Vino_Bouteille::all();
        return view('bouteille.show', ['bouteilles' => $listeBouteilles]);
    }
}
