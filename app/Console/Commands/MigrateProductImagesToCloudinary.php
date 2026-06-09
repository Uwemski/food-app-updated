<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class MigrateProductImagesToCloudinary extends Command
{
    protected $signature = 'images:migrate-products';

    protected $description = 'Move existing product images to Cloudinary';

    public function handle()
    {
        Product::chunk(100, function ($products) {

            foreach ($products as $product) {

                if (!$product->image) {
                    continue;
                }

                // Skip already migrated records
                if (str_starts_with($product->image, 'http')) {
                    continue;
                }

                $localPath = storage_path('app/public/products/' . ltrim($product->image, '/'));

                if (!file_exists($localPath)) {

                    $this->error(
                        "Missing file: {$localPath}"
                    );

                    continue;
                }

                try {

                    $upload = Cloudinary::upload($localPath, [
                        'folder' => 'products'
                    ]);

                    $imageUrl = $upload['secure_url'] ?? null;

                    if (!$imageUrl) {
                        $this->error("Cloudinary upload failed for Product #{$product->id}");
                        continue;
                    }

                    $product->update([
                        'image' => $upload->getSecurePath()
                    ]);

                    $this->info(
                        "Migrated Product #{$product->id}"
                    );

                } catch (\Throwable $e) {

                    $this->error(
                        "Failed Product #{$product->id}: {$e->getMessage()}"
                    );
                }
            }
        });

        $this->info('Migration complete.');

        return self::SUCCESS;
    }
}