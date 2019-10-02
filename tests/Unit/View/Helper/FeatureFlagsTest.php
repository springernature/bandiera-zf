<?php

namespace SpringerNature\Zend\Bandiera\Test\Unit\View\Helper;


use Nature\Bandiera\Client;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use SpringerNature\Zend\Bandiera\View\Helper\FeatureFlags;

class FeatureFlagsTest extends TestCase
{

    /**
     * @test
     */
    function it_has_an_invoke_method_that_calls_isEnabled()
    {
        $client = $this->prophesize(Client::class);
        $viewHelper = new FeatureFlags($client->reveal(), 'my_app');

        $client->isEnabled('my_app', 'feature', [])->willReturn(true);

        $this->assertTrue($viewHelper->__invoke('feature'));
    }

    /**
     * @test
     * @dataProvider featureParamsProvider
     */
    function it_checks_if_feature_is_enabled(string $feature, array $params = [], bool $expected)
    {
        $client = $this->prophesize(Client::class);
        $viewHelper = new FeatureFlags($client->reveal(), 'my_app');

        $client->isEnabled('my_app', $feature, $params)->willReturn($expected);

        $this->assertSame($expected, $viewHelper->isEnabled($feature, $params));
    }

    public function featureParamsProvider(): \Generator
    {
        yield ['foo', [], true];
        yield ['bar', [], false];
        yield ['context', ['bar' => 1], true];
        yield ['context', ['bar' => 0], false];
    }

    /**
     * @test
     */
    public function it_uses_group_is_provided()
    {
        $client = $this->prophesize(Client::class);
        $viewHelper = new FeatureFlags($client->reveal(), 'my_app');

        $client->isEnabled(Argument::cetera())->willReturn(false);

        $viewHelper->isEnabled('foo', [], 'custom');

        $client->isEnabled('custom', Argument::cetera())->shouldHaveBeenCalled(true);
    }

    /**
     * @test
     */
    public function it_throws_exception_if_no_group_name_was_provided()
    {
        $client = $this->prophesize(Client::class);
        $viewHelper = new FeatureFlags($client->reveal(), '');

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('no group specified, review your configuration or pass a group');

        $viewHelper->isEnabled('foo', []);
    }
}
