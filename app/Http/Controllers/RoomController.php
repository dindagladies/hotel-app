<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Room;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\RoomRequest AS Valid;
use App\Repositories\RoomRepository AS Repo;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(User $user)
    {
        $this->middleware('auth');
        $this->user = $user;
    }

    public function index(Repo $repository)
    {
        if(Gate::allows('isAdmin')){
            $role = Role::roleAdmin;
        }else{
            return redirect()->action('HomeController@index')->with(['error' => 'Menu Booking tidak bisa ditampilkan !']);
        }

        $datas = $repository->get_all();
        return view('room.index')
                ->with('datas', $datas);
    }

    // search
    public function search(Repo $repository, Request $request)
    {
        $key = trim($request->get('cari'));
        $datas = $repository->search($key);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('room.form')
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
            return redirect()->action('RoomController@index')->with(['success' => 'Data berhasil ditambahkan !']);
        }else{
            return redirect()->action('RoomController@index')->with(['error' => 'Data gagal ditambahkan !']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Repo $repository, Room $room)
    {
        if(Gate::allows('isAdmin')){
            $role = Role::roleAdmin;
            $data = $repository->get_data_by_id($room->id);
        }else{
            return redirect()->action('HomeController@index')->with(['error' => 'Menu Booking tidak bisa ditampilkan !']);
        }

        if(!empty($data))
        {
            return view('room.form')
                    ->with('data', $data)
                    ->with('title', 'Edit');
        }else{
            return redirect()->action('RoomController@index')->with(['error' => 'Data tidak tersedia !']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Repo $repository, Valid $request, Room $room)
    {
        // validation
        $validated = $request->validated();
        
        // update
        if($repository->update($request->input()))
        {
            return redirect()->action('RoomController@index')->with(['success' => 'Data berhasil diupdate !']);
        }else{
            return redirect()->action('RoomController@index')->with(['error' => 'Data gagal diupdate !']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Repo $repository, Room $room)
    {
        if($repository->delete($room->id))
        {
            return redirect()->action('RoomController@index')->with(['success' => 'Data berhasil dihapus !']);
        }else{
            return redirect()->action('RoomController@index')->with(['error' => 'Data gagal dihapus !']);
        }
    }
}
