<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Form\Config;

use Symfony\Component\Form\FieldInterface;
use Symfony\Component\Form\Renderer\DefaultRenderer;
use Symfony\Component\Form\Renderer\Theme\ThemeInterface;
use Symfony\Component\Form\Renderer\Plugin\FieldPlugin;

class FieldConfig extends AbstractFieldConfig
{
    private $theme;

    public function __construct(ThemeInterface $theme)
    {
        $this->theme = $theme;
    }

    public function configure(FieldInterface $field, array $options)
    {
        $field->setPropertyPath($options['property_path'] === false
                    ? $field->getKey()
                    : $options['property_path'])
            ->setTrim($options['trim'])
            ->setRequired($options['required'])
            ->setDisabled($options['disabled'])
            ->setValueTransformer($options['value_transformer'])
            ->setNormalizationTransformer($options['normalization_transformer'])
            ->setData($options['data'])
            ->setRenderer(new DefaultRenderer($this->theme, $options['template']))
            ->addRendererPlugin(new FieldPlugin($field))
            ->setRendererVar('class', null)
            ->setRendererVar('max_length', null)
            ->setRendererVar('size', null)
            ->setRendererVar('label', ucfirst(strtolower(str_replace('_', ' ', $field->getKey()))));
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'template' => 'text',
            'data' => null,
            'property_path' => false,
            'trim' => true,
            'required' => true,
            'disabled' => false,
            'value_transformer' => null,
            'normalization_transformer' => null,
        );
    }

    public function getClassName()
    {
        return 'Symfony\Component\Form\Field';
    }

    public function getParent(array $options)
    {
        return null;
    }

    public function getIdentifier()
    {
        return 'field';
    }
}