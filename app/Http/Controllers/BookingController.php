<?php

namespace App\Http\Controllers;

use App\Models\BookingModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    //

public function viewReceipt($bookingId)
{
    // Fetch the booking details from the database using the provided bookingId
    $booking = BookingModel::findOrFail($bookingId);

    // Pass the data to the receipt view
    return view('receipt', [
        'source' => $booking->source,
        'destination' => $booking->destination,
        'date' => $booking->journey_date,
        'seats' => $booking->seats,
        'name' => $booking->name,
        'passenger_id' => $booking->passenger_id,
        'gender' => $booking->gender,
        'age' => $booking->age,
        'contact' => $booking->contact,
        'card_number' => $booking->card_number,
        'expiry_date' => $booking->expiry_date,
        'cvv' => $booking->cvv,
        'amount' => $booking->amount,
    ]);
}

public function downloadPDF($bookingId)
{
    $booking = BookingModel::findOrFail($bookingId);

    $pdf = PDF::loadView('receipt', compact('booking'));

    return $pdf->download('receipt_' . $booking->id . '.pdf');
}

public function confirmBooking(Request $request)
{
    // Validate the request data
    $validatedData = $request->validate([
        'source' => 'required|string',
        'destination' => 'required|string',
        'journey_date' => 'required|date',
        'seats' => 'required|integer',
        'name' => 'required|string',
        'passenger_id' => 'required|string',
        'gender' => 'required|string',
        'age' => 'required|integer',
        'contact' => 'required|string',
        'card_number' => 'required|string',
        'expiry_date' => 'required|string',
        'cvv' => 'required|string',
        'amount' => 'required|numeric',
    ]);

    // Create the new booking record
    $booking = BookingModel::create($validatedData);

    // Redirect or return to the view with the booking details
    return redirect()->route('viewReceipt', ['bookingId' => $booking->id]);
}


public function showReceipt()
{
    return view('admin.receipt.receipt'); // Ensure this file exists in resources/views/admin/receipt/receipt.blade.php
}


}
