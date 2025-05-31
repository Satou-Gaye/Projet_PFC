<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreUsersRequest;
use App\Http\Requests\UpdateUsersRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $users = User::all();  
        return view('user.index', 
compact('users')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('welcome');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUsersRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $users)
    {
       // $users = User::find($users->id);
        //return view('user.show',compact('user'));
        return view('user.show', ['user' => $user]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $users)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUsersRequest $request, User $users)
    {
        $users = User::find($users->id);
        $users->update($request->all());
        return redirect('/users')->with('success','utilisateur modifie');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $users)
    {
        
        $users = User::find($id);  
        $users->delete();         
        return redirect('/users')
        >with('success', 'User removed.'); 
    }

    

    public function createUser(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'role' => 'required|string|in:admin,chef_departement,chef_filliere,assistant',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $user = User::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => Hash::make($request->input('password')),
        'role' => $request->input('role'), // Affectation du rôle ici
    ]);

    return redirect()->back()->with('success', 'Utilisateur créé et rôle assigné avec succès.');
}



}
