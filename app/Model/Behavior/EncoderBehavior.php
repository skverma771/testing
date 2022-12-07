<?php
/**
 *
 * @package		Crowdfunding
 * @author 		siva_063at09
 * @copyright 	Copyright (c) 2012 {@link http://www.agriya.com/ Agriya Infoway}
 * @license		http://www.agriya.com/ Agriya Infoway Licence
 * @since 		2012-07-25
 *
 */
class EncoderBehavior extends ModelBehavior
{
    public function setup(Model $model, $config = array()) 
    {
        if (is_string($config)) {
            $config = array(
                $config
            );
        }
        $this->settings[$model->alias] = $config;
    }
    /**
     * Encode data
     *
     * Turn array into a JSON
     *
     * @param object $model model
     * @param array $data data
     * @param array $options (optional)
     * @return string
     */
    public function encodeData(Model $model, $data, $options = array()) 
    {
        $_options = array(
            'json' => false,
            'trim' => true,
        );
        $options = array_merge($_options, $options);
        if (is_array($data) && count($data) > 0) {
            // trim
            if ($options['trim']) {
                $elements = array();
                foreach($data as $id => $d) {
                    $d = trim($d);
                    if ($d != '') {
                        $elements[$id] = '"' . $d . '"';
                    }
                }
            } else {
                $elements = $data;
            }
            // encode
            if (count($elements) > 0) {
                if ($options['json']) {
                    $output = json_encode($elements);
                } else {
                    $output = '[' . implode(',', $elements) . ']';
                }
            } else {
                $output = '';
            }
        } else {
            $output = '';
        }
        return $output;
    }
    /**
     * Decode data
     *
     * @param object $model model
     * @param string $data data
     * @return array
     */
    public function decodeData(Model $model, $data) 
    {
        if ($data == '') {
            $output = '';
        } else {
            $output = json_decode($data, true);
        }
        return $output;
    }
}
