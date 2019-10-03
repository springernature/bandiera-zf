<?php
declare(strict_types=1);

namespace SpringerNature\Zend\Bandiera\View\Helper;

use Nature\Bandiera\Client;
use Zend\View\Helper\AbstractHelper;

class FeatureFlags extends AbstractHelper
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $group;

    public function __construct(Client $client, string $group)
    {
        $this->client = $client;
        $this->group = $group;
    }

    public function __invoke(string $feature, array $params = [], string $group = null): bool
    {
        return $this->isEnabled($feature, $params);
    }

    public function isEnabled(string $feature, array $params = [], string $group = null): bool
    {
        $group = $group ?: $this->group;

        if (empty($group)) {
            throw new \RuntimeException('no group specified, review your configuration or pass a group');
        }

        return (bool)$this->client->isEnabled($group, $feature, $params);
    }
}
