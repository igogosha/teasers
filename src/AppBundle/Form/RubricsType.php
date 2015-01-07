<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RubricsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                'label' => 'Название',
                'attr' => array(
                    'class' => 'form-control input-lg'
                )
            ))
//            ->add('alias')
//            ->add('groups')
//            ->add('createdAt')
//            ->add('user')
            ->add('save', 'button', array(
                'label' => 'Save',
                'attr' => array(
                    'class' => 'btn btn-lg btn-danger'
                ),
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Rubrics'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_rubrics';
    }
}
