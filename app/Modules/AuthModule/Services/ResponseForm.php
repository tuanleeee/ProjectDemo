<?php   
namespace App\Modules\AuthModule\Services;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class ResponseForm{
    private $data;
    private $status;
    private $message;

    public function __construct(){
        $this->data = new Collection;
        $this->status = "200";
        $this->message = "Successful";
    }

    public function addData(Collection $data){
        $this->data = $this->data->merge($data);
    }

    public function setMessage(string $status,string $message){
        $this->status = $status;
        $this->message = $message; 
    }

    public function getResponse() : JsonResponse{
        return response()->json([
            'data' => $this->data,
            'status' => $this->status,
            'message' => $this->message
        ]);
    }
}