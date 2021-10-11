<?php

namespace App\Repositories;

use Auth;
use App\Models\Booking;
use App\Models\Transaction;

class BookingRepository
{
    protected $model = null;

    public function __construct(Booking $model)
    {
        $this->model = $model;
    }
    
    

    /*
    * Admin
    */

    public function get_all()
    {
        return $this->model();
        // return $this->model->paginate(5);
    }

    public function get_data_by_id($id)
    {
        return $this->model
                ->where('id', $id)->first();
    }

    public function get_data_process()
    {
        return $this->model->select('*','bookings.id AS kode')
                        ->where('status', 'process')
                        ->join('data_users', 'data_users.id', '=', 'bookings.data_user')
                        ->join('rooms', 'rooms.id', '=', 'bookings.room')
                        ->orderBy('bookings.id', 'ASC')
                        ->paginate(5);
    }

    public function get_data_done()
    {
        return $this->model->select('*','bookings.id AS kode')
                        ->where('status', 'done')
                        ->join('data_users', 'data_users.id', '=', 'bookings.data_user')
                        ->join('rooms', 'rooms.id', '=', 'bookings.room')
                        ->orderBy('bookings.id', 'ASC')
                        ->paginate(5);
    }


    /*
    * User
    */

    

    /*
    * Both
    */

    public function create(array $data)
    {
        // field
        $field = [
            'checkin' => date($data['checkin']),
            'checkout' => date($data['checkout']),
            'total' => (strtotime($data['checkout']) - strtotime($data['checkin'])) / (60 * 60 * 24),
            'room' => $data['room'],
            'price' => $data['price'],
            'data_user' => $data['data_user'],
            'status' => $data['status'],
        ];

        $store = $this->model->create($field);

        // add transaction
        $price = (int)($field['total']) * (int)($field['price']);
        Transaction::create([
            'booking' => $store->id,
            'total' => $price,
            'status' => "Pending"
        ]);

        return $store;


        
    }

    public function update_status_done($id)
    {
        $booking = $this->model->where('id', $id)->first();
        $booking->status = 'Done';
        return $booking->save();
    }

    public function update_status_cancel($id)
    {
        $booking = $this->model->where('id', $id)->first();
        $booking->status = 'Cancel';
        return $booking->save();
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