@extends('layouts.dashboard')

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8 align-self-center">
                    <h3>Movies</h3>
                </div>

                <div class="col-4">
                    <form method="get" action="{{ url('dashboard/movies') }}">
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
            @if($movies->total())
            <table class="table table-borderless table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Thumbnail</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
               <tbody>
                @foreach ($movies as $item)
                <tr>
                    <th scope="row">{{ ($movies->currentPage() - 1) * $movies->perPage() + $loop->iteration }}</th>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->thumbnail }}</td>
                    <td> 
                        <a href="{{ route('dashboard.movies.edit', ['id' => $item->id]) }}" class="btn btn-success btn-sm" title="Edit">
                            <i class="fas fa-pen"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
               </tbody>
            </table>
            {{ $movies->appends($request)->links() }}
            @else
            <h4 class="text-center p-3">Data Movie Belum Ada</h4>
            @endif
        </div>
    </div>
    
@endsection