<?php

namespace App\Http\Controllers;

use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user_id = Auth::user()->id;
        // $departments = Department::where('user_id',$user_id)->orderBy('name','asc')->get();
        $departments = DepartmentResource::collection(Department::where('user_id',$user_id)->orderBy('name','asc')->get());
        
        // return $departments;
        return Inertia::render('Department/Index',[
            'departments'=>$departments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Department/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'min:5', 'max:64','unique:departments'],
        ]);

        $slug = Str::slug($request->name,'-');
        $user_id = Auth::user()->id;

        $department = new Department;
        $department->user_id = $user_id;
        $department->name = $request->name;
        $department->slug = $slug;
        $department->save();
        
        return Redirect::route('departments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $department = Department::where('slug',$slug)->first();
        return Inertia::render('Department/Edit',[
            'department'=>$department
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'min:5', 'max:64','unique:departments'],
        ]);

        $slug = Str::slug($request->name,'-');
        $user_id = Auth::user()->id;

        $department = Department::find($id);
        $department->name = $request->name;
        $department->slug = $slug;
        $department->update();
        
        return Redirect::route('departments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department = Department::find($id);
        $department->delete();

        return Redirect::route('departments.index');
    }
}
