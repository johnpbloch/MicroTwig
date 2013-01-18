<?php

namespace MicroTwig;

class View extends \Micro\View
{

	/**
	 * A default instance of a twig loader
	 * @var \Twig_Loader_Filesystem
	 */
	private static $_loader;

	/**
	 * A default Twig environment, using the default twig loader
	 * @var \Twig_Environment
	 */
	private static $_twig;

	/**
	 * The loader object for an object
	 * @var \Twig_LoaderInterface
	 */
	private $loader;

	/**
	 * The twig object for an object
	 * @var \Twig_Environment
	 */
	private $twig;

	/**
	 * The template object for an instance of this class
	 * @var \Twig_TemplateInterface
	 */
	private $twig_template;

	/**
	 * Constructor method
	 * 
	 * Initializes the object. If static properties aren't set, set them here.
	 * If a loader was passed to this function, use it and a custom twig environment.
	 * Otherwise, use the default one stored in the static property.
	 *
	 * @param  $view    string                 The view to load
	 * @param  $loader  \Twig_LoaderInterface  An optional custom loader
	 * @return void
	 */
	public function __construct($view, \Twig_LoaderInterface $loader = NULL)
	{
		parent::__construct($view);
		if(!self::$_loader)
		{
			self::$_loader = new \Twig_Loader_Filesystem(static::$directory);
		}
		$defaults = array(
			'autoescape' => false
		);
		if(!self::$_twig)
		{
			self::$_twig = new \Twig_Environment(self::$_loader, $defaults);
		}
		$this->loader = $loader ?: self::$_loader;
		$this->twig = $loader ? new \Twig_Environment($loader, $defaults) : self::$_twig;
		$this->twig_template = $this->twig->loadTemplate($view . static::$ext);
	}

	/**
	 * Convert the view to string
	 *
	 * Grab all the public properties of this class and render the twig
	 * template with them. Any public properties that are views will first
	 * be converted to strings before rendering the template.
	 *
	 * @return string
	 */
	public function __toString()
	{
		$vars = call_user_func('get_object_vars', $this);
		array_map(function($item)
			{
				if($item instanceof \Micro\View) $item = "$item";
				return $item;
			}, $vars);
		return $this->twig_template->render($vars);
	}

}
