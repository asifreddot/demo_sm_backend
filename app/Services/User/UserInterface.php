<?php

namespace App\Services\User;
use Illuminate\Http\Request;

interface UserInterface
{
    /**
     * Retrieve all users.
     *
     * @return array An array containing all users.
     */
    public function getUsers();

    /**
     * Retrieve the profile information of the currently authenticated user.
     *
     * @return array An array containing the profile information of the user.
     */
    public function profile();

    /**
     * Retrieve information about a specific user by their identifier.
     *
     * @param int $id The identifier of the user.
     * @return array An array containing information about the specified user.
     */
    public function getUserInfo($id);

    /**
     * Save a new user based on the provided request data.
     *
     * @param Request $request The request object containing user information.
     * @return void
     */
    public function saveUser(Request $request);

    /**
     * Update an existing user based on the provided request data.
     *
     * @param Request $request The request object containing updated user information.
     * @return void
     */
    public function updateUser(Request $request);
}
