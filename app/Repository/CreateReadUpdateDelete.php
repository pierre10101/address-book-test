<?php

namespace App\Repository;

use App\Contacts;
use Illuminate\Http\Request;
use App\Repository\Interfaces\ModelRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class CreateReadUpdateDelete implements ModelRepositoryInterface
{
    /**
     * an instance of Model Interface
     *
     * @var collection $model
     */
    private $model;

    /**
     * construct class injecting $model or setting up default class
     *
     * @param Model $model
     */
    public function __construct(Model $model = null)
    {
        if ($model === null) {
            $this->model = new Contacts; 
        }
    }
    /**
     * Method to create or update fields
     *
     * @param Request $request
     * @return array
     */
    public function create(Request $request) : array
    {
        if ($request->choice === true) {
            $this->model->create(
            [
                'name' => $request->info['name'],
                'surname' => $request->info['surname'],
                'id_number' => $request->info['id_number']
            ]);
        }
        if ($request->choice === false) {
            $this->model->find($request->info['id'])->addresses()->create([
                'email' => $request->info['email'],
                'contact_number' => $request->info['contact_number'],
                'contacts_id' => $request->info['id'],
            ]);
        }
        
        return ['status' => 'success'];
    }
    /**
     * Method to update or update fields
     *
     * @param Request $request
     * @return array
     */
    public function update(Request $request) : array
    {
        if ($request->choice === true) {
            $this->model->find($request->info['id'])->update(
            array_filter([
                'name' => $request->info['name'],
                'surname' => $request->info['surname'],
            ]));
        }
        if ($request->choice === false) {
            $this->model->find($request->info['id'])->addresses()->find($request->info['specific_id'])->update(
            array_filter([
                'email' => $request->info['email'],
                'contact_number' => $request->info['contact_number'],
                'contacts_id' => $request->info['id'],
            ]));
        }
        
        return ['status' => 'success'];
    }
    /**
     *  method that retrieves all database entries
     *
     * @return array
     */
    public function all() : array
    {
        $contactArray = [];
        foreach ($this->model->with(['addresses'])->get() as $contact) {
            $contactArray[$contact['id']] = [
                'name' => $contact['name'],
                'surname' => $contact['surname'],
                'addresses' => $contact['addresses'],
                'id_number' => $contact['id_number']
            ];
        }
        return $contactArray;
    }
    /**
     *  method that deletes database entries
     *
     * @return array
     */
    public function delete(int $id) : array
    {
        $this->model->find($id)->addresses()->delete();
        $this->model->find($id)->delete();
        return ['status' => 'success'];
    }
}