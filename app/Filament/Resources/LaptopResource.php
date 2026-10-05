<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LaptopResource\Pages;
use App\Models\Laptop;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class LaptopResource extends Resource
{
    protected static ?string $model = Laptop::class;

    protected static ?string $navigationIcon = 'heroicon-o-computer-desktop';

    protected static ?string $navigationGroup = 'Katalog Toko';

    protected static ?string $navigationLabel = 'Stok Laptop Bekas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Unit')
                    ->schema([
                        Forms\Components\Select::make('brand_id')
                            ->relationship('brand', 'name')
                            ->required()
                            ->label('Merek'),

                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->label('Judul Produk')
                            ->placeholder('Contoh: Asus ROG Strix G15 (2022)')
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),

                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->readOnly(),

                        Forms\Components\TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->prefix('Rp')
                            ->label('Harga Jual'),

                        Forms\Components\Select::make('condition_grade')
                            ->options([
                                'Like New' => 'Like New (99% Mulus)',
                                'Mulus' => 'Mulus (90-95%)',
                                'Pemakaian Normal' => 'Pemakaian Normal',
                            ])
                            ->default('Like New')
                            ->required()
                            ->label('Kondisi Fisik'),

                        Forms\Components\Select::make('status')
                            ->options([
                                'available' => 'Tersedia (Ready Stock)',
                                'sold' => 'Terjual (Sold Out)',
                            ])
                            ->default('available')
                            ->required(),
                    ])->columns(2),

                Forms\Components\Section::make('Spesifikasi & Foto')
                    ->schema([
                        Forms\Components\TextInput::make('processor')->required()->placeholder('Intel Core i7-11800H'),
                        Forms\Components\TextInput::make('ram')->required()->placeholder('16GB DDR4'),
                        Forms\Components\TextInput::make('storage')->required()->placeholder('512GB NVMe SSD'),
                        Forms\Components\TextInput::make('gpu')->placeholder('NVIDIA RTX 3060 6GB'),

                        Forms\Components\FileUpload::make('photo')
                            ->image()
                            ->directory('laptops')
                            ->columnSpanFull()
                            ->label('Foto Utama Laptop'),

                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi Lengkap & Kelengkapan')
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Foto'),

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->label('Nama Laptop'),

                Tables\Columns\TextColumn::make('brand.name')
                    ->badge(),

                Tables\Columns\TextColumn::make('price')
                    ->money('IDR')
                    ->sortable()
                    ->label('Harga'),

                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'success' => 'available',
                        'danger' => 'sold',
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'available' => 'Tersedia',
                        'sold' => 'Terjual',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
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