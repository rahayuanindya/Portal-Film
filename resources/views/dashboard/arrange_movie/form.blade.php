@extends('layouts.dashboard')

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8 align-self-center">
                    <h3>Arrange Movies</h3>
                </div>

                <div class="col-4 text-right">
                <button class="btn btn-sm text-secondary" data-toggle="modal" data-target="#deleteModal">
                    <i class="fas fa-trash"></i>
                </button>
                </div>
            </div>
        </div>
        <div class="card-body">
           <div class="row">
            <div class="col-md-8 offset-2">
                <form action="{{ route($url, $arrangeMovie->id ?? '') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @if (isset($arrangeMovie))
                       @method('PUT')
                    @endif
                    <input type="hidden" name="theaters_id" id="" value="{{ $theaters->id }}">
                    <div class="form-group">
                        <label for="movie">Movie</label>
                        <select name="movies_id" class="form-control">
                        <option value="">Pilih Movie</option>
                        @foreach ($movies as $movie)
                            @if($movie->id == old('movies_id', $arrangeMovie->movies_id ?? ''))
                                 <option value="{{ $movie->id }}" selected>{{ $movie->title }}</option>
                            @else
                                <option value="{{ $movie->id }}">{{ $movie->title }}</option>
                                @endif
                        @endforeach
                    </select>
                    @error('movies_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Studio</label>
                        <input type="text" name="studio" class="form-control @error('studio') {{ 'is-invalid' }} @enderror" value="{{ old('studio') ?? $arrangeMovie->studio ?? '' }}">
                        @error('studio')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" name="price" class="form-control @error('price') {{ 'is-invalid' }} @enderror" value="{{ old('price') ?? $arrangeMovie->price ?? '' }}">
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group form-row mt-4">
                        <div class="col-2 align-self-center">
                            <label for="seats">Seats</label>
                        </div>
                        <div class="col-5">
                                @php
                                    $seats = isset($arrangeMovie->seats) ? json_decode($arrangeMovie->seats) : false;
              
                                @endphp
                                <input type="number" name="rows" id="" value="{{ old('rows') ?? $arrangeMovie->rows ?? $seats->rows ?? '' }}" placeholder="Rows" class="form-control @error('rows') {{ 'is-invalid' }} @enderror">
                            @error('rows')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-5">
                            <input type="number" name="columns" id="" value="{{ old('columns') ?? $arrangeMovie->columns ?? $seats->columns ?? '' }}" placeholder="Columns" class="form-control @error('columns') {{ 'is-invalid' }} @enderror">
                            @error('columns')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <label for="schedules">Schedules</label>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <schedule-component :old-schedules="{{ $arrangeMovie->schedules ?? json_encode(old('schedules') ?? []) }}"></schedule-component>
                        </div>
                        @error('schedules')
                            <span class="text-danger">{{ $message }}</span>
                         @enderror
                    </div>
                    <div class="mb-2">
                    <div class="form-group mb-0">
                        <label for="status">Status</label>
                    </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="status" id="" class="form-check-input" value="coming soon" id="cooming soon" @if ((old('status') ?? $arrangeMovie->status ?? '') == 'cooming soon') checked @endif>
                            <label for="active" class="form-check-label">Coming soon</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="status" id="" class="form-check-input" value="in theaters" id="in theaters" @if ((old('status') ?? $arrangeMovie->status ?? '') == 'in theaters') checked @endif>
                            <label for="in theaters" class="form-check-label">In Theaters</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="status" id="" class="form-check-input" value="finish" id="finish" @if ((old('status') ?? $arrangeMovie->status ?? '') == 'finish') checked @endif>
                            <label for="finish" class="form-check-label">Finish</label>
                        </div>
                    </div>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="form-group mb-0">
                        <button type="button" class="btn btn-sm btn-secondary" onclick="window.history.back()">Cancel</button>
                        <button type="submit" class="btn btn-success btn-sm">{{ $button }}</button>
                    </div>
                </form>
            </div>
           </div>
        </div>
    </div>

    @if (isset($arrangeMovie))
    <div class="modal fade" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Delete</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <p>Anda Yakin Ingin Menghapus theaters </p>
                </div>

                <div class="modal-footer">
                    <form action="{{ route('dashboard.theaters.arrange.movies.delete', $arrangeMovie->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection