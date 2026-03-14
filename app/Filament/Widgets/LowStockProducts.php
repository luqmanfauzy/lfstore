<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Widgets\Widget;

class LowStockProducts extends Widget
{
    protected static string $view = 'filament.widgets.low-stock-products';

    protected function getViewData(): array
    {
        return [
            'data' => Product::where('stock', '<', 3)->get(),
        ];
    }
}
