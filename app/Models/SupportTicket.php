<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\SupportTicketMsg;

class SupportTicket extends Model
{
    use HasFactory;

    public function msgs()
    {
        return $this->hasMany(SupportTicketMsg::class, 'ticket_id', 'id')->orderBy('id', 'desc');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}
