<?php

namespace App\Helpers;

/**
 * Enlaces de WhatsApp reutilizables (cotización / asesoría).
 */
class WhatsAppHelper
{
    public static function phone(): string
    {
        return (string) config('services.impeercol.whatsapp_phone', '573025069825');
    }

    public static function messageUrl(string $message): string
    {
        $phone = self::phone();

        return 'https://wa.me/'.$phone.'?text='.rawurlencode($message);
    }
}
