<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Our_ServicesModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;

class AdminServicesController extends Controller
{
    // Handle DataTable AJAX request
    public function ServicesScript(Request $request)
    {
        if ($request->ajax()) {
            $services = Our_ServicesModel::select(['our_services_id', 'title', 'description', 'image'])->latest();

            return DataTables::of($services)
                ->addColumn('image', function ($row) {
                    return (!empty($row->image) && file_exists(public_path($row->image)))
                        ? '<img src="' . asset($row->image) . '" width="50" height="50">'
                        : 'No Image';
                })
                ->addColumn('action', function ($row) {
                    $edit = route('our_services-edit', ['our_services_id' => $row->our_services_id]);
                    $delete = route('our_services-delete', ['our_services_id' => $row->our_services_id]);
                
                    $actionBtn = '<a href="' . $edit . '" class="btn mt-2 btn-primary">Edit</a>';
                    $actionBtn .= '<form id="delete-form-' . $row->our_services_id . '" action="' . $delete . '" method="POST" style="display:inline;">
                                  ' . csrf_field() . '
                                  ' . method_field('DELETE') . '
                                  <button type="button" class="delete-button btn btn-danger mt-2 ms-2" onclick="confirmDelete(' . $row->our_services_id . ')">Delete</button>
                                  </form>';
                
                    return $actionBtn;
                })
                ->rawColumns(['image', 'action'])
                ->make(true);
        }
        return view('admin.our_services.our_services');
    }

    // Load main services page
    public function Services()
    {
        return view('admin.our_services.our_services');
    }

    public function add()
    {
        return view('admin.our_services.add');
    }

    // Store service data
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('dashboard/img/our_services/'), $filename);
            $imagePath = 'dashboard/img/our_services/' . $filename;
        }
    
        Our_ServicesModel::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
        ]);
    
        return redirect()->route('services')->with('success', 'Service added successfully!');

    }
    
    public function edit($our_services_id)
    {
        $data = Our_ServicesModel::findOrFail($our_services_id);
        return view('admin.our_services.edit', compact('data'));
    }

    // Update service data
    public function update(Request $request, $our_services_id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = Our_ServicesModel::findOrFail($our_services_id);
    
        if ($request->hasFile('image')) {
            if (File::exists(public_path($data->image))) {
                File::delete(public_path($data->image));
            }
    
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('dashboard/img/our_services/'), $filename);
            $data->image = 'dashboard/img/our_services/' . $filename;
        }
    
        $data->update($request->except('image') + ['image' => $data->image]);
    
        return redirect()->route('services')->with('success', 'Service updated successfully!');
    }

    // Delete service
    public function Delete($our_services_id)
    {
        $slider = Our_ServicesModel::findOrFail($our_services_id);
        $slider->delete();
    
        return redirect()->route('services')->with('success', 'You have successfully deleted the slider.');
    }
}