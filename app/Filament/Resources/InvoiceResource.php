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

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;
    protected static ?int $navigationSort = 4;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    private static function recalculateTotal(callable $get, callable $set): void
    {
        $items = $get('items') ?? $get('../../items');
        $itemsTotal = is_array($items) ? collect($items)->sum('subtotal') : 0;
        $shipping = floatval($get('shipping_cost') ?? $get('../../shipping_cost') ?? 0);
        $discount = floatval($get('discount_nominal') ?? $get('../../discount_nominal') ?? 0);
        $total = $itemsTotal + $shipping - $discount;

        try {
            $set('total_purchases', max(0, $total));
        } catch (\Throwable $e) {
        }
        try {
            $set('../../total_purchases', max(0, $total));
        } catch (\Throwable $e) {
        }
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Invoice Details')
                    ->schema([
                        Forms\Components\DatePicker::make('date')
                            ->required()
                            ->default(now()),

                        Forms\Components\TextInput::make('customer_name')
                            ->required(),

                        Forms\Components\TextInput::make('total_purchases')
                            ->label('Total')
                            ->numeric()
                            ->readOnly()
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
                                    ->getOptionLabelUsing(fn($value): ?string => Product::find($value)?->name)
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                        $product = Product::find($state);
                                        $price = $product?->price ?? 0;
                                        $set('price', $price);

                                        $qty = floatval($get('qty') ?? 1);
                                        $set('subtotal', $price * $qty);

                                        static::recalculateTotal($get, $set);
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

                                        static::recalculateTotal($get, $set);
                                    })
                                    ->required(),

                                Forms\Components\TextInput::make('price')
                                    ->numeric()
                                    ->readOnly()
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                        $qty = floatval($get('qty') ?? 0);
                                        $subtotal = floatval($state) * $qty;
                                        $set('subtotal', $subtotal);

                                        static::recalculateTotal($get, $set);
                                    }),

                                Forms\Components\TextInput::make('subtotal')
                                    ->numeric()
                                    ->readOnly()
                                    ->required(),
                            ])
                            ->afterStateUpdated(function (callable $get, callable $set) {
                                static::recalculateTotal($get, $set);
                            })
                            ->columns(4)
                            ->reactive()
                            ->required(),
                    ]),

                Forms\Components\Section::make('Pengiriman & Pembayaran')
                    ->schema([
                        Forms\Components\Toggle::make('has_shipping')
                            ->label('Tambah Ongkir')
                            ->default(false)
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                if (!$state) {
                                    $set('shipping_cost', 0);
                                }
                                static::recalculateTotal($get, $set);
                            })
                            ->dehydrated(false),

                        Forms\Components\TextInput::make('shipping_cost')
                            ->label('Ongkir (Rp)')
                            ->numeric()
                            ->default(0)
                            ->reactive()
                            ->visible(fn(callable $get) => $get('has_shipping') == true)
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                static::recalculateTotal($get, $set);
                            }),

                        Forms\Components\Radio::make('payment_method')
                            ->label('Metode Pembayaran')
                            ->options([
                                'cod' => 'COD (Cash on Delivery)',
                                'transfer' => 'Transfer Bank',
                            ])
                            ->required()
                            ->default('cod'),
                    ])->columns(2),

                Forms\Components\Section::make('Diskon')
                    ->schema([
                        Forms\Components\Toggle::make('has_discount')
                            ->label('Tambah Diskon')
                            ->default(false)
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                if (!$state) {
                                    $set('discount_name', null);
                                    $set('discount_nominal', 0);
                                }
                                static::recalculateTotal($get, $set);
                            })
                            ->dehydrated(false), 

                        Forms\Components\TextInput::make('discount_name')
                            ->label('Nama Diskon')
                            ->placeholder('contoh: Promo Lebaran, Member, dll')
                            ->nullable()
                            ->visible(fn(callable $get) => $get('has_discount') == true),

                        Forms\Components\TextInput::make('discount_nominal')
                            ->label('Nominal Diskon (Rp)')
                            ->numeric()
                            ->default(0)
                            ->reactive()
                            ->visible(fn(callable $get) => $get('has_discount') == true)
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                static::recalculateTotal($get, $set);
                            }),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('invoice')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('date')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('customer_name')
                    ->searchable(),

                Tables\Columns\TextColumn::make('total_purchases')
                    ->formatStateUsing(fn($state) => 'Rp ' . number_format($state, 0, ',', '.')),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('download')
                    ->label('Download')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(function (Invoice $record) {
                        $html = view('invoice', [
                            'invoiceNumber' => $record->invoice,
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
                            'shippingCost' => $record->shipping_cost ?? 0,
                            'paymentMethod' => $record->payment_method ?? 'cod',
                            'discountName' => $record->discount_name,
                            'discountNominal' => $record->discount_nominal ?? 0,
                        ])->render();

                        $filename = 'invoice-' . $record->invoice . '.jpg';
                        $path = storage_path("app/public/$filename");

                        \Spatie\Browsershot\Browsershot::html($html)
                            ->waitUntilNetworkIdle()
                            ->windowSize(860, 100)
                            ->fullPage()
                            ->setScreenshotType('jpeg', 90)
                            ->setChromePath(env('CHROME_PATH', '/usr/bin/google-chrome'))
                            ->save($path);

                        return response()->download($path)->deleteFileAfterSend(true);
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('invoice', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInvoices::route('/'),
            'create' => Pages\CreateInvoice::route('/create'),
        ];
    }
}