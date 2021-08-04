<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('address')->get();

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
            'email' => 'bail|required|email|unique:users',
            'address' => 'required'
        ]);

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
        ]);

        $user->address()->create([
            'address' => $request->get('address'),
        ]);

        return redirect()->route('users.index')->with('success','user created successfully.');
     }


    /**
     * Display the specified resource.
     *
      *@param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
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
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'bail|required|email|unique:users,email,'.$user->id,
            'address' => 'required'
        ]);

        $user->update([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
        ]);

        $address = $user->address();

        if ($address) {
            $address->update([
                'address' => $request->get('address'),
            ]);
        } else {
            $user->address()->create([
                'address' => $request->get('address'),
            ]);
        }


        return redirect()->route('users.index')->with('success','user updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $address = $user->address();
        if ($address) {
            $address->delete();
        }

        $user->delete();

        return redirect()->route('users.index')->with('success','user deleted successfully');
    }
}
