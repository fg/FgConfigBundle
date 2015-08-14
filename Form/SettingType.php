<?php

namespace Fg\Bundle\ConfigBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SettingType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('scopeGroupType', null,
                array(
                    'label' => 'layout.setting_scope_group_type',
                    'translation_domain' => 'FgConfigBundle'
                )
            )
            ->add('scopeById', null,
                array(
                    'label' => 'layout.setting_scope_by_id',
                    'translation_domain' => 'FgConfigBundle'
                )
            )
            ->add('section', null,
                array(
                    'label' => 'layout.setting_section',
                    'translation_domain' => 'FgConfigBundle'
                )
            )
            ->add('name', null,
                array(
                    'label' => 'layout.setting_name',
                    'translation_domain' => 'FgConfigBundle'
                )
            )
            ->add('value', null,
                array(
                    'label' => 'layout.setting_value',
                    'translation_domain' => 'FgConfigBundle'
                )
            )
            ->add('createdAt', null,
                array(
                    'label' => 'layout.setting_created_at',
                    'translation_domain' => 'FgConfigBundle'
                )
            )
            ->add('updatedAt', null,
                array(
                    'label' => 'layout.setting_updated_at',
                    'translation_domain' => 'FgConfigBundle'
                )
            )
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Fg\Bundle\ConfigBundle\Entity\Setting'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'fg_bundle_configbundle_setting';
    }
}
