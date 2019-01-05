<?php

namespace RoundPartner\Tests\Provider;

use GuzzleHttp\Psr7\Response;

class ResponseProvider
{
    /**
     * @return Response[]
     */
    public static function success()
    {
        return [
            [[new Response(204, [], '')]],
        ];
    }
}