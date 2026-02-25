<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedbacks';

    protected $fillable = ['complaint_id', 'admin_id', 'content'];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
