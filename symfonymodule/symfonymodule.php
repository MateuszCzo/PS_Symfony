<?php
/**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License version 3.0
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License version 3.0
 */

use SymfonyModule\Hook\DefaultHook;
use PrestaShop\PrestaShop\Adapter\SymfonyContainer;
use PrestaShop\PrestaShop\Core\Module\WidgetInterface;
use SymfonyModule\Helper\Installer;

if (!defined('_PS_VERSION_')) exit;

require_once __DIR__ . '/vendor/autoload.php';

class SymfonyModule extends Module implements WidgetInterface
{
    private Installer $installer;

    public function __construct()
    {
        $this->name = 'symfonymodule';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Mateusz Czosnyka';
        $this->bootstrap = true;
        $this->ps_versions_compliancy = [
            'min' => '1.7.8',
            'max' => _PS_VERSION_
        ];
        $this->displayName = $this->trans('Learning module.', [], 'Admin.Symfonymodule.Admin');
        $this->description = $this->trans('Learning module - symfony.', [], 'Admin.Symfonymodule.Module');

        $this->installer = new Installer($this);

        parent::__construct();
    }

    public function install(): bool
    {
        return parent::install() && 
            $this->installer->registerHooks() &&
            $this->installer->createDatabase();
    }

    public function uninstall(): bool
    {
        return parent::uninstall() && 
            $this->installer->dropDatabase();
    }
    
    public function isUsingNewTranslationSystem(): bool
    {
        return true;
    }

    public function getContent()
    {
        /** @var Router $router */
        $router = SymfonyContainer::getInstance()->get('router');

        return Tools::redirectAdmin($router->generate('symfonymodule_youtube_create'));
    }

    public function renderWidget($hookName, array $configuration)
    {
        $className = 'SymfonyModule\Hook\\' . $hookName;

        if (!class_exists($className)) {
            return (new DefaultHook())->renderHook($this, $configuration);
        }
        /** @var HookInterface $hook */
        $hook = new $className;

        return $hook->renderHook($this, $configuration);
    }

    public function getWidgetVariables($hookName, array $configuration)
    {
        throw new Exception('This function is not used.');
    }
}
