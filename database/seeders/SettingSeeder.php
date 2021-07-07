<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'email'=>'contact@skillsHub.com',
            'phone'=>'1234567890',
            'facebook'=>'https://www.facebook.com',
            'youtube'=>'https://www.youtube.com',
            'twitter'=>'https://www.twitter.com',
            'linkedin'=>'https://www.linkedin.com',
            'instagram'=>'https://www.instagram.com',
        ]);
    }
}
