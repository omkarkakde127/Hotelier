<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TeamModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;

class AdminTeamController extends Controller
{
    public function TeamScript(Request $request)
    {
        if ($request->ajax()) {
            $sliders = TeamModel::select(['team_id', 'name', 'profession', 'image'])->latest();

            return DataTables::of($sliders)
                ->addColumn('image', function ($row) {
                    if (!empty($row->image) && file_exists(public_path($row->image))) {
                        return '<img src="' . asset($row->image) . '" width="50" height="50">';
                    }
                    return 'No Image';
                })
                ->addColumn('action', function ($row) {
                    $edit = route('team-edit', ['team_id' => $row->team_id]);
                    $delete = route('team-delete', ['team_id' => $row->team_id]);
                
                    $actionBtn = '<a href="' . $edit . '" class="btn mt-2 btn-primary">Edit</a>';
                    $actionBtn .= '<form id="delete-form-' . $row->team_id . '" action="' . $delete . '" method="POST" style="display:inline;">
                                  ' . csrf_field() . '
                                  ' . method_field('DELETE') . '
                                  <button type="button" class="delete-button btn btn-danger mt-2 ms-2" onclick="confirmDelete(' . $row->team_id . ')">Delete</button>
                                  </form>';
                
                    return $actionBtn;
                })
                
                ->rawColumns(['image', 'action'])
                ->make(true);
        }
        // return response()->json(['error' => 'Invalid request'], 400);
        return view('admin.team.team');
    }



    public function Team()
    {
        return view('admin.team.team');
    }

    public function Add()
    {
        return view('admin.team.add');
    }

    public function Store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'profession' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Handle Image Upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('dashboard/img/team_img/'), $filename);
            $imagePath = 'dashboard/img/team_img/' . $filename;
        } else {
            return back()->withErrors(['image' => 'Image upload failed. Please try again.']);
        }
    
        // Store Data in Database
        TeamModel::create([
            'name' => $request->name,
            'profession' => $request->profession,
            'image' => $imagePath,
        ]);
    
        // Flash success message to session
        session()->flash('success', 'Data has been added successfully!');
    
        return redirect()->route('team');
    }
    

    public function Edit($team_id)
    {
        $data = TeamModel::findOrFail($team_id);
        return view('admin.team.edit', compact('data'));
    }

    public function update(Request $request, $team_id)
    {
        $request->validate([
            'name' => 'required',
            'profession' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = TeamModel::findOrFail($team_id);
        $data->update($request->all());

        return redirect()->route('team')->with('success', 'Data has been updated successfully!');

        if ($request->hasFile('image')) {
            if (File::exists(public_path($data->image))) {
                File::delete(public_path($data->image));
            }

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('dashboard/img/team_img/'), $filename);
            $data->image = 'dashboard/img/team_img/' . $filename;
        }

        $data->update($request->except('image'));

        return redirect()->route('team')->with('success', 'Data has been added successfully!');
    }


    public function Delete($team_id)
    {
        $slider = TeamModel::findOrFail($team_id);
        $slider->delete();
    
        return redirect()->route('team')->with('success', 'You have successfully deleted the slider.');
    }
    
    
}
