<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
        'company_id' 
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function createUserEmployee($name, $email, $password, $status,$company_id)
    {
        // Validate input data
        // You can add more specific validation rules as needed
        if (empty($name) || empty($email) || empty($password) || empty($company_id)) {
            throw new \InvalidArgumentException('Invalid input data');
        }

        $role = 'employe';

        // Create a new user
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => $role,
            'status' => $status,
            'company_id' => $company_id,
        ]);
    
        if ($user) {
            // Send the email verification notification
            $user->sendEmailVerificationNotification();
    
            // You can also return a success message or response here
            return 'User created successfully';
        } else {
            // Handle the case where user creation fails
            return 'User creation failed';
        }
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public static function dataSearch($request)
    {
        return self::where('role', 'employe')
            ->where(function ($query) use ($request) {
                $query->where('email', 'like', '%'.$request->get('query').'%')
                    ->orWhere('name', 'like', '%'.$request->get('query').'%');
            })
            ->with('company')
            ->get();
    }

    public function updateStatusUser($status)
    {
        $this->status = $status;
        $this->save();
    }
}
