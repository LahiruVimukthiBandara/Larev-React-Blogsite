<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder {
    /**
    * Run the database seeds.
    */

    public function run(): void {
        $categories = [
            'Technology',
            'Health & Wellness',
            'Education',
            'Fashion',
            'Travel',
            'Food',
        ];

        foreach ( $categories as $name ) {
            DB::table( 'categories' )->insert( [
                'name' => $name,
                'slug' => Str::slug( $name ),
                'created_at' => now(),
                'updated_at' => now(),
            ] );
        }
    }
}
