<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('blog_posts')
            ->where('is_published', false)
            ->update([
                'is_published' => true,
                'published_at' => now(),
                'updated_at' => now(),
            ]);

        DB::table('blog_posts')
            ->whereNull('published_at')
            ->update([
                'published_at' => now(),
                'updated_at' => now(),
            ]);
    }

    public function down(): void
    {
        //
    }
};
