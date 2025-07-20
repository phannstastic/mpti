<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;

    // TAMBAHKAN METHOD DI BAWAH INI
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $total = 0;
        // Hitung total dari semua item yang ada di repeater
        if (isset($data['items'])) {
            foreach ($data['items'] as $item) {
                $total += $item['price'] * $item['quantity'];
            }
        }
        $data['total_price'] = $total;

        return $data;
    }
}
