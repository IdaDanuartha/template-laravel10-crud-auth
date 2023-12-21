<?php

namespace App\Interfaces;

interface RepositoryInterface 
{
  public function findAll();
  public function findById($id);
  public function store(array $data);
  public function update($id, array $newData);
  public function delete($id);  
}