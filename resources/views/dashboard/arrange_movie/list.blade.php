@extends('layouts.dashboard')

@section('content')
    <div class="mb-2">
        <a href="{{ route('dashboard.theaters.arrange.movies.create', $theaters->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Movie</a>
    </div>

    @if (session()->has('messages'))
    <div class="alert alert-success">
        <strong>{{ session()->get('messages') }}</strong>
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
    @endif

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8 align-self-center">
                    <h3>Theaters</h3>
                </div>

                <div class="col-4">
                    <form method="get" action="{{ route('dashboard.theaters') }}">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control form-control-sm" value="{{ $request['q'] ?? ''}}">
                            <div class="input input-group-append">
                                <button type="submit" class="btn btn-secondary btn-sm">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
        
        </div>
    </div>
    
@endsection