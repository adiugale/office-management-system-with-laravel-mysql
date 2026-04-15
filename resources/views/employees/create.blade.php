@extends('layouts.app')

@section('content')

<div class="bg-white p-6 rounded shadow max-w-lg">

    <h2 class="text-xl font-bold mb-4">Add Employee</h2>

    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-2 mb-3 rounded">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('employees.store') }}">
        @csrf

        <input type="text" name="name" placeholder="Name"
               class="w-full mb-3 p-2 border rounded">

        <input type="email" name="email" placeholder="Email"
               class="w-full mb-3 p-2 border rounded">

        <select name="company_id" class="w-full mb-3 p-2 border rounded">
            @foreach($companies as $company)
                <option value="{{ $company->id }}">{{ $company->name }}</option>
            @endforeach
        </select>

        <select name="manager_id" class="w-full mb-3 p-2 border rounded">
            <option value="">No Manager</option>
            @foreach($employees as $emp)
                <option value="{{ $emp->id }}">{{ $emp->name }}</option>
            @endforeach
        </select>

        <input type="text" name="position" placeholder="Position"
               class="w-full mb-3 p-2 border rounded">

        <select id="country" name="country" class="w-full mb-3 p-2 border rounded">
            <option value="">Select Country</option>
        </select>

        <select id="state" name="state" class="w-full mb-3 p-2 border rounded">
            <option value="">Select State</option>
        </select>

        <select id="city" name="city" class="w-full mb-3 p-2 border rounded">
            <option value="">Select City</option>
        </select>

        <button class="bg-blue-500 text-white px-4 py-2 rounded">
            Save
        </button>
    </form>

</div>

@endsection


@section('scripts')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {

    $.get('https://countriesnow.space/api/v0.1/countries', function (data) {
        data.data.forEach(function (country) {
            $('#country').append(`<option value="${country.country}">${country.country}</option>`);
        });
    });

    $('#country').change(function () {
        let country = $(this).val();

        $('#state').html('<option>Select State</option>');
        $('#city').html('<option>Select City</option>');

        $.ajax({
            url: 'https://countriesnow.space/api/v0.1/countries/states',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ country: country }),
            success: function (res) {
                res.data.states.forEach(function (state) {
                    $('#state').append(`<option value="${state.name}">${state.name}</option>`);
                });
            }
        });
    });

    $('#state').change(function () {
        let country = $('#country').val();
        let state = $(this).val();

        $('#city').html('<option>Select City</option>');

        $.ajax({
            url: 'https://countriesnow.space/api/v0.1/countries/state/cities',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ country: country, state: state }),
            success: function (res) {
                res.data.forEach(function (city) {
                    $('#city').append(`<option value="${city}">${city}</option>`);
                });
            }
        });
    });

});
</script>

@endsection