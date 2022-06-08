<?php

namespace App\Http\Controllers;
//Include models that will be used in this controller
use App\Models\ApprovedDrugs;
use App\Models\DrugTargets;
use App\Models\TargetSequences;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SectionController extends Controller
{
    //Section containing a list of all drugs from database
    public function drugsection(){
        $drugs = ApprovedDrugs::all();
        return view('section.approveddrugs', compact('drugs'));
    }
    //Section containing a list of all drug targets from database
    public function targetsection(){
        $targets = DrugTargets::all();
        return view('section.drugtargets', compact('targets'));
    }
    //Section containing a list of all drug target sequences from database
    public function sequencesection(){
        $sequences = DB::table('target_sequences')->get();
        return view('section.targetsequences', compact('sequences'));
    }
}
