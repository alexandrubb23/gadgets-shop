<?php

namespace LinkAcademy\Gadgets\Commons;

use Twig_Environment;
use Twig_Loader_Filesystem;
use LinkAcademy\Gadgets\Commons\TwigExtension;

class Twig
{
	const VIEWS_DIR = '/views/templates/electro/';

	/**
	 * @var object
	 */
	private $twig;

	/**
	 * Get Twig
	 * 
	 * @return \Twig_Environment
	 */
	public static function get()
	{
		$loader = new Twig_Loader_Filesystem(self::getTemplateDir());
		$template = new Twig_Environment($loader);
		$template->addExtension(new TwigExtension(self::globalVars()));
		// var_dump(self::getUrl());
		return $template;
	}	

    /**
     * Set global variables
     *
     * @return array
     */
	protected static function globalVars()
	{
		return [
			'template_path' => self::getUrl()
		];
	}

	protected static function getUrl()
	{
		return 'http://' . $_SERVER['SERVER_NAME'] . self::VIEWS_DIR;
	}

	/**
	 * Get template dir
	 * 
	 * @return string
	 */
	public static function getTemplateDir()
	{
		return APP_DIR . self::VIEWS_DIR;
	}
}