<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Room;
use App\Models\User;
use App\Models\Role;
use App\Models\Booking;
use App\Models\DataUser;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\BookingRequest AS Valid;
use App\Repositories\BookingRepository AS Repo;
use App\Repositories\DataUserRepository AS RepoDataUser;
use App\Repositories\RoomRepository AS RepoRoom;
use App\Repositories\TransactionRepository AS RepoTransaction;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $user;

    public function __construct(User $user)
    {
        $this->middleware('auth');
        $this->user = $user;
    }

    public function index(RepoRoom $reporoom)
    {
        if(Gate::allows('isAdmin')){
            $role = Role::roleAdmin;
        }else if(Gate::allows('isUser')){
            $role = Role::roleUser;
        }else{
            return redirect()->action('HomeController@index')->with(['error' => 'Menu Booking tidak bisa ditampilkan !']);
        }
        
        $datas = $reporoom->get_all();
        return view('booking.index')
                ->with('datas', $datas)
                ->with('role', $role);
    }

    public function process(Repo $repository)
    {
        if(Gate::allows('isAdmin')){
            $role = Role::roleAdmin;
        }else if(Gate::allows('isUser')){
            return redirect()->action('HomeController@index')->with(['error' => 'Anda tidak bisa mengakses menu ini']);
        }else{
            return redirect()->action('HomeController@index')->with(['error' => 'Menu Booking tidak bisa ditampilkan !']);
        }

        $datas = $repository->get_data_process();

        return view('booking.process')
                ->with('datas', $datas)
                ->with('role', $role);
    }

    public function done(Repo $repository)
    {
        if(Gate::allows('isAdmin')){
            $role = Role::roleAdmin;
        }else if(Gate::allows('isUser')){
            return redirect()->action('HomeController@index')->with(['error' => 'Anda tidak bisa mengakses menu ini']);
        }else{
            return redirect()->action('HomeController@index')->with(['error' => 'Menu Booking tidak bisa ditampilkan !']);
        }

        $datas = $repository->get_data_done();

        return view('booking.done')
                ->with('datas', $datas)
                ->with('title', 'Edit')
                ->with('role', $role);
    }

    public function search()
    {
        return view('booking.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('booking.form')
                ->with('title', 'Tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Valid $request, Repo $repository)
    {
        // validation
        $validated = $request->validated();
        
        // create
        if($repository->create($request->input()))
        {
            return redirect()->action('BookingController@index')->with(['success' => 'Data berhasil ditambahkan !']);
        }else{
            return redirect()->action('BookingController@index')->with(['error' => 'Data gagal ditambahkan !']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */

    public function show(RepoRoom $reporoom, RepoDataUser $repositoryUser, $booking)
    {
        if(Gate::allows('isAdmin')){
            $role = Role::roleAdmin;
            $customers = $repositoryUser->all();
        }else if(Gate::allows('isUser')){
            $role = Role::roleUser;
            $customers = $repositoryUser->all_by_user();
        }else{
            return redirect()->action('HomeController@index')->with(['error' => 'Menu Booking tidak bisa ditampilkan !']);
        }

        $room =$reporoom->show($booking);
        
        return view('booking.form')
                ->with('room', $room )
                ->with('customers', $customers )
                ->with('title', 'Tambah')
                ->with('url', 'booking')
                ->with('role', $role);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(
        Repo $repository, RepoRoom $reporoom, RepoDataUser $repoDataUser,
        RepoTransaction $repotransaction, Booking $booking
        )
    {
        if(Gate::allows('isAdmin')){
            $role = Role::roleAdmin;
        }else if(Gate::allows('isUser')){
            return redirect()->action('HomeController@index')->with(['error' => 'Anda tidak bisa mengakses menu ini']);
        }else{
            return redirect()->action('HomeController@index')->with(['error' => 'Menu Booking tidak bisa ditampilkan !']);
        }

        $data = $repository->get_data_by_id($booking->id);
        $room = $reporoom->get_data_by_id($booking->room);
        $transaction = $repotransaction->get_data_by_booking($booking->id);
        $customer = $repoDataUser->get_data_by_id($booking->data_user);
        return view('booking.form')
                ->with('data', $data)
                ->with('room', $room)
                ->with('customer', $customer)
                ->with('transaction', $transaction)
                ->with('title', 'Edit')
                ->with('url', 'processbooking')
                ->with('role', $role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
