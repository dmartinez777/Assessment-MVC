<?php

namespace App\Entities;

use ReflectionObject;
use ReflectionProperty;

/**
 * Class Entities
 *
 * @package App\Entities
 */
class Entities
{

    /**
     * @param array|object $properties
     *
     * @return mixed
     */
    public static function props($properties)
    {
        $className = get_called_class();

        try {
            $instance   = new $className();
            $reflection = new ReflectionObject($instance);

            foreach ((array) $properties as $column => $value) {
                $property = $reflection->getProperty(self::camelCaseProperties($column));
                $property->setAccessible(true);

                if ($property instanceof ReflectionProperty) {
                    $property->setValue($instance, $value);
                } else {
                    unset($property);
                }
            }

            return $instance;
        } catch (\ReflectionException $e) {
            die('Incorrect param'); //@todo: this should be logged, maybe also return false.
        }
    }

    /**
     * Match each column with it's respected entity class
     * Replace _ with blank string and uppercase the first letter
     *
     * @param string $string
     * @return string
     */
    public static function camelCaseProperties(string $string)
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $string))));
    }

    /**
     * @todo: Move to a helper?
     *
     * Change columns back to Snake case
     *
     * @param string $string
     * @return string
     */
    public static function camelToSnake(string $string)
    {
        $strSnake = preg_replace_callback('/[A-Z]/', function ($matches) {
            return '_' . strtolower($matches[0]);
        }, $string);

        return ltrim($strSnake, '_');
    }
}
