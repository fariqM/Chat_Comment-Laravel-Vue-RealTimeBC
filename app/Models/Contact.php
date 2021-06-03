<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    public function has_user(){
        return $this->belongsTo(User::class);
    }

    public function has_owner(){
        return $this->belongsTo(User::class, 'owner_id', 'id', 'owner_id');
    }

    public function conversation(){
        return $this->belongsTo(Conversation::class);
    }
    

}
