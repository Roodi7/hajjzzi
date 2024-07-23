<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\ContactSectionInfo;
use App\Models\Permission;
use App\Models\Section;
use App\Models\Settings;
use Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'test@example.com',
            'password' => Hash::make('admin'),
            'role' => 'admin',

        ]);
        City::factory(10)->create();
        Settings::create();
        Permission::create([
            'user_id' => 1,
            'city_index' => 1,
            'city_create' => 1,
            'city_edit' => 1,
            'city_delete' => 1,
            'accomodation_index' => 1,
            'accomodation_create' => 1,
            'accomodation_edit' => 1,
            'accomodation_delete' => 1,
            'feature_index' => 1,
            'feature_create' => 1,
            'feature_edit' => 1,
            'feature_delete' => 1,
            'term_index' => 1,
            'term_create' => 1,
            'term_edit' => 1,
            'term_delete' => 1,
            'manage_mainpage' => 1,
            'manage_mails' => 1,
        ]);

        ContactSectionInfo::create([
            'title' => 'Contact Us Heading Title',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
        ]);
        Section::create([
            'hotels_description' => 'Default hotels description',
            'hotels_image' => 'default_hotels_image.jpg',
            'chalets_description' => 'Default chalets description',
            'chalets_image' => 'default_chalets_image.jpg',
            'halls_description' => 'Default halls description',
            'halls_image' => 'default_halls_image.jpg',
            'appartments_description' => 'Default appartments description',
            'appartments_image' => 'default_appartments_image.jpg',
        ]);

    }
}
