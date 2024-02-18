@extends('layouts.master')

@section('content')
<div class="container my-3">
    <div class="d-flex justify-content-between my-3">
        <h5>Roles</h5>
        <a href="{{ route('role.create') }}" class="btn btn-sm btn-primary d-block">
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
                @foreach ($roles as $key => $r)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ Illuminate\Support\Str::title($r->name) }}</td>
                    <td>
                        <a href="{{ route('role.show', $r->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('role.edit', $r->id) }}" class="btn btn-sm btn-success me-2"><i class="fas fa-pen-to-square"></i></a>
                        <a href="" onclick="event.preventDefault(); document.getElementById('deleteRole-{{ $r->id }}').submit();" class="btn btn-sm btn-danger me-2"><i class="fas fa-trash"></i></a>
                        <form class="d-none" id="deleteRole-{{ $r->id }}" action="{{ route('role.destroy', $r->id) }}" method="post">
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
