<?php

declare(strict_types=1);


namespace App\Service\NyTimes;


use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * Interface for endpoints of NyTimes API.
 */
interface EnpointInterface
{
    /**
     * Send request.
     *
     * @return ResponseInterface
     */
    public function call() : ResponseInterface;
}