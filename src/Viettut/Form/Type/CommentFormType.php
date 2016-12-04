<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 10:03 PM
 */

namespace Viettut\Form\Type;


use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Viettut\Entity\Core\Comment;
use Viettut\Model\Core\CommentInterface;
use Viettut\Utilities\StringFactory;

class CommentFormType extends AbstractRoleSpecificFormType
{
    use StringFactory;
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content')
            ->add('course')
            ->add('chapter')
            ->add('tutorial')
            ->add('replyFor')
        ;

        $builder->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                /** @var CommentInterface $comment */
                $comment = $event->getData();

                if ($comment->getCourse() === null &&
                    $comment->getTutorial() === null &&
                    $comment->getReplyFor() === null &&
                    $comment->getChapter() === null ) {
                    $event->getForm()->get('course')->addError(new FormError('invalid argument'));
                    $event->getForm()->get('chapter')->addError(new FormError('invalid argument'));
                    $event->getForm()->get('tutorial')->addError(new FormError('invalid argument'));
                    $event->getForm()->get('replyFor')->addError(new FormError('invalid argument'));
                    return;
                }

                $parent = $comment->getReplyFor();
                if ($parent instanceof CommentInterface) {
                    $parent->addReply($comment);
                }

                $comment->setActive(true);
            }
        );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults([
                'data_class' => Comment::class
            ]);
    }
    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'viettut_form_chapter';
    }
}