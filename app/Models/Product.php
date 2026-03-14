<?php

namespace App\Models;

use Storage;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'is_available',
        'image_thumbnail',
        'is_display'
    ];

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function category()
    {
        return $this->BelongsTo(Category::class);
    }

    public static function boot()
    {
        parent::boot();

        // Slug otomatis saat membuat
        static::creating(function ($product) {
            $slug = Str::slug($product->name);
            $count = Product::where('slug', 'LIKE', "{$slug}%")->count();
            $product->slug = $count ? "{$slug}-{$count}" : $slug;
        });

        // Slug otomatis saat update jika name berubah
        static::updating(function ($product) {
            if ($product->isDirty('name')) {
                $slug = Str::slug($product->name);
                $count = Product::where('slug', 'LIKE', "{$slug}%")
                    ->where('id', '!=', $product->id)
                    ->count();

                $product->slug = $count ? "{$slug}-{$count}" : $slug;
            }
        });
    }

    protected static function booted()
    {
        static::deleting(function ($product) {
            if ($product->image_thumbnail) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($product->image_thumbnail);
            }

            foreach ($product->images as $image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($image->image_path);
                $image->delete();
            }
        });
    }

}
