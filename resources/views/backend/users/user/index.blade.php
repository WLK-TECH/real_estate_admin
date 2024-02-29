@extends('layouts.master')

@section('content')
<div class="container-fluid my-3">
    <div class="card border-none shadow p-3">
        <div class="d-flex justify-content-between my-3">
            <h5>Users</h5>
            <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary d-block">
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
                            <span class="badge badge-primary">
                                {{ Illuminate\Support\Str::title($role->name) }}
                            </span>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-success me-2"><i class="fas fa-pen-to-square"></i></a>
                            <form class="d-inline" action="{{ route('users.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                  <i class="fas fa-trash"></i>
                                </button>
                              </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end mt-4">
            <div>
                {{ $users->links() }}
            </div>
        </div>
        @if (!$users->count())
            <div class="bg-light text-center py-3 my-2">
                <h5 class="text-center">Data Not Found!</h5>
                <p>Go To <a href="{{ url('/admin/users/') }}" class="btn btn-sm btn-primary">Previous Page</a></p>
            </div>
        @endif

    </div>
</div>
@endsection
