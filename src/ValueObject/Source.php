<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\ValueObject;

use JLanky\ZenPayments\Enum\ValidationChoices;
use JLanky\ZenPayments\Enum\ValidationErrorMessages;
use Symfony\Component\Validator\Constraints as Assert;

final class Source
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Choice(choices: ValidationChoices::SOURCE_CHANNELS, message: ValidationErrorMessages::INVALID_CHANNEL)]
        private readonly string $channel,
        #[Assert\Length(min: 1, max: 100)]
        #[Assert\Regex(pattern: '/^[a-zA-Z0-9_-]+$/', message: ValidationErrorMessages::PLUGIN_NAME_INVALID)]
        private readonly ?string $pluginName = null,
        #[Assert\Regex(pattern: '/^\d+\.\d+\.\d+$/', message: ValidationErrorMessages::INVALID_VERSION)]
        private readonly ?string $pluginVersion = null,
        #[Assert\Length(min: 1, max: 100)]
        #[Assert\Regex(pattern: '/^[a-zA-Z0-9_-]+$/', message: ValidationErrorMessages::PLATFORM_NAME_INVALID)]
        private readonly ?string $platformName = null,
        #[Assert\Regex(pattern: '/^\d+\.\d+\.\d+$/', message: ValidationErrorMessages::INVALID_VERSION)]
        private readonly ?string $platformVersion = null
    ) {
    }

    public function getChannel(): string
    {
        return $this->channel;
    }

    public function getPluginName(): ?string
    {
        return $this->pluginName;
    }

    public function getPluginVersion(): ?string
    {
        return $this->pluginVersion;
    }

    public function getPlatformName(): ?string
    {
        return $this->platformName;
    }

    public function getPlatformVersion(): ?string
    {
        return $this->platformVersion;
    }
}
