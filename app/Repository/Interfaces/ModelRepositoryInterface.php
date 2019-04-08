<?php

namespace App\Repository\Interfaces;

use Illuminate\Http\Request;
/**
 * Interface for handling repositories created to work with ORM's
 */
interface ModelRepositoryInterface {
    public function create(Request $request) : array;
    public function update(Request $request) : array;
    public function all() : array;
    public function delete(int $id) : array;
}