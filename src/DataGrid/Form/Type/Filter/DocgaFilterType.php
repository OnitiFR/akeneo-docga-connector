<?php

namespace Oniti\Docga\ConnectorBundle\DataGrid\Form\Type\Filter;

use Oro\Bundle\FilterBundle\Form\Type\Filter\FilterType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * TextCollectionFilterType to display the grid filter
 *
 * @author JM Leroux <jean-marie.leroux@akeneo.com>
 */
class DocgaFilterType extends AbstractType
{
    const TYPE_CONTAINS = 1;
    const TYPE_NOT_CONTAINS = 2;

    const NAME = 'pim_type_docga_filter';

    /** @var TranslatorInterface */
    protected $translator;

    /**
     * @param TranslatorInterface $translator
     */
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return self::NAME;
    }

    /**
     * {@inheritDoc}
     */
    public function getParent()
    {
        return FilterType::class;
    }

    /**
     * {@inheritDoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $choices = [
            self::TYPE_CONTAINS        => $this->translator->trans('oro.filter.form.label_type_contains'),
            self::TYPE_NOT_CONTAINS    => $this->translator->trans('oro.filter.form.label_type_not_contains'),
            FilterType::TYPE_EMPTY     => $this->translator->trans('oro.filter.form.label_type_empty'),
            FilterType::TYPE_NOT_EMPTY => $this->translator->trans('oro.filter.form.label_type_not_empty'),
        ];

        $resolver->setDefaults(
            [
                'field_type'       => TextType::class,
                'operator_choices' => $choices,
            ]
        );
    }
}
