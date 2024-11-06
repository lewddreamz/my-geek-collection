<?php
declare(strict_types=1);
namespace App\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
class EntryDataForm extends AbstractType
{
    public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('title', TextType::class)
        ->add('genre', TextType::class)
        ->add('createdAt', DateTimeType::class)
        ->add('author', TextType::class);
    }
}