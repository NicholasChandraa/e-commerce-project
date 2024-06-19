<?php 


namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;
use Exception;
use Illuminate\Support\Facades\Log;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function createTransaction($params)
    {
        try {
            $transaction = Snap::createTransaction($params);
            Log::info('Midtrans transaction created: ' . json_encode($transaction));
            return $transaction;
        } catch (Exception $e) {
            Log::error('Midtrans Error: ' . $e->getMessage());
            throw $e;
        }
    }
}


