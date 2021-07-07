<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;

use App\User;
use App\TicketMember;
use Session;

class TicketController extends Controller {
    
    public function __construct() {
        $this->middleware(['auth']);
    }

    public function index(Request $request) {
        $searchTerm = $request->input('searchTerm');
        $searchUsers = $request->input('searchUsers');
        $tickets = Ticket::with('users')->search($searchTerm, $searchUsers)->paginate(20);
        $tickets->appends(['searchTerm' => $searchTerm, 'searchUsers' => $searchUsers]);
        $users = User::select('id', 'name')->orderBy('name')->get();
        return view('tickets.index', compact('tickets', 'searchTerm', 'users', 'searchUsers'));
    }

    public function create() {
        $autonumber = $this->ticketAutoNumber();
        $users = User::select('id', 'name')->orderBy('name')->get();
        return view('tickets.create', compact('autonumber', 'users'));
    }

    public function store(Request $request) {
        $this->validate($request, [
            'number' => 'required|unique:tickets,number',
            'title' => 'required|unique:tickets,title',
            'users' => 'required',
        ]);

        $message = new Ticket;
        $message->number = $request->input('number');
        $message->title = $request->input('title');
        $message->description = $request->input('description');
        $message->save();

        $users = $request['users']; 

        if (isset($users)) {
            $message->users()->sync($users);
        } else {
            $message->users()->detach();
        }
        
        $request->session()->flash('alert-success', 'Ticket was successful added!');
        return redirect()->route('tickets.index');
    }

    public function show($id) {
        return redirect('tickets');
    }

    public function edit($id) {
        $ticket = Ticket::findOrFail($id);
        $users = User::get();

        return view('tickets.edit', compact('ticket', 'users'));
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'number' => 'required|unique:tickets,number,'.$id,
            'title' => 'required|unique:tickets,title,'.$id,
            'users' => 'required',
        ]);

        $message = Ticket::findOrFail($id);
        $message->number = $request->input('number');
        $message->title = $request->input('title');
        $message->description = $request->input('description');
        $message->save();

        $users = $request['users']; 

        if (isset($users)) {
            $message->users()->sync($users);
        } else {
            $message->users()->detach();
        }

        $request->session()->flash('alert-success', 'Ticket was successful updates!');
        return redirect()->route('tickets.index');
    }

    public function destroy($id) {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();
        Session::flash('alert-success', 'Ticket was successful deleted!');
        return redirect()->route('tickets.index');
    }

    private function ticketAutoNumber() {
        $lastNumber = '';
        $ticketNumber = Ticket::select('number')->whereRaw('DATE(created_at) = DATE(NOW())')->orderBy('id', 'DESC')->limit(1)->first();
        if ($ticketNumber) {
            $lastNumber = substr($ticketNumber['number'], -2);
            $que = (int) $lastNumber;
            $que = $que + 1;
            $que = ''.$que;
            if(strlen($que) < 2) $que = '0'.$que;
            $lastNumber = date("ymd").$que;
        } else {
            $lastNumber = date("ymd").'01';
        }
        return $lastNumber;
    }

}
