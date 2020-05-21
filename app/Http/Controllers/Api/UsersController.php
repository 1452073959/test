<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Http\Resources\Json\Resource;
use Response;
use Validator;
use App\Http\Requests\Api\UserRequest;
class UsersController extends Controller
{
    protected $guard = 'api';
    //
    public function store(UserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'password' => bcrypt($request->password),
        ]);

    }

    public function test()
    {
//        return $this->response->noContent();
//        return User::all()->setStatusCode(234);;
            $user=User::all();
        return $this->success($user);
        return Response::json(array('key' => 'value'));
    }
    public function login()
    {
        $credentials = request(['email', 'password']);
     $boolean = auth('api')->validate($credentials);
        if($boolean){
//            echo 12111;
//            $user = auth('api')->setToken('eyJhb...')->user();
        }else{
            echo 456;
        }
//        print_r($credentials);
        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => '错误'], 401);
        }

        return $this->respondWithToken($token);
    }

    //
    public function me()
    {
        return response()->json(auth('api')->user());
    }

    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
    /**
     * Refresh a token.
     * 刷新token，如果开启黑名单，以前的token便会失效。
     * 值得注意的是用上面的getToken再获取一次Token并不算做刷新，两次获得的Token是并行的，即两个都可用。
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    public function register(Request $request)
    {

        $payload = $request->only('name', 'email', 'password');

        // 创建用户
        $result = User::create([
            'name' => $payload['name'],
            'email' => $payload['email'],
            'password' => bcrypt($payload['password']),
        ]);
        if ($result) {
            return $this->success($result);
        } else {
            return $this->error(300);
        }
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    public function update(User $user,Request $request)
    {
        $user = auth('api')->user();

        $attributes = $request->only(['name', 'email']);
        $user->name=$attributes['name'];
        $user->email=$attributes['email'];
        $result=  $user->save();
//        $result=$user->update($attributes);

        return $this->respondWithToken($result);
    }

    public static function success($data)
    {
        return [
            'status_code' => 200,
            'data'        => $data,
        ];
    }

    public static function error($message = '')
    {
        return [
            'status_code' => 0,
            'message'     => $message,
        ];
    }

    public static function return($statusCode, $message, $data = [])
    {
        return [
            'status_code' => $statusCode,
            'message'     => $message,
            'data'        => $data,
        ];
    }

}
