<?php

namespace App\Controller\Admin;

use App\Entity\Order;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OrderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Order::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setDefaultSort(['id'=>'DESC']);
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('FullName', 'Client'),
            MoneyField::new('subTotalHT', 'Sous-total HT')->setCurrency('XAF'),
            MoneyField::new('taxe', 'TVA')->setCurrency('XAF'),
            MoneyField::new('subTotalTTC', 'Sous-total TTC')->setCurrency('XAF'),
            BooleanField::new('isPaid', 'Payé'),
            DateTimeField::new('createdAt', 'Date de creation')
        ];
    }
    
}
