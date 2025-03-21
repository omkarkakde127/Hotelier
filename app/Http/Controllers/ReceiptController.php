<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReceiptController extends Controller
{
    public function showReceipt()
    {
        return view('admin.receipt.receipt'); // Ensure this file exists in resources/views/admin/receipt/receipt.blade.php
    }

    public function downloadPDF()
    {
        // Load a static view to generate the PDF
        $pdf = Pdf::loadView('admin.receipt.receipt-pdf');
        return $pdf->download('booking_receipt.pdf');
    }
}
