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

    public static function createUserEmployee($name, $email, $password, $status)
    {
        return self::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'employe', // Assuming you want a default role
            'status' => $status,
        ]);
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'id_company', 'id');
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
