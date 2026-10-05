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

    protected static ?string $navigationGroup = 'Transaksi & Buyback';

    protected static ?string $navigationLabel = 'Penawaran Masuk';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Pengirim & Unit')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'name')
                            ->label('Nama Pengguna')
                            ->disabled(),

                        Forms\Components\Select::make('brand_id')
                            ->relationship('brand', 'name')
                            ->label('Merek')
                            ->disabled(),

                        Forms\Components\TextInput::make('model_name')
                            ->label('Tipe / Seri Laptop')
                            ->disabled(),

                        Forms\Components\TextInput::make('expected_price')
                            ->label('Harga Ekspektasi User')
                            ->prefix('Rp')
                            ->numeric()
                            ->disabled(),

                        Forms\Components\TextInput::make('processor')
                            ->disabled(),

                        Forms\Components\TextInput::make('ram')
                            ->disabled(),

                        Forms\Components\TextInput::make('storage')
                            ->disabled(),

                        Forms\Components\Textarea::make('condition_description')
                            ->label('Kondisi & Kelengkapan')
                            ->columnSpanFull()
                            ->disabled(),
                    ])->columns(2),

                Forms\Components\Section::make('Respon Toko / Admin')
                    ->schema([
                        Forms\Components\TextInput::make('admin_offer_price')
                            ->label('Harga Penawaran Toko (Rp)')
                            ->prefix('Rp')
                            ->numeric()
                            ->placeholder('Masukkan penawaran harga dari toko'),

                        Forms\Components\Select::make('status')
                            ->options([
                                'pending' => 'Pending (Belum Di-review)',
                                'negotiating' => 'Dalam Negosiasi',
                                'accepted' => 'Disetujui',
                                'rejected' => 'Ditolak',
                                'completed' => 'Selesai (Laptop Dibeli)',
                            ])
                            ->required()
                            ->default('pending'),

                        Forms\Components\Textarea::make('admin_notes')
                            ->label('Catatan Admin untuk User')
                            ->placeholder('Contoh: Harga bisa naik jika dus buku lengkap...')
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama User')
                    ->searchable(),

                Tables\Columns\TextColumn::make('brand.name')
                    ->label('Brand')
                    ->badge(),

                Tables\Columns\TextColumn::make('model_name')
                    ->label('Seri Laptop')
                    ->searchable(),

                Tables\Columns\TextColumn::make('expected_price')
                    ->label('Ekspektasi User')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('admin_offer_price')
                    ->label('Tawaran Toko')
                    ->money('IDR')
                    ->placeholder('Belum diisi'),

                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'secondary' => 'pending',
                        'warning' => 'negotiating',
                        'success' => 'accepted',
                        'danger' => 'rejected',
                        'info' => 'completed',
                    ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'negotiating' => 'Negosiasi',
                        'accepted' => 'Disetujui',
                        'rejected' => 'Ditolak',
                        'completed' => 'Selesai',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
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