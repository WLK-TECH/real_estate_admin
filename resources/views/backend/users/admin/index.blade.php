@extends('layouts.master')

@section('content')
<div class="container-fluid my-3">
    <div class="card border-none p-3 shadow">
        <div class="d-flex justify-content-between my-3">
            <h5>Admins</h5>
            <a href="{{ route('admins.create') }}" class="btn btn-sm btn-primary d-block">
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
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $key => $user)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @foreach ($user->roles as $role)
                            <span class="badge badge-primary mb-3">
                                {{ Illuminate\Support\Str::title($role->name) }}
                            </span>
                            @endforeach
                        </td>
                        <td>
                            @can('edit admins')
                            <a href="{{ route('admins.edit', $user->id) }}" class="btn btn-sm btn-success me-2"><i class="fas fa-pen-to-square"></i></a>
                            @endcan
                            @can('delete admins')
                            <form class="d-inline" action="{{ route('admins.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                  <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
