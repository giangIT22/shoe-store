<?php

namespace App\Services;

use App\Models\Coupon;

class CouponService implements CouponServiceInterface
{
    public function getListCoupon()
    {
        $data = Coupon::orderBy('created_at', 'desc')->paginate(Coupon::PER_PAGE);

        return [
            'listCoupons' =>  $data->items(),
            'total' => $data->total(),
            'lastPage' => $data->lastPage(),
        ];
    }

    public function createCoupon($params)
    {
        Coupon::create($params);
    }

    public function getInfoCoupon($couponId)
    {
        $coupon = Coupon::findOrFail($couponId);

        return $coupon;
    }

    public function updateCoupon($couponId, $params)
    {
        $coupon = Coupon::findOrFail($couponId);

        $coupon->update($params);
    }
}
