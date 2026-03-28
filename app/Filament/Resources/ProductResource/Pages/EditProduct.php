<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Models\ProductImage;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Str;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['slug'] = Str::slug($data['name']);

        return $data;
    }

    protected function afterSave(): void
    {
        $record = $this->record;
        $data = $this->form->getState();

        if (isset($data['images']) && is_array($data['images'])) {
            $existingPaths = $record->images->pluck('image_path')->toArray();
            $newPaths = $data['images'];

            $pathsToDelete = array_diff($existingPaths, $newPaths);

            if (! empty($pathsToDelete)) {
                // ✅ Cukup delete dari database, file deletion handled by deleteUploadedFileUsing
                ProductImage::where('product_id', $record->id)
                    ->whereIn('image_path', $pathsToDelete)
                    ->delete();
            }

            $pathsToAdd = array_diff($newPaths, $existingPaths);

            foreach ($pathsToAdd as $path) {
                ProductImage::create([
                    'product_id' => $record->id,
                    'image_path' => $path,
                ]);
            }
        }
    }

    // Optional: Add this method to prepare the data before it's loaded into the form
    protected function mutateFormDataBeforeFill(array $data): array
    {
        // This step might not be necessary with the afterStateHydrated approach,
        // but it's good to have as a backup
        $record = $this->record;
        if ($record) {
            $data['images'] = $record->images->pluck('image_path')->toArray();
        }

        return $data;
    }
}
