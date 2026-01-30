<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupportTicketController extends Controller
{
    public function anonForm($companyId)
    {
        return view('pages.app.ticket.anon-form', ['companyId' => $companyId]);
    }
}
