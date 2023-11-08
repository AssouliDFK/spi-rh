<?php

namespace App\Http\Controllers\BackPanel;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    public function dashboard()
    {
        $currentUser = auth()->user();

        if (isset($currentUser->company_id)) {
            $currentUserCompany = $currentUser->with('company');
        } else {
        }

        $companies = Company::orderBy('name', 'asc')->paginate(5);
        $employeesInSameCompany = User::where('company_id', $currentUser->company_id)->get();

        return view('employe.dashboard', compact('companies', 'employeesInSameCompany'));
    }

    public function assignCompany(Request $request, User $employee)
    {
        $employee->company_id = $request->input('company_id');
        $employee->save();

        return redirect()->back()->with('success', 'Company assigned successfully');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => 'employe',
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Administrator created successfully');
    }

    public function show($id)
    {
        $employee = User::with('company')->find($id);

        if ($employee->company) {
            $companyName = $employee->company->name;
        } else {
            // Handle the case where the user doesn't belong to a company
            $companyName = 'No Company';
        }
        $companies = Company::all();
        $company = Company::find($employee->company_id);
        if (! $employee) {
            // Handle the case where the employee with the given ID is not found, e.g., show an error message.
        }

        return view('employe.show', compact('employee', 'companies', 'companyName'));
    }

    // Delete an employee
    public function delete($id)
    {
        $employee = User::find($id);
        if ($employee) {
            $employee->delete();

            return view('admin.dashboard')->with('success', 'Employee deleted successfully.');
        } else {
            return view('admin.dashboard')->with('error', 'Employee not found.');
        }
    }
    // deactivate pending if not activated yet
    public function cancel($id)
    {
        $employee = User::find($id);
        if ($employee && $employee->status === 'pending') {
            $employee->status = "inactive"; // Update the status as needed
            $employee->password = "changingPassword";
            $employee->save();
            return view('admin.dashboard')->with('success', 'Invitation Employee Canceled.');
        } else {
            return view('admin.dashboard')->with('error', 'Employee not found.');
        }
    }
}
