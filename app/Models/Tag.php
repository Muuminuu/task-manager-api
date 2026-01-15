<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'color'
    ];

    public function boot()
    {
        parent::boot();

        static::creating(function ($tag){
            if (empty($tag->slug)) {
                $tag->slug = Str::slug($tag->name);
            }
        });
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }
}
