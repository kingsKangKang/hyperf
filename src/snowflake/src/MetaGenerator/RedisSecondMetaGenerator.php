<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace Hyperf\Snowflake\MetaGenerator;

use Hyperf\Contract\ConfigInterface;
use Hyperf\Snowflake\ConfigurationInterface;

class RedisSecondMetaGenerator extends RedisMetaGenerator
{
    public function __construct(ConfigurationInterface $configuration, int $beginTimestamp = self::DEFAULT_BEGIN_SECOND, ConfigInterface $config)
    {
        parent::__construct($configuration, $beginTimestamp, $config);
    }

    public function getTimestamp(): int
    {
        return time();
    }

    public function getNextTimestamp(): int
    {
        $timestamp = $this->getTimestamp();
        while ($timestamp <= $this->lastTimestamp) {
            usleep(1000);
            $timestamp = $this->getTimestamp();
        }

        return $timestamp;
    }
}
