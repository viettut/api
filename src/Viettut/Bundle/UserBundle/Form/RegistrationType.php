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
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Viettut\Model\User\UserEntityInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('professional')
        ;

        $builder->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                /** @var UserEntityInterface $user */
                $user = $event->getData();

                if ($user->getId() === null) {
                    $hash = md5(trim($user->getEmail()));
                    $user->setAvatar(sprintf('http://gravatar.com/avatar/%s?size=64&d=identicon', $hash));
                }
            }
        );
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