<?php

namespace App\Http\Controllers;
//Include models that will be used in this controller
use App\Models\ApprovedDrugs;
use App\Models\DrugTargets;
use App\Models\TargetSequences;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DrugSearchController extends Controller
{
    //Search by drug identifiers or name
    public function getdrugid(Request $request){
        if ($request->filled('id')) {
            $keyword = $request->input('id');
            $results = DB::table('approved_drugs')
                ->where('drugbankid','LIKE','%'.$keyword.'%')
                ->orWhere('drugname','LIKE','%'.$keyword.'%')
                ->orWhere('pubchemid','LIKE','%'.$keyword.'%')
                ->orWhere('hetid','LIKE','%'.$keyword.'%')
                ->get();
            if ($results->count()) {return view('drugsearch/id', compact(['results', 'keyword']));}
            else {return view('nohit');} //return nohit page when no match found
        }
        else {return view('noinput');} //return noinput page when the input is empty
    }
    //Search by drug indication
    public function getindication(Request $request){
        if ($request->filled('indication')) {
            $keyword = $request->input('indication');
            $results = DB::table('approved_drugs')
                ->where('indication','LIKE','%'.$keyword.'%')
                ->get();
            if ($results->count()) {return view('drugsearch/indication', compact(['results', 'keyword']));}
            else {return view('nohit');}
        }
        else {return view('noinput');}
    }
    //Page for individual drugs (interconnected tables)
    public function viewdrug($drugbankid){
        $drugbankid = $drugbankid;
        $first = DB::table('approved_drugs')
            ->where('drugbankid','LIKE','%'.$drugbankid.'%')
            ->first();
        if ($first) {
            $results = DB::table('drug_targets')
            ->where('drugids','LIKE','%'.$drugbankid.'%')
            ->get();
            return view('drugsearch/viewdrug', compact(['results', 'drugbankid', 'first']));
        }
        else {return view('nohit');}
    }
}
    

//https://cdn.rcsb.org/images/structures/1g/11gs/11gs_assembly-1.jpeg
//https://pubchem.ncbi.nlm.nih.gov/image/imgsrv.fcgi?cid=392622&t=l
