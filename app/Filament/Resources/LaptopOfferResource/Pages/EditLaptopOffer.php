<?php

namespace App\Filament\Resources\LaptopOfferResource\Pages;

use App\Filament\Resources\LaptopOfferResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLaptopOffer extends EditRecord
{
    protected static string $resource = LaptopOfferResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
