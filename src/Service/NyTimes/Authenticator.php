<?php

declare(strict_types=1);


namespace App\Service\NyTimes;

/**
 * Class for authentication.
 */
class Authenticator
{
    public function __construct(private string $apiKey)
    {
    }

    /**
     * Getter.
     *
     * @return string
     */
    public function getApiKey() : string
    {
        if (!$this->apiKey) {
            throw new \LogicException("Provide 'NYTIMES_API_KEY' in .env");
        }
        return $this->apiKey;
    }
}
