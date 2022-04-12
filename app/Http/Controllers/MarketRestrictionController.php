<?php

namespace App\Http\Controllers;

use App\Models\AnalysisResults;
use App\Models\MarketRestriction;
use App\Models\Restriction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MarketRestrictionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($dispatchguide = session()->get('dispatchguide')){
            $marketrestrictions = MarketRestriction::where('dispatch_guide_id', $dispatchguide->id)->get();
            $restrictions = Restriction::all();
            return view('marketrestrictions.index', compact('marketrestrictions', 'dispatchguide', 'restrictions'));
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
                'restrictionId' => 'required',
                'file' => 'required',
            ]);

            $file = 'files/market_restrictions/' . time() . '.' . $request->file->extension();

            $request->file->move(public_path('files/market_restrictions'), time() . '.' . $request->file->extension());


            $marketrestriction = MarketRestriction::create([
                'dispatch_guide_id' => $dispatchguide->id,
                'restriction_id' => $request->restrictionId,
                'file' => $file
            ]);

            return (
            ['marketrestriction' => [
                'id' => $marketrestriction->id,
                'restriction' => $marketrestriction->restriction->name,
                'file' => asset($file),
            ]
            ]);
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
    public function destroy(MarketRestriction $marketrestriction)
    {
        File::delete($marketrestriction->file);
        $marketrestriction->delete();
        return (['success' => true]);
    }
}
