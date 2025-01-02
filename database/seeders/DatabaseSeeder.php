<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //  \App\Models\User::factory(5)->create();


        //! 001 => User and Admin account
        \App\Models\User::factory()->create([
            'name' => 'Marwan Yasser',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
            'isAdmin' => 1,
            'phone' => '01074392440',

        ]);

        \App\Models\User::factory()->create([
            'name' => 'Murad Ali',
            'email' => 'user@test.com',
            'password' => Hash::make('password'),
            'isAdmin' => 0,
            'phone' => '01005501825',

        ]);


        //! 002 => Locations factory
        \App\Models\Area::factory()->create([
        'name' => 'Delta',
        'shipmentPrice' => 100,


         ]);
        \App\Models\Governate::factory()->create([
            'name' => 'Dakhlia',
            'area_id' => 1,


        ]);
        \App\Models\City::factory()->create([
            'name' => 'Mansuora',
            'governate_id' => 1,
        ]);

        \App\Models\Hub::factory()->create([
            'name_ar' => 'المنصورة',
            'city_id' => 1,
            'address' => 'المنصورة',
        ]);

        \App\Models\Map::factory()->create([
        'hub_id' => 1,
        'map' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d16260.557367986423!2d31.396591276144594!3d31.04404553345957!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14f79db7a9053547%3A0xf8dab3bbed766c97!2z2KfZhNmF2YbYtdmI2LHYqdiMINin2YTZhdmG2LXZiNix2KkgKNmC2LPZhSAyKdiMINin2YTZhdmG2LXZiNix2KnYjCDZhdit2KfZgdi42Kkg2KfZhNiv2YLZh9mE2YrYqQ!5e0!3m2!1sar!2seg!4v1735839602739!5m2!1sar!2seg'
        ]);
    }
}
