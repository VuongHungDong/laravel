<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'price',
        'quantity',
        'view',
        'category_id',
    ];

    /**
     * Use slug for route model binding
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Boot method: auto-generate slug on create/update
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = static::generateUniqueSlug($product->name);
            }
        });

        static::updating(function ($product) {
            if ($product->isDirty('name') && !$product->isDirty('slug')) {
                $product->slug = static::generateUniqueSlug($product->name, $product->id);
            }
        });
    }

    /**
     * Generate a unique slug
     */
    public static function generateUniqueSlug(string $name, ?int $excludeId = null): string
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        $query = static::where('slug', $slug);
        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        while ($query->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
            $query = static::where('slug', $slug);
            if ($excludeId) {
                $query->where('id', '!=', $excludeId);
            }
        }

        return $slug;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Register media collections
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('product-images')
            ->useFallbackUrl(asset('images/products/placeholder.jpg'))
            ->singleFile(); // One main image per product
    }

    /**
     * Register media conversions (thumbnails, etc.)
     */
    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(300)
            ->sharpen(10)
            ->nonQueued();

        $this->addMediaConversion('medium')
            ->width(800)
            ->height(800)
            ->sharpen(5)
            ->nonQueued();
    }

    /**
     * Check if product has any image (Media Library, local file, or URL)
     */
    public function hasImage(): bool
    {
        // 1. Check Media Library
        if ($this->hasMedia('product-images')) {
            return true;
        }

        // 2. Check local file
        $extensions = ['jpg', 'png', 'jpeg', 'webp'];
        foreach ($extensions as $ext) {
            $path = 'images/products/' . $this->id . '.' . $ext;
            if (file_exists(public_path($path))) {
                return true;
            }
        }

        // 3. Check URL in database
        return !empty($this->image);
    }

    /**
     * Get display image URL with priority:
     * 1. Media Library → 2. Local file → 3. External URL → 4. Placeholder
     */
    public function displayImage($width = 800, $height = null): string
    {
        // 1. Media Library
        if ($this->hasMedia('product-images')) {
            $media = $this->getFirstMedia('product-images');
            $conversion = $width <= 300 ? 'thumb' : ($width <= 800 ? 'medium' : '');
            if ($media && $conversion && $media->hasGeneratedConversion($conversion)) {
                return $media->getUrl($conversion);
            }
            return $this->getFirstMediaUrl('product-images');
        }

        // 2. Local file
        $extensions = ['jpg', 'png', 'jpeg', 'webp'];
        foreach ($extensions as $ext) {
            $path = 'images/products/' . $this->id . '.' . $ext;
            if (file_exists(public_path($path))) {
                return asset($path);
            }
        }

        // 3. External URL (Unsplash, etc.)
        if ($this->image && str_starts_with($this->image, 'http')) {
            $baseUrl = explode('?', $this->image)[0];
            $url = $baseUrl . '?auto=format&fit=crop&q=80&w=' . $width;
            if ($height) {
                $url .= '&h=' . $height;
            }
            return $url;
        }

        // 4. Relative path in image column
        if ($this->image && !str_starts_with($this->image, 'http')) {
            return asset($this->image);
        }

        // 5. Placeholder
        return asset('images/products/placeholder.jpg');
    }
}
