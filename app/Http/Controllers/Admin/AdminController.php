<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\GmailModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf; // For PDF generation
use Illuminate\Support\Facades\Log;
use App\Mail\UserNotification;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    // Show the login page
    public function login()
    {
        return view('/login');
    }

    // Show the registration page
    public function registration()
    {
        return view('/registration');
    }

    // Handle user registration
    // public function registerUser(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email',
    //         'course' => 'required|string|max:255',
    //         'password' => 'required|string|min:5|max:12',
    //     ]);

    //     // Check if the email is already registered
    //     $existingUser = UserModel::where('email', $request->email)->first();

    //     if ($existingUser) {
    //         return back()->with('fail', 'This email is already registered. Please login.');
    //     }

    //     // Create a new user instance
    //     $user = new UserModel();
    //     $user->name = $request->name;
    //     $user->email = $request->email;
    //     $user->course = $request->course;
    //     $user->password = Hash::make($request->password);

    //     if ($user->save()) {
    //         return back()->with('success', 'User registered successfully. Please login.');
    //     } else {
    //         return back()->with('error', 'Failed to register user');
    //     }
        
    // }

    public function registerUser(Request $request)
{
    // Validate the request data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'course' => 'required|string|max:255',
        'password' => 'required|string|min:5|max:12',
    ]);

    // Check if the email is already registered
    $existingUser = UserModel::where('email', $request->email)->first();

    if ($existingUser) {
        return back()->with('fail', 'This email is already registered. Please login.');
    }

    // Create a new user instance
    $user = new UserModel();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->course = $request->course;
    $user->password = Hash::make($request->password);

    // Save the user to the database
    if ($user->save()) {
        // Redirect to login page with success message
        return redirect('login')->with('success', 'User registered successfully. Please login.');
    } else {
        // Redirect back with error message if registration fails
        return back()->with('fail', 'Failed to register user.');
    }
}



    // Handle user login
    public function loginUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:5|max:12',
        ]);

        $user = UserModel::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $request->session()->put('loginId', $user->id);
            return view('admin/Dashboard/dashboard', compact('user'));
        }

        return back()->with('fail', 'This email is not registered or password is incorrect.');
    }

    public function dashboard()
    {
        // Fetch all users from the database
        $users = UserModel::all();

        return view('admin/Dashboard/dashboard', compact('users'));
    }

    public function logout()
    {
        if (Session::has('loginId')) {
            Session::flush();
        }
        return redirect('login')->with('success', 'Logged out successfully');
    }

    public function deleteUser($id)
    {
        $user = UserModel::find($id);

        if ($user) {
            $user->delete();
            return back()->with('success', 'User deleted successfully');
        } else {
            return back()->with('fail', 'User not found');
        }
    }

    // public function mail(Request $request, $id)
    // {
    //     // Find the user by ID
    //     $user = UserModel::find($id);

    //     if (!$user) {
    //         return back()->with('fail', 'User not found.');
    //     }

    //     // Fetch the certificate associated with the user
    //     $certificate = CertificateModel::where('user_id', $id)->first();

    //     if (!$certificate) {
    //         return back()->with('fail', 'No certificate found for this user.');
    //     }

    //     // Generate the PDF for the certificate
    //     $pdf = FacadePdf::loadView('admin.certify', compact('certificate')); // Generate the PDF

    //     // Store the PDF temporarily
    //     $pdfPath = storage_path('app/public/certificate-' . $user->id . '.pdf');
    //     $pdf->save($pdfPath); // Save the PDF to storage

    //     try {
    //         // Send the email with the certificate PDF attached
    //         Mail::to($user->email)->send(new CertificateMail($certificate, $pdfPath));

    //         // Optionally, delete the PDF after sending
           

    //         return redirect()->back()->with('success', 'Email sent successfully!');
    //     } catch (\Exception $e) {
    //         return back()->with('error', 'Error sending email: ' . $e->getMessage());
    //     }
    // }



    // public function mail(Request $request, $certificate_id)
    // {
        
    //     $data = CertificateModel::where('certificate_id', $certificate_id)->first();
    
    //     if (!$data) {
    //         return back()->with('fail', 'No certificate found for this user.');
    //     }
    
    //     $pdf = FacadePdf::loadView('admin.certificate_pdf', compact('data'));
    //     $pdfPath = public_path('certificate-' . $data->certificate_id . '.pdf');
    //     $pdf->save($pdfPath);
    
    //     try {
    //         Mail::to($data->email)->send(new CertificateMail($data, $pdfPath));
    //       // Delete the PDF after sending
    //         return redirect()->back()->with('success', 'Email sent successfully!');
    //     } catch (\Exception $e) {
    //         Log::error('Email Sending Error: ' . $e->getMessage());
    //         return back()->with('error', 'Error sending email: ' . $e->getMessage());
    //     }
    // }
    

//     public function certify($certificate_id = null)
// {
//     if (!$certificate_id) {
//         return back()->with('fail', 'Certificate ID is required.');
//     }

//     $data = CertificateModel::find($certificate_id);

//     if (!$data) {
//         return back()->with('fail', 'Certificate not found.');
//     }

//     return view('admin.certify', compact('data'));
// }

    

    public function email()
    {
        $users = UserModel::all();
        return view('admin.email.email', compact('users'));
    }


    
    // public function sendEmail(Request $request, $gmail_id)
    // {
    //     // Fetch the Gmail user from the database
    //     $gmailUser = GmailModel::find($gmail_id);
    
    //     if (!$gmailUser) {
    //         return redirect()->back()->with('error', 'User not found!');
    //     }
    
    //     // Prepare the email details
    //     $details = [
    //         'subject' => 'Welcome to Our Service',
    //         'title' => 'Hello, ' . $gmailUser->name . '!',
    //         'body' => 'Thank you for signing up for our platform. We are excited to have you!'
    //     ];
    
    //     // Send the email using the Mailable class or directly using the Mail facade
    //     Mail::to($gmailUser->email)->send(new UserNotification($details));
    
    //     // Redirect back to the dashboard with a success message
    //     return redirect()->route('gmail-dashboard')->with('success', 'Email sent successfully to ' . $gmailUser->name);
    // }
    


    // Add this method to your AdminController
    // public function generatePDF($certificate_id)
    // {
    //     $data = CertificateModel::findOrFail($certificate_id); // Retrieve a single certificate by ID
    //     $pdf = FacadePdf::loadView('admin.certificate_pdf', compact('data'));
    //     return $pdf->download('certificate.pdf');
    // }
    

   
// public function generatePDF($certificate_id)
// {
//     try {
//         set_time_limit(300); // Increase the maximum execution time to 300 seconds
//         $data = CertificateModel::findOrFail($certificate_id); // Retrieve a single certificate by ID
//         $pdf = FacadePdf::loadView('admin.certificate_pdf', compact('data'));
//         // Test PDF generation without downloading
//         // return $pdf->stream('certificate.pdf');
//         return $pdf->download('certificate.pdf');
//     } catch (\Exception $e) {
//         Log::error('PDF generation failed: ' . $e->getMessage());
//         return response()->json(['success' => false, 'message' => 'PDF generation failed.']);
//     }
// }

}



