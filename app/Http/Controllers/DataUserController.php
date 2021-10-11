<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Models\User;
use App\Models\Role;
use App\Models\DataUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\DataUserRequest AS Valid;
use App\Repositories\DataUserRepository AS Repo;

class DataUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Repo $repository)
    {
        if(Gate::allows('isAdmin')){
            $role = Role::roleAdmin;
            $datas = $repository->get_all();
        }else if(Gate::allows('isUser')){
            $role = Role::roleUser;
            $datas = $repository->get_all_by_user();
        }else{
            return redirect()->action('HomeController@index')->with(['error' => 'Menu Booking tidak bisa ditampilkan !']);
        }
        return view('data_user.index')
                ->with('datas', $datas)
                ->with('role', $role);
    }

    public function search(Request $request)
    {
        $key = trim($request->get('cari'));
        $datas = $repository->search($key);
        return view('data_user.index')
                ->with('datas', $datas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('data_user.form')
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
            return redirect()->action('DataUserController@index')->with(['success' => 'Data berhasil ditambahkan !']);
        }else{
            return redirect()->action('DataUserController@index')->with(['error' => 'Data gagal ditambahkan !']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataUser  $dataUser
     * @return \Illuminate\Http\Response
     */
    public function edit(Repo $repository, DataUser $datauser)
    {
        if(Gate::allows('isAdmin')){
            $role = Role::roleAdmin;
            $data = $repository->get_data_by_id($datauser->id);
        }elseif(Gate::allows('isUser')){
            $role = Role::roleUser;
            $data = $repository->get_data_by_id_user($datauser->id);
        }else{
            return redirect()->action('HomeController@index')->with(['error' => 'Menu Data User tidak bisa ditampilkan !']);
        }
        
        if(!empty($data))
        {
            return view('data_user.form')
                ->with('data', $data)
                ->with('title', 'Edit');
        }else{
            return redirect()->action('DataUserController@index')->with(['error' => 'Data tidak tersedia !']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataUser  $dataUser
     * @return \Illuminate\Http\Response
     */
    public function update(Valid $request, Repo $repository, DataUser $datauser)
    {
        // validation
        $validated = $request->validated();
        
        // update
        if($repository->update($request->input()))
        {
            return redirect()->action('DataUserController@index')->with(['success' => 'Data berhasil diupdate !']);
        }else{
            return redirect()->action('DataUserController@index')->with(['error' => 'Data gagal diupdate !']);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataUser  $dataUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataUser $datauser, Repo $repository)
    {
        if($repository->delete($datauser->id))
        {
            return redirect()->action('DataUserController@index')->with(['success' => 'Data berhasil dihapus !']);
        }else{
            return redirect()->action('DataUserController@index')->with(['error' => 'Data gagal dihapus !']);
        }
    }
}
