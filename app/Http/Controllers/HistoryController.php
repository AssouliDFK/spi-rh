<?php

namespace App\Http\Controllers;

use App\Models\History;

class HistoryController extends Controller
{
    public function index()
    {
        $history = History::orderBy('created_at', 'desc')->get(); // Fetch all history records

        return view('history.index', compact('history'));
    }

    public static function logInvitationHistory($emailSender, $emailRecipient, $statusInvitation)
    {
        History::create([
            'email_sender' => $emailSender,
            'email_recipient' => $emailRecipient,
            'status_invitation' => $statusInvitation,
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
