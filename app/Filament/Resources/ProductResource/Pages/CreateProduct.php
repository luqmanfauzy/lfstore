<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Models\ProductImage;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;
    
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['slug'] = Str::slug($data['name']);
        return $data;
    }
    
    protected function afterCreate(): void
    {
        $record = $this->record;
        $data = $this->form->getState();
        
        // Handle product images
        if (!empty($data['images']) && is_array($data['images'])) {
            foreach ($data['images'] as $path) {
                ProductImage::create([
                    'product_id' => $record->id,
                    'image_path' => $path,
                ]);
            }
        }
    }
}