<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BlockSettingsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('blockName', 'text', array(
                'label' => 'Название блока',
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Название блока'
                )
            ))
            ->add('rows', 'number', array(
                'label' => 'Количество строк',
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('cols', 'number', array(
                'label' => 'Количество столбцов',
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('textPosition', 'choice', array(
                'label' => 'Положение текста',
                'choices'   => array('top' => 'Сверху', 'bottom' => 'Снизу', 'left' => 'Слева', 'right' => 'Справа')
            ))
            ->add('background', 'hidden')
            ->add('padding', 'number', array(
                'label' => 'Расстояние от текста до краев',
                'attr' => array(
                    'class' => 'form-control'
                )
            ))

            ->add('pictureSize')
            ->add('pictureBorderRadius')
            ->add('pictureShadowSize')
            ->add('pictureShadowColor')
            ->add('pictureBorderSize')
            ->add('pictureAlignHor')
            ->add('pictureAlignVer')
            ->add('headerFontFamily')
            ->add('headerFontSize')
            ->add('headerFontColor')
            ->add('headerAlignHor')
            ->add('headerAlignVer')
            ->add('headerFontStyle')
            ->add('headerFontHoverColor')
            ->add('headerFontHoverStyle')
            ->add('moreActive')
            ->add('moreType')
            ->add('moreTxt')
            ->add('moreImage')
            ->add('morePosition')
            ->add('moreBtnAlignHor')
            ->add('moreBtnAlignVer')
            ->add('moreTxtFont')
            ->add('moreTxtFontSize')
            ->add('moreTxtFontColor')
            ->add('moreTxtFontStyle')
            ->add('moreTxtFontHoverColor')
            ->add('moreTxtFontHoverStyle')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\BlockSettings'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_blocksettings';
    }
}
