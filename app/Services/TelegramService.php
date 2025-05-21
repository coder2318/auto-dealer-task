<?php

namespace App\Services;


use Exception;
use Illuminate\Support\Facades\Http;

class TelegramService extends BaseService
{

    public static function sendMessage($text, $message_thread_id = null): bool
    {
        $token = config('telegram.token');
        $chat_id = config('telegram.chat_id');
        $content = self::arrayToPrettyString($text);
        $app_name = preg_replace("/[^a-zA-Z0-9]+/", "", config('app.name'));
        $suffix = '#' . $app_name . PHP_EOL . '#' . config('app.env');
        try {
            $res = Http::withoutVerifying()
                ->withOptions([
                    'timeout' => 10,
                    'verify' => false
                ])
                ->get("https://api.telegram.org/bot$token/sendMessage", [
                    'chat_id' => $chat_id,
                    'text' => $content . PHP_EOL . $suffix,
                    'message_thread_id' => $message_thread_id,
                    'parse_mode' => 'HTML'
                ]);
            return $res->status() == 200;
        } catch (Exception $exception) {
            return false;
        }
    }


    public static function arrayToPrettyString($array, $level = 0): string
    {
        if (empty($array)) return '';
        if (!is_array($array)) return $array;
        $res = '[' . PHP_EOL;
        $tab = '';
        foreach ($array as $key => $item) {
            $tab = str_pad("", $level, "\t", STR_PAD_LEFT);
            $res .= $tab . "\t" . '"' . $key . '"=>';
            $res .= is_array($item)
                ? self::arrayToPrettyString($item, $level + 1)
                : '"' . $item . '",' . PHP_EOL;
        }
        $res .= $tab . '],' . PHP_EOL;
        return $res;

    }
}
