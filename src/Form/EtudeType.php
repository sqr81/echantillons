<?php

namespace App\Form;

use App\Entity\Etude;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtudeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero')
            ->add('sponsor')
            ->add('test')
            ->add('DE', null, [
                'label' => 'DE'
            ])
            ->add('tre', null, [
                'label' => 'TRE'
            ])
            ->add('espece', ChoiceType::class, [
                'choices' => $this->getChoices()
            ])             
            ->add('statut',ChoiceType::class,[
                'choices' => [
                    'stocké' => true,
                    'en cours' => false,
                    'détruit' => false,
                ],
                ])
            ->add('commentaire')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Etude::class,
        ]);
    }

    private function getChoices()
    {
        $choices = Etude::ESPECE;
        $ouput = [];
        foreach($choices as $k => $v) {
            $output[$v] = $k;
        }
        return $output;
    }
   
}
