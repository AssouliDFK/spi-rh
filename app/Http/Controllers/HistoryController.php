<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Company;

class HistoryController extends Controller
{
    public function index()
    {
        $history = History::orderBy('created_at', 'desc')->get(); // Fetch all history records

        return view('history.index', compact('history'));
    }

    public static function logInvitationHistory($emailSender, $emailRecipient, $statusInvitation, $companyid=Null)
    {
        $company = Company::where('id', $companyid)->first(); // Replace 'Company' with your actual model name
        $companyName = $company ? $company->name : null;
        History::create([
            'email_sender' => $emailSender,
            'email_recipient' => $emailRecipient,
            'status_invitation' => $statusInvitation,
            'company_id' => $companyName,
        ]);

    }

    public static function validateInvitationHistory($emailRecipient, $statusInvitation)
    {
        History::create([
            'email_recipient' => $emailRecipient,
            'status_invitation' => $statusInvitation,
        ]);

    }
}
