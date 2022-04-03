<?php

declare(strict_types=1);


namespace App\Collector;

/**
 * Class for collecting data from NyTimes Api for Article Resource.
 */
class NyTimesArticleCollector implements ArticleCollectorInterface
{
    private ?string $main;
    private ?string $publicationDate;
    private ?string $leadParagraph;
    private ?string $image;
    private ?string $webUrl;

    /**
     * @param object $data Single Object 'doc' from HttpResponse.
     */
    public function __construct(object $data)
    {
        $this->main = $data?->headline?->main;
        $this->publicationDate = $data?->pub_date;
        $this->leadParagraph = $data?->lead_paragraph;

        $multimedias = $data?->multimedia;
        $multimedias = array_filter($multimedias, fn($multimedia) => $multimedia->subtype === 'superJumbo');
        $this->image = !empty($multimedias) ? reset($multimedias)?->url : null;

        $this->webUrl = $data?->web_url;
    }

    /**
     * @return string|null
     */
    public function getMain(): ?string
    {
        return $this->main;
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
    public function getLeadParagraph(): ?string
    {
        return $this->leadParagraph;
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
    public function getWebUrl(): ?string
    {
        return $this->webUrl;
    }
}