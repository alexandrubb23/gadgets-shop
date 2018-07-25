<?php

namespace LinkAcademy\Gadgets\Commons;

use Twig_Loader_Filesystem;
use Twig_Environment;

class Twig
{
	const VIEWS_DIR = '/views';

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
		return new Twig_Environment($loader);
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