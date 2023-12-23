<?php

namespace App\Interfaces;

interface RepositoryInterface 
{
  public function findAll();
  public function findById(int $id, array $relations = []);
  public function store(array $data);
  public function update(int $id, array $newData);
  public function delete(int $id);  
}