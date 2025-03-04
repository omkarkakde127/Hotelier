<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Our_ServicesModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;
// use App\Models\items;
use App\Models\items;

class AdminServicesController extends Controller
{
    
    public function ServicesScript(Request $request)
    {
        if ($request->ajax()) {
            $data = Our_ServicesModel::select(['our_services_id', 'title', 'description',  'image'])->latest()->get();
            
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('new_column', function($row) {
                    return $row->new_column; // Ensure new_column exists in DB
                })
                ->addColumn('action', function ($row) {
                    $edit = route('our_services-edit', ['our_services_id' => $row->our_services_id]);
                    $delete = route('our_services-delete', ['our_services_id' => $row->our_services_id]);

                    $actionBtn = '<a href="' . $edit . '" class="btn btn-primary">Edit</a>';
                    $actionBtn .= '<form id="delete-form-' . $row->our_services_id . '" action="' . $delete . '" method="POST" style="display:inline;">
                                    ' . csrf_field() . '
                                    ' . method_field('DELETE') . '
                                    <button type="button" class="delete-button btn btn-danger mt-2 mt-md-0 mt-lg-0" onclick="confirmDelete(' . $row->our_services_id . ')">Delete</button>
                                  </form>';
                    return $actionBtn;
                })
                ->addColumn('image', function ($row) {
                    return '<img style="width:50px; height:50px;" src="' . asset($row->image) . '" class="img-fluid shadow img-thumbnail" alt="img">';
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
        }
    
        return view('admin/our_services/our_services');
    }

    public function Our_Services()
    {
        $sliders = Our_ServicesModel::all(); // Fetch all slider records
        return view('admin/our_services/our_services', compact('sliders')); // Pass to view
    }

    public function Add()
    {
        return view('admin/our_services/add');
    }

    public function Store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required',
        ]);

        $path = 'dashboard/img/our_services/';

        // Handle the file upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension(); // Create a unique filename
            $file->move(public_path($path), $filename); // Save the file to the specified path
            $imagePath = $path . $filename; // Create full path for storage in DB
        } else {
            return back()->withErrors(['image' => 'Image upload failed. Please try again.']);
        }
        $data = ['image' => $imagePath, 'title' => $request->title, 'description' => $request->description];
        Our_ServicesModel::create($data);

        session()->flash('success', 'Data has been added successfully!');
        return redirect('admin/our_services');
    }

    
    public function Edit($our_services_id)
    {
        $data = Our_ServicesModel::findOrFail($our_services_id);
        // return view('homeslider-edit', compact('data'));\
        return view('admin/our_services/edit', compact('data'));
    }
    public function Update(Request $request, $our_services_id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required',
        ]);

        $data = Our_ServicesModel::findOrFail($our_services_id);
        $data->title = $request->input('title');
        $data->description = $request->input('description');

        if ($request->hasFile('image')) {
            $path = 'dashboard/img/our_services/';
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('dashboard/img/our_services/', $filename);
            $data->image = $path . $filename;
        }
    
        $data->save();
        session()->flash('success', 'Data has been Updated successfully!');
        return redirect('admin/our_services');
    }
    public function Delete($our_services_id)
    {
        $slider = Our_ServicesModel::findOrFail($our_services_id);
        $slider->delete();
        session()->flash('delete-button', 'Data has been deleted successfully!');
        return redirect('admin/our_services');
    }
  
}
