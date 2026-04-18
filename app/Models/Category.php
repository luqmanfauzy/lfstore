<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $guarded= ['id'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
    
    public static function boot()
    {
        parent::boot();

        // Slug otomatis saat membuat
        static::creating(function ($category) {
            $slug = Str::slug($category->category_name);
            $count = Category::where('slug', 'LIKE', "{$slug}%")->count();
            $category->slug = $count ? "{$slug}-{$count}" : $slug;
        });

        // Slug otomatis saat update jika category_name berubah
        static::updating(function ($category) {
            if ($category->isDirty('category_name')) {
                $slug = Str::slug($category->category_name);
                $count = Category::where('slug', 'LIKE', "{$slug}%")
                    ->where('id', '!=', $category->id)
                    ->count();

                $category->slug = $count ? "{$slug}-{$count}" : $slug;
            }
        });
    }
}
