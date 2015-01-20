<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TeasersType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user', 'hidden')
            ->add('groups')
            ->add('createdAt', 'hidden')
//            ->add('image', 'file', array(
//                'label' => 'upload',
//                'attr' => array(
//                    'multiple' => true,
//                    'class' => 'btn btn-success btn-cons uploadImages'
//                )
//            ))
            ->add('title', 'textarea', array(
                'attr' => array(
                    'class' => 'form-control groupsDetails',
                    'rows' => 10
                )
            ))
            ->add('link', 'textarea', array(
                'attr' => array(
                    'class' => 'form-control groupsDetails',
                    'rows' => 10
                )
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Teasers'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_teasers';
    }
}
