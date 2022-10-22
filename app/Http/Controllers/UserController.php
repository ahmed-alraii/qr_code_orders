<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function index(){
        return view('user.index')->with('records' , User::all());
    }


    public function addUser(Request $request)
    {
        $data = $request->all();
        $this->validator($data);
        $user = $this->create($data);

        if($user->role->name === 'Employee'){
            $restaurant = Restaurant::findOrFail($data['restaurant_id']);
            $restaurant->users()->attach($user);
        }

        return redirect()->route('users.index')->with(['message' => 'User Added']);
    }

    protected function validator(array $data)
    {
       $id = request()->method() === 'PUT' ? $data['id'] : "";
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users' . $id],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role_id' => ['required']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => $data['role_id']
        ]);
    }


    public function edit(User $user){
        return view('user.edit')
            ->with(
                [
                    'record' => $user,
                    'roles' => Role::all() ,
                     'restaurants' => Restaurant::all()
                ]);
    }

    public function updateUser(User $user){

        $data = request()->all();
        $this->validator($data);
        $user->update($data);
        return redirect()->route('users.index')->with(['message' => 'User Updated']);

    }

    public function destroyUser(User $user){

        if($user->role->name === 'Employee'){
            foreach (Restaurant::all() as $restaurant){
                    if( count($restaurant->users->where('id' , $user->id)) > 0){
                        $restaurant->users()->detach($user);
                        break;
               }
            }
        }
        $user->delete();
        return redirect()->route('users.index')->with(['message' => 'User Deleted']);
    }
}
