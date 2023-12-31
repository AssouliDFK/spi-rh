<?php

namespace App\Http\Controllers\BackPanel;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HistoryController;
use App\Mail\TestMail;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Mail;

class AdminController extends Controller
{
    public function dashboard()
    {
        $employees = User::where('role', 'employe')->get();
        $companies = Company::all();

        return view('admin.dashboard', compact('employees', 'companies'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function storeAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);
        $email = $request->input('email');
        $password = $request->input('password');

        $userAdmin = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => 'admin', // Set the role to 'admin'
        ]);
        HistoryController::logInvitationHistory(auth()->user()->name, $request->input('name'), 'addAdmin');
        $userAdmin->sendEmailVerificationNotification();
        $subject = 'Invitation to join our Comapny Tersea ';
        $body = 'Credentials Admin mail :  '.$email.' password :'.  $password;
        Mail::to($email)->send(new TestMail($subject, $body));
        return view('admin.dashboard');

    }
    //employee

    public function storeEmploye(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // dd($request->input('email'));
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $status ="pending";
        $company_id = $request->input('company_id');
        $user = User::createUserEmployee($name, $email, $password, $status, $company_id);
        $userEmployee = User::where('email', $email)->first();
        $company = Company::where('id',$company_id);
        $subject = 'Invitation to join our Comapny Tersea ';
        $body = 'This is a test that invite you to join the application mail : '.$email.' password :'.$request->input('password');

        // $userEmployee->sendEmailVerificationNotification();

        Mail::to($email)->send(new TestMail($subject, $body));
        HistoryController::logInvitationHistory(auth()->user()->name,  $name, 'pending', $company_id);

        return view('dashboard')->with('success', 'Utilisateur ajouté avec succès!');;

    }

    public function createEmploye()
    {   
        $companies = Company::all();
        return view('admin.createEmploye',compact('companies'));
    }

    // Action est la methodes qui relance la partie recherche employee par non ou email
    public function action(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            $output = '';
            if ($query != '') {
                $data = User::dataSearch($request);
            } else {
                $data = User::where('role', 'employe')->get();
            }
            $total_row = $data->count();
            if ($total_row > 0) {

                $jsonData = [];
                foreach ($data as $row) {
                    if ($row->company) {
                        $companyName = $row->company->name;
                    } else {
                        $companyName = 'No Company';
                    }
                    $jsonData[] = [
                        'name' => $row->name,
                        'email' => $row->email,
                        'status' => $row->status,
                        'companyName' => $companyName,
                        'details_url' => route('employee.showDetails', ['id' => $row->id]),
                    ];
                }
                $response = [
                    'total_rows' => $total_row,
                    'data' => $jsonData,
                ];

                return response()->json($response);
            } else {
                $response = [
                    'total_rows' => 0,
                ];

                return response()->json($response);
            }
        }
    }
}
