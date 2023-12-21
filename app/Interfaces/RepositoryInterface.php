<?php

namespace App\Interfaces;

interface RepositoryInterface 
{
  public function getAll();
  public function getById($id);
  public function store(array $data);
  public function update($id, array $newData);
  public function delete($id);  
}