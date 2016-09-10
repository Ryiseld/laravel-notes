<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Session;
use App\User;
use App\Note;
use App\Notebook;

class NoteController extends Controller
{
	// [GET] Show the index page, with all notes
	public function index() {
			$user = User::find(Auth::user()->id);
			$notebooks = $user->notebooks()->get();
			$notes = $user->notes()->get();

			return view('home', ['notebooks' => $notebooks, 'notes' => $notes]);
	}

	// [GET] Create a note
  public function create() {
  	$user = User::find(Auth::user()->id);
  	$notebooks = $user->notebooks()->get();
  	return view('note.create', ['notebooks' => $notebooks]);
  }

  // [POST] Create a note
  public function store(Request $request) {
  	$this->validate($request, array(
  		'notebook' => 'required|numeric',
  		'title' => 'required|max:50',
  		'content' => 'required'
  	));

  	$note = new Note;
  	$note->title = $request->title;
  	$note->content = $request->content;
  	$note->notebook_id = $request->notebook;
  	$note->user_id = Auth::user()->id;
  	$note->save();

  	Session::flash('success', 'The note was successfully created!');
  	return redirect()->route('home');
  }

  // [GET] Edit a note
  public function edit($id) {
    $user = User::find(Auth::user()->id);
    $notebooks = $user->notebooks()->get();
    $note = Note::findOrFail($id);
    return view('note.edit', ['notebooks' => $notebooks, 'note' => $note]);
  }

  // [POST] Edit a note
  public function update(Request $request, $id) {
    $this->validate($request, array(
      'notebook' => 'required|numeric',
      'title' => 'required|max:50',
      'content' => 'required'
    ));

    $note = Note::findOrFail($id);
    $note->title = $request->title;
    $note->content = $request->content;
    $note->notebook_id = $request->notebook;
    $note->save();

    Session::flash('success', 'The note was successfully updated!');
    return redirect()->action('NoteController@showNote', ['id' => $id]);
  }

  // [GET] Delete a note
  public function destroy($id) {
    $note = Note::findOrFail($id);
    $note->delete();

    Session::flash('success', 'The note was successfully deleted!');
    return redirect()->route('home');
  }

	// [GET] Show the index page with notes from the notebook
	public function indexByNotebook($id) {
		$user = User::find(Auth::user()->id);
		$notebooks = $user->notebooks()->get();
		$notebook_name = Notebook::findOrFail($id)->name;
		$notes = Note::where('notebook_id', '=', $id)->get();

		return view('home', ['notebook_name' => $notebook_name, 'notebooks' => $notebooks, 'notes' => $notes]);
	}

	// [GET] Show the specified note
	public function showNote($id) {
    $note = Note::findOrFail($id);

    return view('note.show', ['note' => $note]);
	}
}
