<?php

namespace App\Http\Controllers;

use App\Wikipedia;
use Illuminate\Http\Request;

use Auth;
use App\User;
use Session;

class WikipediaController extends Controller {
    public function __construct() {
        $this->middleware(['auth']);
    }

    public function index(Request $request) {
        $searchTerm = $request->input('searchTerm');
        $searchUsers = $request->input('searchUsers');
        $wikipedias = Wikipedia::with('user')->search($searchTerm, $searchUsers)->paginate(20);
        $wikipedias->appends(['searchTerm' => $searchTerm, 'searchUsers' => $searchUsers]);
        $users = User::select('id', 'name')->orderBy('name')->get();
        return view('wikipedias.index', compact('wikipedias', 'searchTerm', 'users', 'searchUsers'));
    }

    public function create() {
        $autonumber = $this->wikipediaAutoNumber();
        return view('wikipedias.create', compact('autonumber'));
    }

    public function store(Request $request) {
        $this->validate($request, [
            'number' => 'required|unique:wikipedias,number',
            'title' => 'required|unique:wikipedias,title',
            'body' => 'required',
        ]);

        $message = new Wikipedia;
        $message->number = $request->input('number');
        $message->title = $request->input('title');
        $message->body = $request->input('body');
        $message->description = $request->input('description');
        $message->user_id = Auth::user()->id;
        $message->save();
        
        $request->session()->flash('alert-success', 'Wikipedia was successful added!');
        return redirect()->route('wikipedias.index');
    }

    public function show($id) {
        $wikipedia = Wikipedia::find($id);
        return view('wikipedias.show', compact('wikipedia'))->renderSections()['content'];
    }

    public function edit($id) {
        $wikipedia = Wikipedia::findOrFail($id);

        return view('wikipedias.edit', compact('wikipedia'));
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'number' => 'required|unique:wikipedias,number,'.$id,
            'title' => 'required|unique:wikipedias,title,'.$id,
            'body' => 'required',
        ]);

        $message = Wikipedia::findOrFail($id);
        $message->number = $request->input('number');
        $message->title = $request->input('title');
        $message->body = $request->input('body');
        $message->description = $request->input('description');
        $message->user_id = Auth::user()->id;
        $message->save();

        $request->session()->flash('alert-success', 'Wikipedia was successful updates!');
        return redirect()->route('wikipedias.index');
    }

    public function destroy($id) {
        $wikipedia = Wikipedia::findOrFail($id);
        $wikipedia->delete();
        Session::flash('alert-success', 'Wikipedia was successful deleted!');
        return redirect()->route('wikipedias.index');
    }

    private function wikipediaAutoNumber() {
        $lastNumber = '';
        $wikipediaNumber = Wikipedia::select('number')->whereRaw('DATE(created_at) = DATE(NOW())')->orderBy('id', 'DESC')->limit(1)->first();
        if ($wikipediaNumber) {
            $lastNumber = substr($wikipediaNumber['number'], -2);
            $que = (int) $lastNumber;
            $que = $que + 1;
            $que = ''.$que;
            if(strlen($que) < 2) $que = '0'.$que;
            $lastNumber = date("Ymd").$que;
        } else {
            $lastNumber = date("Ymd").'01';
        }
        return 'WI'.$lastNumber;
    }
}
