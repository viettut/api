<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 10:03 PM
 */

namespace Viettut\Form\Type;


use Doctrine\Common\Collections\Collection;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Viettut\Entity\Core\Challenge;
use Viettut\Model\Core\ChallengeInterface;
use Viettut\Model\Core\TestCollectionInterface;
use Viettut\Model\Core\TestInterface;

class ChallengeFormType extends AbstractRoleSpecificFormType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('timeLimit')
            ->add('total')
            ->add('name')
            ->add('testCollection', 'collection', array(
                    'mapped' => true,
                    'type' => new TestCollectionFormType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                )
            )
        ;

        $builder->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                /** @var ChallengeInterface $challenge */
                $challenge = $event->getData();

                /** @var Collection|TestCollectionInterface[] $testCollection */
                $testCollection = $event->getForm()->get('testCollection')->getData();
                if ($testCollection === null) {
                    $testCollection = [];
                }

                /** @var TestCollectionInterface $item */
                foreach ($testCollection as $item) {
                    if (!$item->getTest() instanceof TestInterface) {
                        $item->setChallenge($challenge);
                    }
                }

                if ($testCollection instanceof Collection) {
                    $testCollection = $testCollection->toArray();
                }

                $testCollection = array_unique($testCollection);
                $challenge->setTestCollection($testCollection);
                $challenge->setTotal(count($testCollection));
            }
        );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults([
                'data_class' => Challenge::class,
                'csrf_protection'   => false
            ]);
    }
    
    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'viettut_form_challenge';
    }
}