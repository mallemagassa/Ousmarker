<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use phpDocumentor\Reflection\Types\Boolean;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('firstname', 'Nom'),
            TextField::new('lastname', 'Prénom'),
            TextField::new('username', 'Nom d\'utilisateur'),
            BooleanField::new('is_verified', 'Vérifié Email'),
            ChoiceField::new('roles')
            ->autocomplete()
            ->escapeHtml(false)
            ->setChoices([
                'Administrateur'=>'ROLE_ADMIN', 
                'Utilisateur'=>'ROLE_USER',
            ])->allowMultipleChoices(),
        ];
    }
    
}
