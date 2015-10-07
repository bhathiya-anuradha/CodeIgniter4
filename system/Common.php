<?php
/**
 * Common Functions
 *
 * Several application-wide utility methods.
 *
 * @package  CodeIgniter
 * @category Common Functions
 */

if (! function_exists('DI'))
{
	/**
	 * A convenience method for getting the current instance
	 * of the dependency injection container.
	 *
	 * If a class "alias" is passed in as the first parameter
	 * then try to create that class using the single() method.
	 *
	 * @return \CodeIgniter\DI\DI instance
	 */
	function DI($alias=null)
	{
		if (! empty($alias) && is_string($alias))
		{
			return \CodeIgniter\DI\DI::getInstance()->single($alias);
		}

		return \CodeIgniter\DI\DI::getInstance();
	}
}

//--------------------------------------------------------------------

if (! function_exists('log_message'))
{
	/**
	 * A convenience/compatibility method for logging events through
	 * the Log system.
	 *
	 * Allowed log levels are:
	 *  - emergency
	 *  - alert
	 *  - critical
	 *  - error
	 *  - warning
	 *  - notice
	 *  - info
	 *  - debug
	 *
	 * @param string $level
	 * @param        $message
	 * @param array  $context
	 *
	 * @return mixed
	 */
	function log_message(string $level, $message, array $context=[])
	{
		return DI('logger')->log($level, $message, $context);
	}
}

//--------------------------------------------------------------------

if (! function_exists('view'))
{
	/**
	 * Grabs the current RenderableInterface-compatible class
	 * and tells it to render the specified view. Simply provides
	 * a convenience method that can be used in controllers,
	 * libraries, and routed closures.
	 *
	 * @param string $name
	 * @param array  $data
	 * @param bool   $escape Whether the data values should be escaped.
	 *
	 * @return string
	 */
	function view(string $name, array $data=[], bool $escape=true)
	{
		/**
		 * @var CodeIgniter\View\View $renderer
		 */
		$renderer = DI('renderer');

		return $renderer->setData($data, $escape)
						->render($name);
	}
}