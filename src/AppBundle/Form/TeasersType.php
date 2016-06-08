<?php

namespace AppBundle\Form;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TeasersType extends AbstractType
{

    private $user;
    private $em;

    function __construct(User $user, EntityManager $em)
    {
        $this->user = $user;
        $this->em = $em;
    }


    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user', 'hidden')
            ->add('rubrics', 'entity', array(
                    'class' => 'AppBundle:Rubrics',
                    'choices' => $this->getRubricsForUser()
                ))
            ->add('createdAt', 'hidden')
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

    private function getRubricsForUser() {
        return $this->em->getRepository('AppBundle:Rubrics')
            ->findBy(array('user'=> $this->user));
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
