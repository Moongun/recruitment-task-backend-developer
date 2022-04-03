<?php

declare(strict_types=1);


namespace App\Collector;


interface ArticleCollectorInterface
{
    /**
     * @return string|null
     */
    public function getMain(): ?string;

    /**
     * @return string|null
     */
    public function getPublicationDate(): ?string;

    /**
     * @return string|null
     */
    public function getLeadParagraph(): ?string;

    /**
     * @return string|null
     */
    public function getImage(): ?string;

    /**
     * @return string|null
     */
    public function getWebUrl(): ?string;
}
