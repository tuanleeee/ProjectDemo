<?php
namespace App\Modules\AuthModule\Services;

use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Modules\AuthModule\Repository\SysUserRepository;
use App\Modules\AuthModule\Exceptions\FailLoginException;

use Cache;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Modules\AuthModule\Model\SysUser;

class UserServices{
    private $userRepository; 
    
    public function  __construct(SysUserRepository $userRepository){
        $this->userRepository = $userRepository;
    }


    public function create_user(array $data,$img_path){
        $user = new SysUser();
        $this->userRepository->save($data,$user);
    }


    private function setOnline(){
    
        $expireAt = Carbon::now()->addMinutes(1);
        Cache::put('user-is-online-' . Auth::user()->id,true,$expireAt);
    
    }


    public function login($request) : Collection{
    
        $credentials = request(['username', 'password']);
        if(!Auth::attempt($credentials))
            throw new FailLoginException();
        $user = $request->user();

        $tokenResult = $user->createToken(config('AuthModule_config.token.key'));
        $token = $tokenResult->token;
        $this->setOnline();
        $token->save();
        
        return collect([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    
    }

    public function logout($request){
    
        $request->user()->token()->revoke();
        Cache::pull('user-is-online-' . Auth::user()->id);
    
    }

    
    public function getUser(Int $id): Collection{
    
        $user = $this->userRepository->getUser($id);
        return collect($user);
    
    }

    
    public function changeUserInfo($data){
        
        $data['user_role'] = null;
        $data['username'] = null;
        $id =  auth('api')->user()->id;
        $user = $this->userRepository->getUser($id);
        
        $this->userRepository->save($data,$user);
    
    }

    
    public function getSupporterList(string $path) : LengthAwarePaginator{

        $userList = $this->userRepository->getSupporterList();
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = config('AuthModule_config.pagination.items_per_page');
        $currentPageItems = $userList->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($userList), $perPage);
        $paginatedItems->setPath($path);
        return $paginatedItems;
    }

    public function delete($id){

        $user = $this->userRepository->getUser($id);

        $this->userRepository->delete($user);
    }
}
