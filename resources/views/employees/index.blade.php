@extends('layouts.app')

@section('content')

<div class="bg-white p-6 rounded shadow">

    <div class="flex justify-between mb-4">
        <h2 class="text-xl font-bold">Employees</h2>

        <a href="{{ route('employees.create') }}"
           class="bg-blue-500 text-white px-4 py-2 rounded">
           + Add Employee
        </a>
    </div>

    <div class="flex gap-4 mb-4">
        
        <select id="companyFilter" class="p-2 border rounded">
            <option value="">All Companies</option>
            @foreach($employees->pluck('company.name')->unique() as $company)
                <option value="{{ $company }}">{{ $company }}</option>
            @endforeach
        </select>

        <select id="positionFilter" class="p-2 border rounded">
            <option value="">All Positions</option>
            @foreach($employees->pluck('position')->unique() as $position)
                <option value="{{ $position }}">{{ $position }}</option>
            @endforeach
        </select>

    </div>

    <table id="employeeTable" class="w-full border">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2">Name</th>
                <th class="p-2">Email</th>
                <th class="p-2">Company</th>
                <th class="p-2">Manager</th>
                <th class="p-2">Position</th>
                <th class="p-2">Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($employees as $emp)
            <tr class="border-t">
                <td class="p-2">{{ $emp->name }}</td>
                <td class="p-2">{{ $emp->email }}</td>
                <td class="p-2">{{ $emp->company->name }}</td>
                <td class="p-2">{{ $emp->manager->name ?? 'N/A' }}</td>
                <td class="p-2">{{ $emp->position }}</td>

                <td class="p-2 flex gap-2">
                    <a href="{{ route('employees.edit', $emp->id) }}"
                       class="bg-yellow-400 px-3 py-1 rounded">
                       Edit
                    </a>

                    <form method="POST" action="{{ route('employees.destroy', $emp->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-500 text-white px-3 py-1 rounded">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection


@section('scripts')

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function () {

    let table = $('#employeeTable').DataTable({
        pageLength: 5,
        lengthMenu: [[5, 10, 25, 50], [5, 10, 25, 50]]
    });

    $('#companyFilter').on('change', function () {
        table.column(2).search(this.value).draw();
    });

    $('#positionFilter').on('change', function () {
        table.column(4).search(this.value).draw();
    });

});
</script>

@endsection