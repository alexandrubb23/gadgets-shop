<?php declare(strict_types=1);

namespace LinkAcademy\Gadgets\Commons\Http;

defined('APP_DIR') or die('No script kiddies please!');

class HomeController
{
    /**
     * get home page
     *
     * @return void
     */
    public function index()
    {
        return view('index.html');
    }
}
