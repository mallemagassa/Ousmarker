<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Nom'),
            SlugField::new('slug')->setTargetFieldName('name')->hideOnIndex(),
            TextEditorField::new('description')->hideOnIndex(),
            TextEditorField::new('moreInformations', 'Plus D\'information')->hideOnIndex(),
            MoneyField::new('price', 'Prix')->setCurrency('XAF'),
            IntegerField::new('quantity', 'Quantité'),
            TextField::new('tags'),
            BooleanField::new('isBestSeller','Meilleur vente'),
            BooleanField::new('isNewArrival', 'Nouvelle arrivée'),
            BooleanField::new('isFeatured', 'Produits populaires'),
            BooleanField::new('isSpecialOffer', 'Offre spéciale'),
            AssociationField::new('category', 'Categories'),
            ImageField::new('image')->setBasePath('/assets/uploads/products/')
                                    ->setUploadDir('/public/assets/uploads/products/')
                                    ->setUploadedFileNamePattern('[randomhash].[extension]')
                                    ->setRequired(false),
            DateTimeField::new('createdAt', 'Date de création')
        ];
    }
    
}
