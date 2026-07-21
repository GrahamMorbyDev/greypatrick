<?php

namespace App\Filament\Resources\QuoteEnquiries\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class QuoteEnquiryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Project')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(120),
                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(160),
                        TextInput::make('project_name')
                            ->maxLength(160),
                        TextInput::make('website')
                            ->url()
                            ->maxLength(255),
                        Select::make('project_type')
                            ->required()
                            ->options([
                                'New website' => 'New website',
                                'Website redesign' => 'Website redesign',
                                'Landing page' => 'Landing page',
                                'Laravel / custom web app' => 'Laravel / custom web app',
                                'AI feature or automation' => 'AI feature or automation',
                                'Not sure yet' => 'Not sure yet',
                            ]),
                        Select::make('status')
                            ->required()
                            ->default('new')
                            ->options([
                                'new' => 'New',
                                'read' => 'Read',
                                'quoted' => 'Quoted',
                                'won' => 'Won',
                                'lost' => 'Lost',
                                'archived' => 'Archived',
                            ]),
                        Select::make('budget')
                            ->options([
                                'Under £500' => 'Under £500',
                                '£500 - £1,500' => '£500 - £1,500',
                                '£1,500 - £3,000' => '£1,500 - £3,000',
                                '£3,000+' => '£3,000+',
                            ]),
                        Select::make('timeframe')
                            ->options([
                                'ASAP' => 'ASAP',
                                '2-4 weeks' => '2-4 weeks',
                                '1-3 months' => '1-3 months',
                                'Flexible' => 'Flexible',
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
