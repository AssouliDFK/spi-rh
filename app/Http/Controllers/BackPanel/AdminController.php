<?php

namespace App\Http\Controllers\BackPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\Mail\TestMail; 
use DB ;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class AdminController extends Controller
{
   public function dashboard(){
      $employees = Employee::all();
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
      $employees = Employee::all();
      $companies = Company::all();
      // return redirect()->route('success.page');
      return view('admin.dashboard', compact('employees', 'companies'));

   }
   //employee

   public function storeEmploye(Request $request)
   {

      Employee::create([
         'name' => $request->input('name'),
         'email' => $request->input('email'),
         'password' => Hash::make($request->input('password')),
         'role' =>$request->input('role'), // Set the role to 'admin'
         'belongs_to_company' => $request->input('company_id'), // You can provide a value if needed or leave it null
      ]);
       User::create([
         'name' => $request->input('name'),
         'email' => $request->input('email'),
         'password' => Hash::make($request->input('password')),
         'role' => 'employe', // Set the role to 'admin'
         'status' => 'inactive', // Set the role to 'admin'
      ]);
      $email = $request->input('email') ;
      $userEmployee = User::where('email', $email)->first();
      // dd($userEmployee);
      $subject ='Invitation to join our Comapny Tersea ' ;
      $body = 'This is a test that invite you to join the application mail : '.$request->input('email').' password :'.$request->input('password') ;

      Mail::to($email)->send(new TestMail($subject,$body));
      $userEmployee->sendEmailVerificationNotification();
 
      
      $employees = Employee::all();
      $companies = Company::all();
      return view('admin.dashboard', compact('employees', 'companies'));

   }
   public function createEmploye(){
      return view('admin.createEmploye');
   }
   public function action(Request $request){
      if($request->ajax()){

         $query = $request->get('query');

         $output = '';
            if($query != ''){
               $data =Employee::where('email', 'like', '%' . $query . '%')->orWhere('name','like','%'.$query.'%')->get();
               // validated 
            }
            
            else{
               $data = Employee::all();
            }
            $total_row = $data->count();
            if($total_row > 0){

                     foreach($data as $row){
                        $company = Company::find($row->belongs_to_company);
                        if ($company) {
                           $companyName = $company->name;
                       } else {
                           $companyName = "No Company";
                       }
                        $output .='<tr>
                        <td>'.$row->name.'</td>
                        <td>'.$row->email.'</td>
                        <td> '.$companyName.' </td>
                        <td>
                           <a href="' . route("employee.showDetails", ["id" => $row->id]) . '" class="btn btn-sm btn-primary">
                                 View More Details
                           </a>
                        </td>
                     
                           </tr>';
                     }
            }
            else{
               $output='<tr>
                     <td> No Data </td>
                     <td > No Data </td>
                     <td> No Data </td>
                     <td>
                         <a class="btn btn-sm btn-disabled">
                             No Details
                         </a>
                     </td>
                  </tr>';
            }
            $data = array(
               'table_data' => $output,
               'total_data' => $total_row,
            );
            echo json_encode($data);
      }
   }

}
