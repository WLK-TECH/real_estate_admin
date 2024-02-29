@extends('layouts.master')

@section('content')
<div class="container my-3">
    <div class="d-flex justify-content-between my-3">
        <h5>{{ Illuminate\Support\Str::title($role->name) }} with Permissions</h5>
        <a href="{{ route('roles.index') }}" class="btn btn-sm btn-primary d-block">
            <i class="fas fa-arrow-left mr-2"></i>
            Back
        </a>
    </div>
    <div class="table-responsive">
        <table class="table">
                <tr>
                    <th>Role</th>
                    <td>{{ Illuminate\Support\Str::title($role->name) }}</td>
                </tr>
                <tr>
                    <th>Permissions</th>
                    <td>
                        @foreach ($role->permissions as $p)
                        <span class="btn btn-sm btn-primary mb-1">{{ $p->name }}</span>
                        @endforeach
                    </td>
                </tr>
        </table>
    </div>
</div>
@endsection
