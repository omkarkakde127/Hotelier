<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TestimonialModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;

class AdminTestimonialController extends Controller
{
    public function TestimonialScript(Request $request)
    {
        if ($request->ajax()) {
            $sliders = TestimonialModel::select(['testimonial_id', 'description', 'image','name','profession'])->latest();

            return DataTables::of($sliders)
                ->addColumn('image', function ($row) {
                    if (!empty($row->image) && file_exists(public_path($row->image))) {
                        return '<img src="' . asset($row->image) . '" width="50" height="50">';
                    }
                    return 'No Image';
                })
                ->addColumn('action', function ($row) {
                    $edit = route('testimonial-edit', ['testimonial_id' => $row->testimonial_id]);
                    $delete = route('testimonial-delete', ['testimonial_id' => $row->testimonial_id]);
                
                    $actionBtn = '<a href="' . $edit . '" class="btn mt-2 btn-primary">Edit</a>';
                    $actionBtn .= '<form id="delete-form-' . $row->testimonial_id . '" action="' . $delete . '" method="POST" style="display:inline;">
                                  ' . csrf_field() . '
                                  ' . method_field('DELETE') . '
                                  <button type="button" class="delete-button btn btn-danger mt-2 ms-2" onclick="confirmDelete(' . $row->testimonial_id . ')">Delete</button>
                                  </form>';
                
                    return $actionBtn;
                })
                
                ->rawColumns(['image', 'action'])
                ->make(true);
        }
        // return response()->json(['error' => 'Invalid request'], 400);
        return view('admin.testimonial.testimonial');
    }



    public function Testimonial()
    {
        return view('admin.testimonial.testimonial');
    }

    public function add()
    {
        return view('admin.testimonial.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'name' => 'required',
            'profession' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Handle Image Upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('dashboard/img/testimonial/'), $filename);
            $imagePath = 'dashboard/img/testimonial/' . $filename;
        } else {
            return back()->withErrors(['image' => 'Image upload failed. Please try again.']);
        }
    
        // Store Data in Database
        TestimonialModel::create([
            'description' => $request->description,
            'name' => $request->name,
            'profession' => $request->profession,
            'image' => $imagePath,
        ]);
    
        // Flash success message to session
        session()->flash('success', 'Data has been added successfully!');
    
        return redirect()->route('testimonial');
    }
    

    public function edit($testimonial_id)
    {
        $data = TestimonialModel::findOrFail($testimonial_id);
        return view('admin.testimonial.edit', compact('data'));
    }

    public function update(Request $request, $testimonial_id)
    {
        $request->validate([
            'description' => 'required',
            'name' => 'required',
            'profession' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $data = TestimonialModel::findOrFail($testimonial_id);
    
        // Handle Image Upload
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if (!empty($data->image) && File::exists(public_path($data->image))) {
                File::delete(public_path($data->image));
            }
    
            // Upload new image
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('dashboard/img/testimonial/'), $filename);
            $data->image = 'dashboard/img/testimonial/' . $filename;
        }
    
        // Update other fields
        $data->update([
            'description' => $request->description,
            'name' => $request->name,
            'profession' => $request->profession,
            'image' => $data->image, // Keep new image path if uploaded
        ]);
    
        return redirect()->route('testimonial')->with('success', 'Testimonial updated successfully!');
    }
    


    public function Delete($testimonial_id)
    {
        $slider = TestimonialModel::findOrFail($testimonial_id);
        $slider->delete();
    
        return redirect()->route('testimonial')->with('success', 'You have successfully deleted the slider.');
    }
    
    
}
