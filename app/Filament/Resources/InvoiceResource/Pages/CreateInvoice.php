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
        $today = now()->format('Ymd');

        // Ambil nomor terakhir khusus hari ini, sort by nomor invoice
        $last = Invoice::where('invoice', 'like', "INV-{$today}-%")
            ->orderBy('invoice', 'desc')
            ->first();

        if ($last) {
            $lastNumber = (int) substr($last->invoice, -2); // ambil 2 digit terakhir
            $number = $lastNumber + 1;
        } else {
            $number = 1;
        }

        $data['invoice'] = 'INV-' . $today . '-' . str_pad($number, 2, '0', STR_PAD_LEFT);

        return $data;
    }
}
