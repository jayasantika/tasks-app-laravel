<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'category_id',
        'user_id',
        'status',
        'deadline'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function isLate()
    {
        return $this->deadline && $this->deadline < now() && $this->status != 'done';
    }

    public function isCompletedLate()
    {
        return $this->completed_at && $this->deadline && $this->completed_at > $this->deadline;
    }

    public function isDone()
    {
        return $this->status == 'done';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
