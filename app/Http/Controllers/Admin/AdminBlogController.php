<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BlogModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;
// use App\Models\items;
use App\Models\items;

class AdminBlogController extends Controller
{
    

    public function BlogScript(Request $request)
    {
        if ($request->ajax()) {
            // Fetch data from BlogModel, select the relevant columns
            $data = BlogModel::latest()->get();
        
            return DataTables::of($data)
                ->addIndexColumn()  // Adds a serial number for each row
                ->addColumn('action', function ($row) {
                    // Define the edit and delete URLs
                    $edit = route('blog-edit', ['blog_id' => $row->blog_id]);
                    $delete = route('blog-delete', ['blog_id' => $row->blog_id]);
    
                    // Create action buttons for Edit and Delete
                    $actionBtn = '<a href="' . $edit . '" class="btn btn-primary">Edit</a>';
                    $actionBtn .= '<form id="delete-form-' . $row->blog_id . '" action="' . $delete . '" method="POST" style="display:inline;">
                                    ' . csrf_field() . '
                                    ' . method_field('DELETE') . '
                                    <button type="button" class="delete-button btn btn-danger mt-2" onclick="confirmDelete(' . $row->blog_id . ')">Delete</button>
                                  </form>';
                    return $actionBtn;
                })
                ->addColumn('image', function ($row) {
                    // Add the image column with image tag
                    return '<img style="width:50px; height:50px;" src="' . asset($row->image) . '" class="img-fluid shadow img-thumbnail" alt="img">';
                })
               
                ->rawColumns(['action', 'image'])
                ->make(true);
        }
        
        return view('admin/blog/blog');
    }

    public function Blog()
    {
        $sliders = BlogModel::all(); // Fetch all slider records
        return view('admin/blog/blog', compact('sliders')); // Pass to view
    }

    public function Add()
    {
        return view('admin/blog/add');
    }

    public function Store(Request $request)
    {
        $request->validate([
            'image' => 'required',
            'tag' => 'required',
            'title' => 'required',
            'description' => 'required',
            'Admin_name' => 'required',
        ]);

        $path = 'dashboard/img/blog_img/';

        // Handle the file upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename1 = time() . '.' . $file->getClientOriginalExtension(); // Create a unique filename
            $file->move(public_path($path), $filename1); // Save the file to the specified path
            $imagePath1 = $path . $filename1; // Create full path for storage in DB
        } else {
            return back()->withErrors(['image' => 'Image upload failed. Please try again.']);
        }

         // Handle the file upload
        
        $data = ['image' => $imagePath1, 'tag' => $request->tag,'title' => $request->title, 'description' => $request->description, 'Admin_name' => $request->Admin_name];
        BlogModel::create($data);

        session()->flash('success', 'Data has been added successfully!');
        return redirect('admin/blog');
    }



    public function Edit($blog_id)
    {
        $data = BlogModel::findOrFail($blog_id);
        // return view('homeslider-edit', compact('data'));\
        return view('admin/blog/edit', compact('data'));
    }
    public function Update(Request $request, $blog_id)
    {
        $request->validate([
            'image' => 'required',
            'tag' => 'required',
            'title' => 'required',
            'description' => 'required',
            'Admin_name' => 'required',
        ]);

        $data = BlogModel::findOrFail($blog_id);

        $data->tag = $request->input('tag');
        $data->title = $request->input('title');
        $data->description = $request->input('description');
        $data->Admin_name = $request->input('Admin_name');


        if ($request->hasFile('image')) {
            $path = 'dashboard/img/blog_img/';
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('dashboard/img/blog_img/', $filename);
            $data->image = $path . $filename;
        }

    
        $data->save();
        session()->flash('success', 'Data has been Updated successfully!');
        return redirect('admin/blog');
    }
    public function Delete($blog_id)
    {
        $slider = BlogModel::findOrFail($blog_id);
        $slider->delete();
        session()->flash('delete-button', 'Data has been deleted successfully!');
        return redirect('admin/blog');
    }


  

    //functio for script in home_slider.blade.php



}
