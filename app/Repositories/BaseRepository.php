<?php


namespace App\Repositories;

class BaseRepository
{

    protected $entity;

    public function getQuery()
    {
        return $this->entity->query();
    }

    public function getById($id)
    {
        $model = $this->entity->withoutGlobalScopes()->find($id);
        if(!$model || $model->deleted_at)
            abort(404);
        return $model;
    }

    public function getPaginate($query, int $perPage = null)
    {
        if ($perPage){
            return $query->paginate($perPage);
        }

        return $query->get();
    }

    public function store($params)
    {
        return $this->entity->create($params);
    }

    public function update(array $params, int $id): mixed
    {
        $query = $this->getById($id);
        if ($query) {
            $query->update($params);
            return $query;
        } else {
            return false;
        }
    }

    public function destroy(int $id)
    {
        $entity = $this->getById($id);
        return ($entity) ? $entity->delete() : false;
    }


    public function insert($rows)
    {
        return $this->entity::insert($rows);
    }

    public function updateOrCreate($params, $conditions)
    {
        return $this->entity::updateOrCreate($params, $conditions);
    }

}
