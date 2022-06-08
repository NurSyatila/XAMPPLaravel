<?php

namespace App\Http\Controllers;
use App\Models\ApprovedDrugs;
use App\Models\DrugTargets;
use App\Models\TargetSequences;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
    
class TargetSearchController extends Controller
{

    //Search by drug (interconnected tables)
    public function getdrugid(Request $request){
        if ($request->filled('drugid')) {
            $keyword = $request->input('drugid');
            $first = DB::table('approved_drugs')
                ->where('drugbankid','LIKE','%'.$keyword.'%')
                ->orWhere('drugname','LIKE','%'.$keyword.'%')
                ->orWhere('pubchemid','LIKE','%'.$keyword.'%')
                ->orWhere('hetid','LIKE','%'.$keyword.'%')
                ->first();
            if ($first) {
                $drugbankid = $first->drugbankid;
                $results = DB::table('drug_targets')
                ->where('drugids','LIKE','%'.$drugbankid.'%')
                ->get();
                if ($results->count()) {
                    return view('targetsearch/drugid', compact(['results', 'keyword','drugbankid']));}
                else {return view('nohit');} //return nohit page when no match found
            }
            else {return view('nohit');} //return noinput page when the input is empty
        }
        else {return view('noinput');}
    }

    //Search by protein
    public function getproteinid(Request $request){
        if ($request->filled('proteinid')) {
            $keyword = $request->input('proteinid');
            $results = DB::table('drug_targets')
                ->where('proteinname','LIKE','%'.$keyword.'%')
                ->orWhere('genename','LIKE','%'.$keyword.'%')
                ->orWhere('gbproteinid','LIKE','%'.$keyword.'%')
                ->orWhere('gbgeneid','LIKE','%'.$keyword.'%')
                ->orWhere('uniprotid','LIKE','%'.$keyword.'%')
                ->orWhere('uniprottitle','LIKE','%'.$keyword.'%')
                ->orWhere('pdbids','LIKE','%'.$keyword.'%')
                ->get();
            if ($results->count()) {return view('targetsearch/proteinid', compact(['results', 'keyword']));}
            else {return view('nohit');}
        }
        else {return view('noinput');}
    }

    //Search by organism
    public function getspecies(Request $request){
        if ($request->filled('species')) {
            $keyword = $request->input('species');
            $results = DB::table('drug_targets')
                ->where('species','LIKE','%'.$keyword.'%')
                ->get();
            if ($results->count()) {return view('targetsearch/species', compact(['results', 'keyword']));}
            else {return view('nohit');}
        }
        else {return view('noinput');}
    }
    
    //Search by sequence
    public function getsequence(Request $request){
        if ($request->filled('sequence')) {
            $keyword = $request->input('sequence');
            $results = DB::table('target_sequences')
                ->where('sequence','LIKE','%'.$keyword.'%')
                ->get();
            if ($results->count()) {return view('targetsearch/sequence', compact(['results', 'keyword']));}
            else {return view('nohit');}
        }
        else {return view('noinput');}
    }
    //Page for individual targets (interconnected tables)
    public function viewtarget($uniprotid){
        $uniprotid = $uniprotid;
        $first = DB::table('drug_targets')
            ->where('uniprotid','LIKE','%'.$uniprotid.'%')
            ->first();
        if ($first) {
            $pdbids = explode('; ',$first->pdbids);
            $reppdb = $pdbids[0];
            $alldrugs = explode('; ',$first->drugids);
            $results = DB::table('approved_drugs')
                ->whereIn('drugbankid',$alldrugs)
                ->get();
            return view('targetsearch/viewtarget', compact(['results','alldrugs', 'uniprotid', 'reppdb', 'first']));
        }
        else {return view('nohit');}
    }
}
