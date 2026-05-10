<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('slug', 300)->nullable()->after('name');
        });

        // Generate slugs for existing products
        $products = \DB::table('products')->get();
        foreach ($products as $product) {
            $slug = Str::slug($product->name);
            // Ensure uniqueness
            $originalSlug = $slug;
            $counter = 1;
            while (\DB::table('products')->where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }
            \DB::table('products')->where('id', $product->id)->update(['slug' => $slug]);
        }

        Schema::table('products', function (Blueprint $table) {
            $table->string('slug', 300)->unique()->nullable(false)->change();
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
