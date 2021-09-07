<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class SupportTicketMsg extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id')->orderBy('id', 'desc');
    }

    public function getAttachmentsAttribute($val)
    {
        return $this->attributes['attachments_arr'] = unserialize($val);
    }

}
