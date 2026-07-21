<?php

namespace App\Filament\Resources\QuoteEnquiries\Pages;

use App\Filament\Resources\QuoteEnquiries\QuoteEnquiryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditQuoteEnquiry extends EditRecord
{
    protected static string $resource = QuoteEnquiryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
