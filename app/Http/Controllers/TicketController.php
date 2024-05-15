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

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $distribuitors = Distribuitor::all();
        $vendors = Vendor::all();
        return view('auth.ticket.create', compact('distribuitors', 'vendors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ticket_number' => 'required',
            'distribuitor_id' => 'required|exists:distribuitors,id',
            'vendor_id' => 'required|exists:vendors,id',
            'product_name' => 'required|string',
            'quantity' => 'required|numeric',
            'total_amount' => 'required|numeric'
        ]);

        $ticket = new Ticket([
            'ticket_number' => $request->ticket_number,
            'distribuitor_id' => $request->distribuitor_id,
            'vendor_id' => $request->vendor_id,
            'product_name' => $request->product_name,
            'quantity' => $request->quantity,
            'total_amount' => $request->total_amount,
            'user_id' => auth()->id() // Linking to the logged-in user
        ]);

        $ticket->save();

        return redirect()->route('dashboard')->with('success', 'Ticket Registrado Correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
