<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiResources extends Controller
{
    public function getResources(Request $request)
    {
        $currency = [0 => ["name" => "Bitcoin (BTC)", "value" => "BTC"], 1 => ["name" => "Ethereum (ETH)", "value" => "ETH"], 2 => ["name" => "Litecoin (LTC)", "value" => "LTC"], 3 => ["name" => "Dash (DASH)", "value" => "DASH"], 4 => ["name" => "Zcash (TZEC)", "value" => "TZEC"], 5 => ["name" => "Dogecoin (DOGE)", "value" => "DOGE"], 6 => ["name" => "Bitcoin Cash (BCH)", "value" => "BCH"], 7 => ["name" => "Monero (XMR)", "value" => "XMR"], 8 => ["name" => "Tron (TRX)", "value" => "TRX"], 9 => ["name" => "USDT-Erc20", "value" => "Erc20"], 10 => ["name" => "USDT-Trc20", "value" => "Trc20"]];
        return $currency;
    }
}
