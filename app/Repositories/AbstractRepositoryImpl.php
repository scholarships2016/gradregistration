<?php
/**
 * Created by PhpStorm.
 * User: worakanpongnumkul
 * Date: 4/9/2017 AD
 * Time: 10:52 PM
 */

namespace App\Repositories;


use App\Repositories\Contracts\Repository;

abstract class AbstractRepositoryImpl implements Repository
{
    protected $modelClassName;

    public function create(array $attributes)
    {
        return call_user_func_array("{$this->modelClassName}::create", array($attributes));
    }

    public function all($columns = array('*'))
    {
        return call_user_func_array("{$this->modelClassName}::all", array($columns));
    }

    public function find($id, $columns = array('*'))
    {
        return call_user_func_array("{$this->modelClassName}::find", array($id, $columns));
    }

    public function destroy($ids)
    {
        return call_user_func_array("{$this->modelClassName}::destroy", array($ids));
    }

    public function with($relations)
    {
        return call_user_func_array("{$this->modelClassName}::with", array($relations));
    }


    /**
     * @return mixed
     */
    public function getModelClassName()
    {
        return $this->modelClassName;
    }

    /**
     * @param mixed $modelClassName
     */
    public function setModelClassName($modelClassName)
    {
        $this->modelClassName = $modelClassName;
    }
}