<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Order\OrderAllResource;
use Illuminate\Http\Request;
use App\Models\User;
use App\Repository\OrderRepository;
use App\Services\OrderService;

class OrderController extends Controller
{    

    public $orderRepository;

    public function __construct(OrderRepository $orderRepository){
        $this->orderRepository = $orderRepository;
    }

    /**
     * index
     *
     * @return void
     */
    public function index(){
        //return $this->orderRepository->allByAuthUser(true);
        return OrderAllResource::collection($this->orderRepository->allByAuthUser(true));
    }
}
