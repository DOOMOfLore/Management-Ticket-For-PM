<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TicketMember;

class Ticket extends Model {
    
    public function users() {
        return $this->belongsToMany('App\User', 'ticket_user');
    }

    public static function scopeSearch($query, $searchTerm, $searchUsers) {
        if(isset($searchUsers)){
            return $query->where(function ($qu) use ($searchTerm) {
                            $qu->where('number', 'like', '%'. $searchTerm .'%')
                            ->orWhere('title', 'like', '%'. $searchTerm .'%')
                            ->orWhere('description', 'like', '%'. $searchTerm .'%');
                        })
                        ->whereHas('users', function($que) use ($searchUsers) {
                            $que->whereIn('user_id', $searchUsers);
                         });
        } else {
            return $query->where('number', 'like', '%'. $searchTerm .'%')
                     ->orWhere('title', 'like', '%'. $searchTerm .'%')
                     ->orWhere('description', 'like', '%'. $searchTerm .'%');
        }
    }
}
