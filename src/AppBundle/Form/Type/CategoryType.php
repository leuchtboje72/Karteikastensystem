<?php

    namespace AppBundle\Form\Type;

    use Symfony\Bridge\Doctrine\Form\DataTransformer\CollectionToArrayTransformer;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\FormBuilderInterface;

    class CategoryType extends AbstractType {

        /**
         * @param FormBuilderInterface $builder
         * @param array $options
         */
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder
                ->addModelTransformer(new CollectionToArrayTransformer(), true)
                ->addModelTransformer(new CategoryTransformer(), true);
        }

        public function getParent()
        {
            return TextType::class;
        }
    }