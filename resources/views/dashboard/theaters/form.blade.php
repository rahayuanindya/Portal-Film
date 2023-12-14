@extends('layouts.dashboard')

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8 align-self-center">
                    <h3>Theaters</h3>
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
                <form action="{{ route($url, $theaters->id ?? '') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @if (isset($theaters))
                        @method('PUT')
                    @endif
                    <div class="form-group">
                        <label for="name">Theaters</label>
                        <input type="text" name="theaters" class="form-control @error('theaters') {{ 'is-invalid' }} @enderror" value="{{ old('theaters') ?? $theaters->theaters ?? '' }}">
                        @error('theaters')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Address</label>
                        <textarea name="addresss" class="form-control @error('addresss') {{ 'is-invalid' }} @enderror">{{ old('addresss') ?? $theaters->addresss ?? '' }}</textarea>
                        @error('addresss')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-2">
                    <div class="form-group mb-0">
                        <label for="status">Status</label>
                    </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="status" id="" class="form-check-input" value="active" id="active" @if ((old('status') ?? $theaters->status ?? '') == 'active') checked @endif>
                            <label for="active" class="form-check-label">Active</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="status" id="" class="form-check-input" value="inactive" id="inactive" @if ((old('status') ?? $theaters->status ?? '') == 'inactive') checked @endif>
                            <label for="inactive" class="form-check-label">Inactive</label>
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

    @if (isset($theaters))
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
                    <form action="{{ route('dashboard.theaters.delete', $theaters->id) }}" method="post">
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