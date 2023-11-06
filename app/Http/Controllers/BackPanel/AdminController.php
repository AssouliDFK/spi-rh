<?php

namespace App\Http\Controllers\BackPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\Mail\TestMail; 
use DB ;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
   public function dashboard(){
      $employees = User::where('role','employe')->get();
      $companies = Company::all();
      return view('admin.dashboard', compact('employees', 'companies'));
   }
   public function create(){
      return view('admin.create');
   }

   public function storeAdmin(Request $request)
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
         'role' => 'admin', // Set the role to 'admin'
      ]);
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
     $name = $request->input('name');
     $email = $request->input('email');
     $password = $request->input('password');
     $status = $request->input('status');
 
     $user = User::createUserEmployee($name, $email, $password, $status);
 
      $userEmployee = User::where('email', $email)->first();
      $subject ='Invitation to join our Comapny Tersea ' ;
      $body = 'This is a test that invite you to join the application mail : '.$email.' password :'.$request->input('password') ;

      Mail::to($email)->send(new TestMail($subject,$body));
      $userEmployee->sendEmailVerificationNotification();
 
      
      return view('admin.dashboard');

   }
   public function createEmploye(){
      return view('admin.createEmploye');
   }
   // Action est la methodes qui relance la partie recherche employee par non ou email 
   public function action(Request $request){
      if($request->ajax()){
         $query = $request->get('query');
         $output = '';
            if($query != ''){
               $data = User::dataSearch($request);
            }
            
            else{
               $data = User::where('role','employe')->get();
            }
            $total_row = $data->count();
            if($total_row > 0){

                   
                     $jsonData = [];
                     foreach ($data as $row) {
                        if ($row->company) {
                              $companyName = $row->company->name;
                        } else {
                              $companyName = "No Company";
                        }
                        $jsonData[] = [
                              'name' => $row->name,
                              'email' => $row->email,
                              'companyName' => $companyName,
                              'details_url' => route("employee.showDetails", ["id" => $row->id]),
                        ];
                     }

                     //  tableau en JSON
                     $jsonResponse = json_encode($jsonData);

                     // envoyer la réponse JSON
                     return response()->json($jsonResponse);
            }
            else{
            echo json_encode($data);
            }
      }
   }

}
