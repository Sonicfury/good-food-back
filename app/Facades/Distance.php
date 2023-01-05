<?php

namespace App\Facades;

use Illuminate\Contracts\Container\BindingResolutionException;

class Distance
{
    /**
     * @param $name
     * @param $arguments
     * @return mixed
     * @throws BindingResolutionException
     */
    public static function __callStatic($name, $arguments)
    {
        return self::resolve($name, $arguments);
    }

    /**
     * @param string $name
     * @param array $arguments
     * @return mixed
     * @throws BindingResolutionException
     */
    private static function resolve(string $name, array $arguments): mixed
    {
        return (app()->make('App\Services\RestaurantService'))->$name(...$arguments);
    }
}
