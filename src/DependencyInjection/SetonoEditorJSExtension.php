<?php

declare(strict_types=1);

namespace Setono\EditorJSBundle\DependencyInjection;

use Setono\EditorJS\BlockHydrator\BlockHydratorInterface;
use Setono\EditorJS\BlockRenderer\BlockRendererInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

final class SetonoEditorJSExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));

        /** @psalm-suppress ReservedWord */
        $loader->load('services.xml');

        $container->registerForAutoconfiguration(BlockHydratorInterface::class)
            ->addTag('setono_editorjs.block_hydrator');

        $container->registerForAutoconfiguration(BlockRendererInterface::class)
            ->addTag('setono_editorjs.block_renderer');
    }
}
