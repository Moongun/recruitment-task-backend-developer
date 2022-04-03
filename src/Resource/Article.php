<?php

declare(strict_types=1);


namespace App\Resource;

/**
 * Article Resource.
 */
class Article implements ResourceInterface
{
    public function __construct(
        private ?string $title,
        private ?string $publicationDate,
        private ?string $lead,
        private ?string $image,
        private ?string $url
    )
    {
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @return string|null
     */
    public function getPublicationDate(): ?string
    {
        return $this->publicationDate;
    }

    /**
     * @return string|null
     */
    public function getLead(): ?string
    {
        return $this->lead;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }


}