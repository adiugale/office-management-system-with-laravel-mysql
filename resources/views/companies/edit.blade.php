@extends('layouts.app')

@section('content')

<div class="bg-white p-6 rounded shadow max-w-lg">

    <h2 class="text-xl font-bold mb-4">Edit Company</h2>

    <form method="POST" action="{{ route('companies.update', $company->id) }}">
        @csrf
        @method('PUT')

        <input type="text" name="name"
               value="{{ $company->name }}"
               class="w-full mb-3 p-2 border rounded">

        <input type="text" name="location"
               value="{{ $company->location }}"
               class="w-full mb-3 p-2 border rounded">

        <button class="bg-blue-500 text-white px-4 py-2 rounded">
            Update
        </button>
    </form>

</div>

@endsection