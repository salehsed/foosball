<?php

namespace Tagged\FoosballBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FoosballGameType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('player1')
            ->add('player2')
            ->add('player1_score')
            ->add('player2_score')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Tagged\FoosballBundle\Entity\FoosballGame'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'tagged_foosballbundle_foosballgame';
    }
}
