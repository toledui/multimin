<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Vendor;
use Illuminate\View\View;
use App\Models\Distribuitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tickets = Ticket::with(['distribuitor', 'vendor2'])
        ->where('user_id', Auth::id())
        ->paginate(10);
        $granTotal = 0;
        foreach ($tickets as $ticket) {
            $granTotal = $granTotal + floatval($ticket->total_amount);
        }
        return view('dashboard', compact('tickets', 'granTotal'));
    }




}
