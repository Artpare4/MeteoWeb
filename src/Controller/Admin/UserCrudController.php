<?php

namespace App\Controller\Admin;

use App\Entity\Adresse;
use App\Entity\User;
use App\Repository\AssoAdresseUserRepository;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use PharIo\Manifest\Email;

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
            TextField::new('firstname','Prénom'),
            TextField::new('lastname','Nom'),
            EmailField::new('email','Email'),
            ArrayField::new('roles','Rôles'),
            AssociationField::new('adresses','Adresses')
                ->setFormTypeOption('choice_label',function ($label){
                    return $label->getAdresse()->getRue().' '.$label->getAdresse()->getVille().' '.$label->getAdresse()->getCodePostal();
                })
                ->setFormTypeOption('by_reference',false)
        ];
    }

}
