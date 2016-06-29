<?php

namespace Satisfaction\FormBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Satisfaction\FormBundle\Entity\Client;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Satisfaction\FormBundle\Entity\Ticket;
use Satisfaction\FormBundle\Entity;

class TicketType extends AbstractType
{
    private $choices_5;

    private $choices_10;

    private $listID;

    private $nt;

    private $data_num;

    public function __construct(array $choices_5,$choices_10,$listID,$nt)
    {
        $this->choices_5 = $choices_5;
        $this->choices_10 = $choices_10;
        $this->listID = $listID;
        $this->nt = $nt;
        if(strlen($nt[0])>= "1") $this->data_num = $nt[0];
        if(strlen($nt[0])<= "1") $this->data_num = $nt;

        echo $this->data_num;
    }

    public function buildForm(FormBuilderInterface $builder,  array $options)
    {
        $builder
            ->add('numticket', 'choice', array(
                'label' => 'Numéro Ticket',
                'choices' => $this->listID,
                'read_only' => false,
                'data' => $this->data_num,
                'multiple' => false,
                'label_attr' => array(
                    'class' => 'col-sm-2 control-label',
                ),
                'attr' => array(
                    'class' => 'form-control',
                    'onChange'=> 'submit()',
                )
            ))
            ->add('Sujet', 'text', array(
                'label' => 'Sujet',
                'label_attr' => array(
                    'class' => 'col-sm-2 control-label',
                ),
                'attr' => array(
                    'class' => 'form-control',
                ),
                'read_only' => true
            ))
            ->add('Description', 'textarea', array(
                'label' => 'Description',
                'label_attr' => array(
                    'class' => 'col-sm-2 control-label',
                    'rows' => '5',
                ),
                'attr' => array(
                    'class' => 'form-control',
                ),
                'read_only' => true
            ))
            ->add('Satisfaction', 'choice', array(
                'label' => 'Satisfaction',
                'label_attr' => array(
                    'class' => 'col-sm-2 control-label',
                ),
                'choices' => $this->choices_10,
                'expanded' => true,
                'multiple' => false,
                'required' => true,
                'attr' => array(
                    'class' => 'form-control',
                )
            ))
            ->add('Conformite', 'choice', array(
                'label' => 'Conformité',
                'label_attr' => array(
                    'class' => 'col-sm-2 control-label',
                ),
                'choices' => $this->choices_10,
                'expanded' => true,
                'multiple' => false,
                'required' => true,
                'attr' => array(
                    'class' => 'form-control',
                )
            ))
            ->add('Accompagnement', 'choice', array(
                'label' => 'Accompagnement',
                'label_attr' => array(
                    'class' => 'col-sm-2 control-label',
                ),
                'choices' => $this->choices_10,
                'expanded' => true,
                'multiple' => false,
                'required' => true,
                'attr' => array(
                    'class' => 'form-control',
                )
            ))
            ->add('Delais', 'choice', array(
                'label' => 'Délais',
                'label_attr' => array(
                    'class' => 'col-sm-2 control-label',
                ),
                'choices' => $this->choices_10,
                'expanded' => true,
                'multiple' => false,
                'required' => true,
                'attr' => array(
                    'class' => 'form-control',
                )
            ))
            ->add('Commentaires', 'textarea', array(
                'label' => 'Commentaires',
                'required' => false,
                'label_attr' => array(
                    'class' => 'col-sm-2 control-label',
                ),
                'attr' => array(
                    'class' => 'form-control',
                )
            ))

            ->add('id', 'hidden', array(
                'label' => 'id'
            ))
            ->add('Envoyer', 'submit', array(
                'label' => 'Envoyer',
                'attr' => array(
                    'class' => 'btn btn-success',
                )
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Satisfaction\FormBundle\Entity\Ticket',
        ));
    }
}
?>
