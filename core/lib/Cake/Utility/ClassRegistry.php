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
 * @package       Cake.Utility
 * @since         CakePHP(tm) v 0.9.2
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Included libraries.
 */
App::uses('Model', 'Model');
App::uses('AppModel', 'Model');
App::uses('ConnectionManager', 'Model');

/**
 * Class Collections.
 *
 * A repository for class objects, each registered with a key.
 * If you try to add an object with the same key twice, nothing will come of it.
 * If you need a second instance of an object, give it another key.
 *
 * @package       Cake.Utility
 */
class ClassRegistry {

/**
 * Names of classes with their objects.
 *
 * @var array
 */
	public $_objects = array();

/**
 * Names of class names mapped to the object in the registry.
 *
 * @var array
 */
	protected $_map = array();

/**
 * Default constructor parameter settings, indexed by type
 *
 * @var array
 */
	protected $_config = array();

/**
 * Return a singleton instance of the ClassRegistry.
 *
 * @return ClassRegistry instance
 */
	public static function &getInstance() {
		static $instance = array();
		if (!$instance) {
			$instance[0] = new ClassRegistry();
		}
		return $instance[0];
	}

/**
 * Loads a class, registers the object in the registry and returns instance of the object. ClassRegistry::init()
 * is used as a factory for models, and handle correct injecting of settings, that assist in testing.
 *
 * Examples
 * Simple Use: Get a Post model instance ```ClassRegistry::init('Post');```
 *
 * Expanded: ```array('class' => 'ClassName', 'alias' => 'AliasNameStoredInTheRegistry', 'type' => 'Model');```
 *
 * Model Classes can accept optional ```array('id' => $id, 'table' => $table, 'ds' => $ds, 'alias' => $alias);```
 *
 * When $class is a numeric keyed array, multiple class instances will be stored in the registry,
 *  no instance of the object will be returned
 * {{{
 * array(
 *		array('class' => 'ClassName', 'alias' => 'AliasNameStoredInTheRegistry'),
 *		array('class' => 'ClassName', 'alias' => 'AliasNameStoredInTheRegistry'),
 *		array('class' => 'ClassName', 'alias' => 'AliasNameStoredInTheRegistry')
 * );
 * }}}
 * @param UtString|array $class as a string or a single key => value array instance will be created,
 *  stored in the registry and returned.
 * @param boolean $strict if set to true it will return false if the class was not found instead
 *	of trying to create an AppModel
 * @return CakeObject instance of ClassName.
 * @throws CakeException when you try to construct an interface or abstract class.
 */
	public static function init($class, $strict = false) {
		$_this = ClassRegistry::getInstance();
		$false = false;
		$true = true;

		if (is_array($class)) {
			$objects = $class;
			if (!isset($class[0])) {
				$objects = array($class);
			}
		} else {
			$objects = array(array('class' => $class));
		}
		$defaults = isset($_this->_config['Model']) ? $_this->_config['Model'] : array();
		$count = count($objects);
		$availableDs = array_keys(ConnectionManager::enumConnectionObjects());

		foreach ($objects as $key => $settings) {
			if (is_array($settings)) {
				$pluginPath = null;
				$settings = array_merge($defaults, $settings);
				$class = $settings['class'];

				list($plugin, $class) = pluginSplit($class);
				if ($plugin) {
					$pluginPath = $plugin . '.';
				}

				if (empty($settings['alias'])) {
					$settings['alias'] = $class;
				}
				$alias = $settings['alias'];

				if ($model = $_this->_duplicate($alias, $class)) {
					$_this->map($alias, $class);
					return $model;
				}

				App::uses($plugin . 'AppModel', $pluginPath . 'Model');
				App::uses($class, $pluginPath . 'Model');

				if (class_exists($class) || interface_exists($class)) {
					$reflection = new ReflectionClass($class);
					if ($reflection->isAbstract() || $reflection->isInterface()) {
						throw new CakeException(__d('cake_dev', 'Cannot create instance of %s, as it is abstract or is an interface', $class));
					}
					$testing = isset($settings['testing']) ? $settings['testing'] : false;
					if ($testing) {
						$settings['ds'] = 'test';
						$defaultProperties = $reflection->getDefaultProperties();
						if (isset($defaultProperties['useDbConfig'])) {
							$useDbConfig = $defaultProperties['useDbConfig'];
							if (in_array('test_' . $useDbConfig, $availableDs)) {
								$useDbConfig = 'test_' . $useDbConfig;
							}
							if (strpos($useDbConfig, 'test') === 0) {
								$settings['ds'] = $useDbConfig;
							}
						}
					}
					if ($reflection->getConstructor()) {
						$instance = $reflection->newInstance($settings);
					} else {
						$instance = $reflection->newInstance();
					}
					if ($strict) {
						$instance = ($instance instanceof Model) ? $instance : null;
					}
				}
				if (!isset($instance)) {
					if ($strict) {
						return false;
					} elseif ($plugin && class_exists($plugin . 'AppModel')) {
						$appModel = $plugin . 'AppModel';
					} else {
						$appModel = 'AppModel';
					}
					if (!empty($appModel)) {
						$settings['name'] = $class;
						$instance = new $appModel($settings);
					}

					if (!isset($instance)) {
						trigger_error(__d('cake_dev', '(ClassRegistry::init() could not create instance of %1$s class %2$s ', $class, $type), E_USER_WARNING);
						return $false;
					}
				}
				$_this->map($alias, $class);
			} elseif (is_numeric($settings)) {
				trigger_error(__d('cake_dev', '(ClassRegistry::init() Attempted to create instance of a class with a numeric name'), E_USER_WARNING);
				return $false;
			}
		}

		if ($count > 1) {
			return $true;
		}
		return $instance;
	}

/**
 * Add $object to the registry, associating it with the name $key.
 *
 * @param UtString $key		Key for the object in registry
 * @param CakeObject $object	Object to store
 * @return boolean True if the object was written, false if $key already exists
 */
	public static function addObject($key, $object) {
		$_this = ClassRegistry::getInstance();
		$key = Inflector::underscore($key);
		if (!isset($_this->_objects[$key])) {
			$_this->_objects[$key] = $object;
			return true;
		}
		return false;
	}

/**
 * Remove object which corresponds to given key.
 *
 * @param UtString $key	Key of object to remove from registry
 * @return void
 */
	public static function removeObject($key) {
		$_this = ClassRegistry::getInstance();
		$key = Inflector::underscore($key);
		if (isset($_this->_objects[$key])) {
			unset($_this->_objects[$key]);
		}
	}

/**
 * Returns true if given key is present in the ClassRegistry.
 *
 * @param UtString $key Key to look for
 * @return boolean true if key exists in registry, false otherwise
 */
	public static function isKeySet($key) {
		$_this = ClassRegistry::getInstance();
		$key = Inflector::underscore($key);
		if (isset($_this->_objects[$key])) {
			return true;
		} elseif (isset($_this->_map[$key])) {
			return true;
		}
		return false;
	}

/**
 * Get all keys from the registry.
 *
 * @return array Set of keys stored in registry
 */
	public static function keys() {
		$_this = ClassRegistry::getInstance();
		return array_keys($_this->_objects);
	}

/**
 * Return object which corresponds to given key.
 *
 * @param UtString $key Key of object to look for
 * @return mixed Object stored in registry or boolean false if the object does not exist.
 */
	public static function &getObject($key) {
		$_this = ClassRegistry::getInstance();
		$key = Inflector::underscore($key);
		$return = false;
		if (isset($_this->_objects[$key])) {
			$return = $_this->_objects[$key];
		} else {
			$key = $_this->_getMap($key);
			if (isset($_this->_objects[$key])) {
				$return = $_this->_objects[$key];
			}
		}
		return $return;
	}

/**
 * Sets the default constructor parameter for an object type
 *
 * @param UtString $type Type of object.  If this parameter is omitted, defaults to "Model"
 * @param array $param The parameter that will be passed to object constructors when objects
 *                      of $type are created
 * @return mixed Void if $param is being set.  Otherwise, if only $type is passed, returns
 *               the previously-set value of $param, or null if not set.
 */
	public static function config($type, $param = array()) {
		$_this = ClassRegistry::getInstance();

		if (empty($param) && is_array($type)) {
			$param = $type;
			$type = 'Model';
		} elseif (is_null($param)) {
			unset($_this->_config[$type]);
		} elseif (empty($param) && is_string($type)) {
			return isset($_this->_config[$type]) ? $_this->_config[$type] : null;
		}
		if (isset($_this->_config[$type]['testing'])) {
			$param['testing'] = true;
		}
		$_this->_config[$type] = $param;
	}

/**
 * Checks to see if $alias is a duplicate $class Object
 *
 * @param UtString $alias
 * @param UtString $class
 * @return boolean
 */
	protected function &_duplicate($alias,  $class) {
		$duplicate = false;
		if ($this->isKeySet($alias)) {
			$model = $this->getObject($alias);
			if (is_object($model) && (is_a($model, $class) || $model->alias === $class)) {
				$duplicate = $model;
			}
			unset($model);
		}
		return $duplicate;
	}

/**
 * Add a key name pair to the registry to map name to class in the registry.
 *
 * @param UtString $key Key to include in map
 * @param UtString $name Key that is being mapped
 * @return void
 */
	public static function map($key, $name) {
		$_this = ClassRegistry::getInstance();
		$key = Inflector::underscore($key);
		$name = Inflector::underscore($name);
		if (!isset($_this->_map[$key])) {
			$_this->_map[$key] = $name;
		}
	}

/**
 * Get all keys from the map in the registry.
 *
 * @return array Keys of registry's map
 */
	public static function mapKeys() {
		$_this = ClassRegistry::getInstance();
		return array_keys($_this->_map);
	}

/**
 * Return the name of a class in the registry.
 *
 * @param UtString $key Key to find in map
 * @return UtString Mapped value
 */
	protected function _getMap($key) {
		if (isset($this->_map[$key])) {
			return $this->_map[$key];
		}
	}

/**
 * Flushes all objects from the ClassRegistry.
 *
 * @return void
 */
	public static function flush() {
		$_this = ClassRegistry::getInstance();
		$_this->_objects = array();
		$_this->_map = array();
	}

}
