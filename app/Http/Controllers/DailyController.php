<?php

namespace App\Http\Controllers;

use App\Models\Daily;
use Illuminate\Http\Request;

use Auth;
use App\User;
use Session;

class DailyController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }

    public function index(Request $request) {
        $searchTerm = $request->input('searchTerm');
        $searchUsers = $request->input('searchUsers');
        $dailys = Daily::with('user')->search($searchTerm, $searchUsers)->paginate(20);
        $dailys->appends(['searchTerm' => $searchTerm, 'searchUsers' => $searchUsers]);
        $users = User::select('id', 'name')->orderBy('name')->get();
        return view('dailys.index', compact('dailys', 'searchTerm', 'users', 'searchUsers'));
    }

    public function create(Request $request) {
        $autonumber = $this->dailyAutoNumber();
        return view('dailys.create', compact('autonumber'));
    }

    public function store(Request $request) {
        $this->validate($request, [
            'number' => 'required|unique:dailies,number',
            'title' => 'required|unique:dailies,title',
            'body' => 'required',
        ]);

        $message = new Daily;
        $message->number = $request->input('number');
        $message->title = $request->input('title');
        $message->body = $request->input('body');
        $message->description = $request->input('description');
        $message->user_id = Auth::user()->id;
        $message->save();

        $request->session()->flash('alert-success', 'Daily was successful added!');
        return redirect()->route('dailys.index');
    }

    private function dailyAutoNumber() {
        $lastNumber = '';
        $dailyNumber = Daily::select('number')->whereRaw('DATE(created_at) = DATE(NOW())')->orderBy('id', 'DESC')->limit(1)->first();
        if ($dailyNumber) {
            $lastNumber = substr($dailyNumber['number'], -2);
            $que = (int) $lastNumber;
            $que = $que + 1;
            $que = ''.$que;
            if(strlen($que) < 2) $que = '0'.$que;
            $lastNumber = date("Ymd").$que;
        } else {
            $lastNumber = date("Ymd").'01';
        }
        return 'MP'.$lastNumber;
    }

    public function show($id) {
        $daily = Daily::find($id);
        return view('dailys.show', compact('daily'))->renderSections()['content'];
    }

    public function edit($id) {
        $daily = Daily::findOrFail($id);
        return view('dailys.edit', compact('daily'));
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'number' => 'required|unique:dailies,number,'.$id,
            'title' => 'required|unique:dailies,title,'.$id,
            'body' => 'required',
        ]);

        $message = Daily::findOrFail($id);
        $message->number = $request->input('number');
        $message->title = $request->input('title');
        $message->body = $request->input('body');
        $message->description = $request->input('description');
        $message->user_id = Auth::user()->id;
        $message->save();

        $request->session()->flash('alert-success', 'Archive was successful updates!');
        return redirect()->route('dailys.index');
    }

    public function destroy($id) {
        $daily = Daily::findOrFail($id);
        $daily->delete();
        Session::flash('alert-success', 'Archive was successful deleted!');
        return redirect()->route('dailys.index');
    }
}
