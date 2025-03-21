<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AboutModel;
use Yajra\DataTables\Facades\DataTables;

class AdminAboutController extends Controller
{
    // ✅ Script for DataTable
    public function AboutScript(Request $request)
    {
        if ($request->ajax()) {
            $about = AboutModel::select(['about_id', 'title', 'description', 'Rooms', 'Staffs', 'Clients'])->latest();

            return DataTables::of($about)
            ->addColumn('action', function ($row) {
                $edit = route('about-edit', ['about_id' => $row->about_id]);
                $delete = route('about-delete', ['about_id' => $row->about_id]);
            
                $actionBtn = '<a href="' . $edit . '" class="btn mt-2 btn-primary">Edit</a>';
                $actionBtn .= '<form id="delete-form-' . $row->about_id . '" action="' . $delete . '" method="POST" style="display:inline;">
                              ' . csrf_field() . '
                              ' . method_field('DELETE') . '
                              <button type="button" class="delete-button btn btn-danger mt-2 ms-2" onclick="confirmDelete(' . $row->about_id . ')">Delete</button>
                              </form>';
            
                return $actionBtn;
            })
            
            ->rawColumns([ 'action'])
            ->make(true);
        }

        return view('admin.about.about');
    }

    // ✅ Load main About page
    public function About()
    {
        return view('admin.about.about');
    }

    public function add()
    {
        return view('admin.about.add');
    }

    // ✅ Store data with success message
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'Rooms' => 'required',
            'Staffs' => 'required',
            'Clients' => 'required',
        ]);

        AboutModel::create($request->all());

        return redirect()->route('about')->with('success', 'Data has been added successfully!');
    }

    public function edit($about_id)
    {
        $data = AboutModel::findOrFail($about_id);
        return view('admin.about.edit', compact('data'));
    }

    public function update(Request $request, $about_id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'Rooms' => 'required',
            'Staffs' => 'required',
            'Clients' => 'required',
        ]);

        $data = AboutModel::findOrFail($about_id);
        $data->update($request->all());

        return redirect()->route('about')->with('success', 'Data has been updated successfully!');
    }

    public function Delete($about_id)
    {
        AboutModel::findOrFail($about_id)->delete();
        return redirect()->route('about')->with('success', 'You have successfully deleted the entry.');
    }
}
