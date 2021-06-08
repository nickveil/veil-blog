<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use HasFactory;

    protected $gaurded = [];

    protected $with = ['category','author'];

    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query
                ->where('title','like', '%' . request('search') .'%')
                ->orWhere('body','like', '%' . request('search') .'%');
        }
    }

    // Alternate method for solving n+1 problem, also see the Routes\web file. 
    // Caveate is you are constanly loading relationships even when you don't 
    // need them. 

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
