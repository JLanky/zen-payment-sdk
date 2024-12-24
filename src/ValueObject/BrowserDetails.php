<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\ValueObject;

use Symfony\Component\Validator\Constraints as Assert;

class BrowserDetails
{
    public function __construct(
        #[Assert\NotBlank]
        private readonly string $acceptHeader,

        #[Assert\NotBlank]
        private readonly string $colorDepth,

        #[Assert\NotBlank]
        private readonly bool $javaEnabled,

        #[Assert\NotBlank]
        private readonly bool $javascriptEnabled,

        #[Assert\NotBlank]
        private readonly string $lang,

        #[Assert\NotBlank]
        private readonly string $screenHeight,

        #[Assert\NotBlank]
        private readonly string $screenWidth,

        #[Assert\NotBlank]
        private readonly string $timezone,

        #[Assert\NotBlank]
        private readonly string $windowSize,

        #[Assert\NotBlank]
        private readonly string $userAgent
    ) {}

    public function getAcceptHeader(): string
    {
        return $this->acceptHeader;
    }

    public function getColorDepth(): string
    {
        return $this->colorDepth;
    }

    public function isJavaEnabled(): bool
    {
        return $this->javaEnabled;
    }

    public function isJavascriptEnabled(): bool
    {
        return $this->javascriptEnabled;
    }

    public function getLang(): string
    {
        return $this->lang;
    }

    public function getScreenHeight(): string
    {
        return $this->screenHeight;
    }

    public function getScreenWidth(): string
    {
        return $this->screenWidth;
    }

    public function getTimezone(): string
    {
        return $this->timezone;
    }

    public function getWindowSize(): string
    {
        return $this->windowSize;
    }

    public function getUserAgent(): string
    {
        return $this->userAgent;
    }
}
