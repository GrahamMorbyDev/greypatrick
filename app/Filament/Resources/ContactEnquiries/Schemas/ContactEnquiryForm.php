<?php

namespace App\Filament\Resources\ContactEnquiries\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactEnquiryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Enquiry')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(120),
                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(160),
                        Select::make('reason')
                            ->required()
                            ->options([
                                'Website project' => 'Website project',
                                'AI platform work' => 'AI platform work',
                                'Laravel / software engineering' => 'Laravel / software engineering',
                                'Collaboration' => 'Collaboration',
                                'General enquiry' => 'General enquiry',
                            ]),
                        Select::make('status')
                            ->required()
                            ->default('new')
                            ->options([
                                'new' => 'New',
                                'read' => 'Read',
                                'replied' => 'Replied',
                                'archived' => 'Archived',
                            ]),
                        Textarea::make('message')
                            ->required()
                            ->rows(8)
                            ->columnSpanFull(),
                        DateTimePicker::make('read_at')
                            ->seconds(false),
                    ])
                    ->columns(2),
            ]);
    }
}
