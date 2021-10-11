<?php

namespace App\Repositories;

use Auth;
use App\Models\DataUser;

class DataUserRepository
{
    protected $model = null;

    public function __construct(DataUser $model)
    {
        $this->model = $model;
    }
    
    

    /*
    * Admin
    */

    public function all()
    {
        return $this->model->all();
    }

    public function get_all()
    {
        return $this->model->paginate(5);
    }

    public function get_data_by_id($id)
    {
        return $this->model
                ->where('id', $id)->first();
    }


    /*
    * User
    */

    public function all_by_user()
    {
        return $this->model
                ->where('user_id', Auth::user()->id)
                ->get();
        
    }

    public function get_all_by_user()
    {
        return $this->model
                ->where('user_id', Auth::user()->id)
                ->paginate(2);
        
    }

    public function get_data_by_id_user($id)
    {
        return $this->model
                ->where('id', $id)
                ->where('user_id', Auth::user()->id)->first();
    }

    /*
    * Both
    */

    public function create(array $data)
    {
        // field
        $field = [
            'user_id' => Auth::user()->id,
            'name' => $data['name'],
            'birth_date' => $data['birth_date'],
            'phone' => $data['phone'],
            'email' => $data['email'],
        ];

        return $this->model->create($field);

        
    }

    public function update(array $data)
    {
        $user = $this->model->where('id', $data['id'])->first();
        $user->name = $data['name'];
        $user->birth_date = $data['birth_date'];
        $user->email = $data['email'];
        $user->phone = $data['phone'];
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
                ->where('name', 'like', "{$key}")
                ->orwhere('phone', 'like', "{$key}")
                ->orwhere('email', 'like', "{$key}")
                ->orderBy('name', 'ASC')
                ->paginate(2);
    }

    
}