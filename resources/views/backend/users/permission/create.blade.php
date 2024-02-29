@extends('layouts.master')

@section('content')
<div class="container my-3">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h5 class="mb-4">Create Permissions</h5>
            <form action="{{ route('permissions.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Permission</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter Permission Name">
                    @error('name')
                    <span class="d-block text-danger">*{{ $message }}</span>
                    @enderror
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-plus mr-2"></i>Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
