<?php

namespace App\Http\Controllers;

use App\Models\Land;
use Illuminate\Http\Request;

class LandController extends Controller
{
    public function list(Request $req) {
        $sortMethod = "asc";

        if ($req->query("sort") != null) {
            // if ($req->query("sort") == 'descD' || 'ascD'){
            //     if ($req->query("sort") == 'descD'){
            //         $sortMethod = $req->query("desc");
            //     }else{
            //         $sortMethod = $req->query("asc");
            //     }    
            //     return Land::orderBy("dimensione", $sortMethod)->get();
            // }
            $sortMethod = $req->query("sort");
            return Land::orderBy("created_at", $sortMethod)->get();
        }

        
    }


    public function listDimension(Request $req) {
        $sortMethod = "desc";

        if ($req->query("sort") != null) {
            $sortMethod = $req->query("sort");
        }

        return Land::orderBy("dimensione", $sortMethod)->get();
    }

    public function detail($id) {
        return Land::where("id", $id)->first();
    }

    public function create(Request $req) {
        // Get data from request
        $landData = json_decode($req->getContent());

        $land = new Land();

        $land->comune = $landData->comune;
        $land->foto = $landData->foto;
        $land->dimensione = $landData->dimensione;
        $land->foglio_catastale = $landData->foglio_catastale;
        $land->mappale_catastale = $landData->mappale_catastale;
        $land->parcella_catastale = $landData->parcella_catastale;
        $land->tipo_terreno = $landData->tipo_terreno;
        $land->tipo_irrigazione = $landData->tipo_irrigazione;
        $land->tipo_offerta = $landData->tipo_offerta;
        $land->canone_offerta = $landData->canone_offerta;
        $land->disponibile = $landData->disponibile;

        $land->save();

        return response()->json($land, 201);
    }

    public function modify(Request $req, $id) {
        $land = Land::where("id", $id)->first();

        // Get data from request
        $landData = json_decode($req->getContent());

        $land->comune = $landData->comune;
        $land->foto = $landData->foto;
        $land->dimensione = $landData->dimensione;
        $land->foglio_catastale = $landData->foglio_catastale;
        $land->mappale_catastale = $landData->mappale_catastale;
        $land->parcella_catastale = $landData->parcella_catastale;
        $land->tipo_terreno = $landData->tipo_terreno;
        $land->tipo_irrigazione = $landData->tipo_irrigazione;
        $land->tipo_offerta = $landData->tipo_offerta;
        $land->canone_offerta = $landData->canone_offerta;
        $land->disponibile = $landData->disponibile;

        $land->save();

        return response()->json($land, 200);
    }

    public function destroy($id) {
        return Land::destroy($id);
    }
}
