<?php
namespace App\Repositories\Generic;

abstract class AbstractGenericRepository implements IGenericRepository
{
    const PAGINATION_PER_PAGE = 10;
    protected $model;

    /**
     * AbstractGenericRepository constructor.
     *
     * @param $model
     */
    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function getOne(array $params)
    {
       return $this->model::where($params)->first();
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function store(array $attributes)
    {
        return $this->model::Create($attributes);
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function firstOrCreate(array $attributes)
    {
        return $this->model::firstOrCreate($attributes);
    }

    /**
     * @param $instanceId
     * @param array $attributes
     * @return mixed
     */
    public function update($instanceId, array $attributes)
    {
        return $this->model::where('id',$instanceId)->update($attributes);
    }

    /**
     * @return mixed
     */
    public function paginate()
    {
        return $this->model::Paginate(self::PAGINATION_PER_PAGE);
    }

    /**
     * @param $instance
     * @return boolean
     */
    public function delete($instance)
    {
        return $instance->delete();
    }
}
