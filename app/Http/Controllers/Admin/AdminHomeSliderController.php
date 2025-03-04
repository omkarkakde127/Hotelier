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
    
                    return '<a href="' . $edit . '" class="btn btn-primary">Edit</a>
                            <button type="button" class="delete-button btn btn-danger mt-2" 
                                    data-id="' . $row->home_slider_id . '">Delete</button>
                            <form id="delete-form-' . $row->home_slider_id . '" 
                                  action="' . $delete . '" method="POST" style="display: none;">
                                ' . csrf_field() . '
                                <input type="hidden" name="_method" value="DELETE">
                            </form>';
                })
                ->rawColumns(['image', 'action'])
                ->make(true);
        }
        return response()->json(['error' => 'Invalid request'], 400);
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

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('dashboard/img/home_slider/'), $filename);
            $imagePath = 'dashboard/img/home_slider/' . $filename;
        } else {
            return back()->withErrors(['image' => 'Image upload failed. Please try again.']);
        }

        HomeSliderModel::create($request->except('image') + ['image' => $imagePath]);

        return redirect()->route('home_slider')->with('success', 'Data has been added successfully!');


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

    public function delete($home_slider_id)
    {
        $slider = HomeSliderModel::find($home_slider_id);
        
        if (!$slider) {
            return response()->json(['error' => 'Slider not found'], 404);
        }
    
        // Delete Image if Exists
        if (!empty($slider->image) && file_exists(public_path($slider->image))) {
            unlink(public_path($slider->image));
        }
    
        $slider->delete();
    
        return response()->json(['success' => 'Slider deleted successfully']);
    }
    
    
    
    
}
