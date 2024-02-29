@extends('layouts.master')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="container my-3">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h5 class="mb-4">Edit Role with Permissions</h5>
            <form action="{{ route('roles.update', $role->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="" class="form-label">Role</label>
                    <input type="text" class="form-control"  value="{{ $role->name }}" name="name" placeholder="Enter Role Name">
                    @error('name')
                    <span class="d-block text-danger">*{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Permissions</label>
                    <select class="js-example-basic-multiple form-control" name="permissions[]" multiple="multiple">
                        @foreach ($permissions as $p)
                            @php
                                $selected = $role->permissions->contains('id', $p->id) ? 'selected' : '';
                            @endphp
                            <option value="{{ $p->name }}" {{ $selected }}>{{ $p->name }}</option>
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
