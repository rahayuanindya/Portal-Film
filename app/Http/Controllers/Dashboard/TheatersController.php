<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Theaters;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TheatersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Theaters $theaters)
    {
        $q = $request->input('q');

        $active = "Theaters";

        $theaters = $theaters->when($q, function($query) use($q){
            return $query->where('theaters', 'like', '%'.$q.'%');
        })->paginate(10);

        $request = $request->all();

        return view('dashboard/theaters/list', [
            'active' => $active,
            'request'=> $request,
            'theaters'=> $theaters
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $active = "Theaters";

        return view('dashboard.theaters.form', [
            'button'   => 'Create',
            'url'      => 'dashboard.theaters.store',
            'active'   =>  $active,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Theaters $theaters)
    {
        $validator = Validator::make($request->all(), [
            'theaters'  => 'required|unique:App\Models\theaters,theaters',
            'addresss'   => 'required',
            'status'    => 'required'
        ]);

        if($validator->fails()){
            return redirect()
                    ->route('dashboard.theaters.create')
                    ->withErrors($validator)
                    ->withInput();
        } else {
            $theaters->theaters = $request->input('theaters');
            $theaters->addresss = $request->input('addresss');
            $theaters->status = $request->input('status');
            $theaters->save();
            return redirect()
                        ->route('dashboard.theaters')
                        ->with('messages', __('messages.store', ['title' => $request->input('theaters')]));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Theaters  $theaters
     * @return \Illuminate\Http\Response
     */
    public function show(Theaters $theaters)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Theaters  $theaters
     * @return \Illuminate\Http\Response
     */
    public function edit(Theaters $theaters)
    {
        $active = "Theaters";

        return view('dashboard.theaters.form', [
            'theaters' => $theaters,
            'active'   => $active,
            'url'      => 'dashboard.theaters.update',
            'button'   => 'Update'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Theaters  $theaters
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Theaters $theaters)
    {
        $validator = Validator::make($request->all(), [
            'theaters'  => 'required|unique:App\Models\theaters,theaters',$theaters->id,
            'addresss'   => 'required',
            'status'    => 'required'
        ]);

        if($validator->fails()){
            return redirect()
                    ->route('dashboard.theaters.update', $theaters->id)
                    ->withErrors($validator)
                    ->withInput();
        } else {
            $theaters->theaters = $request->input('theaters');
            $theaters->addresss = $request->input('addresss');
            $theaters->status = $request->input('status');
            $theaters->save();
            return redirect()
                        ->route('dashboard.theaters')
                        ->with('messages', __('messages.update', ['title' => $theaters->theaters]));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Theaters  $theaters
     * @return \Illuminate\Http\Response
     */
    public function destroy(Theaters $theaters)
    {
        $title = $theaters->theaters;
        $theaters->delete();
        return redirect()
                ->route('dashboard.theaters')
                ->with('messages', __('messages.delete', ['title' => $title]));
    }
}
