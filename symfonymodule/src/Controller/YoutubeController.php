<?php

namespace SymfonyModule\Controller;

use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;

class YoutubeController extends FrameworkBundleAdminController
{   
    public function createAction()
    {
        return $this->render('@Modules/symfonymodule/templates/admin/create.html.twig');
    }
}
