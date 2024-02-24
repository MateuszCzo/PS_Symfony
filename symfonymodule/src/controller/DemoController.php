<?php

namespace SymfonyModule\Controller;

use Symfony\Component\HttpFoundation\Response;
use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;

class DemoController extends FrameworkBundleAdminController
{   
    public function demoAction()
    {
        return new Response("Hello World!");
    }
}
