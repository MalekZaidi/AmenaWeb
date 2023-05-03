<?php

namespace App\Form;

use App\Entity\Documentexpedition;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
class DocumentexpeditionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('statut', ChoiceType::class, [
            'choices' => [
                'Signé' => 'signe',
                'Non signé' => 'non-signe',
            ],
            'expanded' => true,
            'multiple' => false,
            'label' => 'Statut',
        ])
            ->add('colis_id')
            ->add('description')
            ->add('Enregistrer',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Documentexpedition::class,
        ]);
    }
}
