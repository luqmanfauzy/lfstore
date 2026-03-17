<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvoiceResource\Pages;
use App\Models\Invoice;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Transactions';
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Invoice Details')
                    ->schema([
                        Forms\Components\TextInput::make('invoice')
                            ->label('Invoice Number')
                            ->disabled()
                            ->dehydrated()
                            ->unique(Invoice::class, 'invoice', ignoreRecord: true)
                            ->visibleOn('edit'),
                            
                        Forms\Components\DatePicker::make('date')
                            ->required()
                            ->default(now()),

                        Forms\Components\TextInput::make('customer_name')
                            ->required(),

                        Forms\Components\TextInput::make('total_purchases')
                            ->numeric()
                            ->disabled()
                            ->required()
                            ->default(0),
                    ])->columns(2),

                Forms\Components\Section::make('Invoice Items')
                    ->schema([
                        Forms\Components\Repeater::make('items')
                            ->relationship('items')
                            ->schema([
                                Forms\Components\Select::make('product_id')
                                    ->label('Product')
                                    ->searchable()
                                    ->getSearchResultsUsing(
                                        fn($search) =>
                                        Product::where('name', 'like', "%{$search}%")
                                            ->limit(50)
                                            ->pluck('name', 'id')
                                            ->toArray()
                                    )
                                    ->getOptionLabelUsing(fn ($value): ?string => Product::find($value)?->name)
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                        $product = Product::find($state);
                                        $price = $product?->price ?? 0;
                                        $set('price', $price);
                                        
                                        $qty = floatval($get('qty') ?? 1);
                                        $set('subtotal', $price * $qty);

                                        $items = $get('../../items');
                                        if (is_array($items)) {
                                            $total = collect($items)->sum('subtotal');
                                            $set('../../total_purchases', $total);
                                        }
                                    })
                                    ->required(),

                                Forms\Components\TextInput::make('qty')
                                    ->numeric()
                                    ->default(1)
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                        $price = floatval($get('price') ?? 0);
                                        $subtotal = floatval($state) * $price;
                                        $set('subtotal', $subtotal);

                                        $items = $get('../../items');
                                        if (is_array($items)) {
                                            $total = collect($items)->sum('subtotal');
                                            $set('../../total_purchases', $total);
                                        }
                                    })
                                    ->required(),

                                Forms\Components\TextInput::make('price')
                                    ->numeric()
                                    ->disabled()
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                        $qty = floatval($get('qty') ?? 0);
                                        $subtotal = floatval($state) * $qty;
                                        $set('subtotal', $subtotal);

                                        $items = $get('../../items');
                                        if (is_array($items)) {
                                            $total = collect($items)->sum('subtotal');
                                            $set('../../total_purchases', $total);
                                        }
                                    }),

                                Forms\Components\TextInput::make('subtotal')
                                    ->numeric()
                                    ->disabled()
                                    ->required(),
                            ])
                            ->afterStateUpdated(function (callable $get, callable $set) {
                                $items = $get('items');
                                if (is_array($items)) {
                                    $total = collect($items)->sum('subtotal');
                                    $set('total_purchases', $total);
                                }
                            })
                            ->columns(4)
                            ->reactive()
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('invoice')->sortable()->searchable(),

                Tables\Columns\TextColumn::make('date')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('customer_name')
                    ->searchable(),

                Tables\Columns\TextColumn::make('total_purchases')
                    ->money('IDR', true),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('download')
                    ->label('Download PDF')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(function (Invoice $record) {
                        $html = view('invoice', [
                            'date' => $record->date,
                            'customer' => $record->customer_name,
                            'items' => $record->items->map(function ($item) {
                                return [
                                    'name' => $item->product ? $item->product->name : 'Unknown Product',
                                    'qty' => $item->qty,
                                    'price' => $item->price,
                                    'subtotal' => $item->subtotal,
                                ];
                            }),
                            'total' => $record->total_purchases,
                        ])->render();

                        $filename = 'invoice-' . $record->invoice . '.png';
                        $path = storage_path("app/public/$filename");

                        \Spatie\Browsershot\Browsershot::html($html)->save($path);

                        return response()->download($path)->deleteFileAfterSend(true);
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('date', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            // Removed InvoiceItemsRelationManager as it's handled via repeater
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInvoices::route('/'),
            'create' => Pages\CreateInvoice::route('/create'),
            'edit' => Pages\EditInvoice::route('/{record}/edit'),
        ];
    }
}
