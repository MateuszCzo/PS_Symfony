<?php

namespace SymfonyModule\Hook;

use Context;
use SymfonyModule;

class DefaultHook implements HookInterface
{
    private const TPL_FILE = 'example.tpl';

    public function renderHook(SymfonyModule $module, array &$configuration)
    {
        $context = Context::getContext();

        $cacheId = $module->name . '|defaultHook|' . $context->shop->id . '|' . $context->language->id;

        if (!$module->isCached(self::TPL_FILE, $cacheId)) {
            $context->smarty->assign(self::getHookVariables($module, $configuration));
        }
        
        return $module->display($module->name, self::TPL_FILE, $cacheId);
    }

    public function getHookVariables(SymfonyModule $module, array &$configuration)
    {
        return [
            'example' => 'Example Text.',
        ];
    }
}
