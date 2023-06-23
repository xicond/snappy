<?php

namespace spec\KnpLabs\Snappy\Bundle\DependencyInjection;

use KnpLabs\Snappy\Bundle\DependencyInjection\Configuration;
use PhpSpec\ObjectBehavior;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Assert\Assertion;

class ConfigurationSpec extends ObjectBehavior
{

    function it_is_initializable(): void
    {
        $this->shouldHaveType(Configuration::class);
    }

    function it_is_processing_an_empty_configuration(): void
    {
        $processor = new Processor();
        $config = $processor->processConfiguration($this->getWrappedObject(), []);
        $expected = [];

        Assertion::eq($expected, $config);
    }

    function it_is_processing_a_partial_wkhtmltopdf_backend_configuration(): void
    {
        $processor = new Processor();
        $config = $processor->processConfiguration(
            $this->getWrappedObject(),
            [[
                'wkhtmltopdf' => [
                    'binary_path' => '/usr/bin/wkhtmltopdf',
                ],
            ]]
        );
        $expected = [
            'wkhtmltopdf' => [
                'binary_path' => '/usr/bin/wkhtmltopdf',
                'options' => [],
            ],
        ];

        Assertion::eq($expected, $config);
    }

    function it_is_processing_a_full_wkhtmltopdf_backend_configuration(): void
    {
        $processor = new Processor();
        $config = $processor->processConfiguration(
            $this->getWrappedObject(),
            [[
                'wkhtmltopdf' => [
                    'binary_path' => '/usr/bin/wkhtmltopdf',
                    'options' => [
                        'key1' => 'val',
                        'key2' => null,
                        'key3',
                    ],
                ],
            ]]
        );
        $expected = [
            'wkhtmltopdf' => [
                'binary_path' => '/usr/bin/wkhtmltopdf',
                'options' => [
                    'key1' => 'val',
                    'key2' => null,
                    'key3',
                ],
            ],
        ];

        Assertion::eq($expected, $config);
    }

    function it_is_processing_a_partial_chromium_backend_configuration(): void
    {
        $processor = new Processor();
        $config = $processor->processConfiguration(
            $this->getWrappedObject(),
            [[
                'chromium' => [
                    'binary_path' => '/usr/bin/chromium',
                ],
            ]]
        );
        $expected = [
            'chromium' => [
                'binary_path' => '/usr/bin/chromium',
                'options' => [],
            ],
        ];

        Assertion::eq($expected, $config);
    }

    function it_is_processing_a_full_chromium_backend_configuration(): void
    {
        $processor = new Processor();
        $config = $processor->processConfiguration(
            $this->getWrappedObject(),
            [[
                'chromium' => [
                    'binary_path' => '/usr/bin/chromium',
                    'options' => [
                        'key1' => 'val',
                        'key2' => null,
                        'key3',
                    ],
                ],
            ]]
        );
        $expected = [
            'chromium' => [
                'binary_path' => '/usr/bin/chromium',
                'options' => [
                    'key1' => 'val',
                    'key2' => null,
                    'key3',
                ],
            ],
        ];

        Assertion::eq($expected, $config);
    }

    function it_is_processing_a_multi_backend_configuration(): void
    {
        $processor = new Processor();
        $config = $processor->processConfiguration(
            $this->getWrappedObject(),
            [[
                'wkhtmltopdf' => [
                    'binary_path' => '/usr/bin/wkhtmltopdf',
                ],
                'chromium' => [
                    'binary_path' => '/usr/bin/chromium',
                    'options' => [
                        'key1' => 'val',
                        'key2' => null,
                        'key3',
                    ],
                ],
            ]]
        );
        $expected = [
            'wkhtmltopdf' => [
                'binary_path' => '/usr/bin/wkhtmltopdf',
                'options' => [],
            ],
            'chromium' => [
                'binary_path' => '/usr/bin/chromium',
                'options' => [
                    'key1' => 'val',
                    'key2' => null,
                    'key3',
                ],
            ],
        ];

        Assertion::eq($expected, $config);
    }
}
