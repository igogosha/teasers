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
            ->add('background', 'hidden', array(
                'attr' => array(
                    'class' => 'colorPicker'
                )
            ))
            ->add('padding', 'number', array(
                'label' => 'Расстояние от текста до краев',
                'attr' => array(
                    'class' => 'form-control'
                )
            ))

            ->add('pictureSize', 'hidden', array(
                'label' => 'Размер картинки',
                'attr' => array(
                    'class' => 'slider'
                )
            ))
            ->add('pictureBorderRadius', 'number', array(
                'label' => 'Закругление краев',
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('pictureShadowSize', 'hidden', array(
                'label' => 'Размер тени',
                'attr' => array(
                    'class' => 'slider'
                )
            ))
            ->add('pictureShadowColor', 'hidden', array(
                'label' => 'Цвет тени',
                'attr' => array(
                    'class' => 'colorPicker'
                )
            ))
            ->add('pictureBorderSize', 'hidden', array(
                'label' => 'Размер рамки',
                'attr' => array(
                    'class' => 'slider'
                )
            ))
            ->add('pictureBorderColor', 'hidden', array(
                'label' => 'Цвет рамки',
                'attr' => array(
                    'class' => 'colorPicker'
                )
            ))
            ->add('pictureAlignHor', 'choice', array(
                'label' => 'Горизонтально',
                'choices' => array(
                    'left' => 'Слева',
                    'center' => 'По центру',
                    'right' => 'Справа',
                )
            ))
            ->add('pictureAlignVer', 'choice', array(
                'label' => 'Вертикально',
                'choices' => array(
                    'top' => 'Сверху',
                    'middle' => 'По центру',
                    'bottom' => 'Снизу',
                )
            ))

            ->add('headerFontFamily', 'choice', array(
                'label' => 'Шрифт для заголовка',
                'choices' => array(
                    'Arial' => 'Arial',
                    'Times New Roman' => 'Times New Roman',
                    'Verdana' => 'Verdana',
                    'serif' => 'serif',
                    'Tahoma' => 'Tahoma'
                )
            ))
            ->add('headerFontSize', 'hidden', array(
                'label' => 'Размер заголовка',
                'attr' => array(
                    'class' => 'slider'
                )
            ))
            ->add('headerFontColor', 'hidden', array(
                'attr' => array(
                    'class' => 'colorPicker'
                )
            ))
            ->add('headerAlignHor', 'choice', array(
                'label' => 'Горизонтально',
                'choices' => array(
                    'left' => 'Слева',
                    'center' => 'По центру',
                    'right' => 'Справа',
                )
            ))
            ->add('headerAlignVer', 'choice', array(
                'label' => 'Вертикально',
                'choices' => array(
                    'top' => 'Сверху',
                    'middle' => 'По центру',
                    'bottom' => 'Снизу',
                )
            ))
            ->add('headerFontStyle', 'choice', array(
                'label' => 'Стиль заголовка',
                'choices' => array(
                    'underline' => 'Подчеркнутый',
                    'bold' => 'Жирный',
                    'italic' => 'Курсив',
                )
            ))
            ->add('headerFontHoverColor', 'hidden', array(
                'attr' => array(
                    'class' => 'colorPicker'
                )
            ))
            ->add('headerFontHoverStyle', 'choice', array(
                'label' => 'Стиль активного заголовка',
                'choices' => array(
                    'underline' => 'Подчеркнутый',
                    'bold' => 'Жирный',
                    'italic' => 'Курсив',
                )
            ))

            ->add('moreActive', 'hidden', array(
                'label' => 'Активна',
                'attr' => array(
                    'class' => 'switch'
                )
            ))
            ->add('moreType', 'choice', array(
                'label' => 'Положение текста',
                'choices'   => array(
                    'txt' => 'Текст',
                    'btn' => 'Кнопка',
                )
            ))
            ->add('moreTxt', 'text', array(
                'label' => 'Текст',
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('moreImage')
            ->add('morePosition', 'choice', array(
                'label' => 'Положение текста',
                'choices'   => array(
                    'up' => 'Сверху',
                    'down' => 'Снизу',
                    'img_up' => 'Под картинкой',
                    'img_down' => 'Над картинкой',
                    'left_up' => 'Слева-сверху',
                    'left_down' => 'Слува-снизу',
                    'right_up' => 'Справа-сверху',
                    'right_down' => 'Справа-снизу',
                )
            ))
            ->add('moreBtnAlignHor', 'choice', array(
                'label' => 'Горизонтально',
                'choices' => array(
                    'left' => 'Слева',
                    'center' => 'По центру',
                    'right' => 'Справа',
                )
            ))
            ->add('moreBtnAlignVer', 'choice', array(
                'label' => 'Вертикально',
                'choices' => array(
                    'top' => 'Сверху',
                    'middle' => 'По центру',
                    'bottom' => 'Снизу',
                )
            ))
            ->add('moreTxtFont', 'choice', array(
                'label' => 'Шрифт для заголовка',
                'choices' => array(
                    'Arial' => 'Arial',
                    'Times New Roman' => 'Times New Roman',
                    'Verdana' => 'Verdana',
                    'serif' => 'serif',
                    'Tahoma' => 'Tahoma'
                )
            ))
            ->add('moreTxtFontSize', 'hidden', array(
                'label' => 'Размер шрифта',
                'attr' => array(
                    'class' => 'slider'
                )
            ))
            ->add('moreTxtFontColor', 'hidden', array(
                'attr' => array(
                    'class' => 'colorPicker'
                )
            ))
            ->add('moreTxtFontStyle', 'choice', array(
                'label' => 'Стиль текста',
                'choices' => array(
                    'underline' => 'Подчеркнутый',
                    'bold' => 'Жирный',
                    'italic' => 'Курсив',
                )
            ))
            ->add('moreTxtFontHoverColor', 'hidden', array(
                'attr' => array(
                    'class' => 'colorPicker'
                )
            ))
            ->add('moreTxtFontHoverStyle', 'choice', array(
                'label' => 'Стиль активного текста',
                'choices' => array(
                    'underline' => 'Подчеркнутый',
                    'bold' => 'Жирный',
                    'italic' => 'Курсив',
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
