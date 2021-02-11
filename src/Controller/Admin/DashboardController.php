<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Www');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');

        if ($this->isGranted('ROLE_EDITOR') && '...') {
            yield MenuItem::linkToCrud('Products', 'fa fa-product', ProductCrudController::getEntityFqcn());
            yield MenuItem::linkToCrud('Orders', 'fa fa-product', OrderCrudController::getEntityFqcn());
            yield MenuItem::linkToCrud('OrderProducts', 'fa fa-product', OrderProductCrudController::getEntityFqcn());
            yield MenuItem::linkToCrud('ProduceOrderProducts', 'fa fa-product', ProduceOrderProductCrudController::getEntityFqcn());
        }
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
