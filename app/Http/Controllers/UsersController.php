<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User as Users;
use App\Address;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Users::with('address')->get();

        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        Users::create($request->all());

        return redirect()->route('users.index')->with('success','user created successfully.');
     }


    /**
     * Display the specified resource.
     *
      *@param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Users $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Users $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Users $users)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $users->update($request->all());

        return redirect()->route('users.index')->with('success','user updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Users $user)
    {
        $user->delete();

         return redirect()->route('users.index')
                         ->with('success','user deleted successfully');
    }
}
