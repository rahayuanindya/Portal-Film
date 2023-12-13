@extends('layouts.dashboard')

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8 align-self-center">
                    <h3>Movies</h3>
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
                <form action="{{ route('dashboard.movies.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Title</label>
                        <input type="text" name="title" id="" class="form-control">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Description</label>
                        <textarea name="description" class="form-control"></textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mt-4">
                        <div class="custom-file">
                            <input type="file" name="thumbnail" class="custom-file-input">
                            <label for="thumbnail" class="custom-file-label">Thumbnail</label>
                            @error('thumbnail')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <button type="button" class="btn btn-sm btn-secondary" onclick="window.history.back()">Cancel</button>
                        <button type="submit" class="btn btn-success btn-sm">Create</button>
                    </div>
                </form>
            </div>
           </div>
        </div>
    </div>
    <div class="modal fade" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Delete</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <p>Anda Yakin Ingin Menghapus Movie </p>
                </div>

                <div class="modal-footer">
                    <form action="{{ route('dashboard.movies.delete') }}" method="post">
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
@endsection