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
        $query->when($filters['search'] ?? false, fn ($query, $search) =>
            $query->where(fn($query) =>
                $query->where('title','like', '%' . $search .'%')
                ->orWhere('body','like', '%' . $search .'%')
            )
        );
        
        $query->when($filters['category'] ?? false, fn ($query, $category) =>
            $query->whereHas('category', fn($query) => 
                $query->where('slug', $category))
        
        // Alternative approach
            // $query
            //     ->whereExists( fn($query) =>
            //         $query->from('categories')
            //         ->whereColumn('categories.id', 'posts.category_id')
            //         ->where('categories.slug', $category))
        );
        $query->when($filters['author'] ?? false, fn ($query, $author) =>
            $query->whereHas('author', fn($query) => 
                $query->where('username', $author))
        );
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
