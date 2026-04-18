<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Spatie\Image\Enums\Fit;
use Spatie\Image\Enums\ImageDriver;
use Spatie\Image\Image;
use Filament\Forms\Components\FileUpload;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('categories')
                    ->relationship('categories', 'category_name')
                    ->multiple()
                    ->required()
                    ->native(false),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->unique(Product::class, 'name', fn ($record) => $record),
                Forms\Components\Toggle::make('is_display')
                    ->label('Display in Catalog')
                    ->default(true)
                    ->required(),
                Forms\Components\TextInput::make('price')->numeric()->required(),
                Forms\Components\TextInput::make('stock')->numeric()->required(),
                Forms\Components\RichEditor::make('description')
                    ->required()
                    ->columnSpan(['sm' => 2])
                    ->disableToolbarButtons([
                        'attachFiles',
                        'codeBlock',
                        'h1',
                        'h2',
                        'h3',
                        'quote',
                        'clearFormatting',
                        'indent',
                        'outdent',
                    ]),
                Forms\Components\FileUpload::make('image_thumbnail')
                    ->label('Thumbnail')
                    ->image()
                    ->imageResizeTargetWidth('1024')
                    ->imageResizeTargetHeight('1024')
                    ->maxSize(102400)
                    ->directory('products/thumbnails')
                    ->disk('public')
                    ->visibility('public')
                    ->getUploadedFileUsing(function (FileUpload $component, string $file): ?array {
                        if (! Storage::disk('public')->exists($file)) {
                            return null;
                        }

                        return [
                            'name' => basename($file),
                            'size' => Storage::disk('public')->size($file),
                            'type' => 'image/webp',
                            'url' => Storage::disk('public')->url($file),
                        ];
                    })
                    ->saveUploadedFileUsing(function (TemporaryUploadedFile $file): string {
                        $filename = uniqid('thumb_').'.webp';
                        $storagePath = storage_path('app/public/products/thumbnails/'.$filename);

                        Storage::disk('public')->makeDirectory('products/thumbnails');

                        Image::useImageDriver(ImageDriver::Gd)
                            ->load($file->getRealPath())
                            ->fit(Fit::Crop, 1024, 1024)
                            ->optimize()
                            ->save($storagePath);

                        return 'products/thumbnails/'.$filename;
                    }),

                Forms\Components\FileUpload::make('images')
                    ->label('Gambar Produk')
                    ->multiple()
                    ->image()
                    ->imageResizeTargetWidth('1024')
                    ->imageResizeTargetHeight('1024')
                    ->maxSize(102400)
                    ->panelLayout('grid')
                    ->directory('products/images')
                    ->disk('public')
                    ->visibility('public')
                    ->getUploadedFileUsing(function (FileUpload $component, string $file): ?array {
                        if (! Storage::disk('public')->exists($file)) {
                            return null;
                        }

                        return [
                            'name' => basename($file),
                            'size' => Storage::disk('public')->size($file),
                            'type' => 'image/webp',
                            'url' => Storage::disk('public')->url($file),
                        ];
                    })
                    ->saveUploadedFileUsing(function (TemporaryUploadedFile $file): string {
                        $filename = uniqid('img_').'.webp';
                        $storagePath = storage_path('app/public/products/images/'.$filename);

                        Storage::disk('public')->makeDirectory('products/images');

                        Image::useImageDriver(ImageDriver::Gd)
                            ->load($file->getRealPath())
                            ->fit(Fit::Max, 1024, 1024)
                            ->optimize()
                            ->save($storagePath);

                        return 'products/images/'.$filename;
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('Nama produk disalin')
                    ->copyMessageDuration(1500),
                Tables\Columns\ToggleColumn::make('is_display')
                    ->label('Display in Catalog'),
                Tables\Columns\TextColumn::make('categories.category_name')
                    ->badge()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('image_thumbnail'),
                Tables\Columns\TextColumn::make('price')->money('IDR')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextInputColumn::make('stock')
                    ->sortable()
                    ->rules(['required', 'integer', 'min:0']),
            ])
            ->filters([
                SelectFilter::make('categories')
                    ->relationship('categories', 'category_name')
                    ->multiple()
                    ->preload(),
                SelectFilter::make('stock')
                    ->native(false)
                    ->label('Stock')
                    ->options([
                        'in_stock' => '> 2',
                        'out_of_stock' => '0',
                        'low_stock' => '< 2',
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        // Check if a value is selected
                        if (empty($data['value'])) {
                            return $query;
                        }

                        // Apply the appropriate filter based on the selected value
                        return match ($data['value']) {
                            'out_of_stock' => $query->where('stock', 0),
                            'low_stock' => $query->where('stock', '<', 3)->where('stock', '>', 0),
                            'in_stock' => $query->where('stock', '>=', 3),
                            default => $query,
                        };
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
