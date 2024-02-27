<?php

namespace App\Utils;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class CrudRepoImpl implements CrudRepository
{

    public function findAll(string $modelName, int $perPage = 10,array $whereConditions = [])
    {
        $modelClass = "App\\Models\\$modelName";
        $model = new $modelClass;
        $query = $model->query();

        // Add where conditions if provided
        foreach ($whereConditions as $column => $value) {
            // Check if the value is an array, indicating a "not equal" condition
            if (is_array($value) && count($value) == 2 && $value[0] === '!=') {
                $query->where($column, '<>', $value[1]);
            } else {
                $query->where($column, $value);
            }
        }

        return $query->paginate($perPage);
    }

    public function findById(string $modelName, int $id , array $whereConditions = [])
    {
        $modelClass = "App\\Models\\$modelName";
        $model = new $modelClass;
        $query = $model->query();

        // Add where conditions if provided
        foreach ($whereConditions as $column => $value) {
            // Check if the value is an array, indicating a "not equal" condition
            if (is_array($value) && count($value) == 2 && $value[0] === '!=') {
                $query->where($column, '<>', $value[1]);
            } else {
                $query->where($column, $value);
            }
        }
        return $query->find($id);
    }

    public function findByUserId(string $modelName, int $id, int $perPage = 10)
    {
        $modelClass = "App\\Models\\$modelName";
        $model = new $modelClass;
        $data = $model->where('user_id', $id)->paginate($perPage);
        return $data;
    }

    public function save(string $modelName, array $data)
    {
        $modelClass = "App\\Models\\$modelName";
        $model = new $modelClass;
        $model->fill($data);
        $model->create($data);
        return $model;
    }

    public function update(string $modelName, array $data, $id)
    {
        $modelClass = "App\\Models\\$modelName";
        $model = $modelClass::find($id);
        if (!$model) {
            return null;
        }
        $model->fill($data);
        $model->save();

        return $model;
    }

    /**
     * @throws \Exception
     */
    public function delete(string $modelName, int $id)
    {
        $modelClass = "App\\Models\\$modelName";
        try {
            $model = $modelClass::findOrFail($id);
            $model->delete();
            return $model;
        } catch (ModelNotFoundException $e) {
            throw new \Exception("Record with ID $id not found for model $modelName");
        }
    }
}
