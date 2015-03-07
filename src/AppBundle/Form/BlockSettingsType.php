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
            ->add('rows', 'text', array(
                'label' => 'Количество строк',
                'attr' => array(
                    'class' => 'slider_input',
                    'data-slider-min' => 1,
                    'data-slider-max' => 10,
                    'data-slider-step' => 1,
                    'data-slider-value' => 1,
                    'data-slider-orientation' => 'horizontal',
                    'data-slider-selection' => 'after',
                    'value' => ''
                )
            ))
            ->add('cols', 'text', array(
                'label' => 'Количество столбцов',
                'attr' => array(
                    'class' => 'slider_input',
                    'data-slider-min' => 1,
                    'data-slider-max' => 10,
                    'data-slider-step' => 1,
                    'data-slider-value' => 2,
                    'data-slider-orientation' => 'horizontal',
                    'data-slider-selection' => 'after',
                    'value' => ''
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
                    'class' => 'slider_input',
                    'data-slider-min' => 0,
                    'data-slider-max' => 10,
                    'data-slider-step' => 1,
                    'data-slider-value' => 1,
                    'data-slider-orientation' => 'horizontal',
                    'data-slider-selection' => 'after',
                    'value' => ''
                )
            ))

            ->add('pictureSize', 'text', array(
                'label' => 'Размер картинок',
                'attr' => array(
                    'class' => 'slider_input',
                    'data-slider-min' => 50,
                    'data-slider-max' => 200,
                    'data-slider-step' => 10,
                    'data-slider-value' => 100,
                    'data-slider-orientation' => 'horizontal',
                    'data-slider-selection' => 'after',
                    'value' => ''
                )
            ))
            ->add('pictureBorderRadius', 'text', array(
                'label' => 'Закругление краев',
                'attr' => array(
                    'class' => 'slider_input',
                    'data-slider-min' => 0,
                    'data-slider-max' => 50,
                    'data-slider-step' => 1,
                    'data-slider-value' => 1,
                    'data-slider-orientation' => 'horizontal',
                    'data-slider-selection' => 'after',
                    'value' => ''
                )
            ))
            ->add('pictureShadowSize', 'text', array(
                'label' => 'Размер тени',
                'attr' => array(
                    'class' => 'slider_input',
                    'data-slider-min' => 0,
                    'data-slider-max' => 10,
                    'data-slider-step' => 1,
                    'data-slider-value' => 1,
                    'data-slider-orientation' => 'horizontal',
                    'data-slider-selection' => 'after',
                    'value' => ''
                )
            ))
            ->add('pictureShadowColor', 'hidden', array(
                'label' => 'Цвет тени',
                'attr' => array(
                    'class' => 'colorPicker'
                )
            ))
            ->add('pictureBorderSize', 'text', array(
                'label' => 'Размер рамки',
                'attr' => array(
                    'class' => 'slider_input',
                    'data-slider-min' => 0,
                    'data-slider-max' => 10,
                    'data-slider-step' => 1,
                    'data-slider-value' => 1,
                    'data-slider-orientation' => 'horizontal',
                    'data-slider-selection' => 'after',
                    'value' => ''
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
            ->add('headerFontSize', 'text', array(
                'label' => 'Размер заголовка',
                'attr' => array(
                    'class' => 'slider_input',
                    'data-slider-min' => 10,
                    'data-slider-max' => 24,
                    'data-slider-step' => 1,
                    'data-slider-value' => 16,
                    'data-slider-orientation' => 'horizontal',
                    'data-slider-selection' => 'after',
                    'value' => ''
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

            ->add('moreActive', 'checkbox', array(
                'label' => 'Активна',
                'attr' => array(
                    'class' => 'ios',
                    'value' => 0
                )
            ))
            ->add('moreType', 'choice', array(
                'label' => 'Тип',
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
            ->add('moreTxtFontSize', 'text', array(
                'label' => 'Размер шрифта',
                'attr' => array(
                    'class' => 'slider_input',
                    'data-slider-min' => 10,
                    'data-slider-max' => 24,
                    'data-slider-step' => 1,
                    'data-slider-value' => 16,
                    'data-slider-orientation' => 'horizontal',
                    'data-slider-selection' => 'after',
                    'value' => ''
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
