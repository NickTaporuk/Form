<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Form\Extension\Core\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormViewInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FileType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildView(FormViewInterface $view, FormInterface $form, array $options)
    {
        $view
            ->set('type', 'file')
            ->set('value', '')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function finishView(FormViewInterface $view, FormInterface $form, array $options)
    {
        $view
            ->set('multipart', true)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'single_control' => true,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'field';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'file';
    }
}
