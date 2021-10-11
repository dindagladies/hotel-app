<?php

namespace App\Repositories;

use Auth;
use App\Models\Room;

class RoomRepository
{
    protected $model = null;

    public function __construct(Room $model)
    {
        $this->model = $model;
    }

    public function get_all()
    {
        // dd($this->model->all());
        return $this->model->paginate(5);
    }

    public function get_data_by_id($id)
    {
        return $this->model
                ->where('id', $id)->first();
    }

    public function create(array $data)
    {

        return $this->model->create($data);

        
    }

    public function update(array $data)
    {
        $user = $this->model->where('id', $data['id'])->first();
        $user->type_room = $data['type_room'];
        $user->type_bed = $data['type_bed'];
        $user->total = $data['total'];
        $user->price = $data['price'];
        $user->description = $data['description'];
        return $user->save();
    }

    public function delete($id)
    {
        $user = $this->model->find($id);
        return $user->delete();
    }

    public function search($key)
    {
        $datas = $this->model->query()
                ->where('type_room', 'like', "{$key}")
                ->orwhere('type_bed', 'like', "{$key}")
                ->orwhere('total', 'like', "{$key}")
                ->orwhere('price', 'like', "{$key}")
                ->orwhere('description', 'like', "{$key}")
                ->orderBy('type_room', 'ASC')
                ->paginate(2);
    }

    public function show($id)
    {
        return $this->model->where('id', $id)->first();
    }
}