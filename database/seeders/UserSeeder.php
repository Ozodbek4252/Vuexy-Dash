<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\File;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Ozodbek Jo\'rayev',
            'email' => 'ozodbek@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => Role::where('slug', 'owner')->first()->id,
            'image' => 'avatars/11.png',
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => Role::where('slug', 'admin')->first()->id,
            'image' => 'avatars/user-02.jpg',
        ]);

        // Specify the folder path
        $folderPath = public_path('images/avatars');

        $files = File::files($folderPath);

        $images = array_filter($files, function ($file) {
            return in_array(strtolower($file->getExtension()), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']);
        });

        // Get all files from the folder
        $files = File::files($folderPath);

        for ($i = 0; $i < 15; $i++) {
            $name = fake()->name();
            $email = Str::slug($name) . '@gmail.com';

            if (empty($images)) {
                $image = 'images/avatars/user-regular-204.png';
            }

            $image = $images[array_rand($images)];
            $relativeImagePath = str_replace(public_path() . '/images/', '', $image->getPathname());

            User::create([
                'name' => $name,
                'email' => $email,
                'password' => bcrypt('password'),
                'role_id' => Role::where('slug', 'regular')->first()->id,
                'image' => $relativeImagePath
            ]);
        }
    }
}
