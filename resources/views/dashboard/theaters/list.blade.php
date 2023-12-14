@extends('layouts.dashboard')

@section('content')
    <div class="mb-2">
        <a href="{{ route('dashboard.theaters.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Movie</a>
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
            @if($theaters->total())
            <table class="table table-borderless table-striped table-hover">
                <thead>
                    <tr>
                        <th>Theaters</th>
                        <th>Address</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
               <tbody>
                @foreach ($theaters as $item)
                <tr>
                    <td>{{ $item->theaters }}</td>
                    <td>{{ $item->addresss }}</td>
                    <td> 
                        <a href="{{ route('dashboard.theaters.edit', $item->id) }}" class="btn btn-success btn-sm" title="Edit">
                            <i class="fas fa-pen"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
               </tbody>
            </table>
            {{ $theaters->appends($request)->links() }}
            @else
            <h4 class="text-center p-3">{{ __('messages.no_data', ['module' => 'Theaters']) }}</h4>
            @endif
        </div>
    </div>
    
@endsection