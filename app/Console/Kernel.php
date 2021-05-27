<?php

namespace App\Console;

use App\Models\CryptoRate;
use App\Models\CryptoType;
use App\Models\WalletType;
use Http;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Stringable;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $types = CryptoType::where('short', '!=', 'CRT')->get('short')->pluck('short');
        $data = collect($types)->implode(',');

        $schedule->call(function () use ($data) {
            $ticker = Http::get('https://pro-api.coinmarketcap.com/v1/cryptocurrency/quotes/latest?CMC_PRO_API_KEY=' . env('CMC_PRO_API_KEY') . '&symbol=' . $data)->json();

            foreach ($ticker['data'] as $key => $value) {
                $cryptoType = CryptoType::where('short', $key)->first();

                foreach ($value['quote'] as $currency => $value) {
                    if ($rate = $cryptoType->rates()->where('currency', $currency)->first()) {
                        $rate->update([
                            'rate' => $value['price'],
                            'currency' => $currency,
                            'symbol' => "$",
                        ]);

                        return true;
                    }

                    $rate = new CryptoRate([
                        'rate' => $value['price'],
                        'currency' => $currency,
                        'symbol' => "$",
                    ]);

                    $cryptoType->rates()->save($rate);
                }
            }
        })->onFailure(function (Stringable $output) {
            file_put_contents('CryptoRate_log.txt', $output, FILE_APPEND);
        })->everyFiveMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
