@extends('layouts.master')

@section('content')
<div class="container my-3">
    <div class="d-flex justify-content-between my-3">
        <h5>Permissions</h5>
        <a href="{{ route('permissions.create') }}" class="btn btn-sm btn-primary d-block">
            <i class="fas fa-plus me-2"></i>
            Create
        </a>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $key => $p)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $p->name }}</td>
                    <td>
                        <a href="{{ route('permissions.edit', $p->id) }}" class="btn btn-sm btn-success me-2"><i class="fas fa-pen-to-square"></i></a>
                        <a href="" onclick="event.preventDefault(); document.getElementById('deletePermission-{{ $p->id }}').submit();" class="btn btn-sm btn-danger me-2"><i class="fas fa-trash"></i></a>
                        <form class="d-none" id="deletePermission-{{ $p->id }}" action="{{ route('permissions.destroy', $p->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
