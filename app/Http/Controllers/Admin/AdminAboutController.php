<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AboutModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;
// use App\Models\items;
use App\Models\items;

class AdminAboutController extends Controller
{
    

    public function AboutScript(Request $request)
    {
        if ($request->ajax()) {
            $data = AboutModel::select(['about_id', 'title', 'description', 'Rooms', 'Staffs', 'Clients'])->latest()->get();
            
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('new_column', function($row) {
                    return $row->new_column; // Ensure new_column exists in DB
                    })
                ->addColumn('action', function ($row) {
                    $edit = route('about-edit', ['about_id' => $row->about_id]);
                    $delete = route('about-delete', ['about_id' => $row->about_id]);

                    $actionBtn = '<a href="' . $edit . '" class="btn btn-primary">Edit</a>';
                    $actionBtn .= '<form id="delete-form-' . $row->about_id . '" action="' . $delete . '" method="POST" style="display:inline;">
                                    ' . csrf_field() . '
                                    ' . method_field('DELETE') . '
                                    <button type="button" class="delete-button btn btn-danger mt-2" onclick="confirmDelete(' . $row->about_id . ')">Delete</button>
                                  </form>';
                    return $actionBtn;
                })
               
                ->rawColumns(['action'])
                ->make(true);
        }
    
        return view('admin/about/about');
    }
    


    public function About()
    {
        // Fetch all slider records
        return view('admin/about/about'); // Pass to view
    }

    public function Add()
    {
        return view('admin/about/add');
    }

    public function Store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'Rooms' => 'required',
            'Staffs' => 'required',
            'Clients' => 'required',
            
        ]);

        // Handle the file upload
       
        $data = ['title' => $request->title, 'description' => $request->description, 'Rooms' => $request->Rooms , 'Staffs' => $request->Staffs,'Clients' => $request->Clients];
        AboutModel::create($data);

        session()->flash('success', 'Data has been added successfully!');
        return redirect('admin/about');
    }



    public function Edit($about_id)
    {
        $data = AboutModel::findOrFail($about_id);
        // return view('homeslider-edit', compact('data'));\
        return view('admin/about/edit', compact('data'));
    }
    public function Update(Request $request, $about_id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'Rooms' => 'required',
            'Staffs' => 'required',
            'Clients' => 'required',
            
        ]);

        $data = AboutModel::findOrFail($about_id);
        $data->title = $request->input('title');
        $data->description = $request->input('description');
        $data->Rooms = $request->input('Rooms');
        $data->Staffs = $request->input('Staffs');
        $data->Clients = $request->input('Clients');
        
        $data->save();
        session()->flash('success', 'Data has been Updated successfully!');
        return redirect('admin/about');
    }
    public function Delete($about_id)
    {
        $slider = AboutModel::findOrFail($about_id);
        $slider->delete();
        session()->flash('delete-button', 'Data has been deleted successfully!');
        return redirect('admin/about');
    }


  

    //functio for script in home_slider.blade.php



}
