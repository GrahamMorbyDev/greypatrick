<?php

namespace App\Filament\Resources\QuoteEnquiries\Pages;

use App\Filament\Resources\QuoteEnquiries\QuoteEnquiryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListQuoteEnquiries extends ListRecords
{
    protected static string $resource = QuoteEnquiryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
