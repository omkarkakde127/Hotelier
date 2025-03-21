<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LuxuryModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;

class AdminLuxuryController extends Controller
{
    public function LuxuryScript(Request $request)
    {
        if ($request->ajax()) {
            $sliders = LuxuryModel::select(['luxury_id', 'title', 'description', 'image'])->latest();

            return DataTables::of($sliders)
                ->addColumn('image', function ($row) {
                    if (!empty($row->image) && file_exists(public_path($row->image))) {
                        return '<img src="' . asset($row->image) . '" width="50" height="50">';
                    }
                    return 'No Image';
                })
                ->addColumn('action', function ($row) {
                    $edit = route('luxury-edit', ['luxury_id' => $row->luxury_id]);
                    $delete = route('luxury-delete', ['luxury_id' => $row->luxury_id]);
                
                    $actionBtn = '<a href="' . $edit . '" class="btn mt-2 btn-primary">Edit</a>';
                    $actionBtn .= '<form id="delete-form-' . $row->luxury_id . '" action="' . $delete . '" method="POST" style="display:inline;">
                                  ' . csrf_field() . '
                                  ' . method_field('DELETE') . '
                                  <button type="button" class="delete-button btn btn-danger mt-2 ms-2" onclick="confirmDelete(' . $row->luxury_id . ')">Delete</button>
                                  </form>';
                
                    return $actionBtn;
                })
                
                ->rawColumns(['image', 'action'])
                ->make(true);
        }
        // return response()->json(['error' => 'Invalid request'], 400);
        return view('admin.luxury.luxury');
    }



    public function Luxury()
    {
        return view('admin.luxury.luxury');
    }

    public function Add()
    {
        return view('admin.luxury.add');
    }

    public function Store(Request $request)
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
            $file->move(public_path('dashboard/img/luxury_img/'), $filename);
            $imagePath = 'dashboard/img/luxury_img/' . $filename;
        } else {
            return back()->withErrors(['image' => 'Image upload failed. Please try again.']);
        }
    
        // Store Data in Database
        LuxuryModel::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
        ]);
    
        // Flash success message to session
        session()->flash('success', 'Data has been added successfully!');
    
        return redirect()->route('luxury');
    }
    

    public function Edit($luxury_id)
    {
        $data = LuxuryModel::findOrFail($luxury_id);
        return view('admin.luxury.edit', compact('data'));
    }

    public function update(Request $request, $luxury_id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = LuxuryModel::findOrFail($luxury_id);
        $data->update($request->all());

        return redirect()->route('luxury')->with('success', 'Data has been updated successfully!');

        if ($request->hasFile('image')) {
            if (File::exists(public_path($data->image))) {
                File::delete(public_path($data->image));
            }

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('dashboard/img/luxury_img/'), $filename);
            $data->image = 'dashboard/img/luxury_img/' . $filename;
        }

        $data->update($request->except('image'));

        return redirect()->route('luxury')->with('success', 'Data has been added successfully!');
    }


    public function Delete($luxury_id)
    {
        $slider = LuxuryModel::findOrFail($luxury_id);
        $slider->delete();
    
        return redirect()->route('luxury')->with('success', 'You have successfully deleted the slider.');
    }
    
    
}
