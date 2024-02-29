@extends('layouts.master')


@section('content')
<div class="container-fluid mt-3">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Total Users Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('super-admins.index') }}" class="card border-left-danger shadow h-100 py-1 text-decoration-none">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Total Super Admins</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <i class="fas fa-users mr-2"></i>
                                {{ $superAdmins }}</div>
                        </div>
                        <div class="col-auto">
                            {{-- <i class="fas fa-users fa-2x text-gray-300"></i> --}}
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Total Admin Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('admins.index') }}" class="card border-left-primary shadow h-100 py-1 text-decoration-none">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Admins</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $admins }}</div>
                        </div>
                        <div class="col-auto">
                            {{-- <i class="fas fa-users fa-2x text-gray-300"></i> --}}
                        </div>
                    </div>
                </div>
            </a>
        </div>


        <!-- Total Users Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('users.index') }}" class="card border-left-success shadow h-100 py-1 text-decoration-none">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Users</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $users }}</div>
                        </div>
                        <div class="col-auto">
                            {{-- <i class="fas fa-users fa-2x text-gray-300"></i> --}}
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Total Posts Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ url('/posts') }}" class="card border-left-warning shadow h-100 py-1 text-decoration-none">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total Posts</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><i class="fas fa-blog mr-3"></i>1</div>
                        </div>
                        <div class="col-auto">
                            {{-- <i class="fas fa-book fa-2x text-gray-300"></i> --}}
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
