<?php

namespace App\Http\Controllers;
use App\Mail\ExampleEmail;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function email()
    {
        Mail::to('pnhrdstanley@gmail.com')->send(new ExampleEmail());
        return view('welcome');
    }
}
