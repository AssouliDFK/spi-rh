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

    public static function logInvitationHistory($emailSender, $emailRecipient, $statusInvitation, $companyName = null)
    {
        $company = Company::where('id', $companyName)->first(); // Replace 'Company' with your actual model name
        // Controller code
        $companyName = $company ? $company->name : null;

        if ($statusInvitation === "addAdmin") {
            return History::createHistoryRecord($emailSender, $emailRecipient, $statusInvitation, "Tersea");
        } else {
            return History::createHistoryRecord($emailSender, $emailRecipient, $statusInvitation, $companyName);
        }
    }

    public static function validateInvitationHistory($emailRecipient, $statusInvitation)
    {
        // Controller code or wherever this function is called
        return History::validateInvitationHistory($emailRecipient, $statusInvitation);
    }
}

