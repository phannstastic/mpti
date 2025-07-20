<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Carbon\Carbon;

class SalesChart extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Pesanan Selesai (30 Hari Terakhir)';
    protected static ?int $sort = 1; 

    protected function getData(): array
    {
        // Buat query dengan kondisi where terlebih dahulu
        $query = Order::where('status', 'selesai');

        // Masukkan query tersebut ke dalam Trend::query()
        $data = Trend::query($query)
            ->between(
                start: now()->subDays(30),
                end: now(),
            )
            ->perDay()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Pesanan Selesai',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#36A2EB',
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => Carbon::parse($value->date)->format('d M')),
        ];
    }

    protected function getType(): string
    {
        return 'line'; // Tipe grafik: garis
    }
}