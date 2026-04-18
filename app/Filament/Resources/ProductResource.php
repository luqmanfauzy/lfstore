<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ProductResource\Pages;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Support\Facades\Storage;

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
                    ->unique(Product::class, 'name', fn($record) => $record),
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
                    ->maxSize(102400) // 100MB limit for Filament (bypass)
                    ->directory('products/thumbnails')
                    ->disk('public')
                    ->visibility('public')
                    ->saveUploadedFileUsing(function (TemporaryUploadedFile $file): string {
                        $img = @imagecreatefromstring(file_get_contents($file->getRealPath()));
                        if (!$img) {
                            return $file->store('products/thumbnails', 'public');
                        }
                        
                        // Preserve transparency for PNGs
                        imagepalettetotruecolor($img);
                        imagealphablending($img, false);
                        imagesavealpha($img, true);

                        ob_start();
                        imagewebp($img, null, 75);
                        $binary = ob_get_clean();
                        imagedestroy($img);
                        
                        $filename = uniqid('thumb_') . '.webp';
                        Storage::disk('public')->put('products/thumbnails/' . $filename, $binary);
                        
                        return 'products/thumbnails/' . $filename;
                    }),

                Forms\Components\FileUpload::make('images')
                    ->label('Gambar Produk')
                    ->multiple()
                    ->image()
                    ->imageResizeTargetWidth('1024')
                    ->imageResizeTargetHeight('1024')
                    ->maxSize(102400) // 100MB limit for Filament (bypass)
                    ->panelLayout('grid')
                    ->directory('products/images')
                    ->disk('public')
                    ->visibility('public')
                    ->saveUploadedFileUsing(function (TemporaryUploadedFile $file): string {
                        $img = @imagecreatefromstring(file_get_contents($file->getRealPath()));
                        if (!$img) {
                            return $file->store('products/images', 'public');
                        }
                        
                        // Preserve transparency for PNGs
                        imagepalettetotruecolor($img);
                        imagealphablending($img, false);
                        imagesavealpha($img, true);

                        ob_start();
                        imagewebp($img, null, 75);
                        $binary = ob_get_clean();
                        imagedestroy($img);
                        
                        $filename = uniqid('img_') . '.webp';
                        Storage::disk('public')->put('products/images/' . $filename, $binary);
                        
                        return 'products/images/' . $filename;
                    })
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
                    ->rules(['required', 'integer', 'min:0'])
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
                        'low_stock' => '< 2'
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
