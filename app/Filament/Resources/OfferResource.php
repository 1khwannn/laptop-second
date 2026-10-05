<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OfferResource\Pages;
use App\Models\Laptop;
use App\Models\Offer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OfferResource extends Resource
{
    protected static ?string $model = Offer::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-stack';

    protected static ?string $navigationGroup = 'Transaksi & Buyback';

    protected static ?string $navigationLabel = 'Penawaran Masuk';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Detail Penawaran Pelanggan')
                    ->schema([
                        Forms\Components\Select::make('brand_id')
                            ->relationship('brand', 'name')
                            ->disabled()
                            ->label('Merek'),

                        Forms\Components\TextInput::make('model_name')
                            ->disabled()
                            ->label('Tipe / Seri Laptop'),

                        Forms\Components\TextInput::make('processor')->disabled(),
                        Forms\Components\TextInput::make('ram')->disabled(),
                        Forms\Components\TextInput::make('storage')->disabled(),

                        Forms\Components\TextInput::make('expected_price')
                            ->numeric()
                            ->prefix('Rp')
                            ->disabled()
                            ->label('Ekspektasi Harga User'),

                        Forms\Components\Textarea::make('condition_description')
                            ->disabled()
                            ->columnSpanFull()
                            ->label('Deskripsi Kondisi dari User'),
                    ])->columns(2),

                Forms\Components\Section::make('Respon Toko / Admin')
                    ->schema([
                        Forms\Components\TextInput::make('admin_offer_price')
                            ->numeric()
                            ->prefix('Rp')
                            ->required()
                            ->label('Harga Taksiran Toko'),

                        Forms\Components\Select::make('status')
                            ->options([
                                'pending' => 'Pending (Belum Direspon)',
                                'negotiating' => 'Dalam Negosiasi',
                                'accepted' => 'Disetujui / Deal',
                                'rejected' => 'Ditolak',
                                'completed' => 'Selesai (Sudah Dibeli)',
                            ])
                            ->required(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d M Y H:i')
                    ->label('Tanggal'),

                Tables\Columns\TextColumn::make('model_name')
                    ->searchable()
                    ->label('Laptop'),

                Tables\Columns\TextColumn::make('brand.name')
                    ->badge(),

                Tables\Columns\TextColumn::make('expected_price')
                    ->money('IDR')
                    ->label('Ekspektasi User'),

                Tables\Columns\TextColumn::make('admin_offer_price')
                    ->money('IDR')
                    ->placeholder('Belum diisi')
                    ->label('Tawaran Toko'),

                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'info' => 'negotiating',
                        'success' => 'accepted',
                        'danger' => 'rejected',
                        'gray' => 'completed',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),

                // Tombol Kustom: Konversi ke Stok Katalog
                Tables\Actions\Action::make('convert_to_laptop')
                    ->label('Jadikan Stok Katalog')
                    ->icon('heroicon-o-arrow-path')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Konversi Penawaran ke Stok Toko')
                    ->modalDescription('Apakah Anda yakin ingin memasukkan unit ini ke katalog laptop yang dijual?')
                    ->action(function (Offer $record) {
                        Laptop::create([
                            'brand_id' => $record->brand_id,
                            'title' => $record->model_name,
                            'slug' => \Illuminate\Support\Str::slug($record->model_name . '-' . rand(100, 999)),
                            'processor' => $record->processor,
                            'ram' => $record->ram,
                            'storage' => $record->storage,
                            'price' => $record->admin_offer_price ?? $record->expected_price,
                            'condition_grade' => 'Mulus',
                            'description' => "Unit bekas buyback dari pelanggan.\nCatatan kondisi: " . $record->condition_description,
                            'status' => 'available',
                        ]);

                        $record->update(['status' => 'completed']);

                        Notification::make()
                            ->title('Berhasil!')
                            ->body('Laptop berhasil ditambahkan ke Katalog Toko!')
                            ->success()
                            ->send();
                    })
                    ->visible(fn (Offer $record) => in_array($record->status, ['accepted', 'completed'])),
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