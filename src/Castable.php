<?php

namespace Castable;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\ParameterBag;

class Castable extends FormRequest {

    protected $casting = false;

    /**
     * Get the input source for the request.
     *
     * @return \Symfony\Component\HttpFoundation\ParameterBag
     */
    protected function getInputSource()
    {
        if ($this->isJson()) {
            return $this->json();
        }

        return $this->getRealMethod() == 'GET' ? $this->requestCast($this->query, 'query') : $this->requestCast($this->request, 'post');
    }

    /**
     * Retrieve an input item from the request.
     *
     * @param  string  $key
     * @param  string|array|null  $default
     * @return string|array
     */
    public function input($key = null, $default = null)
    {
        $input = $this->getInputSource()->all() + $this->requestCast($this->query, 'query')->all();

        $this->resetCast();

        return data_get($input, $key, $default);
    }

    /**
     * Get the JSON payload for the request.
     *
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    public function json($key = null, $default = null)
    {
        if (! isset($this->json)) {
            $this->json = new ParameterBag((array) json_decode($this->getContent(), true));
        }

        if (is_null($key)) {
            $jsonData = $this->requestCast($this->json, 'json');

            $this->resetCast();

            return $jsonData;
        }

        $jsonData = $this->requestCast(new ParameterBag($this->json->all()), 'json')->all();

        $this->resetCast();

        return data_get($jsonData, $key, $default);
    }

    /**
     * Convert given cast to incoming types
     *
     * @param  [type] $data parameters payload
     * @param  [type] $type cast group name
     * @return mixed
     */
    public function cast($data = null, $type = null)
    {
        if(! $data) {
            $this->casting = true;

            return $this;
        }

        return $this->applyCast($this->resolveParameters($data), $this->casts[$type], $type)->all();
    }

    /**
     * Resolve types given parameters
     *
     * @param  mixed $data
     * @return object
     */
    protected function resolveParameters($data)
    {
        if($data instanceof Collection) {
            $data = $data->toArray();
        }
        else if($data instanceof Request) {
            $data = $request->all();
        }

        return new ParameterBag($data);
    }

    /**
     * Request parameters convert to the cast payload
     *
     * @param  ParameterBag $parameters
     * @param  array        $casts
     * @param  string cast group
     * @return object ParameterBag
     */
    protected function applyCast(ParameterBag $parameters, array $casts, $type)
    {
        // Cloning the ParameterBag  class to prevent any change
        // Converts parameters everytime
        $data = clone $parameters;

        // Iterates original parameter class
        foreach($parameters as $key => &$originalValue) {

            if(array_has($casts, $key)) {
                $prefix = ucfirst($type);
                $method = $casts[$key].'Type';
                $value  = $this->{$method}($originalValue);
                $setter = $prefix.ucfirst(camel_case($key)).'Attribute';

                if(method_exists($this, $setter)) {
                    $value = $this->{$setter}($value, $originalValue);
                }

                $data->set($key, $value);
            }
        }

        return $data;
    }

    /**
     * Convert type adapter
     *
     * @param  object $request ParameterBag
     * @param  string $type
     * @return object ParameterBag
     */
    protected function requestCast($request, $type)
    {
        if(array_has($this->casts, $type)) {
            $request = !$this->casting ? $request : $this->applyCast($request, $this->casts[$type], $type);
        }

        return $request;
    }

    protected function resetCast()
    {
        $this->casting = false;
    }

    /**
     * Convert to boolean type
     *
     * @param  mixed $value
     * @return bool
     */
    protected function booleanType($value)
    {
        if(in_array($value, ["true", "false", "1", "0", 1, 0])) {
            return (bool) $value;
        }

        return $value;
    }

    /**
     * Convert to float type
     *
     * @param  numeric $value
     * @return int|mixed
     */
    protected function floatType($value)
    {
        if(is_numeric($value)) return (float) $value;

        return $value;
    }

    /**
     * Convert to double type
     *
     * @param  numeric $value
     * @return int|mixed
     */
    protected function doubleType($value)
    {
        if(is_numeric($value)) return (double) $value;

        return $value;
    }

    /**
     * Convert to real type
     *
     * @param  numeric $value
     * @return int|mixed
     */
    protected function realType($value)
    {
        if(is_numeric($value)) return (real) $value;

        return $value;
    }

    /**
     * Convert to unset type
     *
     * @param  mixed $value
     * @return null
     */
    protected function unsetType($value = '')
    {
        return (unset) $value;
    }

    /**
     * Convert to binary type
     *
     * @param  mixed $value
     * @return binary
     */
    protected function binaryType($value = '')
    {
        return (binary) $value;
    }

    /**
     * Convert to integer type
     *
     * @param  numeric $value
     * @return int|mixed
     */
    protected function integerType($value)
    {
        if(is_numeric($value)) return (int) $value;

        return $value;
    }

    /**
     * Convert to string
     *
     * @param  mixed $value
     * @return string
     */
    protected function stringType($value)
    {
        return (string) $value;
    }

    /**
     * Convert to array type
     *
     * @param  mixed $value
     * @return array
     */
    protected function arrayType($value)
    {
        return (array) $value;
    }

    /**
     * Convert to object type
     *
     * @param  mixed $value
     * @return object
     */
    protected function objectType($value)
    {
        return (object) $value;
    }

    /**
     * Convert to Collection wrapper
     * @param  mixed $value
     * @return object Collection
     */
    protected function collectionType($value)
    {
        return collect($value);
    }
}
