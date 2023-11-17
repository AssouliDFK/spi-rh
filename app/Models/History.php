<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $fillable = ['name_sender', 'name_recipient', 'status_invitation','company_name'];

    protected $table = 'history';

    public static function createHistoryRecord($nameSender, $nameRecipient, $statusInvitation, $companyName)
    {
        return self::create([
            'name_sender' => $nameSender,
            'name_recipient' => $nameRecipient,
            'status_invitation' => $statusInvitation,
            'company_name' => $companyName,
        ]);
    }

    public static function validateInvitationHistory($nameRecipient, $statusInvitation)
    {
        return self::create([
            'name_recipient' => $nameRecipient,
            'status_invitation' => $statusInvitation,
        ]);
    }
}
