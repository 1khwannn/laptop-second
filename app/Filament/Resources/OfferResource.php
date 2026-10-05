<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OfferResource\Pages;
use App\Models\Offer;
use App\Models\Laptop;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;

class OfferResource extends Resource
{
    protected static ?string $model = Offer::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-arrow-down';
    protected static ?string $navigationGroup = 'Transaksi & Buyback';
    protected static ?string $navigationLabel = 'Penawaran Masuk';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Laptop Penawaran')
                    ->schema([
                        Forms\Components\Select::make('brand_id')
                            ->relationship('brand', 'name')
                            ->required()
                            ->disabled(),
                        Forms\Components\TextInput::make('model_name')
                            ->required()
                            ->disabled(),
                        Forms\Components\TextInput::make('phone_number')
                            ->label('Nomor Telepon / WhatsApp')
                            ->tel()
                            ->disabled(),
                        Forms\Components\Textarea::make('description')
                            ->columnSpanFull()
                            ->disabled(),
                        Forms\Components\FileUpload::make('image')
                            ->image()
                            ->disabled(),
                    ])->columns(2),

                Forms\Components\Section::make('Penilaian & Negosiasi Toko')
                    ->schema([
                        Forms\Components\TextInput::make('expected_price')
                            ->label('Ekspektasi Harga User')
                            ->prefix('Rp')
                            ->numeric()
                            ->disabled(),
                        Forms\Components\TextInput::make('admin_offer_price')
                            ->label('Harga Taksiran Toko')
                            ->prefix('Rp')
                            ->numeric()
                            ->required(),
                        Forms\Components\Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'negotiating' => 'Negosiasi',
                                'accepted' => 'Disetujui',
                                'rejected' => 'Ditolak',
                                'completed' => 'Selesai (Sudah Dibeli)',
                            ])
                            ->required(),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('model_name')
                    ->label('Laptop')
                    ->searchable(),
                Tables\Columns\TextColumn::make('brand.name')
                    ->label('Brand')
                    ->badge(),
                Tables\Columns\TextColumn::make('expected_price')
                    ->label('Ekspektasi User')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('admin_offer_price')
                    ->label('Tawaran Toko')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'negotiating' => 'info',
                        'accepted' => 'success',
                        'rejected' => 'danger',
                        'completed' => 'gray',
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending (Belum Direspon)',
                        'negotiating' => 'Dalam Negosiasi',
                        'accepted' => 'Disetujui / Deal',
                        'rejected' => 'Ditolak',
                        'completed' => 'Selesai (Sudah Dibeli)',
                    ])
                    ->label('Filter Status'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                
                // Action 1: Cetak Nota PDF
                Tables\Actions\Action::make('cetak_nota')
                    ->label('Cetak Nota')
                    ->icon('heroicon-o-printer')
                    ->color('info')
                    ->url(fn (Offer $record) => route('admin.offers.pdf', $record->id))
                    ->openUrlInNewTab(),

                // Action 2: Convert ke Stok Katalog
                Tables\Actions\Action::make('jadikan_stok')
                    ->label('Jadikan Stok Katalog')
                    ->icon('heroicon-o-plus-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function (Offer $record) {
                        Laptop::create([
                            'brand_id' => $record->brand_id,
                            'name' => $record->model_name,
                            'processor' => 'Processor Laptop Bekas',
                            'ram' => 8,
                            'storage' => '256GB SSD',
                            'price' => $record->admin_offer_price ?? $record->expected_price,
                            'stock' => 1,
                            'condition' => 'Second',
                            'description' => $record->description,
                            'image' => $record->image,
                        ]);

                        $record->update(['status' => 'completed']);

                        Notification::make()
                            ->title('Berhasil Konversi')
                            ->body('Laptop berhasil ditambahkan ke Stok Katalog Toko.')
                            ->success()
                            ->send();
                    })
                    ->visible(fn (Offer $record) => $record->status !== 'completed'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOffers::route('/'),
            'create' => Pages\CreateOffer::route('/create'),
            'edit' => Pages\EditOffer::route('/{record}/edit'),
        ];
    }
}