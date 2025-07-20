<?php

namespace App\Filament\Resources\MenuItemResource\Pages;

use App\Filament\Resources\MenuItemResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMenuItem extends CreateRecord
{
    protected static string $resource = MenuItemResource::class;

    // TAMBAHKAN FUNGSI INI
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}