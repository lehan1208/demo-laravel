<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function order(Request $request)
    {
        //$request->get('username'); //Chính là username/phone bên USERS. Nếu khách đặt mua mà chưa Login => Không có giá trị
        
        //Kiểm tra người đặt hàng đã đăng nhập hay chưa.
        //Nếu chưa đăng nhập => Đơn hàng không cần lưu username
        $user = Auth::user();
        $username = null;
        if ($user) {
            $username = $user->username;
        }

        $shippingFee = 0; // Freeship
        $order = Order::create([
            //'' => $request->get('username'),: Xử lý sau.
            'username' => $username,
            'name' => $request->get('name'),
            'phone' => $request->get('phone'),
            'address' => $request->get('address'),
            'shipping_fee' => $shippingFee, //Free ship, sau muốn thu phí thì setting admin.
            'sub_total'=> 0,
            'total'=> 0,
            'status' => 'WAITING', // Chờ duyệt đơn.
            'method_payment' => $request->get('method_payment')
        ]);

        $subTotal = 0;
        foreach ($request->get('orders') as $item) {
            $product = Product::find($item['product_id']);
            OrderItem::create([
                'order_id' => $order->id,
                'PRO_ID' => $product->PRO_ID,
                'name' => $product->Name,
                'price' => $product->Price,
                'amount' => $item['amount']
            ]);
            $subTotal = $subTotal + ($product->Price * $item['amount']);
        }

        // Cập nhật lại tổng tiền đơn hàng.
        $total = $shippingFee + $subTotal;
        Order::where('id', $order->id)->update(['sub_total' => $subTotal, 'total' => $total]);
        return response()->json([
            'status' => 'success',
            'code' => 200
        ]);
    }
}
