<?php
namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements RepositoryInterface {
  protected $model;

  public function __construct(Model $model)
  {
    $this->model = $model;
  }

  public function findAll(): Model
  {    
    return $this->model;
  }

  public function findById($id, $relations = []): ?Model
  {
    return $this->model->with($relations)->find($id);
  }

  public function store(array $data): Model
  {
      return $this->model->create($data);
  }

  public function update($id, array $data): bool
  {
      $model = $this->model->find($id);

      if (!$model) {
          return false;
      }

      return $model->update($data);
  }

  public function delete($id): bool
  {
    $model = $this->model->find($id);

    if (!$model) {
        return false;
    }

    return $model->delete();
  }
}