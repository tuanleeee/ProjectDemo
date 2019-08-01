<?php
namespace App\Modules\AuthModule\Services;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use App\Modules\AuthModule\Model\SysUser;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Modules\AuthModule\Repository\SysUserRepository;
use App\Modules\AuthModule\Exceptions\FailLoginException;

use Cache;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserServices{
    private $userRepository; 
    
    public function  __construct(SysUserRepository $userRepository){
        $this->userRepository = $userRepository;
    }

    public function create_user(array $data,$img_path){
        $this->userRepository->save($data);
    }

    /**
     * Methods use by login
     * 
     */

    private function setOnline(SysUser $user){
        $expireAt = Carbon::now()->addMinutes(1);
        Cache::put('user-is-online-' . Auth::user()->id,true,$expireAt);
    }

    public function login($request) : Collection{
        $credentials = request(['username', 'password']);
        if(!Auth::attempt($credentials))
            throw new FailLoginException();
        $user = $request->user();
        $tokenResult = $user->createToken('Secret key');
        $token = $tokenResult->token;
        
        $this->setOnline($user);

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
        $id = $data['id'];
        $user = $this->userRepository->getUser($id);
        $this->userRepository->save($user,$data);
    }

    public function getSupporterList(string $path) : LengthAwarePaginator{
        $userList = $this->userRepository->getSupporterList();

        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        $perPage = 1;

        $currentPageItems = $userList->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($userList), $perPage);

        $paginatedItems->setPath($path);
        
        return $paginatedItems;
    }
}
