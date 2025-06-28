<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\User;
use App\Http\Requests\SchoolRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;
use File;

class SchoolController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $schools = School::with(['students', 'instructors'])->orderBy('id', 'desc')->get();
        return view('admin.school.index', compact('schools'));
    }

    public function create()
    {
        return view('admin.school.create');
    }

    public function store(SchoolRequest $request)
    {

        $school = new School();
        $school->name = $request->name;
        $school->slug = $request->slug ?: Str::slug($request->name);
        $school->primary_color = $request->primary_color;
        $school->secondary_color = $request->secondary_color;
        $school->status = $request->status;

        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $ext = $image->getClientOriginalExtension();
            $logo_name = 'school-logo-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$ext;
            $logo_path = 'uploads/schools/'.$logo_name;
            
            // Save original image without resizing (alternative to avoid GD dependency)
            $image->move(public_path('uploads/schools'), $logo_name);
            $school->logo = $logo_name;
        }

        $school->save();

        $notify_message = trans('translate.School created successfully');
        $notify_message = array('message'=>$notify_message,'alert-type'=>'success');
        return redirect()->route('admin.schools.index')->with($notify_message);
    }

    public function show($id)
    {
        $school = School::with(['students', 'instructors'])->findOrFail($id);
        return view('admin.school.show', compact('school'));
    }

    public function edit($id)
    {
        $school = School::findOrFail($id);
        return view('admin.school.edit', compact('school'));
    }

    public function update(SchoolRequest $request, $id)
    {
        $school = School::findOrFail($id);

        $school->name = $request->name;
        $school->slug = $request->slug ?: Str::slug($request->name);
        $school->primary_color = $request->primary_color;
        $school->secondary_color = $request->secondary_color;
        $school->status = $request->status;

        if ($request->hasFile('logo')) {
            $old_logo = $school->logo;
            if ($old_logo) {
                File::delete(public_path('uploads/schools/'.$old_logo));
            }

            $image = $request->file('logo');
            $ext = $image->getClientOriginalExtension();
            $logo_name = 'school-logo-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$ext;
            
            // Save original image without resizing (alternative to avoid GD dependency)
            $image->move(public_path('uploads/schools'), $logo_name);
            $school->logo = $logo_name;
        }

        $school->save();

        $notify_message = trans('translate.School updated successfully');
        $notify_message = array('message'=>$notify_message,'alert-type'=>'success');
        return redirect()->route('admin.schools.index')->with($notify_message);
    }

    public function destroy($id)
    {
        $school = School::findOrFail($id);
        
        if ($school->users()->count() > 0) {
            $notify_message = trans('translate.Cannot delete school with assigned users');
            $notify_message = array('message'=>$notify_message,'alert-type'=>'error');
            return redirect()->back()->with($notify_message);
        }

        if ($school->logo) {
            File::delete(public_path('uploads/schools/'.$school->logo));
        }

        $school->delete();

        $notify_message = trans('translate.School deleted successfully');
        $notify_message = array('message'=>$notify_message,'alert-type'=>'success');
        return redirect()->route('admin.schools.index')->with($notify_message);
    }

    public function school_status($id)
    {
        $school = School::findOrFail($id);
        $school->status = $school->status == 'active' ? 'inactive' : 'active';
        $school->save();

        $notify_message = trans('translate.Status updated successfully');
        $notify_message = array('message'=>$notify_message,'alert-type'=>'success');
        return redirect()->back()->with($notify_message);
    }
}