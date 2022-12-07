<?php
/**
 * Core Security
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Utility
 * @since         CakePHP(tm) v .0.10.0.1233
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('UtString', 'Utility');

/**
 * Security Library contains utility methods related to security
 *
 * @package       Cake.Utility
 */
class Security {

/**
 * Default hash method
 *
 * @var UtString
 */
	public static $hashType = null;

/**
 * Get allowed minutes of inactivity based on security level.
 *
 * @return integer Allowed inactivity in minutes
 */
	public static function inactiveMins() {
		switch (Configure::read('Security.level')) {
			case 'high':
				return 10;
			break;
			case 'medium':
				return 100;
			break;
			case 'low':
			default:
				return 300;
				break;
		}
	}

/**
 * Generate authorization hash.
 *
 * @return UtString Hash
 */
	public static function generateAuthKey() {
		return Security::hash(UtString::uuid());
	}

/**
 * Validate authorization hash.
 *
 * @param UtString $authKey Authorization hash
 * @return boolean Success
 * @todo Complete implementation
 */
	public static function validateAuthKey($authKey) {
		return true;
	}

/**
 * Create a hash from string using given method.
 * Fallback on next available method.
 *
 * @param UtString $string String to hash
 * @param UtString $type Method to use (sha1/sha256/md5)
 * @param boolean $salt If true, automatically appends the application's salt
 *     value to $string (Security.salt)
 * @return UtString Hash
 */
	public static function hash($string, $type = null, $salt = false) {
		if ($salt) {
			if (is_string($salt)) {
				$string = $salt . $string;
			} else {
				$string = Configure::read('Security.salt') . $string;
			}
		}

		if (empty($type)) {
			$type = self::$hashType;
		}
		$type = strtolower($type);

		if ($type == 'sha1' || $type == null) {
			if (function_exists('sha1')) {
				$return = sha1($string);
				return $return;
			}
			$type = 'sha256';
		}

		if ($type == 'sha256' && function_exists('mhash')) {
			return bin2hex(mhash(MHASH_SHA256, $string));
		}

		if (function_exists('hash')) {
			return hash($type, $string);
		}
		return md5($string);
	}

/**
 * Sets the default hash method for the Security object.  This affects all objects using
 * Security::hash().
 *
 * @param UtString $hash Method to use (sha1/sha256/md5)
 * @return void
 * @see Security::hash()
 */
	public static function setHash($hash) {
		self::$hashType = $hash;
	}

/**
 * Encrypts/Decrypts a text using the given key.
 *
 * @param UtString $text Encrypted string to decrypt, normal string to encrypt
 * @param UtString $key Key to use
 * @return UtString Encrypted/Decrypted string
 */
	public static function cipher($text, $key) {
		if (empty($key)) {
			trigger_error(__d('cake_dev', 'You cannot use an empty key for Security::cipher()'), E_USER_WARNING);
			return '';
		}

		srand(Configure::read('Security.cipherSeed'));
		$out = '';
		$keyLength = strlen($key);
		for ($i = 0, $textLength = strlen($text); $i < $textLength; $i++) {
			$j = ord(substr($key, $i % $keyLength, 1));
			while ($j--) {
				rand(0, 255);
			}
			$mask = rand(0, 255);
			$out .= chr(ord(substr($text, $i, 1)) ^ $mask);
		}
		srand();
		return $out;
	}

/**
 * Encrypts/Decrypts a text using the given key using rijndael method.
 *
 * @param UtString $text Encrypted string to decrypt, normal string to encrypt
 * @param UtString $key Key to use
 * @param UtString $operation Operation to perform, encrypt or decrypt
 * @return UtString Encrypted/Descrypted string
 */
	public static function rijndael($text, $key, $operation) {
		if (empty($key)) {
			trigger_error(__d('cake_dev', 'You cannot use an empty key for Security::rijndael()'), E_USER_WARNING);
			return '';
		}
		if (empty($operation) || !in_array($operation, array('encrypt', 'decrypt'))) {
			trigger_error(__d('cake_dev', 'You must specify the operation for Security::rijndael(), either encrypt or decrypt'), E_USER_WARNING);
			return '';
		}
		if (strlen($key) < 32) {
			trigger_error(__d('cake_dev', 'You must use a key larger than 32 bytes for Security::rijndael()'), E_USER_WARNING);
			return '';
		}
		$algorithm = 'rijndael-256';
		$mode = 'cbc';
		$cryptKey = substr($key, 0, 32);
		$iv = substr($key, strlen($key) - 32, 32);
		$out = '';
		if ($operation === 'encrypt') {
			$out .= mcrypt_encrypt($algorithm, $cryptKey, $text, $mode, $iv);
		} elseif ($operation === 'decrypt') {
			$out .= rtrim(mcrypt_decrypt($algorithm, $cryptKey, $text, $mode, $iv), "\0");
		}
		return $out;
	}

}
