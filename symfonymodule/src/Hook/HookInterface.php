<?php

namespace SymfonyModule\Hook;

use SymfonyModule;

interface HookInterface
{
    public function renderHook(SymfonyModule $module, array &$configuration);
}
