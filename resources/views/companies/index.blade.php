@extends('layouts.app')

@section('content')

<div class="bg-white p-6 rounded shadow">

    <div class="flex justify-between mb-4">
        <h2 class="text-xl font-bold">Companies</h2>

        <a href="{{ route('companies.create') }}"
           class="bg-blue-500 text-white px-4 py-2 rounded">
           + Add Company
        </a>
    </div>

    <table class="w-full border border-gray-300">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-3 text-left">Name</th>
                <th class="p-3 text-left">Location</th>
                <th class="p-3 text-left">Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($companies as $company)
            <tr class="border-t hover:bg-gray-100">
                <td class="p-3">{{ $company->name }}</td>
                <td class="p-3">{{ $company->location }}</td>

                <!-- FIXED PART -->
                <td class="p-3">
                    <div class="flex gap-2">
                        <a href="{{ route('companies.edit', $company->id) }}"
                           class="bg-yellow-400 px-3 py-1 rounded">
                           Edit
                        </a>

                        <form method="POST" action="{{ route('companies.destroy', $company->id) }}">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 text-white px-3 py-1 rounded">
                                Delete
                            </button>
                        </form>
                    </div>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection