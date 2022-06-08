<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\DrugSearchController;
use App\Http\Controllers\TargetSearchController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {return view('welcome');});
// search page that include user interfaces
Route::get('search', function () {return view('search');});
//sections
Route::get('section/approveddrugs', [SectionController::class, 'drugsection']);
Route::get('section/drugtargets', [SectionController::class, 'targetsection']);
Route::get('section/targetsequences', [SectionController::class, 'sequencesection']);
//drugsearch
Route::post('drugsearch/id', [DrugSearchController::class, 'getdrugid']);
Route::post('drugsearch/indication', [DrugSearchController::class, 'getindication']);
//targetsearch
Route::post('targetsearch/drugid', [TargetSearchController::class, 'getdrugid']);
Route::post('targetsearch/proteinid', [TargetSearchController::class, 'getproteinid']);
Route::post('targetsearch/species', [TargetSearchController::class, 'getspecies']);
Route::post('targetsearch/sequence', [TargetSearchController::class, 'getsequence']);
//page view for individual drug/target
Route::get('drugsearch/viewdrug/{drugbankid}', [DrugSearchController::class, 'viewdrug']);
Route::get('targetsearch/viewtarget/{uniprotid}', [TargetSearchController::class, 'viewtarget']);
