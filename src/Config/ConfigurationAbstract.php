<?php
declare(strict_types=1);

namespace WShafer\PSR11FlySystem\Config;

use WShafer\PSR11FlySystem\Exception\MissingConfigException;

abstract class ConfigurationAbstract
{
    protected $config = [];

    public function __construct(array $config)
    {
        $this->validateConfig($config);
        $this->config = $config;
    }

    protected function validateConfig($config)
    {
        if (empty($config)) {
            throw new MissingConfigException(
                'No config found'
            );
        }

        if (empty($config['type'])) {
            throw new MissingConfigException(
                'No config key of "type" found in adaptor config array.'
            );
        }
    }

    public function getType()
    {
        return $this->config['type'];
    }

    public function getOptions()
    {
        return $this->config['options'] ?? [];
    }
}
