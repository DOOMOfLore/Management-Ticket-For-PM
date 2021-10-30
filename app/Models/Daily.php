<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daily extends Model
{
    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public static function scopeSearch($query, $searchTerm, $searchUsers) {
        if(isset($searchUsers)){
            return $query->where(function ($qu) use ($searchTerm) {
                            $qu->where('number', 'like', '%'. $searchTerm .'%')
                            ->orWhere('title', 'like', '%'. $searchTerm .'%');
                        })
                        ->whereHas('user', function($que) use ($searchUsers) {
                            $que->whereIn('user_id', $searchUsers);
                         });
        } else {
            return $query->where('number', 'like', '%'. $searchTerm .'%')
                     ->orWhere('title', 'like', '%'. $searchTerm .'%');
        }
    }
}
