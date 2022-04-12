<?php

namespace App\Http\Controllers;

use App\Models\AnalysisResults;
use App\Models\Laboratory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AnalysisResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($dispatchguide = session()->get('dispatchguide')){
            $analysisresults = AnalysisResults::where('dispatch_guide_id', $dispatchguide->id)->get();
            $laboratories = Laboratory::all();
            return view('analysisresults.index', compact('laboratories','analysisresults', 'dispatchguide'));
        }else{
            return redirect()->route('dispatchguides.index');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($dispatchguide = session()->get('dispatchguide')){
            $this->validate($request, [
                'number' => 'required',
                'laboratoryId' => 'required',
                'reportDate' => 'required',
                'file' => 'required',
            ]);

            $file = 'files/analysis_results/' . time() . '.' . $request->file->extension();

            $request->file->move(public_path('files/analysis_results'), time() . '.' . $request->file->extension());


            $analysisresults = AnalysisResults::create([
                'dispatch_guide_id' => $dispatchguide->id,
                'number' => $request->number,
                'laboratory_id' => $request->laboratoryId,
                'report_date' => date('Y-m-d', strtotime($request->reportDate)),
                'file' => $file
            ]);

            return (['analysisresults' => [
                'id' => $analysisresults->id,
                'number'=> $analysisresults->number,
                'laboratory'=> $analysisresults->laboratory->name,
                'reportDate'=> date('d-m-Y', strtotime($analysisresults->report_date)),
                'file'=> asset($file),
            ]]);
        }else{
            return ([error => true]);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnalysisResults $analysisresult)
    {
        File::delete($analysisresult->file);
        $analysisresult->delete();
        return (['success' => true]);
    }
}
