<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RoomModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;

class AdminRoomController extends Controller
{
    public function RoomScript(Request $request)
    {
        if ($request->ajax()) {
            $sliders = RoomModel::select(['room_id', 'title', 'description', 'image','tag'])->latest();

            return DataTables::of($sliders)
                ->addColumn('image', function ($row) {
                    if (!empty($row->image) && file_exists(public_path($row->image))) {
                        return '<img src="' . asset($row->image) . '" width="50" height="50">';
                    }
                    return 'No Image';
                })
                ->addColumn('action', function ($row) {
                    $edit = route('room-edit', ['room_id' => $row->room_id]);
                    $delete = route('room-delete', ['room_id' => $row->room_id]);
                
                    $actionBtn = '<a href="' . $edit . '" class="btn mt-2 btn-primary">Edit</a>';
                    $actionBtn .= '<form id="delete-form-' . $row->room_id . '" action="' . $delete . '" method="POST" style="display:inline;">
                                  ' . csrf_field() . '
                                  ' . method_field('DELETE') . '
                                  <button type="button" class="delete-button btn btn-danger mt-2 ms-2" onclick="confirmDelete(' . $row->room_id . ')">Delete</button>
                                  </form>';
                
                    return $actionBtn;
                })
                
                ->rawColumns(['image', 'action'])
                ->make(true);
        }
        // return response()->json(['error' => 'Invalid request'], 400);
        return view('admin.room.room');
    }



    public function Room()
    {
        return view('admin.room.room');
    }

    public function Add()
    {
        return view('admin.room.add');
    }

    public function Store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'tag' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Handle Image Upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('dashboard/img/blog_img/'), $filename);
            $imagePath = 'dashboard/img/blog_img/' . $filename;
        } else {
            return back()->withErrors(['image' => 'Image upload failed. Please try again.']);
        }
    
        // Store Data in Database
        RoomModel::create([
            'title' => $request->title,
            'description' => $request->description,
            'tag' => $request->tag,
            'image' => $imagePath,
        ]);
    
        // Flash success message to session
        session()->flash('success', 'Data has been added successfully!');
    
        return redirect()->route('room');
    }
    

    public function Edit($room_id)
    {
        $data = RoomModel::findOrFail($room_id);
        return view('admin.room.edit', compact('data'));
    }

    public function update(Request $request, $room_id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'tag' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = RoomModel::findOrFail($room_id);
        $data->update($request->all());

        return redirect()->route('room')->with('success', 'Data has been updated successfully!');

        if ($request->hasFile('image')) {
            if (File::exists(public_path($data->image))) {
                File::delete(public_path($data->image));
            }

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('dashboard/img/blog_img/'), $filename);
            $data->image = 'dashboard/img/blog_img/' . $filename;
        }

        $data->update($request->except('image'));

        return redirect()->route('room')->with('success', 'Data has been added successfully!');
    }


    public function Delete($room_id)
    {
        $slider = RoomModel::findOrFail($room_id);
        $slider->delete();
    
        return redirect()->route('room')->with('success', 'You have successfully deleted the slider.');
    }
    
    
}
