<?php

declare(strict_types=1);

namespace Setono\EditorJSBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Compiler\PriorityTaggedServiceTrait;
use Symfony\Component\DependencyInjection\ContainerBuilder;

final class RegisterBlockRenderersPass implements CompilerPassInterface
{
    use PriorityTaggedServiceTrait;

    public function process(ContainerBuilder $container): void
    {
        if (!$container->hasDefinition('setono_editorjs.block_renderer.composite')) {
            return;
        }

        $renderer = $container->getDefinition('setono_editorjs.block_renderer.composite');

        foreach ($this->findAndSortTaggedServices('setono_editorjs.block_renderer', $container) as $service) {
            $renderer->addMethodCall('add', [$service]);
        }
    }
}
