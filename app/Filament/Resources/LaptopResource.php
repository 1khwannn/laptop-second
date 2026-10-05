<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LaptopResource\Pages;
use App\Models\Laptop;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LaptopResource extends Resource
{
    protected static ?string $model = Laptop::class;

    protected static ?string $navigationIcon = 'heroicon-o-computer-desktop';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->directory('laptops')
                    ->columnSpanFull()
                    ->label('Foto Laptop'),
                Forms\Components\Select::make('brand_id')
                    ->relationship('brand', 'name')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->label('Merek Laptop'),

                Forms\Components\TextInput::make('title')
                    ->required()
                    ->placeholder('Contoh: ASUS ROG Strix G15')
                    ->label('Nama Produk'),

                Forms\Components\TextInput::make('serial_number')
                    ->label('Nomor Seri (SN)'),

                Forms\Components\TextInput::make('processor')
                    ->required()
                    ->placeholder('Contoh: Intel Core i7-11800H'),

                Forms\Components\TextInput::make('ram')
                    ->required()
                    ->placeholder('Contoh: 16GB DDR4'),

                Forms\Components\TextInput::make('storage')
                    ->required()
                    ->placeholder('Contoh: 512GB NVMe SSD'),

                Forms\Components\TextInput::make('vga')
                    ->placeholder('Contoh: NVIDIA RTX 3060 6GB'),

                Forms\Components\TextInput::make('screen_size')
                    ->placeholder('Contoh: 15.6 FHD 144Hz'),

                Forms\Components\Select::make('condition_grade')
                    ->options([
                        'A' => 'Grade A (Mulus / Seperti Baru)',
                        'B' => 'Grade B (Baret Halus / Pemakaian Normal)',
                        'C' => 'Grade C (Ada Minus Fisik/Fungsi)',
                    ])
                    ->default('A')
                    ->required()
                    ->label('Kondisi Unit'),

                Forms\Components\TextInput::make('price')
                    ->numeric()
                    ->prefix('Rp')
                    ->required()
                    ->label('Harga Jual'),

                Forms\Components\Select::make('status')
                    ->options([
                        'available' => 'Tersedia',
                        'booked' => 'Dibooking',
                        'sold' => 'Terjual',
                    ])
                    ->default('available')
                    ->required(),

                Forms\Components\Textarea::make('description')
                    ->columnSpanFull()
                    ->label('Deskripsi / Kelengkapan'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\ImageColumn::make('image')->label('Foto'),
                Tables\Columns\TextColumn::make('brand.name')
                    ->sortable()
                    ->searchable()
                    ->label('Merek'),

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->label('Nama Laptop'),

                Tables\Columns\TextColumn::make('processor')
                    ->label('Prosesor'),

                Tables\Columns\TextColumn::make('ram')
                    ->label('RAM'),

                Tables\Columns\TextColumn::make('storage')
                    ->label('Storage'),

                Tables\Columns\TextColumn::make('price')
                    ->money('IDR')
                    ->sortable()
                    ->label('Harga Jual'),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'available' => 'success',
                        'booked' => 'warning',
                        'sold' => 'danger',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'available' => 'Tersedia',
                        'booked' => 'Dibooking',
                        'sold' => 'Terjual',
                    }),
            ]);
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
            'index' => Pages\ListLaptops::route('/'),
            'create' => Pages\CreateLaptop::route('/create'),
            'edit' => Pages\EditLaptop::route('/{record}/edit'),
        ];
    }
}