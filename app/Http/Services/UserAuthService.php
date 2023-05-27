<?php
namespace App\Http\Services;
use App\Models\User;
use App\Http\Services\TwilloService;

class UserAuthService {

    protected $twilloService;

    public function __construct(TwilloService $twilloService)
    {
        $this->twilloService = $twilloService;
    }

    public function register($data){
        $user = User::create([
            'username' => $data['username'],
            'mobile_number' => $data['mobile_number'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
        $this->twilloService->otp($user);
        $access_token = $user->createToken('User access token')->accessToken;
        return response([
            'success' => true,
            'data' => [
                'user'=>$user ,
                'access_token' => $access_token
            ],
            'message' => 'registered in successfully',
        ]);
    }
    
    public function login($data){
        // dd($data,\App\Models\User::where('mobile_number',$data['mobile_number'])->first());
        if(auth()->attempt(['mobile_number'=>$data['mobile_number'],'password' => $data['password']])){
            $user = auth()->user();
            $access_token = $user->createToken('User access token')->accessToken;
            return response([
                'success' => true,
                'data' => [
                    'user'=>$user ,
                    'access_token' => $access_token
                ],
                'message' => 'sing in successfully',
            ]);
        }else{
            return response(['success' => false,'message' => 'Invalid Credentials.'],401);
        }
    }

}