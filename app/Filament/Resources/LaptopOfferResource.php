<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LaptopOfferResource\Pages;
use App\Models\LaptopOffer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LaptopOfferResource extends Resource
{
    protected static ?string $model = LaptopOffer::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->label('Pengaju Penawaran'),

                Forms\Components\Select::make('brand_id')
                    ->relationship('brand', 'name')
                    ->nullable()
                    ->label('Merek'),

                Forms\Components\TextInput::make('model_name')
                    ->required()
                    ->placeholder('Contoh: Lenovo Legion 5')
                    ->label('Tipe / Seri Laptop'),

                Forms\Components\TextInput::make('processor')->required(),
                Forms\Components\TextInput::make('ram')->required(),
                Forms\Components\TextInput::make('storage')->required(),

                Forms\Components\TextInput::make('expected_price')
                    ->numeric()
                    ->prefix('Rp')
                    ->required()
                    ->label('Ekspektasi Harga User'),

                Forms\Components\TextInput::make('admin_offer_price')
                    ->numeric()
                    ->prefix('Rp')
                    ->label('Harga Tawaran Toko'),

                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending (Menunggu Review)',
                        'negotiating' => 'Dalam Negosiasi',
                        'accepted' => 'Disetujui Toko',
                        'rejected' => 'Ditolak Toko',
                        'completed' => 'Selesai (Transaksi Berhasil)',
                    ])
                    ->required()
                    ->default('pending'),

                Forms\Components\Textarea::make('condition_description')
                    ->columnSpanFull()
                    ->label('Deskripsi Kondisi dari User'),

                Forms\Components\Textarea::make('admin_notes')
                    ->columnSpanFull()
                    ->label('Catatan Admin / Toko'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('Nama Pengaju')->searchable(),
                Tables\Columns\TextColumn::make('model_name')->label('Laptop')->searchable(),
                Tables\Columns\TextColumn::make('expected_price')->money('IDR')->label('Ekspektasi Harga'),
                Tables\Columns\TextColumn::make('admin_offer_price')->money('IDR')->label('Tawaran Toko'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'gray',
                        'negotiating' => 'warning',
                        'accepted' => 'info',
                        'rejected' => 'danger',
                        'completed' => 'success',
                    }),
                Tables\Columns\TextColumn::make('created_at')->dateTime('d M Y, H:i')->label('Tanggal'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLaptopOffers::route('/'),
            'create' => Pages\CreateLaptopOffer::route('/create'),
            'edit' => Pages\EditLaptopOffer::route('/{record}/edit'),
        ];
    }
}