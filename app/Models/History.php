<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $fillable = ['email_sender', 'email_recipient', 'status_invitation','company_id'];

    protected $table = 'history';
}
