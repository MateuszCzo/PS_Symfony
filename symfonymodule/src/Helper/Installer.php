<?php

namespace SymfonyModule\Helper;

use Db;
use SymfonyModule;

class Installer
{
    private $module;

    public function __construct(SymfonyModule $module) {
        $this->module = $module;
    }

    public function createDatabase(): bool
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
        return Db::getInstance()->execute($sql);
    }

    public function dropDatabase(): bool
    {
        $sql = 'DROP TABLE IF EXISTS ' . _DB_PREFIX_ . 'youtube_comment';
        return Db::getInstance()->execute($sql);
    }

    public function registerHooks(): bool
    {
        return $this->module->registerHook('displayFooter');
    }
}
