<?php

namespace App\Filament\Resources\InvoiceResource\Pages;

use App\Filament\Resources\InvoiceResource;
use App\Models\Invoice;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateInvoice extends CreateRecord
{
    protected static string $resource = InvoiceResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $last = Invoice::latest('id')->first();
        $number = $last ? ((int) substr($last->invoice, -4)) + 1 : 1;
        $data['invoice'] = 'INV-' . now()->format('Ymd') . '-' . str_pad($number, 2, '0', STR_PAD_LEFT);
        
        return $data;
    }
}
