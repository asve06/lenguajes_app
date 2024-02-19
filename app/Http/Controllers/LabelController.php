<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Models\Label;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LabelController extends Controller
{

    public function index()
    {
        $labels = DB::table('labels')->get();
        return view('user.label', ['labels' => $labels]);
    }

    public function create()
    {
        //return view('adds.createLabel');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'details' => 'required',
        ]);
        Label::create($request->all());
        return redirect()->route('labels.index')->with('success', 'Label created successfully');
    }


    public function show(Label $label)
    {
        //
    }

    public function edit(Label $label)
    {
        $label = Label::find($label->labelId);
        return view('labels.edit', compact('label'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['name'=>'required','details'=>'required']);
        $label = Label::find($id);
        $label->update($request->all());
        return redirect()->route('labels.index')->with('success','Label updated successfully');
    
    }

    public function destroy($id)
    {
        $label = Label::find($id);
        $label->delete();
        return redirect()->route('labels.index')->with('success', 'Label deleted successfully');
    }
}