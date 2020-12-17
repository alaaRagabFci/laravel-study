<?php
namespace App\Repositories\Generic;

interface IGenericRepository
{
    /**
     * @param array $params (associativeArray)
     * @return Object
     */
    public function getOne(array $params);
    /**
     * @param array $attributes (associativeArray)
     * @return Object
     */
    public function store(array $attributes);

    /**
     * @param $instanceId
     * @param array $attributes (associativeArray)
     * @return boolean
     */
    public function update($instanceId,array $attributes);

    /**
     * @param array $attributes
     * @return mixed
     */
    public function firstOrCreate(array $attributes);

    /**
     * @return mixed
     */
    public function paginate();

    /**
     * @param $instance
     * @return boolean
     */
    public function delete($instance);

}
