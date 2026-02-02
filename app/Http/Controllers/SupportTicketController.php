<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class SupportTicketController extends Controller
{
    public function anonForm(string $company_uuid): View
    {
        return view('pages.app.ticket.anon-form', ['company_uuid' => $company_uuid]);
    }

    public function trackForm(?string $uuid = null): View
    {
        return view('pages.app.ticket.track-form', ['uuid' => $uuid]);
    }
}
