<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\ValueObject;

use Symfony\Component\Validator\Constraints as Assert;

final class Source
{
    public function __construct(
        #[Assert\NotBlank]
        private readonly string $channel,
        #[Assert\NotBlank]
        private readonly ?string $pluginName = null,
        #[Assert\NotBlank]
        private readonly ?string $pluginVersion = null,
        #[Assert\NotBlank]
        private readonly ?string $platformName = null,
        #[Assert\NotBlank]
        private readonly ?string $platformVersion = null
    ) {
    }

    public function getChannel(): string
    {
        return $this->channel;
    }

    public function getPluginName(): string
    {
        return $this->pluginName;
    }

    public function getPluginVersion(): string
    {
        return $this->pluginVersion;
    }

    public function getPlatformName(): string
    {
        return $this->platformName;
    }

    public function getPlatformVersion(): string
    {
        return $this->platformVersion;
    }
}
