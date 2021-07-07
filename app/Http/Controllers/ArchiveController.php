<?php

namespace App\Http\Controllers;

use App\Archive;
use Illuminate\Http\Request;

use Auth;
use App\User;
use Session;

class ArchiveController extends Controller {
    public function __construct() {
        $this->middleware(['auth']);
    }

    public function index(Request $request) {
        $searchTerm = $request->input('searchTerm');
        $searchUsers = $request->input('searchUsers');
        $archives = Archive::with('user')->search($searchTerm, $searchUsers)->paginate(20);
        $archives->appends(['searchTerm' => $searchTerm, 'searchUsers' => $searchUsers]);
        $users = User::select('id', 'name')->orderBy('name')->get();
        return view('archives.index', compact('archives', 'searchTerm', 'users', 'searchUsers'));
    }

    public function create() {
        $autonumber = $this->archiveAutoNumber();
        return view('archives.create', compact('autonumber'));
    }

    public function store(Request $request) {
        $this->validate($request, [
            'number' => 'required|unique:archives,number',
            'title' => 'required|unique:archives,title',
            'body' => 'required',
        ]);

        $message = new Archive;
        $message->number = $request->input('number');
        $message->title = $request->input('title');
        $message->body = $request->input('body');
        $message->description = $request->input('description');
        $message->user_id = Auth::user()->id;
        $message->save();
        
        $request->session()->flash('alert-success', 'Archive was successful added!');
        return redirect()->route('archives.index');
    }

    public function show($id) {
        $archive = Archive::find($id);
        return view('archives.show', compact('archive'))->renderSections()['content'];
    }

    public function edit($id) {
        $archive = Archive::findOrFail($id);

        return view('archives.edit', compact('archive'));
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'number' => 'required|unique:archives,number,'.$id,
            'title' => 'required|unique:archives,title,'.$id,
            'body' => 'required',
        ]);

        $message = Archive::findOrFail($id);
        $message->number = $request->input('number');
        $message->title = $request->input('title');
        $message->body = $request->input('body');
        $message->description = $request->input('description');
        $message->user_id = Auth::user()->id;
        $message->save();

        $request->session()->flash('alert-success', 'Archive was successful updates!');
        return redirect()->route('archives.index');
    }

    public function destroy($id) {
        $archive = Archive::findOrFail($id);
        $archive->delete();
        Session::flash('alert-success', 'Archive was successful deleted!');
        return redirect()->route('archives.index');
    }

    private function archiveAutoNumber() {
        $lastNumber = '';
        $archiveNumber = Archive::select('number')->whereRaw('DATE(created_at) = DATE(NOW())')->orderBy('id', 'DESC')->limit(1)->first();
        if ($archiveNumber) {
            $lastNumber = substr($archiveNumber['number'], -2);
            $que = (int) $lastNumber;
            $que = $que + 1;
            $que = ''.$que;
            if(strlen($que) < 2) $que = '0'.$que;
            $lastNumber = date("Ymd").$que;
        } else {
            $lastNumber = date("Ymd").'01';
        }
        return 'AC'.$lastNumber;
    }
}
