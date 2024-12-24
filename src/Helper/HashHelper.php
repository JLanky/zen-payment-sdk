<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Helper;

use Exception;

class HashHelper
{
    /** @throws Exception */
    function generateRequestId(): string
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789?&:_|-/=+.,#';

        $length = random_int(38, 1024);

        $requestId = '';
        $maxIndex = strlen($characters) - 1;

        for ($i = 0; $i < $length; $i++) {
            $requestId .= $characters[random_int(0, $maxIndex)];
        }

        return $requestId;
    }
}
