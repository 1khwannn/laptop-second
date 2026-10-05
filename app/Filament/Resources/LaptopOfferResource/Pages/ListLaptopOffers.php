<?php

namespace App\Filament\Resources\LaptopOfferResource\Pages;

use App\Filament\Resources\LaptopOfferResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLaptopOffers extends ListRecords
{
    protected static string $resource = LaptopOfferResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
