<?php

class SomethingDigital_ApplyCoupon_Model_Observer {
	/* Apply coupon code which is stored in cookie called 'coupon_code' */
	public function applyCoupon($observer)
	{
		$cookie_name = 'coupon_code';

		if(isset($_COOKIE[$cookie_name])) {
			$coupon_code = $_COOKIE[$cookie_name];
		}

		if(isset($coupon_code)) {
			$existing_coupon = Mage::getSingleton('checkout/session')->getQuote()->getCouponCode();
			$success_message = Mage::getStoreConfig('somethingdigital_applycoupon/settings/success_message');
			if($existing_coupon && $existing_coupon != $coupon_code){	
				Mage::getSingleton('checkout/cart')->getQuote()->setCouponCode($coupon_code)->save();
				Mage::getSingleton('checkout/session')->addSuccess($success_message);
				Mage::getSingleton('checkout/session')->addSuccess(Mage::helper('applycoupon')->__('The previous coupon code "%s" has been removed', $existing_coupon));
			} else {
				Mage::getSingleton('checkout/cart')->getQuote()->setCouponCode($coupon_code)->save();
				Mage::getSingleton('checkout/session')->addSuccess($success_message);
			}
			/* Delete cookie once it's used */
			setcookie($cookie_name, '', time() - 3600, '/');
		}
	}
}
