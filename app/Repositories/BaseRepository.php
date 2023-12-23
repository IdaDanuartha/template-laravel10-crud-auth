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

  public function findAll(
    $search = null,
    $relations = [], 
    $conditions = [], 
    $orderBy = ["created_at" => "desc"],
    $paginate = null): Collection
  {
    // Add relations
    $query = $this->model->with($relations);

    // Add searching condition    
    // if ($search) {
    //   $query->where(function ($query) use ($search) {
    //       // Adjust this based on your specific search criteria
    //       $query->where('field1', 'like', '%' . $search . '%')
    //             ->orWhere('field2', 'like', '%' . $search . '%');
    //   });
    // }
    // if ($search) {
    //   $query->where(function ($query) use ($search, $relations) {
    //     foreach ($relations as $relation) {
    //       $query->orWhereHas($relation, function ($subQuery) use ($search) {
    //         // Adjust this based on your specific search criteria for related models
    //         $subQuery->where('related_field', 'like', '%' . $search . '%');
    //       });
    //     }
    //   });
    // }

    // Add conditions
    foreach ($conditions as $field => $value) {
      $query->where($field, $value);
    }

    // Add orderBy
    foreach ($orderBy as $field => $value) {
      if($field === 'created_at') {
        if($value === 'desc') {
          $query->latest();
        } else {
          $query->oldest();
        }
      } else {
        $query->orderBy($field, $value);
      }
    }

    // Add pagination
    if ($paginate) {
      $query->paginate($paginate);
    }

    return $query->get();
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