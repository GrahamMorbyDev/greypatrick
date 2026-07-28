<?php

namespace App\Filament\Resources\BlogPosts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class BlogPostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Post')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('title')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state ?? ''))),
                                TextInput::make('slug')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(ignoreRecord: true),
                                TextInput::make('author')
                                    ->required()
                                    ->default('Grey Patrick')
                                    ->maxLength(255),
                                FileUpload::make('image')
                                    ->image()
                                    ->directory('blog')
                                    ->imageEditor(),
                            ]),
                        Textarea::make('excerpt')
                            ->maxLength(255)
                            ->rows(3)
                            ->columnSpanFull(),
                        RichEditor::make('post')
                            ->required()
                            ->columnSpanFull(),
                    ]),
                Section::make('Publishing')
                    ->schema([
                        Toggle::make('is_published')
                            ->label('Published')
                            ->default(true)
                            ->live(),
                        DateTimePicker::make('published_at')
                            ->default(now())
                            ->seconds(false),
                    ])
                    ->columns(2),
            ]);
    }
}
