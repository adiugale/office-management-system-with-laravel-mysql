@extends('layouts.app')

@section('content')

<div class="bg-white p-6 rounded shadow max-w-lg">

    <h2 class="text-xl font-bold mb-4">Edit Employee</h2>

    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-2 mb-3 rounded">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('employees.update', $employee->id) }}">
        @csrf
        @method('PUT')

        <input type="text" name="name" value="{{ $employee->name }}"
               class="w-full mb-3 p-2 border rounded">

        <input type="email" name="email" value="{{ $employee->email }}"
               class="w-full mb-3 p-2 border rounded">

        <select name="company_id" class="w-full mb-3 p-2 border rounded">
            @foreach($companies as $company)
                <option value="{{ $company->id }}"
                    {{ $employee->company_id == $company->id ? 'selected' : '' }}>
                    {{ $company->name }}
                </option>
            @endforeach
        </select>

        <select name="manager_id" class="w-full mb-3 p-2 border rounded">
            <option value="">No Manager</option>
            @foreach($employees as $emp)
                <option value="{{ $emp->id }}"
                    {{ $employee->manager_id == $emp->id ? 'selected' : '' }}>
                    {{ $emp->name }}
                </option>
            @endforeach
        </select>

        <input type="text" name="position" value="{{ $employee->position }}"
               class="w-full mb-3 p-2 border rounded">


        <select id="country" name="country" class="w-full mb-3 p-2 border rounded"></select>
        <select id="state" name="state" class="w-full mb-3 p-2 border rounded"></select>
        <select id="city" name="city" class="w-full mb-3 p-2 border rounded"></select>

        <button class="bg-blue-500 text-white px-4 py-2 rounded">
            Update
        </button>
    </form>

</div>

@endsection


@section('scripts')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {

    let selectedCountry = "{{ $employee->country }}";
    let selectedState = "{{ $employee->state }}";
    let selectedCity = "{{ $employee->city }}";

    $.get('https://countriesnow.space/api/v0.1/countries', function (data) {
        data.data.forEach(function (country) {
            let selected = country.country === selectedCountry ? 'selected' : '';
            $('#country').append(`<option value="${country.country}" ${selected}>${country.country}</option>`);
        });

        $('#country').trigger('change');
    });

    $('#country').change(function () {
        let country = $(this).val();

        $('#state').html('<option>Select State</option>');

        $.ajax({
            url: 'https://countriesnow.space/api/v0.1/countries/states',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ country: country }),
            success: function (res) {

                res.data.states.forEach(function (state) {
                    let selected = state.name === selectedState ? 'selected' : '';
                    $('#state').append(`<option value="${state.name}" ${selected}>${state.name}</option>`);
                });

                $('#state').trigger('change');
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
                    let selected = city === selectedCity ? 'selected' : '';
                    $('#city').append(`<option value="${city}" ${selected}>${city}</option>`);
                });
            }
        });
    });

});
</script>

@endsection