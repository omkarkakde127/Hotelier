<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\BookingModel; // Ensure you have a Booking model

class PDFController extends Controller
{
    public function generatePDF($bookingId)
    {
        // Fetch the booking from the database
        $booking = BookingModel::find($bookingId);

        // Check if booking exists
        if (!$booking) {
            return abort(404, 'Booking not found.');
        }

        // Load the Blade view and pass the booking data
        $pdf = Pdf::loadView('admin.receipt', ['booking' => $booking]);

        // Return the PDF for download
        return $pdf->download('booking_receipt.pdf');
    }
}
