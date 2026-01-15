<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Task extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'priority',
        'status',
        'due_date',
        'completed_at'
    ];
    
    protected $casts = [
        'due_date' => 'date',
        'completed_at' => 'datetime'
    ];
        
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'priority' => $thos->priority
        ];
    }

    // TODO Scopes 
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopePending($query)
    {
        return $query->whereIn('status', ['todo', 'in_progress']);
    }

    public function scopeOverdue($query)
    {
        return $query->where('dur_date', '<', now())
            ->where('status', '!=', 'completed');
    }
}
