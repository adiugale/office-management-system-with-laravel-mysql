<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'nullable'
        ]);

        Company::create($request->all());

        return redirect()->route('companies.index');
    }

    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'location' => 'nullable'
        ]);

        $company->update($request->all());

        return redirect()->route('companies.index');
    }

    public function destroy($id)
    {
        Company::destroy($id);
        return redirect()->route('companies.index');
    }
}