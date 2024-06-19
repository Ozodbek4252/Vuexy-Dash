<?php

namespace Database\Seeders;

use App\Models\Icon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class IconSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Delete existing intro images
        $folderPath = storage_path('app/public/icons');

        // Check if the folder exists
        if (File::isDirectory($folderPath)) {
            // Delete the folder and its contents
            File::deleteDirectory($folderPath);
        }

        // Copy the intro image to the storage directory
        $sourcePath = public_path('images/icons/twitter.svg');
        $destinationPath = storage_path('app/public/icons/twitter.svg');

        $path = null;

        if (File::exists($sourcePath)) {
            // Create the destination directory if it doesn't exist
            File::ensureDirectoryExists(dirname($destinationPath));

            // Copy the file to the storage directory
            File::copy($sourcePath, $destinationPath);

            $path = 'icons/twitter.svg';
        } elseif (File::exists($destinationPath)) {
            $path = 'icons/twitter.svg';
        }

        $icon1 = Icon::create([
            'name' => 'Twitter',
        ]);
        $icon1->images()->create([
            'path' => $path,
        ]);


        // Copy the intro image to the storage directory
        $sourcePath = public_path('images/icons/google.svg');
        $destinationPath = storage_path('app/public/icons/google.svg');
        if (File::exists($sourcePath)) {
            // Create the destination directory if it doesn't exist
            File::ensureDirectoryExists(dirname($destinationPath));

            // Copy the file to the storage directory
            File::copy($sourcePath, $destinationPath);

            $path = 'icons/google.svg';
        } elseif (File::exists($destinationPath)) {
            $path = 'icons/google.svg';
        }
        $icon2 = Icon::create([
            'name' => 'Google',
        ]);
        $icon2->images()->create([
            'path' => $path,
        ]);

        // Copy the intro image to the storage directory
        $sourcePath = public_path('images/icons/github.svg');
        $destinationPath = storage_path('app/public/icons/github.svg');
        if (File::exists($sourcePath)) {
            // Create the destination directory if it doesn't exist
            File::ensureDirectoryExists(dirname($destinationPath));

            // Copy the file to the storage directory
            File::copy($sourcePath, $destinationPath);

            $path = 'icons/github.svg';
        } elseif (File::exists($destinationPath)) {
            $path = 'icons/github.svg';
        }
        $icon3 = Icon::create([
            'name' => 'Github',
        ]);
        $icon3->images()->create([
            'path' => $path,
        ]);

        // Copy the intro image to the storage directory
        $sourcePath = public_path('images/icons/facebook.svg');
        $destinationPath = storage_path('app/public/icons/facebook.svg');
        if (File::exists($sourcePath)) {
            // Create the destination directory if it doesn't exist
            File::ensureDirectoryExists(dirname($destinationPath));

            // Copy the file to the storage directory
            File::copy($sourcePath, $destinationPath);

            $path = 'icons/facebook.svg';
        } elseif (File::exists($destinationPath)) {
            $path = 'icons/facebook.svg';
        }
        $icon4 = Icon::create([
            'name' => 'Facebook',
        ]);
        $icon4->images()->create([
            'path' => $path,
        ]);

        // Copy the intro image to the storage directory
        $sourcePath = public_path('images/icons/vue.png');
        $destinationPath = storage_path('app/public/icons/vue.png');
        if (File::exists($sourcePath)) {
            // Create the destination directory if it doesn't exist
            File::ensureDirectoryExists(dirname($destinationPath));

            // Copy the file to the storage directory
            File::copy($sourcePath, $destinationPath);

            $path = 'icons/vue.png';
        } elseif (File::exists($destinationPath)) {
            $path = 'icons/vue.png';
        }
        $icon5 = Icon::create([
            'name' => 'Vue',
        ]);
        $icon5->images()->create([
            'path' => $path,
        ]);

        // Copy the intro image to the storage directory
        $sourcePath = public_path('images/icons/visa.png');
        $destinationPath = storage_path('app/public/icons/visa.png');
        if (File::exists($sourcePath)) {
            // Create the destination directory if it doesn't exist
            File::ensureDirectoryExists(dirname($destinationPath));

            // Copy the file to the storage directory
            File::copy($sourcePath, $destinationPath);

            $path = 'icons/visa.png';
        } elseif (File::exists($destinationPath)) {
            $path = 'icons/visa.png';
        }
        $icon6 = Icon::create([
            'name' => 'Visa',
        ]);
        $icon6->images()->create([
            'path' => $path,
        ]);

        // Copy the intro image to the storage directory
        $sourcePath = public_path('images/icons/social-label.png');
        $destinationPath = storage_path('app/public/icons/social-label.png');
        if (File::exists($sourcePath)) {
            // Create the destination directory if it doesn't exist
            File::ensureDirectoryExists(dirname($destinationPath));

            // Copy the file to the storage directory
            File::copy($sourcePath, $destinationPath);

            $path = 'icons/social-label.png';
        } elseif (File::exists($destinationPath)) {
            $path = 'icons/social-label.png';
        }
        $icon7 = Icon::create([
            'name' => 'Social',
        ]);
        $icon7->images()->create([
            'path' => $path,
        ]);

        // Copy the intro image to the storage directory
        $sourcePath = public_path('images/icons/pdf.png');
        $destinationPath = storage_path('app/public/icons/pdf.png');
        if (File::exists($sourcePath)) {
            // Create the destination directory if it doesn't exist
            File::ensureDirectoryExists(dirname($destinationPath));

            // Copy the file to the storage directory
            File::copy($sourcePath, $destinationPath);

            $path = 'icons/pdf.png';
        } elseif (File::exists($destinationPath)) {
            $path = 'icons/pdf.png';
        }
        $icon8 = Icon::create([
            'name' => 'pdf',
        ]);
        $icon8->images()->create([
            'path' => $path,
        ]);

        // Copy the intro image to the storage directory
        $sourcePath = public_path('images/icons/mastercard.png');
        $destinationPath = storage_path('app/public/icons/mastercard.png');
        if (File::exists($sourcePath)) {
            // Create the destination directory if it doesn't exist
            File::ensureDirectoryExists(dirname($destinationPath));

            // Copy the file to the storage directory
            File::copy($sourcePath, $destinationPath);

            $path = 'icons/mastercard.png';
        } elseif (File::exists($destinationPath)) {
            $path = 'icons/mastercard.png';
        }
        $icon9 = Icon::create([
            'name' => 'Master Card',
        ]);
        $icon9->images()->create([
            'path' => $path,
        ]);

        // Copy the intro image to the storage directory
        $sourcePath = public_path('images/icons/linkedin.png');
        $destinationPath = storage_path('app/public/icons/linkedin.png');
        if (File::exists($sourcePath)) {
            // Create the destination directory if it doesn't exist
            File::ensureDirectoryExists(dirname($destinationPath));

            // Copy the file to the storage directory
            File::copy($sourcePath, $destinationPath);

            $path = 'icons/linkedin.png';
        } elseif (File::exists($destinationPath)) {
            $path = 'icons/linkedin.png';
        }
        $icon10 = Icon::create([
            'name' => 'LinkedIn',
        ]);
        $icon10->images()->create([
            'path' => $path,
        ]);

        // Copy the intro image to the storage directory
        $sourcePath = public_path('images/icons/json.png');
        $destinationPath = storage_path('app/public/icons/json.png');
        if (File::exists($sourcePath)) {
            // Create the destination directory if it doesn't exist
            File::ensureDirectoryExists(dirname($destinationPath));

            // Copy the file to the storage directory
            File::copy($sourcePath, $destinationPath);

            $path = 'icons/json.png';
        } elseif (File::exists($destinationPath)) {
            $path = 'icons/json.png';
        }
        $icon11 = Icon::create([
            'name' => 'JSON',
        ]);
        $icon11->images()->create([
            'path' => $path,
        ]);

        // Copy the intro image to the storage directory
        $sourcePath = public_path('images/icons/doc.png');
        $destinationPath = storage_path('app/public/icons/doc.png');
        if (File::exists($sourcePath)) {
            // Create the destination directory if it doesn't exist
            File::ensureDirectoryExists(dirname($destinationPath));

            // Copy the file to the storage directory
            File::copy($sourcePath, $destinationPath);

            $path = 'icons/doc.png';
        } elseif (File::exists($destinationPath)) {
            $path = 'icons/doc.png';
        }
        $icon12 = Icon::create([
            'name' => 'doc',
        ]);
        $icon12->images()->create([
            'path' => $path,
        ]);

        // Copy the intro image to the storage directory
        $sourcePath = public_path('images/icons/drive.png');
        $destinationPath = storage_path('app/public/icons/drive.png');
        if (File::exists($sourcePath)) {
            // Create the destination directory if it doesn't exist
            File::ensureDirectoryExists(dirname($destinationPath));

            // Copy the file to the storage directory
            File::copy($sourcePath, $destinationPath);

            $path = 'icons/drive.png';
        } elseif (File::exists($destinationPath)) {
            $path = 'icons/drive.png';
        }
        $icon13 = Icon::create([
            'name' => 'Drive',
        ]);
        $icon13->images()->create([
            'path' => $path,
        ]);
    }
}
