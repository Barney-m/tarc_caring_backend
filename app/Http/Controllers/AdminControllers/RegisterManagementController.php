<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterManagementController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::ADMIN_HOME;

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    protected function validator(Request $data)
    {
        $validate = Validator::make($data->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        return $validate;
    }

    public function index(Request $request)
    {

        return view('admin.register_management');
    }

    protected function create(Request $data)
    {
        $flag = $this->validator($data);
        if(!$flag->fails()){
            $user = User::select('user_id')->where('role_id', '=', 5)->orderBy('user_id', 'desc')->first();
            if($user == null){
                $id = 'S100001';
            }
            else{
                $intID = intval(substr($user->user_id, 1)) + 1;
                $id = 'S'.strval($intID);
            }
            $to_name = $data['name'];
            $to_email = $data['email'];
            $pass = Str::random(10);
            $phone = $data['mobile_no'];
            $data = array('name' => $to_name, 'body' => $pass, 'id' => $id);

            Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email){
                $message->to($to_email, $to_name)->subject('TARC Caring Management Account Password');
                $message->from('shintaro990809@gmail.com', 'TARC Caring');
            });

            User::create([
                'user_id' => $id,
                'name' => $to_name,
                'email' => $to_email,
                'mobile_no' => $phone,
                'password' => Hash::make($pass),
                'role_id' => 5,
            ]);

            return view('admin.register_management', ['msg' => 'Management account successfully created.']);
        } else{
            return view('admin.register_management', ['err' => 'Failed to create a management account.']);
        }
    }
}
