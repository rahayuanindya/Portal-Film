<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Theaters;
use App\Models\Movie;
use App\Models\ArrangeMovie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class ArrangeMovieController extends Controller
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

        $arrangeMovies = ArrangeMovie::where('theaters_id', $theaters->id)
                                    ->with('movies')
                                    ->whereHas('movies', function($query) use ($q){
                                        $query->where('title', 'like', "%$q%");
                                    })
                                    ->paginate();
       
        $request = $request->all();

        return view('dashboard/arrange_movie/list', [
            'active' => $active,
            'request'=> $request,
            'theaters'=> $theaters,
            'arrangeMovies' => $arrangeMovies
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Theaters $theaters)
    {   
        $active = "Theaters";

        $movies = Movie::get();

        return view('dashboard/arrange_movie/form',[
            'theaters'  =>  $theaters,
            'url'       =>  'dashboard.theaters.arrange.movies.store',
            'theaters'    =>  $theaters,
            'button'    => 'Create',
            'active'     => $active,
            'movies'     => $movies
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ArrangeMovie $arrangeMovie)
    {

       $validator = Validator::make($request->all(), [    
            'studio'        => 'required',
            'theaters_id'   => 'required',
            'movies_id'     => 'required',
            'price'         => 'required',
            'rows'          => 'required',
            'columns'       => 'required',
            'schedules'     => 'required',
            'status'        => 'required'
        ]);

        if($validator->fails()){
            return redirect()
                    ->route('dashboard.theaters.arrange.movies.create', $request->input('theaters_id'))
                    ->withErrors($validator)
                    ->withInput();
        } else {
            $seats = [
                'rows' => $request->input('rows'),
                'columns' => $request->input('columns')
            ];

            $arrangeMovie->theaters_id  = $request->input('theaters_id');
            $arrangeMovie->movies_id    = $request->input('movies_id');
            $arrangeMovie->studio       = $request->input('studio');
            $arrangeMovie->price        = $request->input('price');
            $arrangeMovie->status       = $request->input('status');
            $arrangeMovie->seats        = json_encode($seats);
            $arrangeMovie->schedules    = json_encode($request->input('schedules'));
            $arrangeMovie->save();

            return redirect()
                    ->route('dashboard.theaters.arrange.movies', $request->input('theaters_id'))
                    ->with('messages', __('messages.store', ['title' => $request->input('studio')]));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ArrangeMovie  $arrangeMovie
     * @return \Illuminate\Http\Response
     */
    public function show(ArrangeMovie $arrangeMovie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ArrangeMovie  $arrangeMovie
     * @return \Illuminate\Http\Response
     */
    public function edit(Theaters $theaters, ArrangeMovie $arrangeMovie)
    {
        $active = "Theaters";

        $movies = Movie::get();

        return view('dashboard/arrange_movie/form', [
            'url'           => 'dashboard.theaters.arrange.movies.update',
            'button'        => 'Update',
            'arrangeMovie' => $arrangeMovie,
            'theaters'      => $theaters,
            'movies'        => $movies,
            'active'        => $active
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ArrangeMovie  $arrangeMovie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ArrangeMovie $arrangeMovie)
    {
        $validator = Validator::make($request->all(), [    
            'studio'        => 'required',
            'theaters_id'   => 'required',
            'movies_id'     => 'required',
            'price'         => 'required',
            'rows'          => 'required',
            'columns'       => 'required',
            'schedules'     => 'required',
            'status'        => 'required'
        ]);

        if($validator->fails()){
            return redirect()
                    ->route('dashboard.theaters.arrange.movies.edit', 
                            [   'theaters' => $request->input('theaters_id'), 
                                'arrangeMovie' => $arrangeMovie->id]
                                )
                    ->withErrors($validator)
                    ->withInput();
        } else {
            $seats = [
                'rows' => $request->input('rows'),
                'columns' => $request->input('columns')
            ];

            $arrangeMovie->theaters_id  = $request->input('theaters_id');
            $arrangeMovie->movies_id    = $request->input('movies_id');
            $arrangeMovie->studio       = $request->input('studio');
            $arrangeMovie->price        = $request->input('price');
            $arrangeMovie->status       = $request->input('status');
            $arrangeMovie->seats        = json_encode($seats);
            $arrangeMovie->schedules    = json_encode($request->input('schedules'));
            $arrangeMovie->save();

            return redirect()
                    ->route('dashboard.theaters.arrange.movies', $request->input('theaters_id'))
                    ->with('messages', __('messages.update', ['title' => $request->input('studio')]));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ArrangeMovie  $arrangeMovie
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArrangeMovie $arrangeMovie)
    {
        $title = $arrangeMovie->studio;
        
        $arrangeMovie->delete();
        
        return redirect()
                ->route('dashboard.theaters.arrange.movies', $arrangeMovie->theaters_id)
                ->with('messages', __('messages.delete', ['title' => $title]));
    }
}
