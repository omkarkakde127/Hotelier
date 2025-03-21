<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HomeSliderModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;

class AdminHomeSliderController extends Controller
{
    public function homeSliderScript(Request $request)
    {
        if ($request->ajax()) {
            $sliders = HomeSliderModel::select(['home_slider_id', 'title', 'description', 'image'])->latest();

            return DataTables::of($sliders)
                ->addColumn('image', function ($row) {
                    if (!empty($row->image) && file_exists(public_path($row->image))) {
                        return '<img src="' . asset($row->image) . '" width="50" height="50">';
                    }
                    return 'No Image';
                })
                ->addColumn('action', function ($row) {
                    $edit = route('homeslider-edit', ['home_slider_id' => $row->home_slider_id]);
                    $delete = route('homeslider-delete', ['home_slider_id' => $row->home_slider_id]);
                
                    $actionBtn = '<a href="' . $edit . '" class="btn mt-2 btn-primary">Edit</a>';
                    $actionBtn .= '<form id="delete-form-' . $row->home_slider_id . '" action="' . $delete . '" method="POST" style="display:inline;">
                                  ' . csrf_field() . '
                                  ' . method_field('DELETE') . '
                                  <button type="button" class="delete-button btn btn-danger mt-2 ms-2" onclick="confirmDelete(' . $row->home_slider_id . ')">Delete</button>
                                  </form>';
                
                    return $actionBtn;
                })
                
                ->rawColumns(['image', 'action'])
                ->make(true);
        }
        // return response()->json(['error' => 'Invalid request'], 400);
        return view('admin.home_slider.home-slider');
    }



    public function HomeSlider()
    {
        return view('admin.home_slider.home-slider');
    }

    public function add()
    {
        return view('admin.home_slider.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Handle Image Upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('dashboard/img/home_slider/'), $filename);
            $imagePath = 'dashboard/img/home_slider/' . $filename;
        } else {
            return back()->withErrors(['image' => 'Image upload failed. Please try again.']);
        }
    
        // Store Data in Database
        HomeSliderModel::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
        ]);
    
        // Flash success message to session
        session()->flash('success', 'Data has been added successfully!');
    
        return redirect()->route('home_slider');
    }
    

    public function edit($home_slider_id)
    {
        $data = HomeSliderModel::findOrFail($home_slider_id);
        return view('admin.home_slider.edit', compact('data'));
    }

    public function update(Request $request, $home_slider_id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = HomeSliderModel::findOrFail($home_slider_id);
        $data->update($request->all());

        return redirect()->route('home_slider')->with('success', 'Data has been updated successfully!');

        if ($request->hasFile('image')) {
            if (File::exists(public_path($data->image))) {
                File::delete(public_path($data->image));
            }

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('dashboard/img/home_slider/'), $filename);
            $data->image = 'dashboard/img/home_slider/' . $filename;
        }

        $data->update($request->except('image'));

        return redirect()->route('home_slider')->with('success', 'Data has been added successfully!');
    }


    public function Delete($home_slider_id)
    {
        $slider = HomeSliderModel::findOrFail($home_slider_id);
        $slider->delete();
    
        return redirect()->route('home_slider')->with('success', 'You have successfully deleted the slider.');
    }
    
    
}
