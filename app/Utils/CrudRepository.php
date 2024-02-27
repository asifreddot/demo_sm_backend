<?php

namespace App\Utils;

interface CrudRepository
{

    /**
     * Find all records of a specified model.
     *
     * @param string $modelName The name of the model to query.
     * @param int $perPage The number of records to display per page (default is 10).
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function findAll(string $modelName, int $perPage = 10);

    /**
     * Find a record by its identifier.
     *
     * @param string $modelName The name of the model to query.
     * @param int $id The identifier of the record to find.
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function findById(string $modelName, int $id);

    /**
     * Find records by user identifier.
     *
     * @param string $modelName The name of the model to query.
     * @param int $userId The user identifier for filtering records.
     * @param int $perPage The number of records to display per page (default is 10).
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function findByUserId(string $modelName, int $userId, int $perPage = 10);

    /**
     * Save a new record for a specified model.
     *
     * @param string $modelName The name of the model to save.
     * @param array $data The data to be saved for the new record.
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function save(string $modelName, array $data);

    /**
     * Update a record for a specified model.
     *
     * @param string $modelName The name of the model to update.
     * @param array $data The data to be updated for the record.
     * @param int $id The identifier of the record to update.
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function update(string $modelName, array $data, $id);

    /**
     * Delete a record by its identifier.
     *
     * @param string $modelName The name of the model to delete from.
     * @param int $id The identifier of the record to delete.
     * @return bool|null
     */
    public function delete(string $modelName, int $id);

}
