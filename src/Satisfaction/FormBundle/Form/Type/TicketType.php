<?php

namespace Satisfaction\FormBundle\Form\Type;


use Symfony\Component\Form\Extension\Core\Type\BaseType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Satisfaction\FormBundle\Entity\Ticket;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Satisfaction\FormBundle\Entity;

class TicketType extends BaseType
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
            ->add('numticket', ChoiceType::class, array(
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
            ->add('Sujet', TextType::class, array(
                'label' => 'Sujet',
                'label_attr' => array(
                    'class' => 'col-sm-2 control-label',
                ),
                'attr' => array(
                    'class' => 'form-control',
                ),
                'read_only' => true
            ))
            ->add('Description', TextareaType::class, array(
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
            ->add('Satisfaction', ChoiceType::class, array(
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
            ->add('Conformite', ChoiceType::class, array(
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
            ->add('Accompagnement', ChoiceType::class, array(
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
            ->add('Delais', ChoiceType::class, array(
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
            ->add('Commentaires', TextareaType::class, array(
                'label' => 'Commentaires',
                'required' => false,
                'label_attr' => array(
                    'class' => 'col-sm-2 control-label',
                ),
                'attr' => array(
                    'class' => 'form-control',
                )
            ))

            ->add('id', HiddenType::class, array(
                'label' => 'id'
            ))
            ->add('Envoyer', SubmitType::class, array(
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
