<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Session;
use App\Notebook;

class NotebookController extends Controller
{
	// [GET] Create a notebook
    public function create() {
    	return view('notebook.create');
    }

    // [POST] Create a notebook
    public function store(Request $request) {
    	$this->validate($request, array(
    		'name' => 'required|max:20'
    	));

    	$notebook = new Notebook;
    	$notebook->name = $request->name;
    	$notebook->user_id = Auth::user()->id;
    	$notebook->save();

    	Session::flash('success', 'The notebook was successfully created!');
    	return redirect()->route('home');
    }

    // [GET] Edit a notebook
    public function edit($id) {
        $notebook = Notebook::findOrFail($id);
        return view('notebook.edit', ['notebook' => $notebook]);
    }

    // [POST] Edit a notebook
    public function update(Request $request, $id) {
        $this->validate($request, array(
            'name' => 'required|max:20'
        ));

        $notebook = Notebook::findOrFail($id);
        $notebook->name = $request->name;
        $notebook->save();

        Session::flash('success', 'The notebook was successfully updated!');
        return redirect()->route('home');
    }

    // [GET] Delete a notebook
    public function destroy($id) {
        $notebook = Notebook::findOrFail($id);
        $notebook->delete();

        Session::flash('success', 'The notebook was successfully deleted!');
        return redirect()->route('home');
    }
}
