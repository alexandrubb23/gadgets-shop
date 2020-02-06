<?php declare(strict_types=1);

namespace LinkAcademy\Gadgets\Commons\Http\Controllers;

defined('APP_DIR') or die('No script kiddies please!');

class HomeController
{
    /**
     * Home.
     *
     * @return void
     */
    public function index(): void
    {
    	view('index.html');
    }
}
