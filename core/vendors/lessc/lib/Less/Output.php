<?php

/**
 * Parser output
 *
 * @package Less
 * @subpackage output
 */
class Less_Output{

	/**
	 * Output holder
	 *
	 * @var UtString
	 */
	protected $strs = array();

	/**
	 * Adds a chunk to the stack
	 *
	 * @param UtString $chunk The chunk to output
	 * @param Less_FileInfo $fileInfo The file information
	 * @param integer $index The index
	 * @param mixed $mapLines
	 */
	public function add($chunk, $fileInfo = null, $index = 0, $mapLines = null){
		$this->strs[] = $chunk;
	}

	/**
	 * Is the output empty?
	 *
	 * @return boolean
	 */
	public function isEmpty(){
		return count($this->strs) === 0;
	}


	/**
	 * Converts the output to string
	 *
	 * @return UtString
	 */
	public function toString(){
		return implode('',$this->strs);
	}

}