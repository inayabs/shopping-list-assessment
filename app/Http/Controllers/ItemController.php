<?php

namespace App\Http\Controllers;

use App\Http\Resources\DepartmentResource;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Item;
use App\Http\Resources\ItemResource;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $department_items = DepartmentResource::collection(Department::with('item')->whereHas('item')->where('user_id',$user_id)->orderBy('name','asc')->get());
        // dd($deparment);
        
        return Inertia::render('Item/Index',[
            'department_items'=>$department_items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = Auth::user()->id;
        $departments = DepartmentResource::collection(Department::where('user_id',$user_id)->orderBy('name','asc')->get());

        return Inertia::render('Item/Create',[
            'departments'=>$departments
        ]);
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
            'name' => ['required', 'max:128','unique:departments'],
            'department'=>'required'
        ]);

        $item = new Item;
        $item->name = $request->name;
        $item->department_id = $request->department;
        $item->save();
        
        return Redirect::route('items.index');
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
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $user_id = Auth::user()->id;
        $departments = DepartmentResource::collection(Department::where('user_id',$user_id)->orderBy('name','asc')->get());

        return Inertia::render('Item/Edit',[
            'item'=>$item,
            'departments'=>$departments
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
            'name' => ['required', 'max:128','unique:departments'],
            'department'=>'required'
        ]);

        $slug = Str::slug($request->name,'-');
        $user_id = Auth::user()->id;

        $item = Item::find($id);
        $item->name = $request->name;
        $item->department_id = $request->department;
        $item->update();
        
        return Redirect::route('items.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        $item->delete();

        return Redirect::route('items.index');
    }
}
