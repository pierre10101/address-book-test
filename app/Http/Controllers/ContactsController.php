<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\Interfaces\ModelRepositoryInterface;

class ContactsController extends Controller
{
    /**
     * An instance of the ModelRepositoryInterface
     *
     * @var ModelRepositoryInterface
     */
    private $crud;

    public function __construct(ModelRepositoryInterface $crud)
    {
        $this->crud = new $crud();
    }
    /**
     * Create database entries
     *
     * @param Request $request
     * @return Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return $this->crud->create($request);
    }
    /**
     * Update database entries or update existing
     *
     * @param Request $request
     * @return Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        return $this->crud->update($request);
    }
    /**
     * Retrieve all database entries
     *
     * @param Request $request
     * @return Illuminate\Http\Response
     */
    public function getAll()
    {
        return $this->crud->all();
    }
    /**
     * Delete specific database entry
     *
     * @param Request $request
     * @return Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        return $this->crud->delete((int) $request->id);
    }

}
