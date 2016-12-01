<?php
/**
 * Created by PhpStorm.
 * User: giangle
 * Date: 12/1/16
 * Time: 9:01 PM
 */

namespace Viettut\Bundle\UserBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('professional')
        ;
    }

    public function getParent()
    {
        return 'fos_user_registration';
    }

    public function getName()
    {
        return 'viettut_user_registration';
    }
}