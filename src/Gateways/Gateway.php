<?php

/*
 * This file is part of the overtrue/easy-sms.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Overtrue\EasySms\Gateways;

use Overtrue\EasySms\Contracts\GatewayInterface;
use Overtrue\EasySms\Support\Config;

/**
 * Class Gateway.
 */
abstract class Gateway implements GatewayInterface
{
    const DEFAULT_TIMEOUT = 5.0;

    const DEFAULT_FORCE_IP_RESOLVE = 'v4';

    /**
     * @var \Overtrue\EasySms\Support\Config
     */
    protected $config;

    /**
     * @var float
     */
    protected $timeout;

    /**
     * @var string
     */
    protected $force_ip_resolve;

    /**
     * Gateway constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = new Config($config);
    }

    /**
     * Return timeout.
     *
     * @return int|mixed
     */
    public function getTimeout()
    {
        return $this->timeout ?: $this->config->get('timeout', self::DEFAULT_TIMEOUT);
    }

    /**
     * @return mixed
     */
    public function getForceIpResolve()
    {
        return $this->force_ip_resolve ?: $this->config->get('force_ip_resolve', self::DEFAULT_FORCE_IP_RESOLVE);
    }

    /**
     * Set timeout.
     *
     * @param int $timeout
     *
     * @return $this
     */
    public function setTimeout($timeout)
    {
        $this->timeout = floatval($timeout);

        return $this;
    }

    /**
     * @return \Overtrue\EasySms\Support\Config
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param \Overtrue\EasySms\Support\Config $config
     *
     * @return $this
     */
    public function setConfig(Config $config)
    {
        $this->config = $config;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return \strtolower(str_replace([__NAMESPACE__.'\\', 'Gateway'], '', \get_class($this)));
    }
}
