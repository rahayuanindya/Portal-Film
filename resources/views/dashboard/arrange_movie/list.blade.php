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
                    <h3>Arrange Movie - {{ $theaters->theaters }}</h3>
                </div>

                <div class="col-4">
                    <form method="get" action="{{ route('dashboard.theaters.arrange.movies', $theaters->id) }}">
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
            <table class="table table-borderless table-striped table-hover">
                <thead>
                    <tr>
                        <th>Movie</th>
                        <th>Studio</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($arrangeMovies as $item)
                        <tr>
                            <td>{{ $item->movies->first()->title }}</td>
                            <td>{{ $item->studio }}</td>
                            <td>{{ $item->price }}</td>
                            <td>{{ $item->status }}</td>
                            <td>
                                <a href="{{ route('dashboard.theaters.arrange.movies.edit', [$theaters->id, $item->id]) }}" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
@endsection