<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    // Show the form for creating a new company.
    public function create()
    {
        return view('companies.create');
    }

    // Store a newly created company in the database.
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $company = Company::create([
            'name' => $request->input('name'),
        ]);

        return view('companies.create');
    }

    // Display a listing of companies.
    public function index()
    {
        $companies = Company::all();
        $companies_users = Company::with('users')->get();

        return view('companies.index', compact('companies', 'companies_users'));
    }

    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $company->update([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('companies.index')->with('success', 'Company updated successfully.');
    }

    public function destroy(Company $company)
    {
        if ($company->users->isEmpty()) {
            // If there are no associated users, delete the company
            $company->delete();

            return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');
        } else {
            // If there are associated users, return with a message
            return redirect()->route('companies.index')->with('error', 'Cannot delete company with associated users.');
        }
    }
}
