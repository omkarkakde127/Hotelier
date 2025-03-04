<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TestimonialModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;
// use App\Models\items;
use App\Models\items;

class AdminTestimonialController extends Controller
{
    
    public function TestimonialScript(Request $request)
    {
        if ($request->ajax()) {
            $data = TestimonialModel::select(['testimonial_id', 'image', 'description','name','profession'])->latest()->get();
            
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('new_column', function($row) {
                    return $row->new_column; // Ensure new_column exists in DB
                })
                ->addColumn('action', function ($row) {
                    $edit = route('testimonial-edit', ['testimonial_id' => $row->testimonial_id]);
                    $delete = route('testimonial-delete', ['testimonial_id' => $row->testimonial_id]);

                    $actionBtn = '<a href="' . $edit . '" class="btn btn-primary">Edit</a>';
                    $actionBtn .= '<form id="delete-form-' . $row->testimonial_id . '" action="' . $delete . '" method="POST" style="display:inline;">
                                    ' . csrf_field() . '
                                    ' . method_field('DELETE') . '
                                    <button type="button" class="delete-button btn btn-danger mt-2 mt-md-0 mt-lg-0" onclick="confirmDelete(' . $row->testimonial_id . ')">Delete</button>
                                  </form>';
                    return $actionBtn;
                })
                ->addColumn('image', function ($row) {
                    return '<img style="width:50px; height:50px;" src="' . asset($row->image) . '" class="img-fluid shadow img-thumbnail" alt="img">';
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
        }
    
        return view('admin/testimonial/testimonial');
    }

    public function Testimonial()
    {
        $sliders = TestimonialModel::all(); // Fetch all slider records
        return view('admin/testimonial/testimonial', compact('sliders')); // Pass to view
    }

    public function Add()
    {
        return view('admin/testimonial/add');
    }

    public function Store(Request $request)
    {
        $request->validate([
            'image' => 'required',
            'description' => 'required',
            'name' => 'required',
            'profession' => 'required',
        ]);

        $path = 'dashboard/img/testimonial/';

        // Handle the file upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension(); // Create a unique filename
            $file->move(public_path($path), $filename); // Save the file to the specified path
            $imagePath = $path . $filename; // Create full path for storage in DB
        } else {
            return back()->withErrors(['image' => 'Image upload failed. Please try again.']);
        }
        $data = ['image' => $imagePath, 'description' => $request->description, 'name' => $request->name,'profession' => $request->profession];
        TestimonialModel::create($data);

        session()->flash('success', 'Data has been added successfully!');
        return redirect('admin/testimonial');
    }

    
    public function Edit($testimonial_id)
    {
        $data = TestimonialModel::findOrFail($testimonial_id);
        // return view('homeslider-edit', compact('data'));\
        return view('admin/testimonial/edit', compact('data'));
    }
    public function Update(Request $request, $testimonial_id)
    {
        $request->validate([
            'image' => 'required',
            'description' => 'required',
            'name' => 'required',
            'profession' => 'required',
        ]);
    
        $data = TestimonialModel::findOrFail($testimonial_id);
        $data->description = $request->input('description'); // Fixed the typo here
        $data->name = $request->input('name');
        $data->profession = $request->input('profession');
    
        if ($request->hasFile('image')) {
            $path = 'dashboard/img/testimonial/';
            if (File::exists($data->image)) { // Ensure the specific file is deleted, not just the folder
                File::delete($data->image);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('dashboard/img/testimonial/', $filename);
            $data->image = $path . $filename;
        }
    
        $data->save();
        session()->flash('success', 'Data has been Updated successfully!');
        return redirect('admin/testimonial');
    }
    
    
    public function Delete($testimonial_id)
    {
        $slider = TestimonialModel::findOrFail($testimonial_id);
        $slider->delete();
        session()->flash('delete-button', 'Data has been deleted successfully!');
        return redirect('admin/testimonial');
    }
  
}
