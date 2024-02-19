<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Models\Origin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OriginController extends Controller
{

    public function index()
    {
        $origins = DB::table('origins')->get();
        return view('user.origin', ['origins' => $origins]);
    }

    public function create()
    {
        //return view('adds.cOrigin');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'number' => 'required',
            'address' => 'required'
        ]);
        Origin::create($request->all());
        return redirect()->route('origins.index')->with('success', 'origin created successfully');
    }


    public function show(Origin $origin)
    {
        //
    }

    public function edit(Origin $origin)
    {
        $origin = Origin::find($origin->originID);
        return view('origins.edit', compact('origin'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'number' => 'required',
            'address' => 'required'
        ]);
        $origin = Origin::find($id);
        $origin->update($request->all());
        return redirect()->route('origins.index')->with('success','Origin updated successfully');
    
    }

    public function destroy($id)
    {
        $origin = Origin::find($id);
        $origin->delete();
        return redirect()->route('origins.index')->with('success', 'origin deleted successfully');
    }
}