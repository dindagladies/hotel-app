<?php

namespace App\Repositories;

use Auth;
use App\Models\Transaction;

class TransactionRepository
{
    protected $model = null;

    public function __construct(Transaction $model)
    {
        $this->model = $model;
    }

    /*
    * Admin
    */

    public function get_all()
    {
        return $this->model->paginate(5);
    }

    /*
    * User
    */

    public function get_all_by_user()
    {
        return $this->model->select('transactions.*', 'bookings.id AS kode' )
                    ->join('bookings', 'transactions.booking', '=', 'bookings.id')
                    ->join('data_users', 'bookings.data_user', '=', 'data_users.id')
                    ->where('data_users.user_id', Auth::user()->id)
                    ->paginate(2);
    }

    /*
    * Both
    */

    public function get_data_by_id($id)
    {
        return $this->model
                ->where('id', $id)->first();
    }

    public function get_data_by_booking($booking)
    {
        return $this->model
                ->where('booking', $booking)->first();
    }

    public function update($id, array $data)
    {
        $transaction = $this->model->where('id', $id)->first();
        $transaction->status = $data['status'];
        $transaction->save();

        return $transaction;
    }

    public function update_file($id, array $data, object $file)
    {
        $transaction = $this->model->where('id', $id)->first();
        $transaction->status = $data['status'];
        $transaction->file = $file('bukti')->store('public');
        $transaction->save();
    }
}