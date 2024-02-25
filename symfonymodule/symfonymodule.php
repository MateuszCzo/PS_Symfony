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

if (!defined('_PS_VERSION_')) {
    exit;
}

class SymfonyModule extends Module
{
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
        $this->need_instatnce = 0;
        $this->displayName = $this->trans('Learning module.', [], 'Admin.Symfonymodule.Admin');
        $this->description = $this->trans('Learning module - symfony.', [], 'Admin.Symfonymodule.Module');
        parent::__construct();
    }

    public function install()
    {
        $sql = '
            CREATE TABLE IF NOT EXISTS ' . _DB_PREFIX_ . 'youtube_comment ( 
                id_product_comment INT AUTO_INCREMENT NOT NULL, 
                id_product INT NOT NULL, 
                customer_name VARCHAR(64) NOT NULL, 
                title VARCHAR(64) NOT NULL, 
                content LONGTEXT NOT NULL, 
                grade INT NOT NULL, 
                PRIMARY KEY(id_product_comment)
            )
            DEFAULT CHARACTER SET utf8mb4 
            COLLATE utf8mb4_unicode_ci 
            ENGINE = InnoDB;';
        return parent::install() && 
            Db::getInstance()->execute($sql);
    }

    public function uninstall()
    {
        $sql = 'DROP TABLE IF EXISTS ' . _DB_PREFIX_ . 'youtube_comment';
        return parent::uninstall() && 
            Db::getInstance()->execute($sql);
    }
    
    public function isUsingNewTranslationSystem()
    {
        return true;
    }
}
