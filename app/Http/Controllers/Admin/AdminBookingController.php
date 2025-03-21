<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BookingModel;
use Yajra\DataTables\Facades\DataTables;
use App\Mail\BookingConfirmationMail;
use Illuminate\Support\Facades\Mail;

class AdminBookingController extends Controller
{

    public function BookingScript(Request $request)
    {
        if ($request->ajax()) {
            // You were using $about, but trying to pass $data.
            $data = BookingModel::select([
                'booking_id',
                'name',
                'email',
                'check_in',
                'check_out',
                'person',
                'room',
                'message'
            ])->latest();
    
            return DataTables::of($data)
            ->addColumn('action', function ($row) {
                $delete = route('booking-delete', ['booking_id' => $row->booking_id]);
                $sendMail = route('booking-send-mail', ['booking_id' => $row->booking_id]);
            
                return '
                    <a href="' . $sendMail . '" class="btn btn-success mt-2">Send Mail</a>
                    <form id="delete-form-' . $row->booking_id . '" action="' . $delete . '" method="POST" style="display:inline;">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="button" class="delete-button btn btn-danger mt-2" onclick="confirmDelete(' . $row->booking_id . ')">Delete</button>
                    </form>
                ';
            })
            
                ->rawColumns(['action'])
                ->make(true);
        }
    
        return view('admin.booking.booking');
    }
    

    public function Booking()
    {
        return view('admin/booking/booking');
    }

    

    public function Store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'check_in' => 'required',
            'check_out' => 'required',
            'person' => 'required',
            'room' => 'required',
            'message' => 'required',
        ]);
    
        BookingModel::create($request->all());
    
        return redirect()->back()->with('success', 'Your booking has been submitted successfully!');
    }
    

    public function sendMail($booking_id)
    {
        $booking = BookingModel::findOrFail($booking_id);
    
        Mail::to($booking->email)->send(new BookingConfirmationMail($booking));
    
        return redirect()->back()->with('success', 'Mail has been sent to ' . $booking->email);
    }
    


    public function Delete($booking_id)
    {
        BookingModel::findOrFail($booking_id)->delete();
        return redirect()->route('booking')->with('success', 'You have successfully deleted the entry.');
    }
}
