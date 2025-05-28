@extends('layouts.app')

@section('navbar')

@endsection

@section('content')
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Exam CRUD') }}
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
                       
                        <li>
                            <a class="dropdown-item" href=""
                               onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                Sign Out
                            </a>
                            <form id="logout-form" action="/logout" method="POST" class="d-none">
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
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row g-4 mb-5">
        {{-- Total Users --}}
        <div class="col-md-12">
            <div class="card text-bg-primary p-1">
                <div class="card-body">
                    <h5 class="card-title">GRAND TOTAL</h5>
                    <p class="display-4">₱ {{ number_format($totalSales ?? 0, 2) }}</p>
                </div>
            </div>
        </div>

        
    </div>

    {{-- Users Table --}}
    <div class="card shadow-sm">
        <div class="card-header">
            <h4>Sales Data
                <button class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#AddModal">
                    Add Sales
                </button>
            </h4>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered mb-0">
                <thead class="table-light">
                    <tr>
                
                        <th>Name</th>
                        <th>Date</th>
                        <th>Item A</th>
                        <th>Item B</th>
                        <th>Item C</th>
                        <th>Item D</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($salesData as $index => $data)
                        <tr>
                            
                            <td>{{ $data->salesperson_name }}</td>
                            <td>{{ $data->created_at->format('F j, Y') }}</td>
                            <td>₱ {{ number_format($data->item_a  ?? 0, 2) }}</td>
                            <td>₱ {{ number_format($data->item_b ?? 0, 2) }}</td>
                            <td>₱ {{ number_format($data->item_c ?? 0, 2) }}</td>
                            <td>₱ {{ number_format($data->item_d ?? 0, 2) }}</td>
                            <td>
                                ₱ {{ number_format($data->item_a + $data->item_b + $data->item_c + $data->item_d ?? 0, 2) }}
                               
                            </td>
                            <td>
                                <!-- add button for update modal -->
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#EditModal{{ $data->id }}"
                                        data-bs-target="#UpdateModal{{ $data->id }}">
                                    Update
                                </button>
                                <!-- button with data-id -->
                                <button class="btn btn-danger btn-sm" onclick="deleteSalesData()"
                                        data-id="{{ $data->id }}" data-salesperson="{{ $data->salesperson_name }}">
                                    Delete
                                </button>
                               
                            </td>
                            <div class="modal fade" id="EditModal{{ $data->id }}" tabindex="-1" aria-labelledby="AddModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="AddModalLabel">Update Sales</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('updateSalesData') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $data->id }}">

                                                <div class="form-group">
                                                    <label for="salesperson" class="form-label">Sales Person</label>
                                                    <input type="text" class="form-control" id="salesperson" name="salesperson" value="{{ $data->salesperson_name }}" required>
                                                </div>

                                                <div class="form-group mt-1">
                                                    <label for="itemA" class="form-label">Item A</label>
                                                    <input type="number" class="form-control" id="itemA" name="itemA" value="{{ $data->item_a }}"  required>
                                                </div>

                                                <div class="form-group mt-1">
                                                    <label for="itemB" class="form-label">Item B</label>
                                                    <input type="number" class="form-control" id="itemB" name="itemB" value="{{ $data->item_b }}" required>
                                                </div>

                                                <div class="form-group mt-1">
                                                    <label for="itemC" class="form-label">Item C</label>
                                                    <input type="number" class="form-control" id="itemC" name="itemC" value="{{ $data->item_c }}" required>
                                                </div>

                                                <div class="form-group mt-1">
                                                    <label for="itemD" class="form-label">Item D</label>
                                                    <input type="number" class="form-control" id="itemD" name="itemD" value="{{ $data->item_d }}" required>
                                                </div>
                                            
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save data</button></form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal --}}
    @include('admin.modal')
</div>
<script>
    function deleteSalesData() {
        const button = event.target;
        const salesId = button.getAttribute('data-id');
        const salesperson = button.getAttribute('data-salesperson');

        Swal.fire({
            title: 'Are you sure?',
            text: `You are about to delete sales data for ${salesperson}. This action cannot be undone.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
            // use ajax
                $.ajax({
                    url: `/deleteSalesData/${salesId}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire(
                            'Deleted!',
                            `Sales data for ${salesperson} has been deleted.`,
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Error!',
                            'There was an error deleting the sales data.',
                            'error'
                        );
                    }
                });
            }
        });
    }
    
</script>


@endsection
