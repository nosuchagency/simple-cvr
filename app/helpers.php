<?php

if (!function_exists('get_property')) {

    /**
     * @param $object
     * @param $property
     * @param string $default
     *
     * @return mixed
     */
    function get_property($object, $property, $default = '')
    {
        $properties = explode('.', $property);

        if ($properties) {
            foreach ($properties as $val) {
                if (isset($object->$val)) {
                    $object = $object->$val;
                } else {
                    break;
                }
            }
        }

        if (!is_object($object) && $object) {
            return $object;
        }

        return $default;
    }
}