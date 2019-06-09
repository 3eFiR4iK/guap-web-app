<?php

namespace App\Form\Vk;

use App\Form\Type\VkObjectType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotNull;

class VkTypeActionForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('type', TextType::class, [
            'constraints' => [
                new NotNull(),
            ],
        ]);
        $builder->add('object', VkObjectType::class);

        $builder->add('group_id', IntegerType::class);

        $builder->add('secret', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'error_bubbling' => false,
        ]);
    }
}
