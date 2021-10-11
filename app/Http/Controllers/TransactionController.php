<?php

namespace App\Http\Controllers;

use PDF;
use Auth;
use App\Models\Transaction;
use App\Models\Booking;
use App\Models\User;
use App\Models\Role;
use App\Models\DataUser;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Repositories\TransactionRepository AS Repo;
use App\Repositories\BookingRepository AS RepoBooking;
use App\Repositories\DataUserRepository AS RepoDataUser;
use App\Repositories\RoomRepository AS RepoRoom;

class TransactionController extends Controller
{
    public function __construct(User $user)
    {
        $this->middleware('auth');
        $this->user = $user;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Repo $repository)
    {
        if(Gate::allows('isAdmin')){
            $role = Role::roleAdmin;
            $datas = $repository->get_all();
        }else if(Gate::allows('isUser')){
            $role = Role::roleUser;
            $datas = $repository->get_all_by_user();
        }else{
            return redirect()->action('HomeController@index')->with(['error' => 'Menu Transaksi tidak bisa ditampilkan !']);
        }

        return view('transaction.index')
                ->with('datas', $datas)
                ->with('role', $role);
    }

    // search
    public function search()
    {
        return view('transaction.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Repo $repository, RepoBooking $repobooking,
        RepoDataUser $repodatauser, RepoRoom $reporoom, Transaction $transaction
        )
    {
        if(Gate::allows('isAdmin')){
            $role = Role::roleAdmin;
        }else if(Gate::allows('isUser')){
            $role = Role::roleUser;
        }else{
            return redirect()->action('HomeController@index')->with(['error' => 'Menu Transaksi tidak bisa ditampilkan !']);
        }

        $data = $repository->get_data_by_id($transaction->id);
        if(!empty($data))
        {
            $bookings = $repobooking->get_data_by_id($transaction->booking);
            $customers = $repodatauser->get_data_by_id($bookings->data_user);
            $rooms = $reporoom->get_data_by_id($bookings->room);
            return view('transaction.form')
                    ->with('data', $data)
                    ->with('booking', $bookings)
                    ->with('customer', $customers)
                    ->with('room', $rooms)
                    ->with('title', 'Edit')
                    ->with('role', $role);
        }else{
            return redirect()->action('TransactionController@index')->with(['error' => 'Data tidak tersedia !']);
        }
    }

    public function invoice(Repo $repository, RepoBooking $repobooking,
        RepoDataUser $repodatauser, RepoRoom $reporoom, $transaction)
    {
        $data = $repository->get_data_by_id($transaction);
        if(!empty($data))
        {

            $booking = $repobooking->get_data_by_id($data->booking);
            $customer = $repodatauser->get_data_by_id($booking->data_user);
            $room = $reporoom->get_data_by_id($booking->room);

            $pdf = PDF::loadview('transaction.invoice', 
                    [
                        'data' => $data,
                        'booking' => $booking,
                        'customer' => $customer,
                        'room' => $room
                    ]
            );
            return $pdf->stream('invoice-pembayaran.pdf');
            
        }else{
            return redirect()->action('TransactionController@edit'. ['id' => $transaction])->with(['error' => 'Data tidak tersedia !']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Repo $repository,
        RepoBooking $repobooking, Transaction $transaction)
    {
        if (!is_null($request->file('bukti'))){
            $transaction->file = $request->file('bukti')->store('public');
            $transaction->save();
        }

        if($update = $repository->update($transaction->id, $request->input()))
        {
            if($update->status == 'Lunas'){
                $repobooking->update_status_done($transaction->booking);
            }elseif($update->status == 'Cancel'){
                $repobooking->update_status_cancel($transaction->booking);
            }
            
            return redirect()->action('TransactionController@index')->with(['success' => 'Data berhasil diupdate !']);
        }else{
            return redirect()->action('TransactionController@index')->with(['error' => 'Data gagal diupdate !']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }

}
