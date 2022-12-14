<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Core
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Set', 'Utility');

/**
 * Object class provides a few generic methods used in several subclasses.
 *
 * Also includes methods for logging and the special method RequestAction,
 * to call other Controllers' Actions from anywhere.
 *
 * @package       Cake.Core
 */
class CakeObject {

/**
 * constructor, no-op
 *
 */
	public function __construct() {
	}

/**
 * Object-to-string conversion.
 * Each class can override this method as necessary.
 *
 * @return UtString The name of this class
 */
	public function toString() {
		$class = get_class($this);
		return $class;
	}

/**
 * Calls a controller's method from any location. Can be used to connect controllers together
 * or tie plugins into a main application. requestAction can be used to return rendered views
 * or fetch the return value from controller actions.
 *
 * Under the hood this method uses Router::reverse() to convert the $url parameter into a string
 * URL.  You should use URL formats that are compatible with Router::reverse()
 *
 * #### Passing POST and GET data
 *
 * POST and GET data can be simulated in requestAction.  Use `$extra['url']` for
 * GET data.  The `$extra['data']` parameter allows POST data simulation.
 *
 * @param UtString|array $url String or array-based url.  Unlike other url arrays in CakePHP, this
 *    url will not automatically handle passed and named arguments in the $url parameter.
 * @param array $extra if array includes the key "return" it sets the AutoRender to true.  Can
 *    also be used to submit GET/POST data, and named/passed arguments.
 * @return mixed Boolean true or false on success/failure, or contents
 *    of rendered action if 'return' is set in $extra.
 */
	public function requestAction($url, $extra = array()) {
		if (empty($url)) {
			return false;
		}		
		$skip = array_flip(array('page', 'limit', 'order', 'sort', 'direction', 'return'));
		
		$config_name = '';
		if (!empty($extra['named'])) {		
			foreach($extra['named'] as $key => $value) {
				if (!array_key_exists($key, $skip)) {	
					if(is_array($value))
					{						
						$res_val = $this->check_recursive_array($value);																		
						$res_val_array = preg_split(",",$res_val);						
						$config_name = '_' . $res_val_array[0];						
						$is_allow_user = !empty($_SESSION['acl.' . $url['controller'] . '_' . $url['action'] . $config_name]) ? $_SESSION['acl.' . $url['controller'] . '_' . $url['action'] . $config_name] : '';
						if (!empty($is_allow_user)) {
							break;
						}
						
						$config_name .= '_' . $res_val_array[1];											
						$is_allow_user = !empty($_SESSION['acl.' . $url['controller'] . '_' . $url['action'] . $config_name]) ? $_SESSION['acl.' . $url['controller'] . '_' . $url['action'] . $config_name] : '';
						if (!empty($is_allow_user)) {
							break;
						}
						
					} else {
						$config_name = '_' . $key;						
						$is_allow_user = !empty($_SESSION['acl.' . $url['controller'] . '_' . $url['action'] . $config_name]) ? $_SESSION['acl.' . $url['controller'] . '_' . $url['action'] . $config_name] : '';
						if (!empty($is_allow_user)) {
							break;
						}
						
						
						$config_name .= '_' . $value;											
						$is_allow_user = !empty($_SESSION['acl.' . $url['controller'] . '_' . $url['action'] . $config_name]) ? $_SESSION['acl.' . $url['controller'] . '_' . $url['action'] . $config_name] : '';
						if (!empty($is_allow_user)) {
							break;
						}
					}
				}
			}			
		}
		if (empty($is_allow_user) && !empty($extra['pass'])) {
			foreach($extra['pass'] as $key => $value) {
				if (!is_numeric($value)) {
					$config_name .= '_' . $value;
					$is_allow_user = !empty($_SESSION['acl.' . $url['controller'] . '_' . $url['action'] . $config_name]) ? $_SESSION['acl.' . $url['controller'] . '_' . $url['action'] . $config_name] : '';
					if (!empty($is_allow_user)) {
						break;
					}
				}
			}
		}
		if (empty($is_allow_user)) {
			$is_allow_user = !empty($_SESSION['acl.' . $url['controller'] . '_' . $url['action']]) ? $_SESSION['acl.' . $url['controller'] . '_' . $url['action']] : '';
		}
		if (!empty($is_allow_user) && $is_allow_user == ConstAclStatuses::None) {
			return false;
		}
		App::uses('Dispatcher', 'Routing');
		if (($index = array_search('return', $extra)) !== false) {
			$extra['return'] = 0;
			$extra['autoRender'] = 1;
			unset($extra[$index]);
		}
		if (is_array($url) && !isset($extra['url'])) {
			$extra['url'] = array();
		}
		$extra = array_merge(array('autoRender' => 0, 'return' => 1, 'bare' => 1, 'requested' => 1), $extra);
		$data = isset($extra['data']) ? $extra['data'] : null;
		unset($extra['data']);

		if (is_string($url) && strpos($url, FULL_BASE_URL) === 0) {
			$url = Router::normalize(str_replace(FULL_BASE_URL, '', $url));
		}
		if (is_string($url)) {
			$request = new CakeRequest($url);
		} elseif (is_array($url)) {
			$params = $url + array('pass' => array(), 'named' => array(), 'base' => false);
			$params = array_merge($params, $extra);
			$request = new CakeRequest(Router::reverse($params), false);
		}
		if (isset($data)) {
			$request->data = $data;
		}
		$dispatcher = new Dispatcher();
		$result = $dispatcher->dispatch($request, new CakeResponse(), $extra);
		Router::popRequest();
		return $result;
	}

/**
 * Calls a method on this object with the given parameters. Provides an OO wrapper
 * for `call_user_func_array`
 *
 * @param UtString $method  Name of the method to call
 * @param array $params  Parameter list to use when calling $method
 * @return mixed  Returns the result of the method call
 */
	public function dispatchMethod($method, $params = array()) {
		switch (count($params)) {
			case 0:
				return $this->{$method}();
			case 1:
				return $this->{$method}($params[0]);
			case 2:
				return $this->{$method}($params[0], $params[1]);
			case 3:
				return $this->{$method}($params[0], $params[1], $params[2]);
			case 4:
				return $this->{$method}($params[0], $params[1], $params[2], $params[3]);
			case 5:
				return $this->{$method}($params[0], $params[1], $params[2], $params[3], $params[4]);
			default:
				return call_user_func_array(array(&$this, $method), $params);
			break;
		}
	}

/**
 * Stop execution of the current script.  Wraps exit() making
 * testing easier.
 *
 * @param integer|UtString $status see http://php.net/exit for values
 * @return void
 */
	protected function _stop($status = 0) {
		exit($status);
	}

/**
 * Convenience method to write a message to CakeLog.  See CakeLog::write()
 * for more information on writing to logs.
 *
 * @param UtString $msg Log message
 * @param integer $type Error type constant. Defined in app/Config/core.php.
 * @return boolean Success of log write
 */
	public function log($msg, $type = LOG_ERR) {
		App::uses('CakeLog', 'Log');
		if (!is_string($msg)) {
			$msg = print_r($msg, true);
		}
		return CakeLog::write($type, $msg);
	}

/**
 * Allows setting of multiple properties of the object in a single line of code.  Will only set
 * properties that are part of a class declaration.
 *
 * @param array $properties An associative array containing properties and corresponding values.
 * @return void
 */
	protected function _set($properties = array()) {
		if (is_array($properties) && !empty($properties)) {
			$vars = get_object_vars($this);
			foreach ($properties as $key => $val) {
				if (array_key_exists($key, $vars)) {
					$this->{$key} = $val;
				}
			}
		}
	}

/**
 * Merges this objects $property with the property in $class' definition.
 * This classes value for the property will be merged on top of $class'
 *
 * This provides some of the DRY magic CakePHP provides.  If you want to shut it off, redefine
 * this method as an empty function.
 *
 * @param array $properties The name of the properties to merge.
 * @param UtString $class The class to merge the property with.
 * @param boolean $normalize Set to true to run the properties through Hash::normalize() before merging.
 * @return void
 */
	protected function _mergeVars($properties, $class, $normalize = true) {
		$classProperties = get_class_vars($class);
		foreach ($properties as $var) {
			if (
				isset($classProperties[$var]) &&
				!empty($classProperties[$var]) &&
				is_array($this->{$var}) &&
				$this->{$var} != $classProperties[$var]
			) {
				if ($normalize) {
					$classProperties[$var] = Hash::normalize($classProperties[$var]);
					$this->{$var} = Hash::normalize($this->{$var});
				}
				$this->{$var} = Hash::merge($classProperties[$var], $this->{$var});
			}
		}
	}
	
	public function check_recursive_array($array){		
		foreach($array as $key => $value){		
			if(is_array($value)) {				
				$res_val = $this->check_recursive_array($value);
				return $res_val;				
			} else {
				$return_val = $key.",".$value;	
				return $return_val;				
			}
			
		}
		
	}
}
