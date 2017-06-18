<?php
/**
 * Created by PhpStorm.
 * User: worakanpongnumkul
 * Date: 4/11/2017 AD
 * Time: 2:18 PM
 */

namespace App\Repositories\Contracts;


interface Repository
{
    public function create(array $attributes);

    public function all($columns = array('*'));

    public function find($id, $columns = array('*'));

    public function destroy($ids);

    public function with($relations);

}