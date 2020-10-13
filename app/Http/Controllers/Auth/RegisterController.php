<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\Image;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'=>['required','regex:/^[a-zA-Z\s]*$/','max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phonenumber'=> ['required','regex:/^(\+2519)[0-9]{8}$/'],
            'address' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
      $users1=User::all();
      $id="";
      if(empty($users1)||count($users1)==0||$users1==null){
        $id=1;
      }
      else {
        $users=User::orderBy('id','desc')->get()->take(1);
        $id=$users[0]->id+1;
        // $user=User::find($id);

      }


      Image::create(['imageable_id'=>$id,'path'=>'/images/user.png','imageable_type'=>'App\User']);

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phonenumber' => $data['phonenumber'],
            'address' => $data['address'],
            'password' => Hash::make($data['password'])
        ]);

    }
}
