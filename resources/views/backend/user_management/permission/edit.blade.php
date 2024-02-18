@extends('layouts.master')

@section('content')
<div class="container my-3">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h5 class="mb-4">Edit Permissions</h5>
            <form action="{{ route('permission.update', $permission->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="" class="form-label">Permission</label>
                    <input type="text" class="form-control" name="name" value="{{ $permission->name }}" placeholder="Enter Permission Name">
                    @error('name')
                    <span class="d-block text-danger">*{{ $message }}</span>
                    @enderror
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-pen-to-square mr-2"></i>Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
