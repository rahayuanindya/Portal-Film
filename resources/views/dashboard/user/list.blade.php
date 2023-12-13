@extends('layouts.dashboard')

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8 align-self-center">
                    <h3>Users</h3>
                </div>

                <div class="col-4">
                    <form method="get" action="{{ url('dashboard/users') }}">
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
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Registered</th>
                        <th>Edited</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
               <tbody>
                @foreach ($users as $item)
                <tr>
                    <th scope="row">{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</th>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->updated_at }}</td>
                    <td> 
                        <a href="{{ route('dashboard.users.edit', $item->id) }}" class="btn btn-success btn-sm" title="Edit">
                            <i class="fas fa-pen"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
               </tbody>
            </table>
            {{ $users->appends($request)->links() }}
        </div>
    </div>
    
@endsection