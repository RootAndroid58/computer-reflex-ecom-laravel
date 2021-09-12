<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\SupportTicketMsg;

class SupportTicket extends Model
{
    use HasFactory;

    protected $primaryKey = "id";
    public $incrementing = false;


    public function msgs()
    {
        return $this->hasMany(SupportTicketMsg::class, 'ticket_id', 'id')->orderBy('id', 'asc');
    }
    
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}
