<?php

namespace App\Controller\Admin;

use App\Entity\Cart;
use App\Entity\Order;
use App\Entity\Carrier;
use App\Entity\Product;
use App\Entity\Categories;
use App\Entity\Contact;
use App\Entity\HomeSlider;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        //return parent::index();
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(OrderCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('OusMarket');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Tableau de Board', 'fa fa-home');
        yield MenuItem::linkToCrud('Produits', 'fas fa-shopping-cart', Product::class);
        yield MenuItem::linkToCrud('Commandes', 'fas fa-shopping-bag', Order::class);
        yield MenuItem::linkToCrud('Paniers', 'fas fa-boxes', Cart::class);
        yield MenuItem::linkToCrud('Categories', 'fas fa-list', Categories::class);
        yield MenuItem::linkToCrud('Curseur d\'Accueil', 'fas fa-images', HomeSlider::class);
        yield MenuItem::linkToCrud('Contact', 'fas fa-envelope', Contact::class);
        yield MenuItem::linkToCrud('Utilisateur', 'fas fa-user', User::class);
    }
}
