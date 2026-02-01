<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class SupportTicketController extends Controller
{
    public function anonForm(string $company_id): View
    {
        return view('pages.app.ticket.anon-form', ['company_id' => $company_id]);
    }

    public function trackForm(?string $uuid = null): View
    {
        return view('pages.app.ticket.track-form', ['uuid' => $uuid]);
    }
}
