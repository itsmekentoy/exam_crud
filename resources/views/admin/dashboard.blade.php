@extends('layouts.app')

@section('navbar')

@endsection

@section('content')
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Ascendens Asia') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                       data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="">Change Password</a></li>
                        <li>
                            <a class="dropdown-item" href=""
                               onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                Sign Out
                            </a>
                            <form id="logout-form" action="" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
              
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-4">
    <h1 class="mb-4">Dashboard</h1>

    <div class="row g-4 mb-5">
        {{-- Total Users --}}
        <div class="col-md-4">
            <div class="card text-bg-primary p-1">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="display-4">{{ $totalUsers ?? 0 }}</p>
                </div>
            </div>
        </div>

        {{-- Active Accounts --}}
        <div class="col-md-4">
            <div class="card text-bg-success p-1">
                <div class="card-body">
                    <h5 class="card-title">Active Accounts</h5>
                    <p class="display-4">{{ $activeUsers ?? 0 }}</p>
                </div>
            </div>
        </div>

        {{-- Deactivated Accounts --}}
        <div class="col-md-4">
            <div class="card text-bg-danger p-1">
                <div class="card-body">
                    <h5 class="card-title">Deactivated Accounts</h5>
                    <p class="display-4">{{ $deactiveUsers ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Users Table --}}
    <div class="card shadow-sm">
        <div class="card-header">
            <h4>User List
                <button class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#AddModal">
                    Add Employee
                </button>
            </h4>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Registered At</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal --}}
    @include('admin.modal')
</div>
@endsection
