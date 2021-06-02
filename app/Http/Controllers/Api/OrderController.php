<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\NewOrderRequest;
use App\Http\Resources\Order\OrderAllResource;
use Illuminate\Http\Request;
use App\Helpers\Response;
use App\Http\Requests\Order\MarkOrderRequest;
use App\Http\Resources\Order\OrderListResource;
use App\Http\Resources\Order\OrderResource;
use App\Models\User;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Repository\OrderRepository;
use App\Services\OrderService;
use CoinPhon\Bitcoin\Wallet\WalletClient;

class OrderController extends Controller
{

    private $types = [
        'legacy' => WalletClient::LEGACY,
        'p2sh-segwit' => WalletClient::P2SH,
        'bech32' => WalletClient::BECH32,
    ];

    public $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        return OrderListResource::collection($this->orderRepository->allByAuthUser()->paginate(5));
    }

    public function show(Order $order){
        return new OrderResource($order);
    }

    public function newOrder(NewOrderRequest $request, Wallet $wallet)
    {
        $type = WalletClient::LEGACY;

        if($request->filled('type')){
            $type = $this->types[$request->type];
        }

        $address = $wallet->getWallet()->newAddress($type);

        $order = Order::create([
            'wallet_id' => $wallet->id,
            'amount' => '0.00281823',
            'amount_fiat' => '130.45',
            'address' => $address,
            'status' => 0,
        ]);

        $transaction = new Transaction([
            'txid' => '469b59b9e98a22f10b3f67138856c6d0032f5bc57a7a8e623a2cc6fabbdc52c5',
            'received' => '0.00281823',
            'received_fiat' => '130.45',
            'confirmations' => 0,
            'from_address' => '1FdHZcXXLEJv7ThNvvdDCYjBEzZcRYLpL9',
            'order_id' => $order->id,
        ]);

        $order->transaction()->save($transaction);

        return Response::successMessage('Order created');
    }

    public function mark(MarkOrderRequest $request, Order $order){

        $order->status = 1;
        $order->save();

        return Response::successMessage('Order updated');
    }
}
