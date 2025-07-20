<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

// Tambahkan use statements yang dibutuhkan
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Actions\Action;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $navigationLabel = 'Riwayat Pesanan';
    protected static ?string $navigationGroup = 'Manajemen Toko';

    // Halaman "Create" tidak diperlukan karena pesanan dibuat dari halaman depan
    public static function canCreate(): bool
    {
        return false;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Order ID')->sortable(),
                TextColumn::make('customer_name')->label('Nama Pelanggan')->searchable(),
                TextColumn::make('total_price')
                    ->label('Total Harga')
                    ->money('IDR')
                    ->sortable(),

                // Kolom untuk Status dengan Badge (Pill)
                BadgeColumn::make('status')
                    ->colors([
                        'primary' => 'diproses',
                        'success' => 'selesai',
                        'danger' => 'dibatalkan',
                    ])
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Waktu Pesanan')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc') // Urutkan dari yang paling baru
            ->filters([
                //
            ])
            ->actions([
                // Tombol untuk melihat detail pesanan
                Tables\Actions\ViewAction::make(),

                // Tombol dropdown untuk mengubah status
                Tables\Actions\ActionGroup::make([
                    Action::make('tandai_selesai')
                        ->label('Tandai Selesai')
                        ->icon('heroicon-s-check-circle')
                        ->color('success')
                        ->action(fn (Order $record) => $record->update(['status' => 'selesai']))
                        ->requiresConfirmation()
                        ->hidden(fn (Order $record) => $record->status === 'selesai'),

                    Action::make('tandai_diproses')
                        ->label('Tandai Diproses')
                        ->icon('heroicon-s-arrow-path')
                        ->color('primary')
                        ->action(fn (Order $record) => $record->update(['status' => 'diproses']))
                        ->requiresConfirmation()
                        ->hidden(fn (Order $record) => $record->status === 'diproses'),
                ])
            ])
            ->bulkActions([
                //
            ]);
    }

    // Fungsi ini untuk menampilkan detail pesanan saat tombol "View" diklik
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Section::make('Informasi Pesanan')
                    ->schema([
                        Components\TextEntry::make('customer_name')->label('Nama Pelanggan'),
                        Components\TextEntry::make('total_price')->label('Total Harga')->money('IDR'),
                        Components\TextEntry::make('status')->badge()->colors([
                            'primary' => 'diproses',
                            'success' => 'selesai',
                        ]),
                        Components\TextEntry::make('created_at')->label('Tanggal Pesan')->dateTime(),
                    ])->columns(2),

                Components\Section::make('Item Pesanan')
                    ->schema([
                        // Menampilkan daftar item dalam bentuk tabel
                        Components\RepeatableEntry::make('items')
                            ->label('')
                            ->schema([
                                // Kita perlu mengambil nama menu dari relasi
                                // Ini memerlukan sedikit penyesuaian pada Model Order
                                Components\TextEntry::make('menuItem.name')->label('Menu'),
                                Components\TextEntry::make('quantity')->label('Jumlah'),
                                Components\TextEntry::make('price')->label('Harga Satuan')->money('IDR'),
                            ])->columns(3),
                    ]),
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
            'index' => Pages\ListOrders::route('/'),
            // 'create' => Pages\CreateOrder::route('/create'), // Dihapus
            // 'view' => Pages\ViewOrder::route('/{record}'), // Halaman untuk melihat detail
            // 'edit' => Pages\EditOrder::route('/{record}/edit'), // Dihapus
        ];
    }
}