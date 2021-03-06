<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Coupon;
use App\Services\OrderServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Kjmtrue\VietnamZone\Models\District;
use Kjmtrue\VietnamZone\Models\Province;

class CheckoutController extends Controller
{
    protected $orderService;

    public function __construct(OrderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
    }

    public function create()
    {
        $categories = Category::with('subCategories')->get();

        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->first();
            if ($cart) {
                $products = DB::table('product_cart')
                ->join('products', 'product_cart.product_id', 'products.id')
                ->join('sizes', 'product_cart.size_id', 'sizes.id')
                ->select('products.id', 'products.name', 'products.image', 'product_cart.amount',
                    'product_cart.price', 'product_cart.size_id', 'sizes.name as size_name')
                ->where('cart_id', $cart->id)
                ->get();

                return view('web.checkout.checkout_view', compact('categories', 'products'));
            } else {
                return redirect()->route('cart.view');
            }
        } else {
            $notification = [
                'message' => 'Bạn cần phải đăng nhập',
                'alert-type' => 'error'
            ];

            return redirect()->route('user.login')->with($notification);
        }
    }

    public function storeOrder(OrderRequest $request)
    {        
        $this->orderService->storeOrder($request->all());

        $notification = [
            'message' => 'Đặt hàng thành công',
            'alert-type' => 'success'
        ];

        return redirect()->route('index')->with($notification);
    }

    public function applyCoupon(Request $request)
    {
        $coupon = Coupon::where('coupon_name', $request->coupon_name)->where('status', 1)->first();
        $cart = Cart::where('user_id', Auth::id())->first();
        $products = DB::table('product_cart')
            ->join('products', 'product_cart.product_id', 'products.id')
            ->select('product_cart.product_id', DB::raw('SUM(product_cart.amount * product_cart.price) as totalPrice'))
            ->where('cart_id', $cart->id)
            ->groupBy('product_cart.product_id')
            ->get();

        if ($coupon) {
            return response()->json([
                'status' => true,
                'coupon_discount' => $coupon->coupon_discount,
                'total_price' => $products->sum('totalPrice')
            ]);
        }

        return response()->json([
            'status' => false
        ]);
    }

    public function removeCoupon()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        $products = DB::table('product_cart')
            ->join('products', 'product_cart.product_id', 'products.id')
            ->select('product_cart.product_id', DB::raw('SUM(product_cart.amount * product_cart.price) as totalPrice'))
            ->where('cart_id', $cart->id)
            ->groupBy('product_cart.product_id')
            ->get();

        return response()->json([
            'status' => true,
            'total_price' => $products->sum('totalPrice')
        ]);
    }
}
