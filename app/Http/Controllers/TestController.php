<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use Mail;

class TestController extends Controller
{
    public function index()
    {
        $subject = 'Invitation to join our Comapny Tersea';
        $body = 'This is a test that invite you to join the application LINK to Validate your Account : __Link ___';

        Mail::to('youssef.assouli.23@gmail.com')->send(new TestMail($subject, $body));
    }
}
