<?php

namespace App\Http\Controllers\BackPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Employee;


class EmployeController extends Controller
{
    public function dashboard(){
        // $companies = Company::all();
        // $companies = Company::all();
        $currentUser = auth()->user();
        $currentEmployee = Employee::where('email',$currentUser->email)->select('belongs_to_company')->first();
      
        if (isset($currentEmployee->belongs_to_company)) {
            // $currentEmployee->belongs_to_company is set and has a value.
            // You can proceed to use it.
            $belongs_to_company = $currentEmployee->belongs_to_company;
    
        } else {
            // $currentEmployee->belongs_to_company is not set or is null.
            // You can handle this situation as needed.
            $belongs_to_company = null;
        }

        $companies = Company::orderBy('name', 'asc')->paginate(5);
        $employeesInSameCompany = Employee::where('belongs_to_company',  $belongs_to_company)->get();
        return view('employe.dashboard', compact('companies','employeesInSameCompany'));
    }


    public function assignCompany(Request $request, Employee $employee)
        {
            $employee->belongs_to_company = $request->input('company_id');
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
            $employee = Employee::find($id); // Replace 'Employee' with your actual model name
            $companies = Company::all();
            $company = Company::find($employee->belongs_to_company);
            if (!$employee) {
                // Handle the case where the employee with the given ID is not found, e.g., show an error message.
            }

            return view('employe.show', compact('employee','companies','company'));
}
    // Delete an employee
    public function delete($id) {
        $employee = Employee::find($id);
        if ($employee) {
            $employee->delete();
            return view('admin.dashboard')->with('success', 'Employee deleted successfully.');
        } else {
            return view('employe.index')->with('error', 'Employee not found.');
        }
    }

        
}
