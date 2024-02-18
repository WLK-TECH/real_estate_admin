@extends('layouts.master')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection


@section('content')
<div class="container my-3">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h5 class="mb-4">Edit User</h5>
            <form action="{{ route('user.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder="Enter Name">
                    @error('name')
                    <span class="d-block text-danger">*{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="" placeholder="Enter Email">
                    <small class="d-block">Old Email - {{ $user->email }}</small>
                    @error('email')
                    <span class="d-block text-danger">*{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Roles</label>
                    <select class="js-example-basic-multiple form-control" name="roles[]" multiple="multiple">
                        @foreach ($roles as $role)
                            @php
                                $selected = $user->roles->contains('id', $role->id) ? 'selected' : '';
                            @endphp
                            <option value="{{ $role->id }}" {{ $selected }}>{{ $role->name }}</option>
                        @endforeach
                      </select>
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-pen-to-square mr-2"></i>Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>
@endsection
