<?php

namespace Tests\Feature;

use Tests\TestCase;

class DebuggerInstallTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_debugger_installed()
    {
        $package = "barryvdh/laravel-debugbar";
        $isInstalled = \Composer\InstalledVersions::isInstalled($package);
        $this->assertSame($isInstalled, true, "{$package}をcomposerでインストールしてください");
    }
}
