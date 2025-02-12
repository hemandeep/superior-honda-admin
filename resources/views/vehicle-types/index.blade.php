@extends('layouts.app')

@section('content')
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">

                    <div class="row">
                        <div class="col-sm-12">
                            @if (session('success'))
                                <x-alert message="{{ session('success') }}"></x-alert>
                            @endif
                            <div class="card">
                                <div class="card-header">
                                    <h5>Vehicle Types</h5>
                                    @can('create vehicle configuration')
                                        <div class="float-right">
                                            <a href="{{ route('vehicle-types.create') }}" class="btn btn-primary btn-md">Add
                                                Vehicle Type</a>
                                        </div>
                                    @endcan
                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="vehicle-types-list" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Category</th>
                                                    <th>Vehicle Type</th>
                                                    @canany(['edit vehicle configuration', 'delete vehicle configuration'])
                                                        <th>Actions</th>
                                                    @endcanany
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($vehicle_types as $key => $vehicle_type)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $vehicle_type->category->name }}</td>
                                                        <td>{{ $vehicle_type->vehicle_type }}</td>
                                                        @canany([
                                                            'edit vehicle configuration',
                                                            'delete vehicle
                                                            configuration',
                                                            ])
                                                            <td>
                                                                <div class="btn-group btn-group-sm">
                                                                    @can('edit vehicle configuration')
                                                                        <a href="{{ route('vehicle-types.edit', $vehicle_type->id) }}"
                                                                            class="btn btn-primary waves-effect waves-light mr-2">
                                                                            <i class="feather icon-edit m-0"></i>
                                                                        </a>
                                                                    @endcan

                                                                    @can('delete vehicle configuration')
                                                                        <button data-source="vehicle type"
                                                                            data-endpoint="{{ route('vehicle-types.destroy', $vehicle_type->id) }}"
                                                                            class="delete-btn btn btn-danger waves-effect waves-light">
                                                                            <i class="feather icon-trash m-0"></i>
                                                                        </button>
                                                                    @endcan
                                                                </div>
                                                            </td>
                                                        @endcanany
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <x-include-plugins dataTable></x-include-plugins>

    <script>
        $(function() {
            $('#vehicle-types-list').DataTable();
        })
    </script>
@endsection