<?php

namespace App\Console;

use App\Models\CryptoRate;
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
        $schedule->call(function (){
            $ticker = Http::get('https://blockchain.info/ticker')->json();

            foreach($ticker as $key => $value){
                $walletType = WalletType::find(1);

                if($rate = $walletType->rates()->where('currency', $key)->first()){
                    $rate->update([
                        'rate' => $value['15m'],
                        'currency' => $key,
                        'symbol' => $value['symbol'],
                    ]);

                    return true;
                }

                $rate = new CryptoRate([
                    'rate' => $value['15m'],
                    'currency' => $key,
                    'symbol' => $value['symbol'],
                ]);

                $walletType->rates()->save($rate);

            }


        })->onFailure(function (Stringable $output){
            file_put_contents('CryptoRate_log.txt', $output, FILE_APPEND);
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
