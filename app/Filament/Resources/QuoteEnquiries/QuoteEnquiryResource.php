<?php

namespace App\Filament\Resources\QuoteEnquiries;

use App\Filament\Resources\QuoteEnquiries\Pages\CreateQuoteEnquiry;
use App\Filament\Resources\QuoteEnquiries\Pages\EditQuoteEnquiry;
use App\Filament\Resources\QuoteEnquiries\Pages\ListQuoteEnquiries;
use App\Filament\Resources\QuoteEnquiries\Schemas\QuoteEnquiryForm;
use App\Filament\Resources\QuoteEnquiries\Tables\QuoteEnquiriesTable;
use App\Models\QuoteEnquiry;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class QuoteEnquiryResource extends Resource
{
    protected static ?string $model = QuoteEnquiry::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    protected static ?string $modelLabel = 'quote enquiry';

    protected static ?string $pluralModelLabel = 'quote enquiries';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return QuoteEnquiryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QuoteEnquiriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListQuoteEnquiries::route('/'),
            'create' => CreateQuoteEnquiry::route('/create'),
            'edit' => EditQuoteEnquiry::route('/{record}/edit'),
        ];
    }
}
