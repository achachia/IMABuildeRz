<?php

/**
 * @author Ihsana Team <imabuilder@ihsana.com>
 * @copyright Ihsana IT Solution 2020
 * @license Commercial License
 * 
 * @package `woocommerce`
 */
 
defined('JSM_EXEC') or die('Silence is golden');
$is_debug = true;
// init class
$db = new jsmDatabase();
$current_app = $db->current();
$static_pages = $db->getStaticPages();
$addons_settings = $db->getAddonsUsed("woocommerce");
$string = new jsmString();
// TODO: CODE BADGE
function createBadge($page = "home", $remove = false)
{
    global $string;
    $pageClass = $string->toClassName($page) . 'Page';
    $code = null;
    $code .= '';
    $code .= "\t" . '// -------------------------------------------------------------------' . "\r\n";
    $code .= "\t" . '// Badge' . "\r\n";
    $code .= '';
    $code .= "\t" . 'count_wishlist:number = 0;' . "\r\n";
    $code .= "\t" . 'temp_count_whishlist:number = 0 ;' . "\r\n";
    $code .= "\t" . 'item_wishlist : any = [];' . "\r\n";
    $code .= "\t" . '' . "\r\n";
    $code .= "\t" . 'count_cart:number = 0;' . "\r\n";
    $code .= "\t" . 'temp_count_cart:number = 0;' . "\r\n";
    $code .= "\t" . 'item_cart : any = [];' . "\r\n";
    $code .= "\t" . '' . "\r\n";
    $code .= "\t" . 'runBadge: any;' . "\r\n";
    $code .= "\t" . '' . "\r\n";
    $code .= "\t" . '' . "\r\n";
    $code .= "\t" . '/**' . "\r\n";
    $code .= "\t" . '* ' . $pageClass . ':createBadge()' . "\r\n";
    $code .= "\t" . '**/' . "\r\n";
    $code .= "\t" . 'createBadge(){' . "\r\n";
    $code .= "\t\t" . 'this.runBadge = setInterval(()=>{' . "\r\n";
    $code .= "\t\t\t" . 'this.getBadges();' . "\r\n";
    $code .= "\t\t" . '},1000)' . "\r\n";
    $code .= "\t" . '}' . "\r\n";
    $code .= "\t" . '' . "\r\n";
    $code .= "\t" . '' . "\r\n";
    if ($remove == false)
    {
        $code .= "\t" . '/**' . "\r\n";
        $code .= "\t" . '* ' . $pageClass . ':ionViewDidLeave()' . "\r\n";
        $code .= "\t" . '**/' . "\r\n";
        $code .= "\t" . 'ionViewDidLeave(){' . "\r\n";
        $code .= "\t\t" . 'clearInterval(this.runBadge);' . "\r\n";
        $code .= "\t" . '}' . "\r\n";
        $code .= "\t" . '' . "\r\n";
        $code .= "\t" . '' . "\r\n";
    }
    $code .= "\t" . '/**' . "\r\n";
    $code .= "\t" . '*  ' . $pageClass . '.getWishlist()' . "\r\n";
    $code .= "\t" . '**/' . "\r\n";
    $code .= "\t" . 'public async getWishlist(){' . "\r\n";
    $code .= "\t\t" . 'this.count_wishlist = this.temp_count_whishlist;' . "\r\n";
    $code .= "\t\t" . 'this.temp_count_whishlist = 0;' . "\r\n";
    $code .= "\t\t" . 'this.item_wishlist = []; ' . "\r\n";
    $code .= "\t\t" . 'this.storage.forEach((iValue, iKey, iIndex) => {' . "\r\n";
    $code .= "\t\t\t" . 'if(iKey.substring(0,9) ==  `wishlist:`){' . "\r\n";
    $code .= "\t\t\t\t" . 'this.pushWishlist(iValue);' . "\r\n";
    $code .= "\t\t\t" . '}' . "\r\n";
    $code .= "\t\t" . '});' . "\r\n";
    $code .= "\t" . '}' . "\r\n";
    $code .= "\t" . '' . "\r\n";
    $code .= "\t" . '' . "\r\n";
    $code .= "\t" . '/**' . "\r\n";
    $code .= "\t" . '*  ' . $pageClass . '.getCart()' . "\r\n";
    $code .= "\t" . '**/' . "\r\n";
    $code .= "\t" . 'public async getCart(){' . "\r\n";
    $code .= "\t\t" . 'this.count_cart = this.temp_count_cart;' . "\r\n";
    $code .= "\t\t" . 'this.temp_count_cart = 0;' . "\r\n";
    $code .= "\t\t" . 'this.item_cart = []; ' . "\r\n";
    $code .= "\t\t" . 'this.storage.forEach((iValue, iKey, iIndex) => {' . "\r\n";
    $code .= "\t\t\t" . 'if(iKey.substring(0,5) ==  `cart:`){' . "\r\n";
    $code .= "\t\t\t\t" . 'this.pushCart(iValue);' . "\r\n";
    $code .= "\t\t\t" . '}' . "\r\n";
    $code .= "\t\t" . '});' . "\r\n";
    $code .= "\t" . '}' . "\r\n";
    $code .= "\t" . '' . "\r\n";
    $code .= "\t" . '' . "\r\n";
    $code .= "\t" . '/**' . "\r\n";
    $code .= "\t" . '* ' . $pageClass . '.pushWishlist(item)' . "\r\n";
    $code .= "\t" . '**/' . "\r\n";
    $code .= "\t" . 'private pushWishlist(item){' . "\r\n";
    $code .= "\t\t" . 'this.temp_count_whishlist++;' . "\r\n";
    $code .= "\t\t" . 'this.item_wishlist.push(item);' . "\r\n";
    $code .= "\t" . '}' . "\r\n";
    $code .= "\t" . '' . "\r\n";
    $code .= "\t" . '' . "\r\n";
    $code .= "\t" . '/**' . "\r\n";
    $code .= "\t" . '* ' . $pageClass . '.pushCart(item)' . "\r\n";
    $code .= "\t" . '**/' . "\r\n";
    $code .= "\t" . 'private pushCart(item){' . "\r\n";
    $code .= "\t\t" . 'this.temp_count_cart = this.temp_count_cart + parseInt(item.qty);' . "\r\n";
    $code .= "\t\t" . 'this.item_cart.push(item);' . "\r\n";
    $code .= "\t" . '}' . "\r\n";
    $code .= "\t" . '' . "\r\n";
    $code .= "\t" . '' . "\r\n";
    $code .= "\t" . '/**' . "\r\n";
    $code .= "\t" . '* ' . $pageClass . ':getBadges()' . "\r\n";
    $code .= "\t" . '**/' . "\r\n";
    $code .= "\t" . 'getBadges(){' . "\r\n";
    $code .= "\t\t" . 'this.getWishlist();' . "\r\n";
    $code .= "\t\t" . 'this.getCart();' . "\r\n";
    $code .= "\t" . '}' . "\r\n";
    $code .= "\t" . '' . "\r\n";
    $code .= "\t" . '' . "\r\n";
    $code .= "\t" . '// -------------------------------------------------------------------' . "\r\n";
    return $code;
}
if ($_GET['a'] === 'delete')
{
    $db->deleteAddOns('woocommerce', 'core');
    header('Location: ./?p=addons&addons=woocommerce&' . time());
}


// TODO: POST --|--
if (isset($_POST['save-woocommerce']))
{
    // TODO: POST --|-- RESPONSE --|--
    $addons = array();
    $addons['page-target'] = 'core';
    $addons['page-title'] = 'core';
    $addons['page-header-color'] = trim($_POST['woocommerce']['page-header-color']);
    $addons['page-content-background'] = trim($_POST['woocommerce']['page-content-background']);
    $addons['wordpress-url'] = str_replace("http://", "https://", trim($_POST['woocommerce']['wordpress-url'])); //url
    $addons['consumer-key'] = trim($_POST['woocommerce']['consumer-key']); //text
    $addons['consumer-secret'] = trim($_POST['woocommerce']['consumer-secret']); //text
    $addons['per-page'] = (int)($_POST['woocommerce']['per-page']); //text
    $addons['contact-call'] = trim($_POST['woocommerce']['contact-call']); //text
    $addons['contact-sms'] = trim($_POST['woocommerce']['contact-sms']); //text
    $addons['contact-whatsapp'] = trim($_POST['woocommerce']['contact-whatsapp']); //text
    $addons['contact-email'] = trim($_POST['woocommerce']['contact-email']); //text
    $addons['label-for-home'] = trim($_POST['woocommerce']['label-for-home']); //text
    $addons['label-for-products'] = trim($_POST['woocommerce']['label-for-products']); //text
    $addons['label-for-product'] = trim($_POST['woocommerce']['label-for-product']); //text
    $addons['label-for-wishlist'] = trim($_POST['woocommerce']['label-for-wishlist']); //text
    $addons['label-for-cart'] = trim($_POST['woocommerce']['label-for-cart']); //text
    $addons['label-for-account'] = trim($_POST['woocommerce']['label-for-account']); //text
    $addons['label-for-please-wait'] = trim($_POST['woocommerce']['label-for-please-wait']); //text
    $addons['label-for-no-products-found'] = trim($_POST['woocommerce']['label-for-no-products-found']); //text
    $addons['label-for-add-to-cart'] = trim($_POST['woocommerce']['label-for-add-to-cart']); //text
    $addons['label-for-buy'] = trim($_POST['woocommerce']['label-for-buy']); //text
    $addons['label-for-contact-us'] = trim($_POST['woocommerce']['label-for-contact-us']); //text
    $addons['label-for-ordering-information'] = trim($_POST['woocommerce']['label-for-ordering-information']); //text
    $addons['label-for-dimensions'] = trim($_POST['woocommerce']['label-for-dimensions']); //text
    $addons['label-for-weight'] = trim($_POST['woocommerce']['label-for-weight']); //text
    $addons['label-for-additional-information'] = trim($_POST['woocommerce']['label-for-additional-information']); //text
    $addons['label-for-clean-up'] = trim($_POST['woocommerce']['label-for-clean-up']); //text
    $addons['label-for-delete'] = trim($_POST['woocommerce']['label-for-delete']); //text
    $addons['label-for-edit'] = trim($_POST['woocommerce']['label-for-edit']); //text
    $addons['label-for-added-to-your-cart'] = trim($_POST['woocommerce']['label-for-added-to-your-cart']); //text
    $addons['label-for-featured-products'] = trim($_POST['woocommerce']['label-for-featured-products']); //text
    $addons['label-for-latest-products'] = trim($_POST['woocommerce']['label-for-latest-products']); //text
    $addons['label-for-tags'] = trim($_POST['woocommerce']['label-for-tags']); //text
    $addons['label-for-categories'] = trim($_POST['woocommerce']['label-for-categories']); //text
    $addons['label-for-privacy-policy'] = trim($_POST['woocommerce']['label-for-privacy-policy']); //text
    $addons['label-for-about-us'] = trim($_POST['woocommerce']['label-for-about-us']); //text
    $addons['label-for-administrator'] = trim($_POST['woocommerce']['label-for-administrator']); //text
    $addons['label-for-dashboard'] = trim($_POST['woocommerce']['label-for-dashboard']); //text
    $addons['label-for-help'] = trim($_POST['woocommerce']['label-for-help']); //text
    $addons['label-for-rate-this-app'] = trim($_POST['woocommerce']['label-for-rate-this-app']); //text
    $addons['label-for-all'] = trim($_POST['woocommerce']['label-for-all']); //text
    $addons['label-for-continue-shopping'] = trim($_POST['woocommerce']['label-for-continue-shopping']); //text
    $addons['label-for-products-in-your-wishlist'] = trim($_POST['woocommerce']['label-for-products-in-your-wishlist']); //text
    $addons['label-for-products-in-your-cart'] = trim($_POST['woocommerce']['label-for-products-in-your-cart']); //text
    $addons['label-for-status'] = trim($_POST['woocommerce']['label-for-status']); //text
    $addons['label-for-quantity'] = trim($_POST['woocommerce']['label-for-quantity']); //text
    $addons['label-for-subtotal'] = trim($_POST['woocommerce']['label-for-subtotal']); //text
    $addons['label-for-shipping'] = trim($_POST['woocommerce']['label-for-shipping']); //text
    $addons['label-for-total'] = trim($_POST['woocommerce']['label-for-total']); //text
    $addons['label-for-checkout'] = trim($_POST['woocommerce']['label-for-checkout']); //text
    $addons['label-for-apply'] = trim($_POST['woocommerce']['label-for-apply']); //text
    $addons['label-for-coupon-code'] = trim($_POST['woocommerce']['label-for-coupon-code']); //text
    $addons['label-for-ok'] = trim($_POST['woocommerce']['label-for-ok']); //text
    $addons['label-for-cancel'] = trim($_POST['woocommerce']['label-for-cancel']); //text
    $addons['label-for-discount'] = trim($_POST['woocommerce']['label-for-discount']); //text
    $addons['label-for-shipping-total'] = trim($_POST['woocommerce']['label-for-shipping-total']); //text
    $addons['label-for-discount-total'] = trim($_POST['woocommerce']['label-for-discount-total']); //text
    $addons['label-for-billing-address'] = trim($_POST['woocommerce']['label-for-billing-address']); //text
    $addons['label-for-shipping-address'] = trim($_POST['woocommerce']['label-for-shipping-address']); //text
    $addons['label-for-state'] = trim($_POST['woocommerce']['label-for-state']); //text
    $addons['label-for-postcode'] = trim($_POST['woocommerce']['label-for-postcode']); //text
    $addons['label-for-city'] = trim($_POST['woocommerce']['label-for-city']); //text
    $addons['label-for-address_1'] = trim($_POST['woocommerce']['label-for-address_1']); //text
    $addons['label-for-address_2'] = trim($_POST['woocommerce']['label-for-address_2']); //text
    $addons['label-for-email'] = trim($_POST['woocommerce']['label-for-email']); //text
    $addons['label-for-phone'] = trim($_POST['woocommerce']['label-for-phone']); //text
    $addons['label-for-first-name'] = trim($_POST['woocommerce']['label-for-first-name']); //text
    $addons['label-for-last-name'] = trim($_POST['woocommerce']['label-for-last-name']); //text
    $addons['label-for-country'] = trim($_POST['woocommerce']['label-for-country']); //text
    $addons['label-for-address'] = trim($_POST['woocommerce']['label-for-address']); //text
    $addons['label-for-choose-your-country'] = trim($_POST['woocommerce']['label-for-choose-your-country']); //text
    $addons['label-for-choose-your-state'] = trim($_POST['woocommerce']['label-for-choose-your-state']); //text
    $addons['label-for-same-as-the-billing-address'] = trim($_POST['woocommerce']['label-for-same-as-the-billing-address']); //text
    $addons['label-for-connection-lost'] = trim($_POST['woocommerce']['label-for-connection-lost']); //text
    
    //auth-type
    $addons['auth-type'] = trim($_POST['woocommerce']['auth-type']); //select

    if (!isset($_POST['woocommerce']['label-for-save']))
    {
        $_POST['woocommerce']['label-for-save'] = 'Save';
    }
    $addons['label-for-save'] = trim($_POST['woocommerce']['label-for-save']); //text
    if (!isset($_POST['woocommerce']['label-for-review']))
    {
        $_POST['woocommerce']['label-for-review'] = 'Review';
    }
    $addons['label-for-review'] = trim($_POST['woocommerce']['label-for-review']); //text
    if (!isset($_POST['woocommerce']['label-for-payment']))
    {
        $_POST['woocommerce']['label-for-payment'] = 'Payment';
    }
    $addons['label-for-payment'] = trim($_POST['woocommerce']['label-for-payment']); //text
    if (!isset($_POST['woocommerce']['label-for-continue-to-shipping']))
    {
        $_POST['woocommerce']['label-for-continue-to-shipping'] = 'Continue To Shipping';
    }
    $addons['label-for-continue-to-shipping'] = trim($_POST['woocommerce']['label-for-continue-to-shipping']); //text
    //label-for-successfully-saved
    if (!isset($_POST['woocommerce']['label-for-successfully-saved']))
    {
        $_POST['woocommerce']['label-for-successfully-saved'] = 'The data has been successfully saved!';
    }
    $addons['label-for-successfully-saved'] = trim($_POST['woocommerce']['label-for-successfully-saved']); //text
    //label-for-continue-to-review
    if (!isset($_POST['woocommerce']['label-for-continue-to-review']))
    {
        $_POST['woocommerce']['label-for-continue-to-review'] = 'Continue To Review';
    }
    $addons['label-for-continue-to-review'] = trim($_POST['woocommerce']['label-for-continue-to-review']); //text
    //label-for-continue-to-payment
    if (!isset($_POST['woocommerce']['label-for-continue-to-payment']))
    {
        $_POST['woocommerce']['label-for-continue-to-payment'] = 'Continue To Payment';
    }
    $addons['label-for-continue-to-payment'] = trim($_POST['woocommerce']['label-for-continue-to-payment']); //text
    //label-for-data-is-incomplete
    if (!isset($_POST['woocommerce']['label-for-data-is-incomplete']))
    {
        $_POST['woocommerce']['label-for-data-is-incomplete'] = 'The requested data is incomplete!';
    }
    $addons['label-for-data-is-incomplete'] = trim($_POST['woocommerce']['label-for-data-is-incomplete']); //text
    //label-for-coupon-saved
    if (!isset($_POST['woocommerce']['label-for-coupon-saved']))
    {
        $_POST['woocommerce']['label-for-coupon-saved'] = 'Coupon code saved successfully!';
    }
    $addons['label-for-coupon-saved'] = trim($_POST['woocommerce']['label-for-coupon-saved']); //text
    //label-for-payment-method
    if (!isset($_POST['woocommerce']['label-for-payment-method']))
    {
        $_POST['woocommerce']['label-for-payment-method'] = 'Payment Method';
    }
    $addons['label-for-payment-method'] = trim($_POST['woocommerce']['label-for-payment-method']); //text
    //label-for-order-details
    if (!isset($_POST['woocommerce']['label-for-order-details']))
    {
        $_POST['woocommerce']['label-for-order-details'] = 'Order details';
    }
    $addons['label-for-order-details'] = trim($_POST['woocommerce']['label-for-order-details']); //text
    //label-for-place-order
    if (!isset($_POST['woocommerce']['label-for-place-order']))
    {
        $_POST['woocommerce']['label-for-place-order'] = 'Place Order';
    }
    $addons['label-for-place-order'] = trim($_POST['woocommerce']['label-for-place-order']); //text
    //label-for-order-received
    if (!isset($_POST['woocommerce']['label-for-order-received']))
    {
        $_POST['woocommerce']['label-for-order-received'] = 'Your order has been received';
    }
    $addons['label-for-order-received'] = trim($_POST['woocommerce']['label-for-order-received']); //text
    //label-for-order-number
    if (!isset($_POST['woocommerce']['label-for-order-number']))
    {
        $_POST['woocommerce']['label-for-order-number'] = 'Order Number';
    }
    $addons['label-for-order-number'] = trim($_POST['woocommerce']['label-for-order-number']); //text
    //label-for-detail
    if (!isset($_POST['woocommerce']['label-for-detail']))
    {
        $_POST['woocommerce']['label-for-detail'] = 'Detail';
    }
    $addons['label-for-detail'] = trim($_POST['woocommerce']['label-for-detail']); //text
    //label-for-ordered-products
    if (!isset($_POST['woocommerce']['label-for-ordered-products']))
    {
        $_POST['woocommerce']['label-for-ordered-products'] = 'Ordered Products';
    }
    $addons['label-for-ordered-products'] = trim($_POST['woocommerce']['label-for-ordered-products']); //text
    //label-for-item
    if (!isset($_POST['woocommerce']['label-for-item']))
    {
        $_POST['woocommerce']['label-for-item'] = 'Item';
    }
    $addons['label-for-item'] = trim($_POST['woocommerce']['label-for-item']); //text
    //label-for-order-history
    if (!isset($_POST['woocommerce']['label-for-order-history']))
    {
        $_POST['woocommerce']['label-for-order-history'] = 'Order History';
    }
    $addons['label-for-order-history'] = trim($_POST['woocommerce']['label-for-order-history']); //text
    //label-for-subtotal-tax
    if (!isset($_POST['woocommerce']['label-for-subtotal-tax']))
    {
        $_POST['woocommerce']['label-for-subtotal-tax'] = 'Subtotal Tax';
    }
    $addons['label-for-subtotal-tax'] = trim($_POST['woocommerce']['label-for-subtotal-tax']); //text
    //label-for-total-tax
    if (!isset($_POST['woocommerce']['label-for-total-tax']))
    {
        $_POST['woocommerce']['label-for-total-tax'] = 'Total Tax';
    }
    $addons['label-for-total-tax'] = trim($_POST['woocommerce']['label-for-total-tax']); //text
    //label-for-price
    if (!isset($_POST['woocommerce']['label-for-price']))
    {
        $_POST['woocommerce']['label-for-price'] = 'Price';
    }
    $addons['label-for-price'] = trim($_POST['woocommerce']['label-for-price']); //text
    //label-for-note
    if (!isset($_POST['woocommerce']['label-for-note']))
    {
        $_POST['woocommerce']['label-for-note'] = 'Note';
    }
    $addons['label-for-note'] = trim($_POST['woocommerce']['label-for-note']); //text
    //label-for-no-order-history
    if (!isset($_POST['woocommerce']['label-for-no-order-history']))
    {
        $_POST['woocommerce']['label-for-no-order-history'] = 'No order history';
    }
    $addons['label-for-no-order-history'] = trim($_POST['woocommerce']['label-for-no-order-history']); //text
    //label-for-coupon-is-invalid
    if (!isset($_POST['woocommerce']['label-for-coupon-is-invalid']))
    {
        $_POST['woocommerce']['label-for-coupon-is-invalid'] = 'The coupon is invalid!';
    }
    $addons['label-for-coupon-is-invalid'] = trim($_POST['woocommerce']['label-for-coupon-is-invalid']); //text


    //label-for-currency
    if (!isset($_POST['woocommerce']['label-for-currency']))
    {
        $_POST['woocommerce']['label-for-currency'] = 'Currency';
    }
    $addons['label-for-currency'] = trim($_POST['woocommerce']['label-for-currency']); //text

    //label-for-date-created
    if (!isset($_POST['woocommerce']['label-for-date-created']))
    {
        $_POST['woocommerce']['label-for-date-created'] = 'Date Created';
    }
    $addons['label-for-date-created'] = trim($_POST['woocommerce']['label-for-date-created']); //text

    //label-for-discount-tax
    if (!isset($_POST['woocommerce']['label-for-discount-tax']))
    {
        $_POST['woocommerce']['label-for-discount-tax'] = 'Discount Tax';
    }
    $addons['label-for-discount-tax'] = trim($_POST['woocommerce']['label-for-discount-tax']); //text

    //label-for-shipping-tax
    if (!isset($_POST['woocommerce']['label-for-shipping-tax']))
    {
        $_POST['woocommerce']['label-for-shipping-tax'] = 'Shipping Tax';
    }
    $addons['label-for-shipping-tax'] = trim($_POST['woocommerce']['label-for-shipping-tax']); //text
    //label-for-cart-tax
    if (!isset($_POST['woocommerce']['label-for-cart-tax']))
    {
        $_POST['woocommerce']['label-for-cart-tax'] = 'Cart Tax';
    }
    $addons['label-for-cart-tax'] = trim($_POST['woocommerce']['label-for-cart-tax']); //text


    //slides-per-view
    $addons['slides-per-view'] = (int)($_POST['woocommerce']['slides-per-view']); //select

    //auto-play
    // checkbox
    if (isset($_POST['woocommerce']['auto-play']))
    {
        $addons['auto-play'] = true;
    } else
    {
        $addons['auto-play'] = false;
    }

    //label-for-actual-prices-note
    if (!isset($_POST['woocommerce']['label-for-actual-prices-note']))
    {
        $_POST['woocommerce']['label-for-actual-prices-note'] = 'Actual prices will appear after checkout is complete';
    }
    $addons['label-for-actual-prices-note'] = trim($_POST['woocommerce']['label-for-actual-prices-note']); //text
    
    //label-for-note
    if (!isset($_POST['woocommerce']['label-for-note']))
    {
        $_POST['woocommerce']['label-for-note'] = 'Note';
    }
    $addons['label-for-note'] = trim($_POST['woocommerce']['label-for-note']); //text

    //label-for-dark-mode
    if (!isset($_POST['woocommerce']['label-for-dark-mode']))
    {
        $_POST['woocommerce']['label-for-dark-mode'] = 'Dark Mode';
    }
    $addons['label-for-dark-mode'] = trim($_POST['woocommerce']['label-for-dark-mode']); //text
    
    
    //show-featured
    // checkbox
    if (isset($_POST['woocommerce']['show-featured']))
    {
        $addons['show-featured'] = true;
    } else
    {
        $addons['show-featured'] = false;
    }

    //show-tags
    // checkbox
    if (isset($_POST['woocommerce']['show-tags']))
    {
        $addons['show-tags'] = true;
    } else
    {
        $addons['show-tags'] = false;
    }

    //show-banners
    // checkbox
    if (isset($_POST['woocommerce']['show-banners']))
    {
        $addons['show-banners'] = true;
    } else
    {
        $addons['show-banners'] = false;
    }

    //banner-helper
    $addons['banner-helper'] = trim($_POST['woocommerce']['banner-helper']); //select

    //banner-by-cat-posts
    if (!isset($_POST['woocommerce']['banner-by-cat-posts']))
    {
        $_POST['woocommerce']['banner-by-cat-posts'] = '';
    }
    $addons['banner-by-cat-posts'] = trim($_POST['woocommerce']['banner-by-cat-posts']); //text

    //banner-custom-api-url
    if (!isset($_POST['woocommerce']['banner-custom-api-url']))
    {
        $_POST['woocommerce']['banner-custom-api-url'] = '';
    }
    $addons['banner-custom-api-url'] = trim($_POST['woocommerce']['banner-custom-api-url']); //text

    //banner-custom-api-variable
    if (!isset($_POST['woocommerce']['banner-custom-api-variable']))
    {
        $_POST['woocommerce']['banner-custom-api-variable'] = '';
    }
    $addons['banner-custom-api-variable'] = trim($_POST['woocommerce']['banner-custom-api-variable']); //text


    $db->saveAddOns('woocommerce', $addons);
    // TODO: ----------------------------------------------------------------------------------------------------
    // TODO: GENERATOR --|-- PROJECT --|--
    $new_project = $current_app['apps'];
    $new_project['ionic-storage'] = true;
    $new_project['rootPage'] = 'home';
    $new_project['statusbar']['style'] = 'lightcontent';
    $new_project['statusbar']['backgroundcolor'] = $db->getRawColorLevel($addons['page-header-color']);
    $new_project['pref-orientation'] = 'portrait';
    $db->saveProject($new_project);


    // TODO: ----------------------------------------------------------------------------------------------------
    // TODO: GENERATOR --|-- POPOVERS --|--
    $popovers = null;
    $popovers['icon'] = 'ellipsis-vertical';
    $popovers['title'] = '';
    $popovers['color'] = $newMenu['color-header'];
    $popovers['background'] = 'light';
    
    // TODO: GENERATOR --|-- POPOVERS --|-- ITEMS
    $v = 0;
    $popovers['items'][$v]['type'] = 'inlink';
    $popovers['items'][$v]['label'] = $addons['label-for-privacy-policy'];
    $popovers['items'][$v]['value'] = '';
    $popovers['items'][$v]['page'] = 'privacy-policy';
    
    $v++;
    $popovers['items'][$v]['type'] = 'dark-mode';
    $popovers['items'][$v]['label'] = $addons['label-for-dark-mode'];
    $popovers['items'][$v]['value'] = '';
    $popovers['items'][$v]['page'] = '';
        
    
    $v++;
    $popovers['items'][$v]['type'] = 'inlink';
    $popovers['items'][$v]['label'] = $addons['label-for-about-us'];
    $popovers['items'][$v]['value'] = '';
    $popovers['items'][$v]['page'] = 'about-us';
    
    
    $v++;
    $popovers['items'][$v]['type'] = 'appbrowser';
    $popovers['items'][$v]['label'] = $addons['label-for-administrator'];
    $popovers['items'][$v]['value'] = $addons['wordpress-url'] . '/my-account/';
    $popovers['items'][$v]['page'] = '';
    $db->savePopover($popovers);
    // TODO: ----------------------------------------------------------------------------------------------------
    // TODO: GENERATOR --|-- MENU
    $newMenu['side'] = 'start';
    $newMenu['type'] = 'overlay';
    $newMenu['ion-header'] = 'expanded-header';
    $newMenu['color-header'] = $addons['page-header-color'];
    $newMenu['text-header'] = $current_app['apps']['app-name'];
    $newMenu['text-subheader'] = $current_app['apps']['app-description'];
    $newMenu['expanded-background'] = 'assets/images/background/expanded-menu.png';
    $color_icon_left = $addons['page-header-color'];
    $color_label = 'dark';
    // TODO: GENERATOR --|-- MENU --|-- ITEMS
    $z = 0;
    $newMenu['items'][$z]["type"] = "title";
    $newMenu['items'][$z]["label"] = $addons['label-for-dashboard'];
    $newMenu['items'][$z]["var"] = "dashboard";
    $newMenu['items'][$z]["page"] = "home";
    $newMenu['items'][$z]["value"] = "";
    $newMenu['items'][$z]["desc"] = "";
    $newMenu['items'][$z]["color-label"] = $color_label;
    $newMenu['items'][$z]["icon-left"] = "home";
    $newMenu['items'][$z]["color-icon-left"] = $color_icon_left;
    $newMenu['items'][$z]["icon-right"] = "";
    $newMenu['items'][$z]["color-icon-right"] = "default";
    $z++;
    $newMenu['items'][$z]["type"] = "inlink";
    $newMenu['items'][$z]["label"] = $addons['label-for-home'];
    $newMenu['items'][$z]["var"] = "home";
    $newMenu['items'][$z]["page"] = "home";
    $newMenu['items'][$z]["value"] = "";
    $newMenu['items'][$z]["desc"] = "";
    $newMenu['items'][$z]["color-label"] = $color_label;
    $newMenu['items'][$z]["icon-left"] = "home-outline";
    $newMenu['items'][$z]["color-icon-left"] = $color_icon_left;
    $newMenu['items'][$z]["icon-right"] = "";
    $newMenu['items'][$z]["color-icon-right"] = "default";
    $z++;
    $newMenu['items'][$z]["type"] = "inlink";
    $newMenu['items'][$z]["label"] = $addons['label-for-products'];
    $newMenu['items'][$z]["var"] = "products-by-category";
    $newMenu['items'][$z]["page"] = "products-by-category";
    $newMenu['items'][$z]["value"] = "";
    $newMenu['items'][$z]["desc"] = "";
    $newMenu['items'][$z]["color-label"] = $color_label;
    $newMenu['items'][$z]["icon-left"] = "wine-outline";
    $newMenu['items'][$z]["color-icon-left"] = $color_icon_left;
    $newMenu['items'][$z]["icon-right"] = "";
    $newMenu['items'][$z]["color-icon-right"] = "default";
    $z++;
    $newMenu['items'][$z]["type"] = "inlink";
    $newMenu['items'][$z]["label"] = $addons['label-for-wishlist'];
    $newMenu['items'][$z]["var"] = "wishlist";
    $newMenu['items'][$z]["page"] = "wishlist";
    $newMenu['items'][$z]["value"] = "";
    $newMenu['items'][$z]["desc"] = "";
    $newMenu['items'][$z]["color-label"] = $color_label;
    $newMenu['items'][$z]["icon-left"] = "heart-circle-outline";
    $newMenu['items'][$z]["color-icon-left"] = $color_icon_left;
    $newMenu['items'][$z]["icon-right"] = "";
    $newMenu['items'][$z]["color-icon-right"] = "default";
    $z++;
    $newMenu['items'][$z]["type"] = "inlink";
    $newMenu['items'][$z]["label"] = $addons['label-for-cart'];
    $newMenu['items'][$z]["var"] = "cart";
    $newMenu['items'][$z]["page"] = "cart";
    $newMenu['items'][$z]["value"] = "";
    $newMenu['items'][$z]["desc"] = "";
    $newMenu['items'][$z]["color-label"] = $color_label;
    $newMenu['items'][$z]["icon-left"] = "cart-outline";
    $newMenu['items'][$z]["color-icon-left"] = $color_icon_left;
    $newMenu['items'][$z]["icon-right"] = "";
    $newMenu['items'][$z]["color-icon-right"] = "default";
    $z++;
    $newMenu['items'][$z]["type"] = "title";
    $newMenu['items'][$z]["label"] = $addons['label-for-help'];
    $newMenu['items'][$z]["var"] = "help";
    $newMenu['items'][$z]["page"] = "";
    $newMenu['items'][$z]["value"] = "";
    $newMenu['items'][$z]["desc"] = "";
    $newMenu['items'][$z]["color-label"] = $color_label;
    $newMenu['items'][$z]["icon-left"] = "help-circle";
    $newMenu['items'][$z]["color-icon-left"] = $color_icon_left;
    $newMenu['items'][$z]["icon-right"] = "";
    $newMenu['items'][$z]["color-icon-right"] = "default";
    $z++;
    $newMenu['items'][$z]["type"] = "playstore";
    $newMenu['items'][$z]["label"] = $addons['label-for-rate-this-app'];
    $newMenu['items'][$z]["var"] = "rate_this_app";
    $newMenu['items'][$z]["page"] = "";
    $newMenu['items'][$z]["value"] = "";
    $newMenu['items'][$z]["desc"] = "";
    $newMenu['items'][$z]["color-label"] = $color_label;
    $newMenu['items'][$z]["icon-left"] = "logo-google-playstore";
    $newMenu['items'][$z]["color-icon-left"] = $color_icon_left;
    $newMenu['items'][$z]["icon-right"] = "";
    $newMenu['items'][$z]["color-icon-right"] = "default";
    $z++;
    $newMenu['items'][$z]["type"] = "inlink";
    $newMenu['items'][$z]["label"] = $addons['label-for-privacy-policy'];
    $newMenu['items'][$z]["var"] = "privacy-policy";
    $newMenu['items'][$z]["page"] = "privacy-policy";
    $newMenu['items'][$z]["value"] = "";
    $newMenu['items'][$z]["desc"] = "";
    $newMenu['items'][$z]["color-label"] = $color_label;
    $newMenu['items'][$z]["icon-left"] = "help-circle";
    $newMenu['items'][$z]["color-icon-left"] = $color_icon_left;
    $newMenu['items'][$z]["icon-right"] = "";
    $newMenu['items'][$z]["color-icon-right"] = "default";
    $z++;
    $newMenu['items'][$z]["type"] = "inlink";
    $newMenu['items'][$z]["label"] = $addons['label-for-about-us'];
    $newMenu['items'][$z]["var"] = "about-us";
    $newMenu['items'][$z]["page"] = "about-us";
    $newMenu['items'][$z]["value"] = "";
    $newMenu['items'][$z]["desc"] = "";
    $newMenu['items'][$z]["color-label"] = $color_label;
    $newMenu['items'][$z]["icon-left"] = "nuclear";
    $newMenu['items'][$z]["color-icon-left"] = $newMenu['color-header'];
    $newMenu['items'][$z]["icon-right"] = "";
    $newMenu['items'][$z]["color-icon-right"] = "default";
    $db->saveMenu($newMenu);
    // TODO: ----------------------------------------------------------------------------------------------------
    // TODO: GENERATOR --|-- SERVICES --|-- WOOCOMERCE --|--
    $varServiceName = 'WoocommerceService';
    $varUserServiceName = 'woocommerceService';
    $service = null;
    $service['name'] = 'woocommerce';
    $service['instruction'] = 'Service for WooCommerce';
    $service['desc'] = 'Service for WooCommerce';
    // TODO: GENERATOR --|-- SERVICES --|-- WOOCOMERCE --|-- MODULES
    $z = 0;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'HttpClient';
    $service['modules']['angular'][$z]['var'] = 'httpClient';
    $service['modules']['angular'][$z]['path'] = '@angular/common/http';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'HttpErrorResponse';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = '@angular/common/http';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'Observable';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = 'rxjs';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'throwError';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = 'rxjs';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'of';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = 'rxjs';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'map';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = 'rxjs/operators';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'catchError';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = 'rxjs/operators';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'retry';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = 'rxjs/operators';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'HttpHeaders';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = '@angular/common/http';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'LoadingController';
    $service['modules']['angular'][$z]['var'] = 'loadingController';
    $service['modules']['angular'][$z]['path'] = '@ionic/angular';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'ToastController';
    $service['modules']['angular'][$z]['var'] = 'toastController';
    $service['modules']['angular'][$z]['path'] = '@ionic/angular';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'AlertController';
    $service['modules']['angular'][$z]['var'] = 'alertController';
    $service['modules']['angular'][$z]['path'] = '@ionic/angular';
    // TODO: GENERATOR --|-- SERVICES --|-- WOOCOMERCE --|-- CODE --|-- OTHER --|--
    $service['code']['other'] = null;
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . 'wpUrl: string = "' . $addons['wordpress-url'] . '";' . "\r\n";
    $service['code']['other'] .= "\t" . 'consumerKey: string = "' . $addons['consumer-key'] . '";' . "\r\n";
    $service['code']['other'] .= "\t" . 'consumerSecret: string = "' . $addons['consumer-secret'] . '";' . "\r\n";
    $service['code']['other'] .= "\t" . 'connectionLost: string = `' . $addons['label-for-connection-lost'] . '`;' . "\r\n";
    $service['code']['other'] .= "\t" . 'catPosts: string = `' . $addons['banner-by-cat-posts'] . '`; //for banners' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . 'loading: any ;' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    if ($addons['auth-type'] == 'url')
    {
        $url_auth = 'consumer_key=${this.consumerKey}&consumer_secret=${this.consumerSecret}';
    } else
    {
        $url_auth = '';
    }

    // TODO: GENERATOR --|-- SERVICES --|-- WOOCOMERCE --|-- CODE --|-- OTHER --|-- getBanners()
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* ' . $varServiceName . '.getBanners()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'getBanners(): Observable<any>{' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'const httpOptions = {' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'headers: new HttpHeaders({' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '"Content-Type": "application/x-www-form-urlencoded"' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t" . '}' . "\r\n";
    if ($addons['banner-helper'] == 'custom-api')
    {
        $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(`' . $addons['banner-custom-api-url'] . '`,httpOptions)' . "\r\n";
    } else
    {
        $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(this.wpUrl + `/wp-json/wp/v2/posts/?_embed&categories=${this.catPosts}`,httpOptions)' . "\r\n";
    }

    $service['code']['other'] .= "\t\t\t" . '.pipe(' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'map(results => {' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`WordPress`,`getBanners`,results);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return results;' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`WordPress`,`getBanners`,`throwError`, err);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'if(err.error.message){' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showToast(err.error.message);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}else{' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showAlert(err.statusText,`' . $addons['label-for-coupons'] . '`,this.connectionLost);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return throwError(err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`WordPress`,`getBanners`,`reThrown`, err);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'return of([]);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . ');' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";


    // TODO: GENERATOR --|-- SERVICES --|-- WOOCOMERCE --|-- CODE --|-- OTHER --|-- getCoupons()
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* ' . $varServiceName . '.getCoupons()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'getCoupons(): Observable<any>{' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'const httpOptions = {' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'headers: new HttpHeaders({' . "\r\n";
    if ($addons['auth-type'] == 'basic')
    {
        $service['code']['other'] .= "\t\t\t\t" . '"Authorization": "Basic " + btoa(this.consumerKey + ":" + this.consumerSecret),' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t" . '"Content-Type": "application/x-www-form-urlencoded"' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t" . '}' . "\r\n";
    if ($addons['auth-type'] == 'basic')
    {
        $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(this.wpUrl + `/wp-json/wc/v3/coupons/`,httpOptions)' . "\r\n";
    } else
    {
        $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(this.wpUrl + `/wp-json/wc/v3/coupons/?' . $url_auth . '`,httpOptions)' . "\r\n";
    }

    $service['code']['other'] .= "\t\t\t" . '.pipe(' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'map(results => {' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Woocomerce`,`getCoupons`,results);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return results;' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Woocomerce`,`getCoupons`,`throwError`, err);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'if(err.error.message){' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showToast(err.error.message);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}else{' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showAlert(err.statusText,`' . $addons['label-for-coupons'] . '`,this.connectionLost);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return throwError(err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Woocomerce`,`getCoupons`,`reThrown`, err);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'return of([]);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . ');' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";

    // TODO: GENERATOR --|-- SERVICES --|-- WOOCOMERCE --|-- CODE --|-- OTHER --|-- getOrder(id)
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* ' . $varServiceName . '.getOrder(orderId)' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'getOrder(orderId:string): Observable<any>{' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'const httpOptions = {' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'headers: new HttpHeaders({' . "\r\n";
    if ($addons['auth-type'] == 'basic')
    {
        $service['code']['other'] .= "\t\t\t\t" . '"Authorization": "Basic " + btoa(this.consumerKey + ":" + this.consumerSecret),' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t" . '"Content-Type": "application/x-www-form-urlencoded"' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t" . '}' . "\r\n";

    if ($addons['auth-type'] == 'basic')
    {
        $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(this.wpUrl + `/wp-json/wc/v3/orders/${orderId}/?_embed=true`,httpOptions)' . "\r\n";
    } else
    {
        $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(this.wpUrl + `/wp-json/wc/v3/orders/${orderId}/?_embed=true&' . $url_auth . '`,httpOptions)' . "\r\n";
    }

    $service['code']['other'] .= "\t\t\t" . '.pipe(' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'map(results => {' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Woocomerce`,`getOrder`,results);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return results;' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Woocomerce`,`getOrder`,`throwError`,err);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'if(err.error.message){' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showToast(err.error.message);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}else{' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showAlert(err.statusText,`' . $addons['label-for-product'] . '`,err.message);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return throwError(err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Woocomerce`,`getOrder`,`reThrown`, err);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'return of([]);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . ');' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- SERVICES --|-- WOOCOMERCE --|-- CODE --|-- OTHER --|-- newOrder()
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* ' . $varServiceName . '.newOrder()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'newOrder(data): Observable<any>{' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'const httpOptions = {' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'headers: new HttpHeaders({' . "\r\n";
    if ($addons['auth-type'] == 'basic')
    {
        $service['code']['other'] .= "\t\t\t\t" . '"Authorization": "Basic " + btoa(this.consumerKey + ":" + this.consumerSecret),' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t" . '"Content-Type": "application/json"' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t" . '}' . "\r\n";
    if ($addons['auth-type'] == 'basic')
    {
        $service['code']['other'] .= "\t\t" . 'return this.httpClient.post(this.wpUrl + `/wp-json/wc/v3/orders/`,data,httpOptions)' . "\r\n";
    } else
    {
        $service['code']['other'] .= "\t\t" . 'return this.httpClient.post(this.wpUrl + `/wp-json/wc/v3/orders/?' . $url_auth . '`,data,httpOptions)' . "\r\n";
    }

    $service['code']['other'] .= "\t\t\t" . '.pipe(' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'map(results => {' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Woocomerce`,`newOrder`,results);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return results;' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Woocomerce`,`newOrder`,`throwError`, err,data);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'if(err.error.message){' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showAlert(`' . $addons['label-for-place-order'] . '`,null,err.error.message);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}else{' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showAlert(`' . $addons['label-for-place-order'] . '`,null,err.message);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return throwError(err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Woocomerce`,`newOrder`,`reThrown`, err);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'return of([]);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . ');' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- SERVICES --|-- WOOCOMERCE --|-- CODE --|-- OTHER --|-- deleteOrder()
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* ' . $varServiceName . '.deleteOrder()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'deleteOrder(itemId): Observable<any>{' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'const httpOptions = {' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'headers: new HttpHeaders({' . "\r\n";
    if ($addons['auth-type'] == 'basic')
    {
        $service['code']['other'] .= "\t\t\t\t" . '"Authorization": "Basic " + btoa(this.consumerKey + ":" + this.consumerSecret),' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t" . '"Content-Type": "application/json"' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t" . '}' . "\r\n";
    if ($addons['auth-type'] == 'basic')
    {
        $service['code']['other'] .= "\t\t" . 'return this.httpClient.delete(this.wpUrl + `/wp-json/wc/v3/orders/${itemId}`,httpOptions)' . "\r\n";
    } else
    {
        $service['code']['other'] .= "\t\t" . 'return this.httpClient.delete(this.wpUrl + `/wp-json/wc/v3/orders/${itemId}/?' . $url_auth . '`,httpOptions)' . "\r\n";
    }


    $service['code']['other'] .= "\t\t\t" . '.pipe(' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'map(results => {' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Woocommerce`,`deleteOrder`,results);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return results;' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Woocommerce`,`deleteOrder`,`throwError`, err);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'if(err.error.message){' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showToast(err.error.message);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}else{' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showAlert(err.statusText,`currencies`,err.message);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return throwError(err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Woocommerce`,`deleteOrder`,`reThrown`, err);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'return of([]);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . ');' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- SERVICES --|-- WOOCOMERCE --|-- CODE --|-- OTHER --|-- getCurrencies()
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* ' . $varServiceName . '.getCurrencies()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'getCurrencies(): Observable<any>{' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'const httpOptions = {' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'headers: new HttpHeaders({' . "\r\n";
    if ($addons['auth-type'] == 'basic')
    {
        $service['code']['other'] .= "\t\t\t\t" . '"Authorization": "Basic " + btoa(this.consumerKey + ":" + this.consumerSecret),' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t" . '"Content-Type": "application/x-www-form-urlencoded"' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t" . '}' . "\r\n";
    if ($addons['auth-type'] == 'basic')
    {
        $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(this.wpUrl + `/wp-json/wc/v3/data/currencies/current`,httpOptions)' . "\r\n";
    } else
    {
        $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(this.wpUrl + `/wp-json/wc/v3/data/currencies/current?' . $url_auth . '`,httpOptions)' . "\r\n";
    }

    $service['code']['other'] .= "\t\t\t" . '.pipe(' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'map(results => {' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Woocommerce`,`getCurrencies`,results);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return results;' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Woocommerce`,`getCurrencies`,`throwError`, err);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'if(err.error.message){' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showToast(err.error.message);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}else{' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showAlert(err.statusText,`currencies`,this.connectionLost);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return throwError(err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Woocommerce`,`getCurrencies`,`reThrown`, err);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'return of([]);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . ');' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- SERVICES --|-- WOOCOMERCE --|-- CODE --|-- OTHER --|-- getPaymentGateways()
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* ' . $varServiceName . '.getPaymentGateways()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'getPaymentGateways(): Observable<any>{' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'const httpOptions = {' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'headers: new HttpHeaders({' . "\r\n";
    if ($addons['auth-type'] == 'basic')
    {
        $service['code']['other'] .= "\t\t\t\t" . '"Authorization": "Basic " + btoa(this.consumerKey + ":" + this.consumerSecret),' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t" . '"Content-Type": "application/x-www-form-urlencoded"' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t" . '}' . "\r\n";

    if ($addons['auth-type'] == 'basic')
    {
        $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(this.wpUrl + `/wp-json/wc/v3/payment_gateways/`,httpOptions)' . "\r\n";
    } else
    {
        $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(this.wpUrl + `/wp-json/wc/v3/payment_gateways/?' . $url_auth . '`,httpOptions)' . "\r\n";
    }

    $service['code']['other'] .= "\t\t\t" . '.pipe(' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'map(results => {' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Woocommerce`,`payment_gateways`,results);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '//this.showToast("Successfully!");' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return results;' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Woocommerce`,`payment_gateways`,`throwError`,err);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'if(err.error.message){' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showToast(err.error.message);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}else{' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showAlert(err.statusText,`Payment Gateways`,err.message);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return throwError(err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Woocommerce`,`payment_gateways`,`reThrown`, err);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'return of([]);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . ');' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- SERVICES --|-- WOOCOMERCE --|-- CODE --|-- OTHER --|-- getCountries()
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* ' . $varServiceName . '.getCountries()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'getCountries(): Observable<any>{' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'const httpOptions = {' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'headers: new HttpHeaders({' . "\r\n";
    if ($addons['auth-type'] == 'basic')
    {
        $service['code']['other'] .= "\t\t\t\t" . '"Authorization": "Basic " + btoa(this.consumerKey + ":" + this.consumerSecret),' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t" . '"Content-Type": "application/x-www-form-urlencoded"' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t" . '}' . "\r\n";
    if ($addons['auth-type'] == 'basic')
    {
        $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(this.wpUrl + `/wp-json/wc/v3/data/countries/`,httpOptions)' . "\r\n";
    } else
    {
        $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(this.wpUrl + `/wp-json/wc/v3/data/countries/?' . $url_auth . '`,httpOptions)' . "\r\n";
    }


    $service['code']['other'] .= "\t\t\t" . '.pipe(' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'map(results => {' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Woocomerce`,`getCountries`,results);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return results;' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Woocomerce`,`getCountries`,`throwError`, err);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'if(err.error.message){' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showToast(err.error.message);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}else{' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showAlert(err.statusText,`countries`,err.message);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return throwError(err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Woocomerce`,`getCountries`,`reThrown`, err);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'return of([]);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . ');' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- SERVICES --|-- WOOCOMERCE --|-- CODE --|-- OTHER --|-- getContinents()
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* ' . $varServiceName . '.getContinents()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'getContinents(): Observable<any>{' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'const httpOptions = {' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'headers: new HttpHeaders({' . "\r\n";
    if ($addons['auth-type'] == 'basic')
    {
        $service['code']['other'] .= "\t\t\t\t" . '"Authorization": "Basic " + btoa(this.consumerKey + ":" + this.consumerSecret),' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t" . '"Content-Type": "application/x-www-form-urlencoded"' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t" . '}' . "\r\n";
    if ($addons['auth-type'] == 'basic')
    {
        $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(this.wpUrl + `/wp-json/wc/v3/data/continents/`,httpOptions)' . "\r\n";
    } else
    {
        $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(this.wpUrl + `/wp-json/wc/v3/data/continents/?' . $url_auth . '`,httpOptions)' . "\r\n";
    }

    $service['code']['other'] .= "\t\t\t" . '.pipe(' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'map(results => {' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Woocomerce`,`getContinents`,results);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return results;' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Woocomerce`,`getContinents`, `throwError`, err);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'return throwError(err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Woocomerce`,`getContinents`,`reThrown`, err);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'return of([]);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . ');' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- SERVICES --|-- WOOCOMERCE --|-- CODE --|-- OTHER --|-- getTags()
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* ' . $varServiceName . '.getTags()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'getTags(): Observable<any>{' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'const httpOptions = {' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'headers: new HttpHeaders({' . "\r\n";
    if ($addons['auth-type'] == 'basic')
    {
        $service['code']['other'] .= "\t\t\t\t" . '"Authorization": "Basic " + btoa(this.consumerKey + ":" + this.consumerSecret),' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t" . '"Content-Type": "application/x-www-form-urlencoded"' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t" . '}' . "\r\n";

    if ($addons['auth-type'] == 'basic')
    {
        $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(this.wpUrl + `/wp-json/wc/v3/products/tags/?per_page=100`,httpOptions)' . "\r\n";
    } else
    {
        $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(this.wpUrl + `/wp-json/wc/v3/products/tags/?per_page=100&' . $url_auth . '`,httpOptions)' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t" . '.pipe(' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'map(results => {' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Woocomerce`,`getTags`,results);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return results;' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Woocomerce`,`getTags`,`throwError`, err);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'if(err.error.message){' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showToast(err.error.message);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}else{' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showAlert(err.statusText,`' . $addons['label-for-tags'] . '`,this.connectionLost);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return throwError(err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Woocomerce`,`getTags`,`reThrown`, err);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'return of([]);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . ');' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- SERVICES --|-- WOOCOMERCE --|-- CODE --|-- OTHER --|-- getCategories()
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* ' . $varServiceName . '.getCategories(query)' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'getCategories(query): Observable<any>{' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'let param = this.httpBuildQuery(query);' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'const httpOptions = {' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'headers: new HttpHeaders({' . "\r\n";
    if ($addons['auth-type'] == 'basic')
    {
        $service['code']['other'] .= "\t\t\t\t" . '"Authorization": "Basic " + btoa(this.consumerKey + ":" + this.consumerSecret),' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t" . '"Content-Type": "application/x-www-form-urlencoded"' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t" . '}' . "\r\n";

    if ($addons['auth-type'] == 'basic')
    {
        $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(this.wpUrl + `/wp-json/wc/v3/products/categories/?${param}`,httpOptions)' . "\r\n";
    } else
    {
        $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(this.wpUrl + `/wp-json/wc/v3/products/categories/?' . $url_auth . '&${param}`,httpOptions)' . "\r\n";
    }

    $service['code']['other'] .= "\t\t\t" . '.pipe(' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'map(results => {' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Woocomerce`,`getCategories`,results);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return results;' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Woocomerce`,`getCategories`,`throwError`, err);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'if(err.error.message){' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showToast(err.error.message);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}else{' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showAlert(err.statusText,`' . $addons['label-for-categories'] . '`,this.connectionLost);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return throwError(err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Woocomerce`,`getCategories`,`reThrown`, err);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'return of([]);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . ');' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- SERVICES --|-- WOOCOMERCE --|-- CODE --|-- OTHER --|-- getProducts()
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* ' . $varServiceName . '.getProducts()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'getProducts(query): Observable<any>{' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'let param = this.httpBuildQuery(query);' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'const httpOptions = {' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'headers: new HttpHeaders({' . "\r\n";
    if ($addons['auth-type'] == 'basic')
    {
        $service['code']['other'] .= "\t\t\t\t" . '"Authorization": "Basic " + btoa(this.consumerKey + ":" + this.consumerSecret),' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t" . '"Content-Type": "application/x-www-form-urlencoded"' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t" . '}' . "\r\n";
    if ($addons['auth-type'] == 'basic')
    {
        $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(this.wpUrl + `/wp-json/wc/v3/products/?${param}`,httpOptions)' . "\r\n";
    } else
    {
        $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(this.wpUrl + `/wp-json/wc/v3/products/?' . $url_auth . '&${param}`,httpOptions)' . "\r\n";
    }

    $service['code']['other'] .= "\t\t\t" . '.pipe(' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'map(results => {' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Woocomerce`,`getProducts`,results);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return results;' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Woocomerce`,`getProducts`,`throwError`, err);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'if(err.error.message){' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showToast(err.error.message);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}else{' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showAlert(err.statusText,`' . $addons['label-for-products'] . '`,this.connectionLost);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return throwError(err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Woocomerce`,`getProducts`,`reThrown`, err);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'return of([]);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . ');' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- SERVICES --|-- WOOCOMERCE --|-- CODE --|-- OTHER --|-- getProduct()
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* ' . $varServiceName . '.getProduct(productId)' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'getProduct(productId:string): Observable<any>{' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'const httpOptions = {' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'headers: new HttpHeaders({' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '"Authorization": "Basic " + btoa(this.consumerKey + ":" + this.consumerSecret),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '"Content-Type": "application/x-www-form-urlencoded"' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t" . '}' . "\r\n";
    if ($addons['auth-type'] == 'basic')
    {
        $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(this.wpUrl + `/wp-json/wc/v3/products/${productId}/?_embed=true`,httpOptions)' . "\r\n";
    } else
    {
        $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(this.wpUrl + `/wp-json/wc/v3/products/${productId}/?_embed=true&' . $url_auth . '`,httpOptions)' . "\r\n";
    }

    $service['code']['other'] .= "\t\t\t" . '.pipe(' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'map(results => {' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Woocomerce`,`getProduct`,results);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return results;' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Woocomerce`,`getProduct`,`throwError`,err);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'if(err.error.message){' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showToast(err.error.message);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}else{' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showAlert(err.statusText,`' . $addons['label-for-product'] . '`,this.connectionLost);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return throwError(err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Woocomerce`,`getProduct`,`reThrown`, err);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'return of([]);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . ');' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- SERVICES --|-- WOOCOMERCE --|-- CODE --|-- OTHER --|-- httpBuildQuery()
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* ' . $varServiceName . '.httpBuildQuery(obj)' . "\r\n";
    $service['code']['other'] .= "\t" . '* @param object $obj' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'private httpBuildQuery(obj) {' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'let k, str;' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'str = [];' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'for (k in obj) {' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'str.push(encodeURIComponent(k) + "=" + encodeURIComponent(obj[k]));' . "\r\n";
    $service['code']['other'] .= "\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'return str.join("&");' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- SERVICES --|-- WOOCOMERCE --|-- CODE --|-- OTHER --|-- presentLoading()
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* ' . $varServiceName . '.presentLoading()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'async presentLoading() {' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'this.loading = await this.loadingController.create({' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'message: "' . $addons['label-for-please-wait'] . '",' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'spinner: "crescent",' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'duration: 2000' . "\r\n";
    $service['code']['other'] .= "\t\t" . '});' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'await this.loading.present();' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* ' . $varServiceName . '.dismissLoading()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'async dismissLoading() {' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'if(this.loading){' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'await this.loading.dismiss();' . "\r\n";
    $service['code']['other'] .= "\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- SERVICES --|-- WOOCOMERCE --|-- CODE --|-- OTHER --|-- showToast()
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* ' . $varServiceName . '.showToast($message)' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'async showToast(message: string){' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'const toast = await this.toastController.create({' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'position: "bottom",' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'color: "dark",' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'duration: 500' . "\r\n";
    $service['code']['other'] .= "\t\t" . '});' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'await toast.present();' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- SERVICES --|-- WOOCOMERCE --|-- CODE --|-- OTHER --|-- showAlert()
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* ' . $varServiceName . '.showAlert()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'async showAlert(header:string, subheader: string, message: string){' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'const alert = await this.alertController.create({' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'header: header,' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'subHeader: subheader,' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'buttons: ["OK"]' . "\r\n";
    $service['code']['other'] .= "\t\t" . '});' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'await alert.present();' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $db->saveService($service, 'core');
    // TODO: ----------------------------------------------------------------------------------------------------
    // TODO: GENERATOR --|-- SERVICES --|-- STORAGE --|--
    $service = null;
    $service['name'] = 'storage';
    $service['instruction'] = 'Service for Storage';
    $service['desc'] = 'Service for Storage Data';
    // TODO: GENERATOR --|-- SERVICES --|-- STORAGE --|-- MODULES


    $service['code']['other'] = null;
    // TODO: GENERATOR --|-- SERVICES --|-- STORAGE --|-- CODE --|-- OTHER --|-- getItems(table:string)
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* StorageService.getItems(table:string)' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'public async getItems(table:string){' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'let data:any = [] ;' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'this.storage.forEach((val,key,index) => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'let prefix : string = `${table}:`;' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'if(key.substring(0,prefix.length) ==  prefix){' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'data.push(val);' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t\t" . '});' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'return await data;' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- SERVICES --|-- STORAGE --|-- CODE --|-- OTHER --|-- getItem(table:string,key:string)
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* StorageService.getItem(table:string,key:string)' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'public async getItem(table:string,key:string){' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'return await this.storage.get(`${table}:${key}`);' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- SERVICES --|-- STORAGE --|-- CODE --|-- OTHER --|-- setItem(table:string,key:string,val:any)
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* StorageService.setItem(table:string,key:string,val:any)' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'public async setItem(table:string,key:string,value:any){' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'return await this.storage.set(`${table}:${key}`,value);' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- SERVICES --|-- STORAGE --|-- CODE --|-- OTHER --|-- removeItem(table:string,key:string)
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* StorageService.removeItem(table:string,key:string)' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'public async removeItem(table:string,key:string){' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'return await this.storage.remove(`${table}:${key}`);' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- SERVICES --|-- STORAGE --|-- CODE --|-- OTHER --|-- clearItems(table:string)
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* StorageService.clearItems(table:string)' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'public async clearItems(table:string) {' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'this.storage.forEach((iValue, iKey, iIndex) => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'let prefix : string = `${table}:`;' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'if(iKey.substring(0,prefix.length) ==  prefix){' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'this.storage.remove(`${iKey}`);' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t\t" . '});' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $db->saveService($service, 'core');
    // TODO: ----------------------------------------------------------------------------------------------------
    // TODO: GENERATOR --|-- GLOBALS --|--
    $global['name'] = 'woocommerce';
    $global['note'] = '-';
    $global['component'][0]['code']['export'] = null;
    $global['component'][0]['code']['init'] = null;
    $global['component'][0]['code']['other'] = null;
    $db->saveGlobal('woocommerce', $global);
    // TODO: ----------------------------------------------------------------------------------------------------
    // TODO: GENERATOR --|-- PAGE --|-- HOME
    $newPage = null;
    $newPage['title'] = 'Welcome';
    $newPage['name'] = 'home';
    $newPage['code-by'] = 'woocommerce';
    $newPage['icon-left'] = 'heart';
    $newPage['icon-right'] = '';
    $newPage['statusbar']['style'] = 'lightcontent';
    $newPage['statusbar']['backgroundcolor'] = $db->getRawColorLevel($addons['page-header-color']);
    $newPage['header']['color'] = $addons['page-header-color'];
    $newPage['content']['color'] = 'none';
    $newPage['content']['custom-color'] = '#ffffff';
    $newPage['content']['background'] = $addons['page-content-background'];
    // TODO: GENERATOR --|-- PAGE --|-- HOME --|-- HEADER
    $newPage['header']['mid']['type'] = 'title';
    $newPage['header']['mid']['items'][0]['label'] = 'Tab 1';
    $newPage['header']['mid']['items'][0]['value'] = 'tab1';
    $newPage['header']['mid']['items'][1]['label'] = 'Tab 2';
    $newPage['header']['mid']['items'][1]['value'] = 'tab2';
    $newPage['header']['mid']['items'][2]['label'] = 'Tab 3';
    $newPage['header']['mid']['items'][2]['value'] = 'tab3';
    // TODO: GENERATOR --|-- PAGE --|-- HOME --|-- MODULES
    $z = 0;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'Observable';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = 'rxjs';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'WoocommerceService';
    $newPage['modules']['angular'][$z]['var'] = 'woocommerceService';
    $newPage['modules']['angular'][$z]['path'] = './../../services/woocommerce/woocommerce.service';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'StorageService';
    $newPage['modules']['angular'][$z]['var'] = 'storageService';
    $newPage['modules']['angular'][$z]['path'] = './../../services/storage/storage.service';
    // TODO: GENERATOR --|-- PAGE --|-- HOME --|-- CONTENT --|-- HTML
    $newPage['content']['html'] = null;
    // TODO: GENERATOR --|-- PAGE --|-- HOME --|-- CONTENT --|-- REFRESHER
    $newPage['content']['html'] .= "\t" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";


    if ($addons['show-banners'] == true)
    {
        // TODO: GENERATOR --|-- PAGE --|-- HOME --|-- CONTENT --|-- BANNERS
        $newPage['content']['html'] .= "\t" . '<!-- banners -->' . "\r\n";
        $newPage['content']['html'] .= "\t" . '<ion-slides *ngIf="dataBanners.length != 0" [options]="{slidesPerView:1,autoplay:1}">' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '<ion-slide *ngFor="let item of dataBanners">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<ion-card [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'products-by-category\',\'0\']" >' . "\r\n";

        switch ($addons['banner-helper'])
        {
            case 'default':
                $newPage['content']['html'] .= "\t\t\t" . '<ion-img *ngIf="item && item[\'_embedded\'] && item[\'_embedded\'][\'wp:featuredmedia\'] && item[\'_embedded\'][\'wp:featuredmedia\'][0] && item[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'] && item[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'] && item[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'] && item[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'][\'large\'] && item[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'][\'large\'].source_url" [src]="item[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'][\'large\'].source_url"></ion-img>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-img *ngIf="!item || !item[\'_embedded\'] || !item[\'_embedded\'][\'wp:featuredmedia\'] || !item[\'_embedded\'][\'wp:featuredmedia\'][0] || !item[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'] || !item[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'] || !item[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'] || !item[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'][\'large\'] || !item[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'][\'large\'].source_url" src="assets/images/placeholder-800x600.png"></ion-img>' . "\r\n";
                break;
            case 'rest-api-helper':
                $newPage['content']['html'] .= "\t\t\t" . '<ion-img *ngIf="item && item.x_featured_media_original" [src]="item.x_featured_media_original"></ion-img>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-img *ngIf="!item || !item.x_featured_media_original" src="assets/images/placeholder-800x600.png"></ion-img>' . "\r\n";
                break;
            case 'jackpat':
                $newPage['content']['html'] .= "\t\t\t" . '<ion-img *ngIf="item && item.jetpack_featured_media_url" [src]="item.jetpack_featured_media_url"></ion-img>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-img *ngIf="!item || !item.jetpack_featured_media_url" src="assets/images/placeholder-800x600.png"></ion-img>' . "\r\n";
                break;
            case 'custom-api':
                $newPage['content']['html'] .= "\t\t\t" . '<ion-img *ngIf="item && item.' . $addons['banner-custom-api-variable'] . '" [src]="item.' . $addons['banner-custom-api-variable'] . '"></ion-img>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-img *ngIf="!item || !item.' . $addons['banner-custom-api-variable'] . '" src="assets/images/placeholder-800x600.png"></ion-img>' . "\r\n";
                break;
        }

        $newPage['content']['html'] .= "\t\t\t" . '</ion-card>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '</ion-slide>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '</ion-slides>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '<ion-slides *ngIf="dataBanners.length == 0" [options]="{slidesPerView:1,autoplay:1}">' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '<ion-slide>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<ion-card>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '<ion-img src="assets/images/placeholder-800x600.png"></ion-img>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</ion-card>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '</ion-slide>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '<ion-slide>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<ion-card>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '<ion-img src="assets/images/placeholder-800x600.png"></ion-img>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</ion-card>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '</ion-slide>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '<ion-slide>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<ion-card>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '<ion-img src="assets/images/placeholder-800x600.png"></ion-img>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</ion-card>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '</ion-slide>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '</ion-slides>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '<!-- ./banners -->' . "\r\n";
    }

    if ($addons['show-featured'] == true)
    {
        // TODO: GENERATOR --|-- PAGE --|-- HOME --|-- CONTENT --|-- FEATURED PRODUCTS
        $newPage['content']['html'] .= "\t" . '<!-- featured -->' . "\r\n";
        $newPage['content']['html'] .= "\t" . '<ion-list-header>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '<ion-text color="' . $addons['page-header-color'] . '">' . $addons['label-for-featured-products'] . '</ion-text>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '</ion-list-header>' . "\r\n";
        if ($addons['auto-play'] == true)
        {
            $autoPlay = 'true';
        } else
        {
            $autoPlay = 'false';
        }
        $newPage['content']['html'] .= "\t" . '<ion-slides *ngIf="dataFeaturedProducts.length != 0" [options]="{slidesPerView:' . $addons['slides-per-view'] . ',autoplay:' . $autoPlay . '}">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<ion-slide *ngFor="let item of dataFeaturedProducts">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'product-detail\',item.id]" >' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-card-header>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-card-title *ngIf="item.name"><h3 [innerHTML]="item.name"></h3></ion-card-title>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-card-subtitle color="danger" *ngIf="item.name" [innerHTML]="item.price_html"></ion-card-subtitle>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-card-header>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-img *ngIf="item.images && item.images[0] && item.images[0].src" [src]="item.images[0].src"></ion-img>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '</ion-card>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</ion-slide>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '</ion-slides>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '<ion-slides *ngIf="dataFeaturedProducts.length == 0" [options]="{slidesPerView:' . $addons['slides-per-view'] . '}">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<ion-slide>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-card-header>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-card-title><h3><ion-skeleton-text animated style="width: 60%"></ion-skeleton-text></h3></ion-card-title>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-card-subtitle color="danger"><ion-skeleton-text animated style="width: 88%"></ion-skeleton-text></ion-card-subtitle>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-card-header>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-img src="assets/images/placeholder-480x480.png"></ion-img>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '</ion-card>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</ion-slide>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<ion-slide>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-card-header>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-card-title><h3><ion-skeleton-text animated style="width: 80%"></ion-skeleton-text></h3></ion-card-title>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-card-subtitle color="danger"><ion-skeleton-text animated style="width: 88%"></ion-skeleton-text></ion-card-subtitle>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-card-header>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-img src="assets/images/placeholder-480x480.png"></ion-img>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '</ion-card>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</ion-slide>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<ion-slide>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-card-header>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-card-title><h3><ion-skeleton-text animated style="width: 50%"></ion-skeleton-text></h3></ion-card-title>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-card-subtitle color="danger"><ion-skeleton-text animated style="width: 88%"></ion-skeleton-text></ion-card-subtitle>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-card-header>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-img src="assets/images/placeholder-480x480.png"></ion-img>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '</ion-card>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</ion-slide>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '</ion-slides>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '<!-- ./featured -->' . "\r\n";
    }

    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<!-- categories -->' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- HOME --|-- CONTENT --|-- SLIDES CATEGORIES
    $newPage['content']['html'] .= "\t" . '<ion-list-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-text color="' . $addons['page-header-color'] . '">' . $addons['label-for-categories'] . '</ion-text>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-list-header>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-slides *ngIf="dataCategories.length != 0" [options]="{slidesPerView:4}">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-slide *ngFor="let cat of dataCategories" >' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<div [routerDirection]="\'root\'" [routerLink]="[\'/\',\'products-by-category\',cat.id]">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card *ngIf="cat.image && cat.image.src">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-card-header  class="ratio-1x1" [ngStyle]="{\'background-image\':\'url(\' + cat.image.src + \')\',\'background-size\':\'cover\',\'background-position\':\'center\'}"></ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-card-content>{{ cat.name }}</ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card *ngIf="!cat.image || !cat.image.src">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-card-header  class="ratio-1x1" [ngStyle]="{\'background-image\':\'url(\\\'assets/images/placeholder-480x480.png\\\')\',\'background-size\':\'cover\',\'background-position\':\'center\'}"></ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-card-content>{{ cat.name }}</ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</div>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-slides>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-slides *ngIf="dataCategories.length == 0" [options]="{slidesPerView:4}">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-header  class="ratio-1x1" [ngStyle]="{\'background-image\':\'url(\\\'assets/images/placeholder-480x480.png\\\')\',\'background-size\':\'cover\',\'background-position\':\'center\'}"></ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-content><ion-skeleton-text animated style="width: 76%"></ion-skeleton-text></ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-header  class="ratio-1x1" [ngStyle]="{\'background-image\':\'url(\\\'assets/images/placeholder-480x480.png\\\')\',\'background-size\':\'cover\',\'background-position\':\'center\'}"></ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-content><ion-skeleton-text animated style="width: 88%"></ion-skeleton-text></ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-header  class="ratio-1x1" [ngStyle]="{\'background-image\':\'url(\\\'assets/images/placeholder-480x480.png\\\')\',\'background-size\':\'cover\',\'background-position\':\'center\'}"></ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-content><ion-skeleton-text animated style="width: 48%"></ion-skeleton-text></ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-header  class="ratio-1x1" [ngStyle]="{\'background-image\':\'url(\\\'assets/images/placeholder-480x480.png\\\')\',\'background-size\':\'cover\',\'background-position\':\'center\'}"></ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-content><ion-skeleton-text animated style="width: 98%"></ion-skeleton-text></ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-header  class="ratio-1x1" [ngStyle]="{\'background-image\':\'url(\\\'assets/images/placeholder-480x480.png\\\')\',\'background-size\':\'cover\',\'background-position\':\'center\'}"></ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-content><ion-skeleton-text animated style="width: 38%"></ion-skeleton-text></ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-header  class="ratio-1x1" [ngStyle]="{\'background-image\':\'url(\\\'assets/images/placeholder-480x480.png\\\')\',\'background-size\':\'cover\',\'background-position\':\'center\'}"></ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-content><ion-skeleton-text animated style="width: 48%"></ion-skeleton-text></ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-slides>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<!-- ./categories -->' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";

    if ($addons['show-tags'] == true)
    {
        // TODO: GENERATOR --|-- PAGE --|-- HOME --|-- CONTENT --|-- TAGS
        $newPage['content']['html'] .= "\t" . '<!-- tags -->' . "\r\n";
        $newPage['content']['html'] .= "\t" . '<ion-list-header>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '<ion-text color="' . $addons['page-header-color'] . '">' . $addons['label-for-tags'] . '</ion-text>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '</ion-list-header>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '<p *ngIf="dataTags.length != 0" class="tags">' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '<span *ngFor="let tag of dataTags" [routerDirection]="\'root\'" [routerLink]="[\'/\',\'products-by-tag\',tag.id]">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<ion-chip  color="' . $addons['page-header-color'] . '">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label>{{ tag.name }}</ion-label>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</ion-chip>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '</span>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '</p>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '<ion-list *ngIf="dataTags.length == 0" class="tags">' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '<span>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<ion-chip color="' . $addons['page-header-color'] . '">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label><ion-skeleton-text animated style="width: 50px"></ion-skeleton-text></ion-label>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</ion-chip>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<ion-chip color="' . $addons['page-header-color'] . '">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label><ion-skeleton-text animated style="width: 90px"></ion-skeleton-text></ion-label>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</ion-chip>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<ion-chip color="' . $addons['page-header-color'] . '">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label><ion-skeleton-text animated style="width: 100px"></ion-skeleton-text></ion-label>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</ion-chip>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<ion-chip color="' . $addons['page-header-color'] . '">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label><ion-skeleton-text animated style="width: 50px"></ion-skeleton-text></ion-label>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</ion-chip>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<ion-chip color="' . $addons['page-header-color'] . '">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label><ion-skeleton-text animated style="width: 20px"></ion-skeleton-text></ion-label>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</ion-chip>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '</span>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '</ion-list>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '<!-- ./tags -->' . "\r\n";
        $newPage['content']['html'] .= "\t" . '' . "\r\n";
        $newPage['content']['html'] .= "\t" . '' . "\r\n";
    }
    // TODO: GENERATOR --|-- PAGE --|-- HOME --|-- CONTENT --|-- LATEST PRODUCTS
    $newPage['content']['html'] .= "\t" . '<!-- latest-products -->' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-list-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-text color="' . $addons['page-header-color'] . '">' . $addons['label-for-latest-products'] . '</ion-text>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-list-header>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-grid *ngIf="dataLatestProducts.length != 0" >' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-row>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-col size="6" size-sm *ngFor="let item of dataLatestProducts">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'product-detail\',item.id]" >' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-img *ngIf="item.images && item.images[0] && item.images[0].src" [src]="item.images[0].src"></ion-img>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-card-title *ngIf="item.name"><h3 [innerHTML]="item.name"></h3></ion-card-title>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-card-subtitle color="danger" *ngIf="item.name" [innerHTML]="item.price_html"></ion-card-subtitle>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<p><ion-text color="warning" title="{{ item.average_rating }}" color="warning" [innerHTML]="ratingRendered(item.average_rating) | trustHtml"></ion-text>({{ item.rating_count }})</p>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-row>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-grid>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-grid *ngIf="dataLatestProducts.length == 0" >' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-row>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-col size="6" size-sm>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card >' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-img src="assets/images/placeholder-480x480.png"></ion-img>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-card-title><h3><ion-skeleton-text animated style="width: 100%"></ion-skeleton-text></h3></ion-card-title>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-card-subtitle color="danger"><ion-skeleton-text animated style="width: 38%"></ion-skeleton-text></ion-card-subtitle>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<p><ion-skeleton-text animated style="width: 28%"></ion-skeleton-text></p>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-col size="6" size-sm>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card >' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-img src="assets/images/placeholder-480x480.png"></ion-img>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-card-title><h3><ion-skeleton-text animated style="width: 88%"></ion-skeleton-text></h3></ion-card-title>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-card-subtitle color="danger"><ion-skeleton-text animated style="width: 38%"></ion-skeleton-text></ion-card-subtitle>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<p><ion-skeleton-text animated style="width: 28%"></ion-skeleton-text></p>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-col size="6" size-sm>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card >' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-img src="assets/images/placeholder-480x480.png"></ion-img>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-card-title><h3><ion-skeleton-text animated style="width: 70%"></ion-skeleton-text></h3></ion-card-title>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-card-subtitle color="danger"><ion-skeleton-text animated style="width: 38%"></ion-skeleton-text></ion-card-subtitle>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<p><ion-skeleton-text animated style="width: 28%"></ion-skeleton-text></p>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-col size="6" size-sm>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card >' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-img src="assets/images/placeholder-480x480.png"></ion-img>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-card-title><h3><ion-skeleton-text animated style="width: 58%"></ion-skeleton-text></h3></ion-card-title>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-card-subtitle color="danger"><ion-skeleton-text animated style="width: 38%"></ion-skeleton-text></ion-card-subtitle>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<p><ion-skeleton-text animated style="width: 28%"></ion-skeleton-text></p>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-row>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-grid>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<!-- ./latest-products -->' . "\r\n";
    //$newPage['content']['html'] .= "\t" . '<pre>{{ dataLatestProducts | json }}</pre>' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- HOME --|-- CONTENT --|-- SCSS
    $newPage['content']['scss'] = null;
    $newPage['content']['scss'] .= "\t" . 'ion-card-header+.card-content-ios {font-size:80% !important;padding: 3px !important;text-overflow: ellipsis !important;white-space: nowrap !important;overflow: hidden !important;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-card-header+.card-content-md {font-size:80% !important;padding: 3px !important;text-overflow: ellipsis !important;white-space: nowrap !important;overflow: hidden !important;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-slide {display:block !important;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-slide .ratio-1x1 {width: 100% !important;padding-top: 100% !important; position: relative !important;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-slide .ratio-16x9 {width: 100% !important;padding-top: 56.25% !important; position: relative !important;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-slide .ratio-4x3 {width: 100% !important;padding-top: 75% !important; position: relative !important;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-slide .ratio-3x2 {width: 100% !important;padding-top: 66.66% !important; position: relative !important;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-slide .ratio-8x5 {width: 100% !important;padding-top: 62.5% !important; position: relative !important;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-slide ion-card{ margin-top: 0.5em;padding:0.2em;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-slide a {text-decoration: none !important;display: block;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'p a {text-decoration: none !important;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-card-header {padding:.5em !important;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-card-header h3{margin: 0px !important;padding: 0px !important;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-grid ion-card{padding:0.2em;margin-top: 0;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-list-header{margin-top: .5em;font-variant: petite-caps;padding-top: 0;padding-bottom:0;font-size: 1.2em;background-color: #fff;opacity:0.9;font-weight: 600;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-list-header ion-text{padding-top: 0.5em;padding-bottom: 0.5em;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '.tags {padding-left: 1em;padding-right: 1em;margin-top: 0;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-card {opacity:0.9;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-slides {opacity:0.9;}' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- HOME --|-- FOOTER
    $newPage['footer']['color'] = 'none';
    $newPage['footer']['type'] = 'code';
    $newPage['footer']['title'] = '';
    $newPage['footer']['code'] = null;
    //$newPage['footer']['code'] .= "\t" . '<ion-footer>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t" . '<ion-toolbar>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t" . '<ion-tabs>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-tab-bar slot="bottom">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-tab-button disabled="true" [routerDirection]="\'root\'" [routerLink]="[\'/home\']">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-home'] . '</ion-label>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="home-outline"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-tab-button [routerDirection]="\'root\'" [routerLink]="[\'/products-by-category/0\']">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-products'] . '</ion-label>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="wine-outline"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-tab-button [routerDirection]="\'root\'" [routerLink]="[\'/wishlist\']">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-wishlist'] . '</ion-label>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="heart-circle"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-badge *ngIf="count_wishlist!=0" color="danger">{{ count_wishlist }}</ion-badge>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-tab-button [routerDirection]="\'root\'" [routerLink]="[\'/cart\']">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-cart'] . '</ion-label>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="cart-outline"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-badge *ngIf="count_cart!=0" color="danger">{{ count_cart }}</ion-badge>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-tab-button [routerDirection]="\'root\'" [routerLink]="[\'/account\']">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-account'] . '</ion-label>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="person-outline"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-tab-bar>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t" . '</ion-tabs>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t" . '</ion-toolbar>' . "\r\n";
    //$newPage['footer']['code'] .= "\t" . '</ion-footer>' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- HOME --|-- CODE --|--
    $newPage['code']['export'] = null;
    $newPage['code']['constructor'] = null;
    $newPage['code']['constructor'] .= "\t\t" . '//badge for wishlist and cart' . "\r\n";
    $newPage['code']['constructor'] .= "\t\t" . 'this.createBadge();' . "\r\n";
    $newPage['code']['constructor'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] = null;
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '// banners' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'banners: Observable<any>;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataBanners: any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '// featured' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'featuredProducts: Observable<any>;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataFeaturedProducts: any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '// latest products' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'latestProducts: Observable<any>;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataLatestProducts: any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '// categories' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'categories: Observable<any>;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataCategories: any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '// tags' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'tags: Observable<any>;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataTags: any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- HOME --|-- CODE --|-- TS --|-- OTHER --|-- getFeaturedProducts()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* HomePage.getFeaturedProducts()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'getFeaturedProducts(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let query = {"_embed":true,"per_page":10,"featured":true};' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.featuredProducts = this.' . $varUserServiceName . '.getProducts(query);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.featuredProducts.subscribe(data => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.dataFeaturedProducts = data ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- HOME --|-- CODE --|-- TS --|-- OTHER --|-- getLatestProducts()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* HomePage.getLatestProducts()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'getLatestProducts(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let query = {"_embed":true,"per_page":10};' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.latestProducts = this.' . $varUserServiceName . '.getProducts(query);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.latestProducts.subscribe(data => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.dataLatestProducts = data ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- HOME --|-- CODE --|-- TS --|-- OTHER --|-- getCategories()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* HomePage.getCategories()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'getCategories(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.categories = this.' . $varUserServiceName . '.getCategories({per_page:100,parent:0});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.categories.subscribe(data => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.dataCategories = data ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- HOME --|-- CODE --|-- TS --|-- OTHER --|-- getBanners()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* HomePage.getBanners()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'getBanners(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.banners = this.' . $varUserServiceName . '.getBanners();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.banners.subscribe(data => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.dataBanners = data ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- HOME --|-- CODE --|-- TS --|-- OTHER --|-- getTags()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* HomePage.getTags()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'getTags(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.tags = this.' . $varUserServiceName . '.getTags();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.tags.subscribe(data => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.dataTags = data ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- HOME --|-- CODE --|-- TS --|-- OTHER --|-- doRefresh()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* HomePage.doRefresh()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public doRefresh(refresher){' . "\r\n";
    if ($addons['show-banners'] == true)
    {
        $newPage['code']['other'] .= "\t\t" . '// banners' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.dataBanners = [];' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.getBanners();' . "\r\n";
    }
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    if ($addons['show-featured'] == true)
    {
        $newPage['code']['other'] .= "\t\t" . '// featured' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.dataFeaturedProducts = [];' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.getFeaturedProducts();' . "\r\n";
    }
    $newPage['code']['other'] .= "\t\t" . '// latest products' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataLatestProducts = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getLatestProducts();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '// categories' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataCategories = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getCategories();' . "\r\n";
    if ($addons['show-tags'] == true)
    {
        $newPage['code']['other'] .= "\t\t" . '// tags' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.dataTags = [];' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.getTags();' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    }
    $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'refresher.target.complete();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}, 2000);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- HOME --|-- CODE --|-- TS --|-- OTHER --|-- ratingRendered()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* HomePage.ratingRendered()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'ratingRendered(rate:string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let rate_dec =   (parseFloat(rate) * 2) ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let rate_number = Math.round(rate_dec);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let star = `<ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon>`;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'switch(rate_number){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'case 0: {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'star = `<ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon>`;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'break;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'case 1: {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'star = `<ion-icon name="star-half-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon>`;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'break;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'case 2: {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '	star = `<ion-icon name="star"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon>`;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'break;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'case 3: {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'star = `<ion-icon name="star"></ion-icon><ion-icon name="star-half-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon>`;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'break;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'case 4: {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'star = `<ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon>`;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'break;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'case 5: {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'star = `<ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star-half-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon>`;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'break;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'case 6: {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'star = `<ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon>`;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'break;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'case 7: { ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'star = `<ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star-half-outline"></ion-icon><ion-icon name="star-outline"></ion-icon>`;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'break;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '} ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'case 8: { ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'star = `<ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star-outline"></ion-icon>`;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'break;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '} ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'case 9: { ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'star = `<ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star-half-outline"></ion-icon>`;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'break;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '} ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'case 10: { ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'star = `<ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon>`;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'break;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '} ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'default: { ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'break; ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '} ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '} ' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'return star;' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- HOME --|-- CODE --|-- TS --|-- OTHER --|-- ngOnInit()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* HomePage.ngOnInit()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public ngOnInit(){' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    if ($addons['show-banners'] == true)
    {
        $newPage['code']['other'] .= "\t\t" . '// banners' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.dataBanners = [];' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.getBanners();' . "\r\n";
    }

    if ($addons['show-featured'] == true)
    {
        $newPage['code']['other'] .= "\t\t" . '// featured' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.dataFeaturedProducts = [];' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.getFeaturedProducts();' . "\r\n";
    }
    $newPage['code']['other'] .= "\t\t" . '// latest products' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataLatestProducts = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getLatestProducts();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '// categories' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataCategories = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getCategories();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    if ($addons['show-tags'] == true)
    {
        $newPage['code']['other'] .= "\t\t" . '// tags' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.dataTags = [];' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.getTags();' . "\r\n";
    }
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= createBadge("home");
    $newPage['code']['init'] = null;
    //generate page code
    $db->savePage($newPage);
    function createProductPage($name)
    {
        global $addons;
        global $db;
        global $varUserServiceName;
        // TODO: ----------------------------------------------------------------------------------------------------
        // TODO: GENERATOR --|-- PAGE --|-- PRODUCTS-BY
        $newPage = null;
        $newPage['title'] = $addons['label-for-products'];
        $newPage['name'] = 'products-by-' . $name;
        $newPage['code-by'] = 'woocommerce';
        $newPage['icon-left'] = 'wine-outline';
        $newPage['icon-right'] = '';
        $newPage['statusbar']['style'] = 'lightcontent';
        $newPage['statusbar']['backgroundcolor'] = $db->getRawColorLevel($addons['page-header-color']);
        $newPage['header']['color'] = $addons['page-header-color'];
        $newPage['content']['color'] = 'none';
        $newPage['content']['custom-color'] = '#ffffff';
        $newPage['content']['background'] = $addons['page-content-background'];
        $newPage['back-button'] = 'home';
        // TODO: GENERATOR --|-- PAGE --|-- PRODUCTS-BY --|-- HEADER
        $newPage['header']['mid']['items'][0]['label'] = 'Tab 1';
        $newPage['header']['mid']['items'][0]['value'] = 'tab1';
        $newPage['header']['mid']['items'][1]['label'] = 'Tab 2';
        $newPage['header']['mid']['items'][1]['value'] = 'tab2';
        $newPage['header']['mid']['items'][2]['label'] = 'Tab 3';
        $newPage['header']['mid']['items'][2]['value'] = 'tab3';
        $newPage['header']['mid']['type'] = 'search';
        $newPage['param'] = 'data_id';
        // TODO: GENERATOR --|-- PAGE --|-- PRODUCTS-BY --|-- MODULES
        $z = 0;
        $newPage['modules']['angular'][$z]['enable'] = true;
        $newPage['modules']['angular'][$z]['class'] = 'Observable';
        $newPage['modules']['angular'][$z]['var'] = '';
        $newPage['modules']['angular'][$z]['path'] = 'rxjs';
        $z++;
        $newPage['modules']['angular'][$z]['enable'] = true;
        $newPage['modules']['angular'][$z]['class'] = 'WoocommerceService';
        $newPage['modules']['angular'][$z]['var'] = 'woocommerceService';
        $newPage['modules']['angular'][$z]['path'] = './../../services/woocommerce/woocommerce.service';
        $z++;
        $newPage['modules']['angular'][$z]['enable'] = true;
        $newPage['modules']['angular'][$z]['class'] = 'StorageService';
        $newPage['modules']['angular'][$z]['var'] = 'storageService';
        $newPage['modules']['angular'][$z]['path'] = './../../services/storage/storage.service';
        // TODO: GENERATOR --|-- PAGE --|-- PRODUCTS-BY --|-- CONTENT --|-- HTML
        $newPage['content']['html'] = null;
        // TODO: GENERATOR --|-- PAGE --|-- PRODUCTS-BY --|-- CONTENT --|-- HTML --|-- REFRESHER
        $newPage['content']['html'] .= "\t" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '' . "\r\n";
        switch ($name)
        {
            case 'category':
                // TODO: GENERATOR --|-- PAGE --|-- PRODUCTS-BY --|-- CONTENT --|-- HTML --|-- HEADER
                $newPage['content']['html'] .= "\t" . '<ion-list-header *ngIf="dataProducts && dataProducts[0] && dataProducts[0].categories && dataProducts[0].categories[0] && dataProducts[0].categories[0].name">' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '<ion-text color="' . $addons['page-header-color'] . '" *ngIf="dataId !=\'0\'">' . $addons['label-for-categories'] . ' : {{ dataProducts[0].categories[0].name }}</ion-text>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '<ion-text color="' . $addons['page-header-color'] . '" *ngIf="dataId == \'0\'">' . $addons['label-for-categories'] . ' : ' . $addons['label-for-all'] . '</ion-text>' . "\r\n";
                $newPage['content']['html'] .= "\t" . '</ion-list-header>' . "\r\n";
                break;
            case 'tag':
                // TODO: GENERATOR --|-- PAGE --|-- PRODUCTS-BY --|-- CONTENT --|-- HTML --|-- HEADER
                $newPage['content']['html'] .= "\t" . '<ion-list-header *ngIf="dataProducts && dataProducts[0] && dataProducts[0].tags && dataProducts[0].tags[0] && dataProducts[0].tags[0].name">' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '<ion-text color="' . $addons['page-header-color'] . '" *ngIf="dataId !=\'0\'" >' . $addons['label-for-tags'] . ' : {{ dataProducts[0].tags[0].name }}</ion-text>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '<ion-text color="' . $addons['page-header-color'] . '" *ngIf="dataId ==\'0\'" >' . $addons['label-for-tags'] . ' : ' . $addons['label-for-all'] . '</ion-text>' . "\r\n";
                $newPage['content']['html'] .= "\t" . '</ion-list-header>' . "\r\n";
                break;
        }
        // TODO: GENERATOR --|-- PAGE --|-- PRODUCTS-BY --|-- CONTENT --|-- HTML --|-- LIST
        $newPage['content']['html'] .= "\t" . '' . "\r\n";
        $newPage['content']['html'] .= "\t" . '<ion-list-header *ngIf="dataProducts.length == 0">' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '<ion-text color="' . $addons['page-header-color'] . '">' . $addons['label-for-no-products-found'] . '</ion-text>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '</ion-list-header>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '' . "\r\n";
        $newPage['content']['html'] .= "\t" . '' . "\r\n";
        $newPage['content']['html'] .= "\t" . '<ion-grid>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '<ion-row>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<ion-col size="6" size-sm *ngFor="let item of dataProducts">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'product-detail\',item.id]" >' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-img *ngIf="item.images && item.images[0] && item.images[0].src" [src]="item.images[0].src"></ion-img>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-card-header>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-card-title *ngIf="item.name"><h3 [innerHTML]="item.name"></h3></ion-card-title>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-card-subtitle color="danger" *ngIf="item.name" [innerHTML]="item.price_html"></ion-card-subtitle>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<p><ion-text color="warning" title="{{ item.average_rating }}" color="warning" [innerHTML]="ratingRendered(item.average_rating) | trustHtml"></ion-text>({{ item.rating_count }})</p>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-card-header>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '</ion-card>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</ion-col>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '</ion-row>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '</ion-grid>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '' . "\r\n";
        $newPage['content']['html'] .= "\t" . '' . "\r\n";
        $newPage['content']['html'] .= "\t" . '<ion-infinite-scroll (ionInfinite)="loadMore($event)">' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '<ion-infinite-scroll-content></ion-infinite-scroll-content>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '</ion-infinite-scroll>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '' . "\r\n";
        // TODO: GENERATOR --|-- PAGE --|-- PRODUCTS-BY --|-- CONTENT --|-- SCSS
        $newPage['content']['scss'] = null;
        $newPage['content']['scss'] .= "\t" . 'ion-card {opacity:0.9;}' . "\r\n";
        $newPage['content']['scss'] .= "\t" . 'ion-card-header {padding: 12px !important;}' . "\r\n";
        $newPage['content']['scss'] .= "\t" . 'ion-card-header h3{margin: 0px !important;padding: 0px !important;}' . "\r\n";
        $newPage['content']['scss'] .= "\t" . 'ion-grid ion-card{ padding: 3px; margin: 6px;}' . "\r\n";
        $newPage['content']['scss'] .= "\t" . '.rating{display: block;position: absolute;right: 0.5em;top: 0.5em;}' . "\r\n";
        $newPage['content']['scss'] .= "\t" . 'ion-list-header{margin-top: .5em;font-variant: petite-caps;padding-top: 0;padding-bottom:0;font-size: 1.2em;background-color: #fff;opacity:0.9;font-weight: 600;}' . "\r\n";
        $newPage['content']['scss'] .= "\t" . 'ion-list-header ion-text{padding-top: 0.5em;padding-bottom: 0.5em;}' . "\r\n";
        // TODO: GENERATOR --|-- PAGE --|-- PRODUCTS-BY --|-- FOOTER
        $newPage['footer']['color'] = 'none';
        $newPage['footer']['type'] = 'code';
        $newPage['footer']['title'] = '';
        $newPage['footer']['code'] = null;
        $newPage['footer']['code'] .= "\t" . '<ion-toolbar>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t" . '<ion-tabs>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t" . '<ion-tab-bar slot="bottom">' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t" . '' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-tab-button [routerDirection]="\'root\'" [routerLink]="[\'/home\']">' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-home'] . '</ion-label>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="home-outline"></ion-icon>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-tab-button>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t" . '' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-tab-button disabled="true" [routerDirection]="\'root\'" [routerLink]="[\'/products-by-category/0\']">' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-products'] . '</ion-label>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="wine-outline"></ion-icon>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-tab-button>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t" . '' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t" . '' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-tab-button [routerDirection]="\'root\'" [routerLink]="[\'/wishlist\']">' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-wishlist'] . '</ion-label>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="heart-circle"></ion-icon>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-badge *ngIf="count_wishlist!=0" color="danger">{{ count_wishlist }}</ion-badge>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-tab-button>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t" . '' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-tab-button [routerDirection]="\'root\'" [routerLink]="[\'/cart\']">' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-cart'] . '</ion-label>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="cart-outline"></ion-icon>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-badge *ngIf="count_cart!=0" color="danger">{{ count_cart }}</ion-badge>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-tab-button>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t" . '' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-tab-button [routerDirection]="\'root\'" [routerLink]="[\'/account\']">' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-account'] . '</ion-label>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="person-outline"></ion-icon>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-tab-button>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t" . '' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t" . '</ion-tab-bar>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t" . '</ion-tabs>' . "\r\n";
        $newPage['footer']['code'] .= "\t" . '</ion-toolbar>' . "\r\n";
        // TODO: GENERATOR --|-- PAGE --|-- PRODUCTS-BY --|-- CODE --|-- OTHER
        $newPage['code']['export'] = null;
        $newPage['code']['constructor'] = null;
        $newPage['code']['constructor'] .= "\t\t" . '//badge for wishlist and cart' . "\r\n";
        $newPage['code']['constructor'] .= "\t\t" . 'this.createBadge();' . "\r\n";
        $newPage['code']['constructor'] .= "\t\t" . '' . "\r\n";
        $newPage['code']['other'] = null;
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'products: Observable<any>;' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'dataProducts: any = [];' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'pageNumber: number = 1;' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'defaultDataId: string = "0" ;' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'query = {};' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* ProductsBy' . ucwords($name) . 'Page.getProducts()' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'getProducts(start: boolean){' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.updateQuery();' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.products = this.' . $varUserServiceName . '.getProducts(this.query);' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.products.subscribe(data => {' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'if(start == true){' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . 'this.dataProducts = data ;' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . '}else{' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . 'this.dataProducts = this.dataProducts.concat(data);' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        // TODO: GENERATOR --|-- PAGE --|-- PRODUCTS-BY --|-- CODE --|-- OTHER --|-- updateQuery()
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* ProductsBy' . ucwords($name) . 'Page.updateQuery()' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'public updateQuery(){' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.query["page"] = this.pageNumber;' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.query["_embed"] = "true";' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.query["per_page"] = ' . (int)$addons['per-page'] . ' ;' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.query["search"] = this.filterQuery;' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'if((this.dataId == "") || (this.dataId == null)){' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'this.dataId = this.defaultDataId ;' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'if(this.dataId != "0"){' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'this.query["' . $name . '"] = this.dataId;' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'console.log("parameter",this.query);' . "\r\n";
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        // TODO: GENERATOR --|-- PAGE --|-- PRODUCTS-BY --|-- CODE --|-- OTHER --|-- filterItems()
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* ProductsBy' . ucwords($name) . 'Page.filterItems($event)' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* @param any $event' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'public filterItems(evt: any){' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'let filterVal = evt.target.value;' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'if (filterVal && filterVal.trim() !== "") {' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'this.filterQuery = filterVal;' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '}else{' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'this.filterQuery = "";' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'if((this.filterQuery.length == 0 ) || (this.filterQuery.length >= 3 )){' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'this.dataProducts = [];' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'this.pageNumber = 1;' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'this.getProducts(true);' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        // TODO: GENERATOR --|-- PAGE --|-- PRODUCTS-BY --|-- CODE --|-- OTHER --|-- loadMore()
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* ProductsBy' . ucwords($name) . 'Page.loadMore(infiniteScroll)' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* @param event $infiniteScroll' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'public loadMore(infiniteScroll){' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'let pageNumber = this.pageNumber;' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.pageNumber++;' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.getProducts(false);' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'infiniteScroll.target.complete();' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . '//infiniteScroll.target.enable = false;' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '}, 500);' . "\r\n";
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        // TODO: GENERATOR --|-- PAGE --|-- PRODUCTS-BY --|-- CODE --|-- OTHER --|-- doRefresh()
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* ProductsBy' . ucwords($name) . 'Page.doRefresh()' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'public doRefresh(refresher){' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.dataProducts = [];' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.getProducts(false);' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'refresher.target.complete();' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '}, 2000);' . "\r\n";
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* ProductsBy' . ucwords($name) . 'Page.ratingRendered()' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'ratingRendered(rate:string){' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'let rate_dec =   (parseFloat(rate) * 2) ;' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'let rate_number = Math.round(rate_dec);' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'let star = `<ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon>`;' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'switch(rate_number){' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'case 0: {' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . 'star = `<ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon>`;' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . 'break;' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'case 1: {' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . 'star = `<ion-icon name="star-half-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon>`;' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . 'break;' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'case 2: {' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . '	star = `<ion-icon name="star"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon>`;' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . 'break;' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'case 3: {' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . 'star = `<ion-icon name="star"></ion-icon><ion-icon name="star-half-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon>`;' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . 'break;' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'case 4: {' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . 'star = `<ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon>`;' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . 'break;' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'case 5: {' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . 'star = `<ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star-half-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon>`;' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . 'break;' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'case 6: {' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . 'star = `<ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon>`;' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . 'break;' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'case 7: { ' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . 'star = `<ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star-half-outline"></ion-icon><ion-icon name="star-outline"></ion-icon>`;' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . 'break;' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . '} ' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'case 8: { ' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . 'star = `<ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star-outline"></ion-icon>`;' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . 'break;' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . '} ' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'case 9: { ' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . 'star = `<ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star-half-outline"></ion-icon>`;' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . 'break;' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . '} ' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'case 10: { ' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . 'star = `<ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon>`;' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . 'break;' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . '} ' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'default: { ' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . 'break; ' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . '} ' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . '} ' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'return star;' . "\r\n";
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* ProductsBy' . ucwords($name) . 'Page.ngOnInit()' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'public ngOnInit(){' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.dataProducts = [];' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.pageNumber = 1;' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.getProducts(true);' . "\r\n";
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= createBadge("products-by-" . $name);
        //generate page code
        $db->savePage($newPage);
    }
    createProductPage('category');
    createProductPage('tag');
    // TODO: ----------------------------------------------------------------------------------------------------
    // TODO: GENERATOR --|-- PAGE --|-- PRODUCTS-DETAIL
    $newPage = null;
    $newPage['title'] = '{{ dataProduct.name }}';
    $newPage['name'] = 'product-detail';
    $newPage['code-by'] = 'woocommerce';
    $newPage['icon-left'] = 'wine-outline';
    $newPage['statusbar']['style'] = 'lightcontent';
    $newPage['statusbar']['backgroundcolor'] = $db->getRawColorLevel($addons['page-header-color']);
    $newPage['icon-right'] = '';
    $newPage['header']['color'] = $addons['page-header-color'];
    $newPage['content']['color'] = 'none';
    $newPage['content']['custom-color'] = '#ffffff';
    $newPage['content']['background'] = $addons['page-content-background'];
    $newPage['param'] = 'product_id';
    $newPage['content']['disable-ion-content'] = false;
    $newPage['content']['enable-fullscreen'] = false;
    $newPage['back-button'] = '/';
    $newPage['header']['mid']['type'] = 'title';
    $newPage['header']['mid']['items'][0]['label'] = 'Tab 1';
    $newPage['header']['mid']['items'][0]['value'] = 'tab1';
    $newPage['header']['mid']['items'][1]['label'] = 'Tab 2';
    $newPage['header']['mid']['items'][1]['value'] = 'tab2';
    $newPage['header']['mid']['items'][2]['label'] = 'Tab 3';
    $newPage['header']['mid']['items'][2]['value'] = 'tab3';
    $newPage['header']['mid']['type'] = 'custom-header';
    $newPage['header']['mid']['custom-code'] = null;
    $newPage['header']['mid']['custom-code'] .= "\t" . '<ion-header page-product-detail-header class="page-product-detail-header">' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t" . '<ion-toolbar color="' . $addons['page-header-color'] . '">' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t" . '<ion-buttons slot="start">' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '<ion-menu-button></ion-menu-button>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '<ion-back-button defaultHref="home"></ion-back-button>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t" . '</ion-buttons>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t" . '<ion-title>{{ dataProduct.name }}</ion-title>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t" . '<ion-buttons slot="end">' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '<ion-button [routerDirection]="\'forward\'" [routerLink]="[\'/cart\']">' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t\t" . '<ion-icon name="cart"></ion-icon>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t\t" . '<ion-badge *ngIf="count_cart!=0" color="danger">{{ count_cart }}</ion-badge>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '</ion-button>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '<ion-button (click)="showPopover($event)">' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t\t" . '<ion-icon name="ellipsis-vertical-outline"></ion-icon>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '</ion-button>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t" . '</ion-buttons>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t" . '</ion-toolbar>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t" . '</ion-header>' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- PRODUCTS-DETAIL --+-- MODULES
    $z = 0;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'Observable';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = 'rxjs';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'WoocommerceService';
    $newPage['modules']['angular'][$z]['var'] = 'woocommerceService';
    $newPage['modules']['angular'][$z]['path'] = './../../services/woocommerce/woocommerce.service';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'LoadingController';
    $newPage['modules']['angular'][$z]['var'] = 'loadingController';
    $newPage['modules']['angular'][$z]['path'] = '@ionic/angular';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'ToastController';
    $newPage['modules']['angular'][$z]['var'] = 'toastController';
    $newPage['modules']['angular'][$z]['path'] = '@ionic/angular';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'AlertController';
    $newPage['modules']['angular'][$z]['var'] = 'alertController';
    $newPage['modules']['angular'][$z]['path'] = '@ionic/angular';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'StorageService';
    $newPage['modules']['angular'][$z]['var'] = 'storageService';
    $newPage['modules']['angular'][$z]['path'] = './../../services/storage/storage.service';
    // TODO: GENERATOR --|-- PAGE --|-- PRODUCTS-DETAIL --+-- HTML
    $newPage['content']['html'] = null;
    $newPage['content']['html'] .= "" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-list-header *ngIf="dataProduct && dataProduct.name">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-text color="' . $addons['page-header-color'] . '">' . $addons['label-for-product'] . '</ion-text>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-list-header>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-card *ngIf="dataProduct && dataProduct.name">' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";

    $previewAnyFile = ' imageZoom src="{{ item[\'src\'] }}" ';
    if (isset($current_app['directives']['preview-any-file']['var']))
    {
        $previewAnyFile = 'previewAnyFile src="{{ item[\'src\'] }}" ';
    }
 

    $newPage['content']['html'] .= "\t\t" . '<ion-slides pager="true" *ngIf="dataProduct.images && dataProduct.images[0] && dataProduct.images[0][\'src\']" >' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-slide *ngFor="let item of dataProduct.images | slice:0:5" [ngStyle]="{\'background-image\':\'url(\' + item[\'src\'] + \')\',\'background-size\':\'cover\',\'background-position\':\'center center\'}" ' . $previewAnyFile . '>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<div class="slide-container ratio-1x1"></div>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-slides>' . "\r\n";
    
    
    //$newPage['content']['html'] .= "\t\t" . '<ion-slides pager="true" *ngIf="dataProduct.images && dataProduct.images[0] && dataProduct.images[0].src" >' . "\r\n";
    //$newPage['content']['html'] .= "\t\t\t" . '<ion-slide *ngFor="let item of dataProduct.images | slice:0:5">' . "\r\n";
    //$newPage['content']['html'] .= "\t\t\t\t" . '<ion-img *ngIf="item && item.src" src="{{ item.src }}" ' . $previewAnyFile . '></ion-img>' . "\r\n";
    //$newPage['content']['html'] .= "\t\t\t" . '</ion-slide>' . "\r\n";
    //$newPage['content']['html'] .= "\t\t" . '</ion-slides>' . "\r\n";
    
    
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-header [ngStyle]="{\'padding-bottom\':0}">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-title *ngIf="dataProduct.name" [innerHTML]="dataProduct.name"></ion-card-title>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-subtitle><ion-text color="warning" title="{{ dataProduct.average_rating }}" color="warning" [innerHTML]="ratingRendered(dataProduct.average_rating) | trustHtml"></ion-text>({{ dataProduct.rating_count }})</ion-card-subtitle>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-list>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label color="danger" *ngIf="dataProduct.name" [innerHTML]="dataProduct.price_html"></ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-button *ngIf="!wishlist" fill="outline" color="danger" (click)="addToWishlist()" slot="end">+ <ion-icon name="heart"></ion-icon></ion-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-button *ngIf="wishlist" fill="solid" color="danger" (click)="removeWishlist()" slot="end"><ion-icon name="heart"></ion-icon></ion-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-list>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-content [innerHTML]="dataProduct.description | trustHtml"></ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- PRODUCTS-DETAIL --+-- HTML --+-- ADDITIONAL INFORMATION
    
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-header [ngStyle]="{\'padding-bottom\':0}">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-subtitle>' . $addons['label-for-additional-information'] . '</ion-card-subtitle>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-card-header>' . "\r\n";
    
    $newPage['content']['html'] .= "\t\t\t" . '<ion-list>' . "\r\n";
    
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item *ngIf="dataProduct.dimensions.width">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label>' . $addons['label-for-dimensions'] . '</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-note slot="end" color="primary">{{ dataProduct.dimensions.length }} x {{ dataProduct.dimensions.width }} x {{ dataProduct.dimensions.height }} cm</ion-note>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item *ngIf="dataProduct.weight">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label>' . $addons['label-for-weight'] . '</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-note slot="end" color="secondary">{{ dataProduct.weight }} kg</ion-note>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item *ngIf="dataProduct.stock_status">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label>' . $addons['label-for-status'] . '</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-note slot="end" color="tertiary">{{ dataProduct.stock_status }}</ion-note>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item *ngIf="dataProduct.shipping_class">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label>' . $addons['label-for-shipping'] . '</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-note slot="end" color="danger">{{ dataProduct.shipping_class }}</ion-note>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    
    
    $newPage['content']['html'] .= "\t\t" . '</ion-list>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- PRODUCTS-DETAIL --+-- HTML --+-- TAGS
    $newPage['content']['html'] .= "\t\t" . '<ion-card-content *ngIf="dataProduct.categories && dataProduct.tags[0]" >' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-text [ngStyle]="{\'padding-right\':\'0.3em\'}" color="' . $addons['page-header-color'] . '" *ngFor="let tag of dataProduct.tags" [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'products-by-tag\',tag.id]">#{{ tag.name }}</ion-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- PRODUCTS-DETAIL --+-- HTML --+-- CATEGORIES
    $newPage['content']['html'] .= "\t\t" . '<ion-card-content *ngIf="dataProduct.categories && dataProduct.categories[0]" >' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-chip outline color="' . $addons['page-header-color'] . '" *ngFor="let cat of dataProduct.categories" [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'products-by-category\',cat.id]">{{ cat.name }}</ion-chip>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-card *ngIf="!dataProduct || !dataProduct.name">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-img src="assets/images/placeholder-480x480.png"></ion-img>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-title><ion-skeleton-text animated style="width: 80%"></ion-skeleton-text></ion-card-title>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-subtitle><ion-text color="warning" color="warning"><ion-skeleton-text animated style="width: 25%"></ion-skeleton-text></ion-text></ion-card-subtitle>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-title><ion-skeleton-text animated style="width: 100%"></ion-skeleton-text></ion-card-title>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-title><ion-skeleton-text animated style="width: 100%"></ion-skeleton-text></ion-card-title>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-title><ion-skeleton-text animated style="width: 80%"></ion-skeleton-text></ion-card-title>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-title><ion-skeleton-text animated style="width: 100%"></ion-skeleton-text></ion-card-title>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-title><ion-skeleton-text animated style="width: 100%"></ion-skeleton-text></ion-card-title>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-title><ion-skeleton-text animated style="width: 70%"></ion-skeleton-text></ion-card-title>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-title><ion-skeleton-text animated style="width: 100%"></ion-skeleton-text></ion-card-title>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-title><ion-skeleton-text animated style="width: 80%"></ion-skeleton-text></ion-card-title>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<!-- categories -->' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- PRODUCTS-DETAIL --+-- HTML --+-- SLIDES CATEGORIES
    $newPage['content']['html'] .= "\t" . '<ion-list-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-text color="' . $addons['page-header-color'] . '">' . $addons['label-for-categories'] . '</ion-text>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-list-header>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-slides class="categories" *ngIf="dataCategories.length != 0" [options]="{slidesPerView:4}">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-slide *ngFor="let cat of dataCategories" >' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<div [routerDirection]="\'root\'" [routerLink]="[\'/\',\'products-by-category\',cat.id]">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card *ngIf="cat.image && cat.image.src">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-card-header  class="ratio-1x1" [ngStyle]="{\'background-image\':\'url(\' + cat.image.src + \')\',\'background-size\':\'cover\',\'background-position\':\'center\'}"></ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-card-content>{{ cat.name }}</ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card *ngIf="!cat.image || !cat.image.src">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-card-header  class="ratio-1x1" [ngStyle]="{\'background-image\':\'url(\\\'assets/images/placeholder-480x480.png\\\')\',\'background-size\':\'cover\',\'background-position\':\'center\'}"></ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-card-content>{{ cat.name }}</ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</div>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-slides>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-slides class="categories" *ngIf="dataCategories.length == 0" [options]="{slidesPerView:4}">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-header  class="ratio-1x1" [ngStyle]="{\'background-image\':\'url(\\\'assets/images/placeholder-480x480.png\\\')\',\'background-size\':\'cover\',\'background-position\':\'center\'}"></ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-content><ion-skeleton-text animated style="width: 76%"></ion-skeleton-text></ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-header  class="ratio-1x1" [ngStyle]="{\'background-image\':\'url(\\\'assets/images/placeholder-480x480.png\\\')\',\'background-size\':\'cover\',\'background-position\':\'center\'}"></ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-content><ion-skeleton-text animated style="width: 88%"></ion-skeleton-text></ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-header  class="ratio-1x1" [ngStyle]="{\'background-image\':\'url(\\\'assets/images/placeholder-480x480.png\\\')\',\'background-size\':\'cover\',\'background-position\':\'center\'}"></ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-content><ion-skeleton-text animated style="width: 48%"></ion-skeleton-text></ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-header  class="ratio-1x1" [ngStyle]="{\'background-image\':\'url(\\\'assets/images/placeholder-480x480.png\\\')\',\'background-size\':\'cover\',\'background-position\':\'center\'}"></ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-content><ion-skeleton-text animated style="width: 98%"></ion-skeleton-text></ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-header  class="ratio-1x1" [ngStyle]="{\'background-image\':\'url(\\\'assets/images/placeholder-480x480.png\\\')\',\'background-size\':\'cover\',\'background-position\':\'center\'}"></ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-content><ion-skeleton-text animated style="width: 38%"></ion-skeleton-text></ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-header  class="ratio-1x1" [ngStyle]="{\'background-image\':\'url(\\\'assets/images/placeholder-480x480.png\\\')\',\'background-size\':\'cover\',\'background-position\':\'center\'}"></ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-content><ion-skeleton-text animated style="width: 48%"></ion-skeleton-text></ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-slides>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<!-- ./categories -->' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- PRODUCTS-DETAIL --+-- HTML --+-- SOCIAL SHARE
    $newPage['content']['html'] .= "\t" . '<!-- social-share -->' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-fab *ngIf="dataProduct.permalink" vertical="bottom" horizontal="end" slot="fixed">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-fab-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-icon name="share-social"></ion-icon>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-fab-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-fab-list side="start">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-fab-button color="primary" facebookApp [url]="dataProduct.permalink">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-icon name="logo-facebook"></ion-icon>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-fab-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-fab-button color="secondary" *ngIf="dataProduct.name" twitterApp message="{{ dataProduct.name | stripTags }} - {{ dataProduct.permalink }}">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-icon name="logo-twitter"></ion-icon>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-fab-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-fab-button color="success" *ngIf="dataProduct.name" whatsappApp message="{{ dataProduct.name | stripTags }} - {{ dataProduct.permalink}}">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-icon name="logo-whatsapp"></ion-icon>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-fab-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-fab-button color="danger" *ngIf="dataProduct.name" mailApp emailAddress="change@email.com" emailSubject="hi, read this article" emailMessage="{{ dataProduct.name | stripTags }} - {{ dataProduct.permalink }}">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-icon name="mail-open"></ion-icon>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-fab-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-fab-list>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-fab>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<!-- ./social-share -->' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- PRODUCTS-DETAIL --|-- FOOTER
    $newPage['footer']['color'] = 'none';
    $newPage['footer']['type'] = 'code';
    $newPage['footer']['title'] = '';
    $newPage['footer']['code'] = null;
    $newPage['footer']['code'] .= "\t" . '<ion-footer *ngIf="dataProduct && dataProduct.name">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t" . '<ion-grid>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-row>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-col size="2">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-button color="medium" contactUs title="' . $addons['label-for-contact-us'] . '" phone="' . $addons['contact-call'] . '" phone="' . $addons['contact-call'] . '" sms="' . $addons['contact-sms'] . '" whatsapp="' . $addons['contact-whatsapp'] . '" email="' . $addons['contact-email'] . '" message="{{ dataProduct.name }}" size="small" fill="outline" expand="block" >' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t\t" . '<ion-icon slot="icon-only" name="chatbox-ellipses"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '</ion-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-col size="4">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-button (click)="buyNow()" size="small" fill="outline" expand="block" color="' . $addons['page-header-color'] . '">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t\t" . '<ion-label>' . $addons['label-for-buy'] . '</ion-label>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '</ion-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-col size="6">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-button (click)="addToCart()" size="small" fill="solid" expand="block" color="' . $addons['page-header-color'] . '">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t\t" . '<ion-icon slot="start" name="add-circle"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t\t" . '<ion-label>' . $addons['label-for-add-to-cart'] . '</ion-label>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '</ion-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-row>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t" . '</ion-grid>' . "\r\n";
    $newPage['footer']['code'] .= "\t" . '</ion-footer>' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- PRODUCTS-DETAIL --+-- SCSS
    $newPage['content']['scss'] = null;
    $newPage['content']['scss'] .= "\t" . 'ion-slide {background-size:cover; display:block !important; min-height:150px}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-slide .ratio-1x1 {width: 100%;padding-top: 100%; position: relative;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-slide .ratio-16x9 {width: 100%;padding-top: 56.25%; position: relative;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-slide .ratio-4x3 {width: 100%;padding-top: 75%; position: relative;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-slide .ratio-3x2 {width: 100%;padding-top: 66.66%; position: relative;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-slide .ratio-8x5 {width: 100%;padding-top: 62.5%; position: relative;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-slide > h2{padding-top:1em;padding-left:1em;padding-right:1em;padding-bottom:0;color: #fff;text-shadow: 1px 1px 1px #777;opacity: .9;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-slide > p{padding-top:0;padding-left:1em;color: #fff;opacity: .9;padding-right:1.8rem;text-shadow: 1px 1px 1px #777;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '.categories ion-card-header+.card-content-ios {font-size:80% !important;padding: 3px !important;text-overflow: ellipsis !important;white-space: nowrap !important;overflow: hidden !important;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '.categories ion-card-header+.card-content-md {font-size:80% !important;padding: 3px !important;text-overflow: ellipsis !important;white-space: nowrap !important;overflow: hidden !important;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-list-header{padding-left: 0.5em;margin-top: .5em;font-variant: petite-caps;padding-top: 0;padding-bottom:0;font-size: 1.2em;background-color: #fff;opacity:0.9;font-weight: 600;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-list-header ion-text{padding-top: 0.5em;padding-bottom: 0.5em;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-card{margin: 0.5em;}' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- PRODUCTS-DETAIL --+-- OTHER
    $newPage['code']['init'] = null;
    $newPage['code']['export'] = null;
    $newPage['code']['constructor'] = null;
    $newPage['code']['constructor'] .= "\t\t" . 'this.isWishlist();' . "\r\n";
    $newPage['code']['constructor'] .= "\t\t" . '//badge for wishlist and cart' . "\r\n";
    $newPage['code']['constructor'] .= "\t\t" . 'this.createBadge();' . "\r\n";
    $newPage['code']['constructor'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] = null;
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '//init' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'product: Observable<any>;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataProduct: any = {};' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'wishlist:any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'currency:string = "USD";' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '// categories' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'categories: Observable<any>;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataCategories: any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- PRODUCTS-DETAIL --|-- TS --|-- getProduct()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ProductDetailPage.getProduct(productId)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public getProduct(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.product = this.woocommerceService.getProduct(this.productId);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.product.subscribe(data => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.dataProduct = data ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- PRODUCTS-DETAIL --|-- TS --|-- doRefresh()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ProductDetailPage.doRefresh()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public doRefresh(refresher){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataProduct = {};' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getProduct();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '// categories' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataCategories = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getCategories();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'refresher.target.complete();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}, 2000);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- PRODUCTS-DETAIL --|-- TS --|-- showDialog()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ProductDetailPage.showDialog()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'async showDialog(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'const alert = await this.alertController.create({' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'header: `' . $addons['label-for-ordering-information'] . '`,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'subHeader: this.dataProduct.name,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'message: this.dataProduct.price_html,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'inputs:[' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'name: "qty",' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'id: "qty",' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'type: "number",' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'min: "1",' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'value: "1",' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'placeholder: "' . $addons['label-for-quantity'] . '"' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '},' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'name: "note",' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'id: "note",' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'type: "textarea",' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'value: "",' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'placeholder: "Optional, eg: XXL"' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'buttons:[' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'text: `' . $addons['label-for-cancel'] . '`,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'role: "cancel",' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'cssClass: "secondary",' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'handler: () => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . 'console.log("Confirm Cancel");' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '},' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'text: `' . $addons['label-for-ok'] . '`,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'handler: (form_input) => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . 'let product_id : string = this.dataProduct.id ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . 'let product_name : string = this.dataProduct.name ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . 'let product_price : string = this.dataProduct.price ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . 'let product_price_html : string = this.dataProduct.price_html ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . 'let product_image : string = this.dataProduct.images[0].src;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . 'let product_qty : string = form_input.qty ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . 'let product_note : string = form_input.note ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . 'let val = {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t\t" . 'id : product_id,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t\t" . 'name : product_name,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t\t" . 'image : product_image,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t\t" . 'qty : product_qty,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t\t" . 'price_html : product_price_html,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t\t" . 'note : product_note,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t\t" . 'price : product_price' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . '};' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . 'let key = product_id ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . 'this.setItem(`cart`,key,val);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . 'console.log("Confirm Ok",val);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . 'this.showToast(`' . $addons['label-for-added-to-your-cart'] . '`);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . ']' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'await alert.present();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- PRODUCTS-DETAIL --|-- TS --|-- getItem()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ProductDetailPage.getItem(table:string,key:string)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public async getItem(table:string,key:string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storage.get(`${table}:${key}`).then((val) => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.wishlist = val;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- PRODUCTS-DETAIL --|-- TS --|-- setItem()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ProductDetailPage.setItem(table:string,key:string,val:any)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public async setItem(table:string,key:string,value:any){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'return await this.storage.set(`${table}:${key}`,value);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- PRODUCTS-DETAIL --|-- TS --|-- removeItem()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ProductDetailPage.removeItem(table:string,key:string)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public async removeItem(table:string,key:string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'return await this.storage.remove(`${table}:${key}`);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- PRODUCTS-DETAIL --|-- TS --|-- addToCart()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ProductDetailPage.addToCart()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'addToCart(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.showDialog();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- PRODUCTS-DETAIL --|-- TS --|-- buyNow()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ProductDetailPage.buyNow()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'buyNow(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let val = {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'id : this.dataProduct.id,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'name : this.dataProduct.name,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'image : this.dataProduct.images[0].src,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'price : this.dataProduct.price,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'price_html : this.dataProduct.price_html,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'qty : 1,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'note : ``,' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '};' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let key = this.dataProduct.id ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.setItem(`cart`,key,val);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'console.log("buyNow",val);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.router.navigate(["/cart"]);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- PRODUCTS-DETAIL --|-- TS --|-- addToWishlist()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ProductDetailPage.addToWishlist()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'addToWishlist(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let key = this.dataProduct.id ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let val = this.dataProduct;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.setItem(`wishlist`,key,val);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- PRODUCTS-DETAIL --|-- TS --|-- removeWishlist()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ProductDetailPage.removeWishlist()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'removeWishlist(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let key = this.dataProduct.id ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.removeItem(`wishlist`,key);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- PRODUCTS-DETAIL --|-- TS --|-- isWishlist()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ProductDetailPage.isWishlist()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'runWishlist:any;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'isWishlist(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.runWishlist = setInterval(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if(this.dataProduct.id){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'let key = this.dataProduct.id ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.getItem(`wishlist`,key);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '//console.log("is_wishlist",this.wishlist);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '},1000);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- PRODUCTS-DETAIL --|-- TS --|-- ionViewDidLeave()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ProductDetailPage.ionViewDidLeave()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'ionViewDidLeave(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'clearInterval(this.runWishlist);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'clearInterval(this.runBadge);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ProductDetailPage.showToast($message)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'async showToast(message: string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'const toast = await this.toastController.create({' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'position: "bottom",' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'color: "' . $addons['page-header-color'] . '",' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'duration: 500' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'await toast.present();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- PRODUCTS-DETAIL --|-- TS --|-- ProductDetailPage()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ProductDetailPage.ratingRendered()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'ratingRendered(rate:string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let rate_dec =   (parseFloat(rate) * 2) ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let rate_number = Math.round(rate_dec);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let star = `<ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon>`;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'switch(rate_number){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'case 0: {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'star = `<ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon>`;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'break;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'case 1: {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'star = `<ion-icon name="star-half-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon>`;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'break;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'case 2: {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '	star = `<ion-icon name="star"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon>`;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'break;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'case 3: {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'star = `<ion-icon name="star"></ion-icon><ion-icon name="star-half-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon>`;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'break;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'case 4: {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'star = `<ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon>`;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'break;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'case 5: {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'star = `<ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star-half-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon>`;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'break;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'case 6: {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'star = `<ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon>`;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'break;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'case 7: { ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'star = `<ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star-half-outline"></ion-icon><ion-icon name="star-outline"></ion-icon>`;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'break;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '} ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'case 8: { ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'star = `<ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star-outline"></ion-icon>`;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'break;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '} ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'case 9: { ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'star = `<ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star-half-outline"></ion-icon>`;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'break;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '} ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'case 10: { ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'star = `<ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon>`;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'break;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '} ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'default: { ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'break; ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '} ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '} ' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'return star;' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- PRODUCTS-DETAIL --|-- TS --|-- ngOnInit()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ProductDetailPage.ngOnInit()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public ngOnInit(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataProduct = {};' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getProduct();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '// categories' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataCategories = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getCategories();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- PRODUCTS-DETAIL --|-- TS --|-- getCategories()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ProductDetailPage.getCategories()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'getCategories(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.categories = this.' . $varUserServiceName . '.getCategories({per_page:100});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.categories.subscribe(data => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.dataCategories = data ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= createBadge("product-detail", true);
    //generate page code
    $db->savePage($newPage);
    // TODO: ----------------------------------------------------------------------------------------------------
    // TODO: GENERATOR --|-- PAGE --|--  WISHLIST
    $newPage = null;
    $newPage['title'] = $addons['label-for-wishlist'];
    $newPage['name'] = "wishlist";
    $newPage['code-by'] = 'woocommerce';
    $newPage['icon-left'] = 'heart-circle';
    $newPage['statusbar']['style'] = 'lightcontent';
    $newPage['statusbar']['backgroundcolor'] = $db->getRawColorLevel($addons['page-header-color']);
    $newPage['icon-right'] = '';
    $newPage['header']['color'] = $addons['page-header-color'];
    $newPage['content']['color'] = 'none';
    $newPage['content']['custom-color'] = '#ffffff';
    $newPage['content']['background'] = $addons['page-content-background'];
    // TODO: GENERATOR --|-- PAGE --|--  WISHLIST --|-- HEADER
    $newPage['header']['mid']['type'] = 'title';
    $newPage['header']['mid']['items'][0]['label'] = 'Tab 1';
    $newPage['header']['mid']['items'][0]['value'] = 'tab1';
    $newPage['header']['mid']['items'][1]['label'] = 'Tab 2';
    $newPage['header']['mid']['items'][1]['value'] = 'tab2';
    $newPage['header']['mid']['items'][2]['label'] = 'Tab 3';
    $newPage['header']['mid']['items'][2]['value'] = 'tab3';
    // TODO: GENERATOR --|-- PAGE --|--  WISHLIST --|-- MODULES
    $z = 0;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'Observable';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = 'rxjs';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'StorageService';
    $newPage['modules']['angular'][$z]['var'] = 'storageService';
    $newPage['modules']['angular'][$z]['path'] = './../../services/storage/storage.service';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'LoadingController';
    $newPage['modules']['angular'][$z]['var'] = 'loadingController';
    $newPage['modules']['angular'][$z]['path'] = '@ionic/angular';
    // TODO: GENERATOR --|-- PAGE --|--  WISHLIST --|-- CONTENT --|-- HTML
    $newPage['content']['html'] = null;
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-list class="empty-products-container" lines="none" *ngIf="dataWishLists.length == 0">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-label class="empty-products-wrapper">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-icon name="heart-outline"></ion-icon>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<h3>' . $addons['label-for-no-products-found'] . '</h3>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-list>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-list-header *ngIf="dataWishLists.length != 0">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-text color="' . $addons['page-header-color'] . '">' . $addons['label-for-products-in-your-wishlist'] . '</ion-text>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-list-header>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-card *ngIf="dataWishLists.length != 0">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-item-sliding *ngFor="let item of dataWishLists">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'product-detail\',item.id]">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-thumbnail slot="start">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-img *ngIf="item.images && item.images[0] && item.images[0].src" [src]="item.images[0].src"></ion-img>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-thumbnail>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<h3 *ngIf="item.name" [innerHTML]="item.name"></h3>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-text color="danger" *ngIf="item.name" [innerHTML]="item.price_html"></ion-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-note color="warning" slot="end"><ion-text title="{{ item.average_rating }}" color="warning" [innerHTML]="ratingRendered(item.average_rating) | trustHtml"></ion-text></ion-note>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item-options side="end">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-item-option color="danger" (click)="removeWishlist(item.id)">' . $addons['label-for-delete'] . '</ion-item-option>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item-options>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item-options side="start" >' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-item-option color="primary" [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'product-detail\',item.id]">' . $addons['label-for-detail'] . '</ion-item-option>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item-options>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-item-sliding>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-item lines="none">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-button fill="outline" (click)="clearWishlist()" slot="end" color="danger"><ion-icon name="reload-circle"></ion-icon> ' . $addons['label-for-clean-up'] . '</ion-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  WISHLIST --|-- CONTENT --|-- SCSS
    $newPage['content']['scss'] = null;
    $newPage['content']['scss'] .= "\t" . '.empty-products-container{height: 100%;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '.empty-products-wrapper{text-align: center;padding-top: 50%;font-size: 72px;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '.empty-products-wrapper h3{font-variant-caps: petite-caps;font-size: 18px;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-list-header{margin-top: .5em;font-variant: petite-caps;padding-top: 0;padding-bottom:0;font-size: 1.2em;background-color: #fff;opacity:0.9;font-weight: 600;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-list-header{margin-top: .5em;font-variant: petite-caps;padding-top: 0;padding-bottom:0;font-size: 1.2em;background-color: #fff;opacity:0.9;font-weight: 600;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-list-header ion-text{padding-top: 0.5em;padding-bottom: 0.5em;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-list{opacity:0.9;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-card{opacity:0.9; padding-top:1em; margin-top: 0.5em;}' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  WISHLIST --|-- FOOTER
    $newPage['footer']['color'] = 'none';
    $newPage['footer']['type'] = 'code';
    $newPage['footer']['title'] = '';
    $newPage['footer']['code'] = null;
    //$newPage['footer']['code'] .= "\t" . '<ion-footer>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t" . '<ion-toolbar>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t" . '<ion-tabs>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-tab-bar slot="bottom">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-tab-button [routerDirection]="\'root\'" [routerLink]="[\'/home\']">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-home'] . '</ion-label>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="home-outline"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-tab-button [routerDirection]="\'root\'" [routerLink]="[\'/products-by-category/0\']">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-products'] . '</ion-label>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="wine-outline"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-tab-button disabled="true" [routerDirection]="\'root\'" [routerLink]="[\'/wishlist\']">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-wishlist'] . '</ion-label>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="heart-circle"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-badge *ngIf="count_wishlist!=0" color="danger">{{ count_wishlist }}</ion-badge>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-tab-button [routerDirection]="\'root\'" [routerLink]="[\'/cart\']">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-cart'] . '</ion-label>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="cart-outline"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-badge *ngIf="count_cart!=0" color="danger">{{ count_cart }}</ion-badge>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-tab-button [routerDirection]="\'root\'" [routerLink]="[\'/account\']">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-account'] . '</ion-label>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="person-outline"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-tab-bar>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t" . '</ion-tabs>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t" . '</ion-toolbar>' . "\r\n";
    //$newPage['footer']['code'] .= "\t" . '</ion-footer>' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  WISHLIST --|-- CODE --|-- OTHER
    $newPage['code']['export'] = null;
    $newPage['code']['constructor'] = null;
    $newPage['code']['constructor'] .= "\t\t" . '//badge for wishlist and cart' . "\r\n";
    $newPage['code']['constructor'] .= "\t\t" . 'this.createBadge();' . "\r\n";
    $newPage['code']['constructor'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] = null;
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataWishLists : any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'loading:any;' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  WISHLIST --|-- CODE --|-- OTHER --|-- ngOnInit()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* WishlistPage.ngOnInit()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public ngOnInit(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storageService.getItems(`wishlist`).then((items)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.dataWishLists = items;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  WISHLIST --|-- CODE --|-- OTHER --|-- presentLoading()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* WishlistPage.presentLoading()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'async presentLoading() {' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.loading = await this.loadingController.create({' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'message: "' . $addons['label-for-please-wait'] . '",' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'spinner: "crescent",' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'duration: 2000' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'await this.loading.present();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  WISHLIST --|-- CODE --|-- OTHER --|-- dismissLoading()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* WishlistPage.dismissLoading()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'async dismissLoading() {' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'if(this.loading){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'await this.loading.dismiss();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  WISHLIST --|-- CODE --|-- OTHER --|-- removeWishlist()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* WishlistPage.removeWishlist()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public removeWishlist(id:string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storageService.removeItem(`wishlist`,id).then((items)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.presentLoading();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.storageService.getItems(`wishlist`).then((items)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.dataWishLists = items;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}, 1000);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  WISHLIST --|-- CODE --|-- OTHER --|-- clearWishlist()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* WishlistPage.clearWishlist()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public clearWishlist(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storageService.clearItems(`wishlist`).then((items)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.presentLoading();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.storageService.getItems(`wishlist`).then((items)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.dataWishLists = items;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}, 1000);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* WishlistPage.ratingRendered()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'ratingRendered(rate:string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let rate_dec =   (parseFloat(rate) * 2) ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let rate_number = Math.round(rate_dec);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let star = `<ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon>`;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'switch(rate_number){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'case 0: {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'star = `<ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon>`;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'break;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'case 1: {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'star = `<ion-icon name="star-half-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon>`;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'break;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'case 2: {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '	star = `<ion-icon name="star"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon>`;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'break;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'case 3: {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'star = `<ion-icon name="star"></ion-icon><ion-icon name="star-half-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon>`;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'break;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'case 4: {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'star = `<ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon>`;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'break;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'case 5: {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'star = `<ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star-half-outline"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon>`;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'break;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'case 6: {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'star = `<ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star-outline"></ion-icon><ion-icon name="star-outline"></ion-icon>`;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'break;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'case 7: { ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'star = `<ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star-half-outline"></ion-icon><ion-icon name="star-outline"></ion-icon>`;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'break;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '} ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'case 8: { ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'star = `<ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star-outline"></ion-icon>`;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'break;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '} ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'case 9: { ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'star = `<ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star-half-outline"></ion-icon>`;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'break;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '} ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'case 10: { ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'star = `<ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon>`;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'break;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '} ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'default: { ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'break; ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '} ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '} ' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'return star;' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  WISHLIST --|-- CODE --|-- OTHER --|-- doRefresh()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* WishlistPage.doRefresh()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public doRefresh(refresher){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storageService.getItems(`wishlist`).then((items)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.dataWishLists = items;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'refresher.target.complete();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}, 2000);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= createBadge("wishlist");
    $newPage['code']['init'] = null;
    //generate page code
    $db->savePage($newPage);
    // TODO: ----------------------------------------------------------------------------------------------------
    // TODO: GENERATOR --|-- PAGE --|--  CART
    $newPage = null;
    $newPage['title'] = $addons['label-for-cart'];
    $newPage['name'] = "cart";
    $newPage['code-by'] = 'woocommerce';
    $newPage['statusbar']['style'] = 'lightcontent';
    $newPage['statusbar']['backgroundcolor'] = $db->getRawColorLevel($addons['page-header-color']);
    $newPage['icon-left'] = 'cart-outline';
    $newPage['icon-right'] = '';
    $newPage['header']['color'] = $addons['page-header-color'];
    $newPage['content']['color'] = 'none';
    $newPage['content']['custom-color'] = '#ffffff';
    $newPage['content']['background'] = $addons['page-content-background'];
    // TODO: GENERATOR --|-- PAGE --|--  CART --|-- HEADER
    $newPage['header']['mid']['type'] = 'title';
    $newPage['header']['mid']['items'][0]['label'] = 'Tab 1';
    $newPage['header']['mid']['items'][0]['value'] = 'tab1';
    $newPage['header']['mid']['items'][1]['label'] = 'Tab 2';
    $newPage['header']['mid']['items'][1]['value'] = 'tab2';
    $newPage['header']['mid']['items'][2]['label'] = 'Tab 3';
    $newPage['header']['mid']['items'][2]['value'] = 'tab3';
    // TODO: GENERATOR --|-- PAGE --|--  CART --|-- MODULES
    $z = 0;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'Observable';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = 'rxjs';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'WoocommerceService';
    $newPage['modules']['angular'][$z]['var'] = 'woocommerceService';
    $newPage['modules']['angular'][$z]['path'] = './../../services/woocommerce/woocommerce.service';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'StorageService';
    $newPage['modules']['angular'][$z]['var'] = 'storageService';
    $newPage['modules']['angular'][$z]['path'] = './../../services/storage/storage.service';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'LoadingController';
    $newPage['modules']['angular'][$z]['var'] = 'loadingController';
    $newPage['modules']['angular'][$z]['path'] = '@ionic/angular';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'ToastController';
    $newPage['modules']['angular'][$z]['var'] = 'toastController';
    $newPage['modules']['angular'][$z]['path'] = '@ionic/angular';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'AlertController';
    $newPage['modules']['angular'][$z]['var'] = 'alertController';
    $newPage['modules']['angular'][$z]['path'] = '@ionic/angular';
    // TODO: GENERATOR --|-- PAGE --|--  CART --|-- CONTENT --|-- HTML
    $newPage['content']['html'] = null;
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-list class="empty-products-container" lines="none" *ngIf="dataProductsInCart.length == 0">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-label class="empty-products-wrapper">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-icon class="empty-products-icon" name="cart-outline"></ion-icon>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<h3>' . $addons['label-for-no-products-found'] . '</h3>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-button [routerDirection]="\'root\'" [routerLink]="[\'/products-by-category/0\']" color="' . $addons['page-header-color'] . '">' . $addons['label-for-continue-shopping'] . '</ion-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-list>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-list-header *ngIf="dataProductsInCart.length != 0">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-text color="' . $addons['page-header-color'] . '">' . $addons['label-for-products-in-your-cart'] . '</ion-text>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-list-header>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-card *ngIf="dataProductsInCart.length != 0">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-item-sliding size-sm *ngFor="let item of dataProductsInCart">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-thumbnail slot="start">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-img [src]="item.image"></ion-img>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-thumbnail>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<h2 [innerHTML]="item.name"></h2>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<h3>{{ item.qty }} ' . $addons['label-for-item'] . '</h3>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<p class="price" [innerHTML]="item.price_html"></p>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-note slot="end" [innerHTML]="item.note"></ion-note>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item-options side="end">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-item-option color="primary" (click)="editProductInCart(item.id)">' . $addons['label-for-edit'] . '</ion-item-option>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-item-option color="danger" (click)="removeProductInCart(item.id)">' . $addons['label-for-delete'] . '</ion-item-option>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item-options>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item-options side="start" >' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-item-option color="primary" [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'product-detail\',item.id]">' . $addons['label-for-detail'] . '</ion-item-option>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item-options>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-item-sliding>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-item lines="none">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-button fill="outline" (click)="clearCart()" slot="end" color="' . $addons['page-header-color'] . '"><ion-icon name="reload-circle"></ion-icon> ' . $addons['label-for-clean-up'] . '</ion-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";

    $newPage['content']['html'] .= "\t" . '<ion-list-header *ngIf="dataProductsInCart.length != 0">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-text color="' . $addons['page-header-color'] . '">' . $addons['label-for-note'] . '</ion-text>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-list-header>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-card *ngIf="dataProductsInCart.length != 0">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<p class="note">' . $addons['label-for-actual-prices-note'] . '</p>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";

    $newPage['content']['html'] .= "\t" . '<ion-list-header *ngIf="dataProductsInCart.length != 0">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-text color="' . $addons['page-header-color'] . '">' . $addons['label-for-discount'] . '</ion-text>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-list-header>' . "\r\n";


    $newPage['content']['html'] .= "\t" . '<ion-card *ngIf="dataProductsInCart.length != 0">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-item lines="none">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-label position="stacked">' . $addons['label-for-coupon-code'] . '</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-input placeholder="DISCOUNT09" [(ngModel)]="coupon" type="text"></ion-input>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-item lines="none">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-button fill="outline" (click)="applyCoupon()" slot="end" color="' . $addons['page-header-color'] . '"><ion-icon name="reader-outline"></ion-icon> ' . $addons['label-for-apply'] . '</ion-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  CART --|-- CONTENT --|-- SCSS
    $newPage['content']['scss'] = null;
    $newPage['content']['scss'] .= "\t" . '.empty-products-container{height: 100%;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '.empty-products-wrapper{text-align: center;padding-top: 50%;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '.empty-products-icon{font-size: 72px;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '.empty-products-wrapper h3{font-variant-caps: petite-caps;font-size: 18px;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '.estimated-price ion-note{font-size: 14px;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '.price {color:' . $db->getRawColorLevel('danger') . ';font-weight:600}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-list-header{margin-top: .5em;font-variant: petite-caps;padding-top: 0;padding-bottom:0;font-size: 1.2em;background-color: #fff;opacity:0.9;font-weight: 600;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-list-header ion-text{padding-top: 0.5em;padding-bottom: 0.5em;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-list{opacity: 0.9;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-card{opacity:0.9; padding-top:1em; margin-top: 0.5em;}' . "\r\n";


    // TODO: GENERATOR --|-- PAGE --|--  CART --|-- FOOTER
    $newPage['footer']['color'] = 'none';
    $newPage['footer']['type'] = 'code';
    $newPage['footer']['title'] = '';
    $newPage['footer']['code'] = null;
    $newPage['footer']['code'] .= "\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t" . '<ion-grid  *ngIf="dataProductsInCart.length != 0">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t" . '<ion-row>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-col size="5">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-label>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<h4>' . $addons['label-for-total'] . '</h4>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<h2 class="price">{{ priceTotal | currency:currencySymbol }}</h2>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-label>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-col size="2">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-col size="5">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-button expand="block" (click)="saveOrder()" color="danger">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '' . $addons['label-for-checkout'] . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t" . '</ion-row>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t" . '</ion-grid>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t" . '<ion-toolbar>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t" . '<ion-tabs>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-tab-bar slot="bottom">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-tab-button [routerDirection]="\'root\'" [routerLink]="[\'/home\']">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-home'] . '</ion-label>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="home-outline"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-tab-button [routerDirection]="\'root\'" [routerLink]="[\'/products-by-category/0\']">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-products'] . '</ion-label>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="wine-outline"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-tab-button [routerDirection]="\'root\'" [routerLink]="[\'/wishlist\']">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-wishlist'] . '</ion-label>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="heart-circle"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-badge *ngIf="count_wishlist!=0" color="danger">{{ count_wishlist }}</ion-badge>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-tab-button disabled="true" [routerDirection]="\'root\'" [routerLink]="[\'/cart\']">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-cart'] . '</ion-label>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="cart-outline"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-badge *ngIf="count_cart!=0" color="danger">{{ count_cart }}</ion-badge>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-tab-button [routerDirection]="\'root\'" [routerLink]="[\'/account\']">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-account'] . '</ion-label>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="person-outline"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-tab-bar>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t" . '</ion-tabs>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t" . '</ion-toolbar>' . "\r\n";
    //$newPage['footer']['code'] .= "\t" . '</ion-footer>' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  CART --|-- CODE --|-- OTHER
    $newPage['code']['export'] = null;
    $newPage['code']['constructor'] = null;
    $newPage['code']['constructor'] .= "\t\t" . '//badge for wishlist and cart' . "\r\n";
    $newPage['code']['constructor'] .= "\t\t" . 'this.createBadge();' . "\r\n";
    $newPage['code']['constructor'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] = null;
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataProductsInCart : any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'runEstimatedPrice:any;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'loading:any;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'priceTotal:number = 0;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'currencySymbol:string = `USD`;' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'currentCurrencies: Observable<any>;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataCurrentCurrencies: any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataOrder:any = {};' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* CartPage.getCurrencies()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public getCurrencies(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.currentCurrencies = this.woocommerceService.getCurrencies();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.currentCurrencies.subscribe(data => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.dataCurrentCurrencies = data ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.currencySymbol = data.code ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  CART --|-- CODE --|-- OTHER --|-- ngOnInit()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* CartPage.ngOnInit()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public ngOnInit(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storageService.getItems(`cart`).then((items)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.dataProductsInCart = items;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getCurrencies();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.runEstimatedPrice = setInterval(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.estimatedPrice();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}, 1000);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  CART --|-- CODE --|-- OTHER --|-- presentLoading()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* CartPage.presentLoading()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'async presentLoading() {' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.loading = await this.loadingController.create({' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'message: "' . $addons['label-for-please-wait'] . '",' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'spinner: "crescent",' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'duration: 1000' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'await this.loading.present();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  CART --|-- CODE --|-- OTHER --|-- dismissLoading()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* CartPage.dismissLoading()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'async dismissLoading() {' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'if(this.loading){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'await this.loading.dismiss();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  CART --|-- CODE --|-- OTHER --|-- showToast()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* CartPage.showToast($message)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'async showToast(message: string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'const toast = await this.toastController.create({' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'position: "bottom",' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'color: "dark",' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'duration: 500' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'await toast.present();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  CART --|-- CODE --|-- OTHER --|-- estimatedPrice()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* CartPage.estimatedPrice()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public estimatedPrice(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let itemPrices:number = 0;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'for (let item of this.dataProductsInCart){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'let itemPrice:number = item.price * item.qty;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'itemPrices += itemPrice;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.priceTotal = itemPrices;' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  CART --|-- CODE --|-- OTHER --|-- removeProduct()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* CartPage.removeProductInCart(productId)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public removeProductInCart(productId:string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storageService.removeItem(`cart`,productId).then((items)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.presentLoading();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.storageService.getItems(`cart`).then((items)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.dataProductsInCart = items;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}, 1000);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  CART --|-- CODE --|-- OTHER --|-- editProductInCart()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* CartPage.editProductInCart(productId:string)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public editProductInCart(productId:string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storageService.getItem(`cart`,productId).then((dataCart)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.editProductInCartDialog(dataCart);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  CART --|-- CODE --|-- OTHER --|-- editProductInCartDialog(dataCart:any)
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* CartPage.editProductInCartDialog(dataCart:any)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'async editProductInCartDialog(dataCart:any){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'const alert = await this.alertController.create({' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'header: `' . $addons['label-for-ordering-information'] . '`,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'subHeader: dataCart.name,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'message: dataCart.price_html,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'inputs:[' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'name: "qty",' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'id: "qty",' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'type: "number",' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'min: "1",' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'value: dataCart.qty,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'placeholder: "' . $addons['label-for-quantity'] . '"' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '},' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'name: "note",' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'id: "note",' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'type: "textarea",' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'value: dataCart.note,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'placeholder: "Optional, eg: XXL"' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'buttons:[' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'text: `' . $addons['label-for-cancel'] . '`,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'role: "cancel",' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'cssClass: "secondary",' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'handler: () => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . 'console.log("Confirm Cancel");' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '},' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'text: `' . $addons['label-for-ok'] . '`,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'handler: (formInput) => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . 'let val = {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t\t" . 'id : dataCart.id,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t\t" . 'name : dataCart.name,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t\t" . 'image : dataCart.image,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t\t" . 'qty : formInput.qty,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t\t" . 'price_html : dataCart.price_html,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t\t" . 'note : formInput.note,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t\t" . 'price : dataCart.price' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . '};' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . 'let key = dataCart.id ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . 'this.storageService.setItem(`cart`,key,val).then(()=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t\t" . 'this.presentLoading();' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . 'setTimeout(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t\t" . 'this.storageService.getItems(`cart`).then((items)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t\t\t" . 'this.dataProductsInCart = items;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . '}, 1000);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . ']' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'await alert.present();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'newOrder: Observable<any>;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataNewOrder: any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'order:any = {};' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  CART --|-- CODE --|-- OTHER --|-- saveOrder()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* CartPage.saveOrder()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public saveOrder(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let line_items:any = []; ' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataProductsInCart.forEach((val, key, index) => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'line_items.push({' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'product_id : val.id,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'name : val.name,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'price : val.price,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'image : val.image,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'price_html : val.price_html,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'quantity : val.qty,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'meta_data : [' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . '{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . 'key : `Note`,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . 'value : val.note' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . ']' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storageService.setItem(`order`,`line_items`,line_items).then(()=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'console.log(`newOrder`,line_items);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.router.navigate([`/billing`]);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  CART --|-- CODE --|-- OTHER --|-- applyCoupon()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* CartPage.applyCoupon()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'coupon:any = "";' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'coupons: Observable<any>;' . "\r\n";
    //$newPage['code']['other'] .= "\t" . 'dataNewOrder: any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public applyCoupon(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let currentCoupon = this.coupon.toLowerCase();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.coupon = "";' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.coupons = this.woocommerceService.getCoupons();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let isValid:boolean = false;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.coupons.subscribe(data => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'for (let item of data){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'let codeCoupon = item.code ;' . "\r\n";
    if ($is_debug == true)
    {
        $newPage['code']['other'] .= "\t\t\t\t" . 'console.log(`is_coupon?`, `${codeCoupon}=${currentCoupon}`);' . "\r\n";
    }
    $newPage['code']['other'] .= "\t\t\t\t" . 'if(codeCoupon == currentCoupon){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'isValid = true;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if(isValid==true){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.storageService.setItem(`order`,`coupon_lines`,[{"code":currentCoupon}]).then(()=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.coupon = currentCoupon;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.showToast(`' . $addons['label-for-coupon-saved'] . '`);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}else{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.storageService.removeItem(`order`,`coupon_lines`).then(()=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.coupon = "";' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.showToast(`' . $addons['label-for-coupon-is-invalid'] . '`);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  CART --|-- CODE --|-- OTHER --|-- doRefresh()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ProductsByCategoriesPage.doRefresh()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public doRefresh(refresher){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storageService.getItems(`cart`).then((items)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.dataProductsInCart = items;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'refresher.target.complete();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}, 2000);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  CART --|-- CODE --|-- OTHER --|-- clearCart()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ProductsByCategoriesPage.clearCart()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public clearCart(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storageService.clearItems(`cart`).then((items)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.presentLoading();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.storageService.getItems(`cart`).then((items)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.dataProductsInCart = items;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}, 500);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= createBadge("cart");
    $newPage['code']['init'] = null;
    //generate page code
    $db->savePage($newPage);
    // TODO: ----------------------------------------------------------------------------------------------------
    // TODO: GENERATOR --|-- PAGE --|--  BILLING
    $newPage = null;
    $newPage['title'] = $addons['label-for-checkout'];
    $newPage['name'] = "billing";
    $newPage['code-by'] = 'woocommerce';
    $newPage['icon-left'] = 'golf-outline';
    $newPage['back-button'] = '/cart';
    $newPage['statusbar']['style'] = 'lightcontent';
    $newPage['statusbar']['backgroundcolor'] = $db->getRawColorLevel($addons['page-header-color']);
    $newPage['icon-right'] = '';
    $newPage['header']['color'] = $addons['page-header-color'];
    $newPage['content']['color'] = 'none';
    $newPage['content']['custom-color'] = '#ffffff';
    $newPage['content']['background'] = $addons['page-content-background'];
    // TODO: GENERATOR --|-- PAGE --|--  BILLING --|-- HEADER
    $newPage['header']['mid']['type'] = 'custom-header';
    $newPage['header']['mid']['custom-code'] = '';
    $newPage['header']['mid']['custom-code'] .= "" . '<ion-header page-billing-header class="page-billing-header">' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t" . '<ion-toolbar color="' . $addons['page-header-color'] . '">' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t" . '<ion-buttons slot="start">' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t" . '<ion-back-button defaultHref="cart"></ion-back-button>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t" . '</ion-buttons>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t" . '<ion-title>' . $addons['label-for-checkout'] . '</ion-title>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t" . '<ion-buttons slot="end">' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t" . '<ion-button (click)="showPopover($event)"><ion-icon name="ellipsis-vertical"></ion-icon></ion-button>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t" . '</ion-buttons>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t" . '</ion-toolbar>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t" . '<ion-toolbar>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t" . '<ion-tabs>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t" . '<ion-tab-bar slot="bottom">' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '<ion-tab-button>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="golf-outline"></ion-icon>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-address'] . '</ion-label>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '<ion-tab-button>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t\t" . '<ion-icon name="boat-outline"></ion-icon>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t\t" . '<ion-label>' . $addons['label-for-shipping'] . '</ion-label>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '<ion-tab-button>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t\t" . '<ion-icon name="cash-outline"></ion-icon>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t\t" . '<ion-label>' . $addons['label-for-payment'] . '</ion-label>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '<ion-tab-button>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t\t" . '<ion-icon name="eye-outline"></ion-icon>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t\t" . '<ion-label>' . $addons['label-for-review'] . '</ion-label>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t" . '</ion-tab-bar>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t" . '</ion-tabs>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t" . '</ion-toolbar>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "" . '</ion-header>' . "\r\n";
    $newPage['header']['mid']['items'][0]['label'] = 'Tab 1';
    $newPage['header']['mid']['items'][0]['value'] = 'tab1';
    $newPage['header']['mid']['items'][1]['label'] = 'Tab 2';
    $newPage['header']['mid']['items'][1]['value'] = 'tab2';
    $newPage['header']['mid']['items'][2]['label'] = 'Tab 3';
    $newPage['header']['mid']['items'][2]['value'] = 'tab3';
    // TODO: GENERATOR --|-- PAGE --|--  BILLING --|-- MODULES
    $z = 0;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'Observable';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = 'rxjs';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'ToastController';
    $newPage['modules']['angular'][$z]['var'] = 'toastController';
    $newPage['modules']['angular'][$z]['path'] = '@ionic/angular';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'WoocommerceService';
    $newPage['modules']['angular'][$z]['var'] = 'woocommerceService';
    $newPage['modules']['angular'][$z]['path'] = './../../services/woocommerce/woocommerce.service';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'StorageService';
    $newPage['modules']['angular'][$z]['var'] = 'storageService';
    $newPage['modules']['angular'][$z]['path'] = './../../services/storage/storage.service';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'Validators';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = '@angular/forms';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'FormBuilder';
    $newPage['modules']['angular'][$z]['var'] = 'formBuilder';
    $newPage['modules']['angular'][$z]['path'] = '@angular/forms';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'FormGroup';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = '@angular/forms';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'FormControl';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = '@angular/forms';
    // TODO: GENERATOR --|-- PAGE --|--  BILLING --|-- CONTENT --|-- HTML
    $newPage['content']['html'] = null;
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<form [formGroup]="formBilling">' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-list-header *ngIf="dataCountries.length != 0">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-text color="' . $addons['page-header-color'] . '">' . $addons['label-for-billing-address'] . '</ion-text>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-list-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-list lines="full" class="ion-no-margin ion-no-padding" *ngIf="dataCountries.length != 0">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="stacked">' . $addons['label-for-first-name'] . '<ion-text color="danger">*</ion-text></ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-input formControlName="first_name" type="text" placeholder="Ahmad"></ion-input>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="stacked">' . $addons['label-for-last-name'] . '</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-input formControlName="last_name" type="text" placeholder="Jhony"></ion-input>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="stacked">' . $addons['label-for-address'] . '<ion-text color="danger">*</ion-text></ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-input formControlName="address_1" type="text" placeholder="' . $addons['label-for-address_1'] . '"></ion-input>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-input formControlName="address_2" type="text" placeholder="' . $addons['label-for-address_2'] . '"></ion-input>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item lines="none">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="floating">' . $addons['label-for-country'] . '<ion-text color="danger">*</ion-text></ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-select formControlName="country" #country placeholder="' . $addons['label-for-choose-your-country'] . '" (ionChange)="updateStates(country.value)" okText="' . $addons['label-for-ok'] . '" cancelText="' . $addons['label-for-cancel'] . '">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-select-option *ngFor="let item of dataCountries" [value]="item.code" [innerHTML]="item.name" ></ion-select-option>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-select>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item  *ngIf="dataStates.length != 0" >' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="floating">' . $addons['label-for-state'] . '</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-select formControlName="state" placeholder="' . $addons['label-for-choose-your-state'] . '" okText="' . $addons['label-for-ok'] . '" cancelText="' . $addons['label-for-cancel'] . '">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-select-option *ngFor="let item of dataStates" [value]="item.code" [innerHTML]="item.name" ></ion-select-option>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-select>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="floating">' . $addons['label-for-city'] . '<ion-text color="danger">*</ion-text></ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-input formControlName="city" type="text" placeholder="West Pasaman"></ion-input>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="floating">' . $addons['label-for-postcode'] . '<ion-text color="danger">*</ion-text></ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-input formControlName="postcode" type="text" placeholder="12345678"></ion-input>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="floating">' . $addons['label-for-email'] . '<ion-text color="danger">*</ion-text></ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-input formControlName="email" type="email" placeholder="your@domain.com"></ion-input>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="floating">' . $addons['label-for-phone'] . '<ion-text color="danger">*</ion-text></ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-input formControlName="phone" type="tel" placeholder="612345678"></ion-input>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-list>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-list lines="full" class="ion-no-margin ion-no-padding" *ngIf="dataCountries.length == 0">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item *ngFor="let x of [1,2,3,4,5]">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-skeleton-text animated></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-skeleton-text animated></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-list>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</form>' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  BILLING --|-- CONTENT --|-- SCSS
    $newPage['content']['scss'] = null;
    $newPage['content']['scss'] .= "\t" . 'ion-list-header{margin-top: .5em;font-variant: petite-caps;padding-top: 0;padding-bottom:0;font-size: 1.2em;background-color: #fff;opacity:0.9;font-weight: 600;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-list-header ion-text{padding-top: 0.5em;padding-bottom: 0.5em;}' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  BILLING --|-- FOOTER
    $newPage['footer']['color'] = 'none';
    $newPage['footer']['type'] = 'code';
    $newPage['footer']['title'] = '';
    $newPage['footer']['code'] = null;
    $newPage['footer']['code'] .= "\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t" . '<ion-grid>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t" . '<ion-row>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-col size="2">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-button [routerDirection]="\'forward\'" [routerLink]="[\'/cart\']" color="medium" size="small" fill="outline" expand="block">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon slot="icon-only" name="arrow-back-outline"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-col size="4">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-button (click)="saveBilling()" size="small" fill="outline" expand="block" color="' . $addons['page-header-color'] . '">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '' . $addons['label-for-save'] . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-col size="6">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-button *ngIf="nextButton == true" (click)="goToShipping()" fill="solid" expand="block" color="' . $addons['page-header-color'] . '">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '' . $addons['label-for-continue-to-shipping'] . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-button *ngIf="nextButton != true" disabled="true" fill="solid" expand="block" color="' . $addons['page-header-color'] . '">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '' . $addons['label-for-continue-to-shipping'] . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t" . '</ion-row>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t" . '</ion-grid>' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  BILLING --|-- CODE --|-- OTHER
    $newPage['code']['export'] = null;
    $newPage['code']['constructor'] = null;
    $newPage['code']['other'] = null;
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* Variables' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'countries: Observable<any>;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataCountries: any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'formBilling: FormGroup;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataStates: any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'nextButton:boolean = true;' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataBilling: any = {' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'first_name: ``,' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'last_name: ``,' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'address_1: ``,' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'address_2: ``,' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'city: ``,' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'state: ``,' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'postcode: ``,' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'country: ``,' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'email: ``,' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'phone: ``' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  BILLING --|-- CODE --|-- OTHER --|-- getCountries()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* BillingPage.getCountries()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public getCountries(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.countries = this.woocommerceService.getCountries();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.countries.subscribe(data => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.dataCountries = data ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  BILLING --|-- CODE --|-- OTHER --|-- updateStates()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* BillingPage.updateStates(selected:string)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public updateStates(selected:string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataCountries.forEach((iVal, iKey, iIndex) => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'let code : string = iVal.code;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if(code == selected){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.dataStates = iVal.states;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  BILLING --|-- CODE --|-- OTHER --|-- formInstance()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* BillingPage.formInstance()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public formInstance(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.formBilling = this.formBuilder.group({' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'first_name: [this.dataBilling.first_name, Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'last_name: [this.dataBilling.last_name, Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'address_1: [this.dataBilling.address_1, Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'address_2: [this.dataBilling.address_2, Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'city: [this.dataBilling.city, Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'state: [this.dataBilling.state, Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'postcode: [this.dataBilling.postcode, Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'country: [this.dataBilling.country, Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'email: [this.dataBilling.email, Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'phone: [this.dataBilling.phone, Validators.required]' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.onChangesBilling();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  BILLING --|-- CODE --|-- OTHER --|-- onChangesBilling()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* BillingPage.onChangesBilling()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'private onChangesBilling():void{' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.formBilling.valueChanges.subscribe(billing => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if((billing.first_name != "") && (billing.address_1 != "") && (billing.city != "") && (billing.postcode != "") && (billing.country != "") && (billing.email != "") && (billing.phone != "")){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.nextButton = true;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}else{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.nextButton = false;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  BILLING --|-- CODE --|-- OTHER --|-- saveBilling()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* BillingPage.saveBilling()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public saveBilling(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let billing:any = this.formBilling.value;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'billing["state_html"] = this.getStateLabel(billing.state);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'billing["country_html"] = this.getCountryLabel(billing.country);' . "\r\n";
    if ($is_debug == true)
    {
        $newPage['code']['other'] .= "\t\t" . 'console.log(`billing`,`save`,billing);' . "\r\n";
    }
    $newPage['code']['other'] .= "\t\t" . 'this.storageService.setItem(`order`,`billing`,billing).then((data)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.showToast(`' . $addons['label-for-successfully-saved'] . '`);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  BILLING --|-- CODE --|-- OTHER --|-- goToShipping()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* BillingPage.goToShipping()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public goToShipping(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let billing:any = this.formBilling.value;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'billing["state_html"] = this.getStateLabel(billing.state);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'billing["country_html"] = this.getCountryLabel(billing.country);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'if((billing.first_name != "") && (billing.address_1 != "") && (billing.city != "") && (billing.postcode != "") && (billing.country != "") && (billing.email != "") && (billing.phone != "")){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.storageService.setItem(`order`,`billing`,billing).then((data)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.showToast(`' . $addons['label-for-successfully-saved'] . '`);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.router.navigate([`/shipping`]);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}else{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.showToast(`' . $addons['label-for-data-is-incomplete'] . '`);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  BILLING --|-- CODE --|-- OTHER --|-- showToast()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* BillingPage.showToast($message)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'async showToast(message: string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'const toast = await this.toastController.create({' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'position: "bottom",' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'color: "dark",' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'duration: 500' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'await toast.present();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  BILLING --|-- CODE --|-- OTHER --|-- getCountryLabel(code)
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* BillingPage.getCountryLabel()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public getCountryLabel(code:string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let label:string = "" ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataCountries.forEach((data) => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if(code == data.code){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'label = data.name;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'return label;' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  BILLING --|-- CODE --|-- OTHER --|-- getStateLabel(code)
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* BillingPage.getStateLabel()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public getStateLabel(code:string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let label:string = "" ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataStates.forEach((data) => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if(code == data.code){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'label = data.name;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'return label;' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  BILLING --|-- CODE --|-- OTHER --|-- ngOnInit()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* BillingPage.ngOnInit()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public ngOnInit(){' . "\r\n";
    //$newPage['code']['other'] .= "\t\t" . 'this.nextButton = false;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataCountries = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getCountries();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.formInstance();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storageService.getItem(`order`,`billing`).then((billing)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if(billing){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.dataBilling = billing; ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.formInstance();' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.updateStates(this.dataBilling.country);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.formInstance();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}, 2000);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  BILLING --|-- CODE --|-- OTHER --|-- doRefresh()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* BillingPage.doRefresh()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public doRefresh(refresher){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataCountries = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getCountries();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.formInstance();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storageService.getItem(`order`,`billing`).then((billing)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if(billing){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.dataBilling = billing; ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.formInstance();' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.updateStates(this.dataBilling.country);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.formInstance();' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'refresher.target.complete();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}, 2000);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['init'] = null;
    //generate page code
    $db->savePage($newPage);


    // TODO: ----------------------------------------------------------------------------------------------------
    // TODO: GENERATOR --|-- PAGE --|--  SHIPPING
    $newPage = null;
    $newPage['title'] = $addons['label-for-checkout'];
    $newPage['name'] = "shipping";
    $newPage['icon-left'] = 'boat-outline';
    $newPage['back-button'] = '/billing';
    $newPage['code-by'] = 'woocommerce';
    $newPage['statusbar']['style'] = 'lightcontent';
    $newPage['statusbar']['backgroundcolor'] = $db->getRawColorLevel($addons['page-header-color']);
    $newPage['icon-right'] = '';
    $newPage['header']['color'] = $addons['page-header-color'];
    $newPage['content']['color'] = 'none';
    $newPage['content']['custom-color'] = '#ffffff';
    $newPage['content']['background'] = $addons['page-content-background'];
    // TODO: GENERATOR --|-- PAGE --|--  SHIPPING --|-- HEADER
    $newPage['header']['mid']['type'] = 'custom-header';
    $newPage['header']['mid']['custom-code'] = '';
    $newPage['header']['mid']['custom-code'] .= "" . '<ion-header page-billing-header class="page-billing-header">' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t" . '<ion-toolbar color="' . $addons['page-header-color'] . '">' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t" . '<ion-buttons slot="start">' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t" . '<ion-back-button  defaultHref="billing"></ion-back-button>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t" . '</ion-buttons>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t" . '<ion-title>' . $addons['label-for-checkout'] . '</ion-title>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t" . '<ion-buttons slot="end">' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t" . '<ion-button (click)="showPopover($event)"><ion-icon name="ellipsis-vertical"></ion-icon></ion-button>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t" . '</ion-buttons>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t" . '</ion-toolbar>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t" . '<ion-toolbar>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t" . '<ion-tabs>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t" . '<ion-tab-bar slot="bottom">' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '<ion-tab-button>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="golf-outline"></ion-icon>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-address'] . '</ion-label>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '<ion-tab-button>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="boat-outline"></ion-icon>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-shipping'] . '</ion-label>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '<ion-tab-button>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t\t" . '<ion-icon name="cash-outline"></ion-icon>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t\t" . '<ion-label>' . $addons['label-for-payment'] . '</ion-label>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '<ion-tab-button>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t\t" . '<ion-icon name="eye-outline"></ion-icon>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t\t" . '<ion-label>' . $addons['label-for-review'] . '</ion-label>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t" . '</ion-tab-bar>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t" . '</ion-tabs>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t" . '</ion-toolbar>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "" . '</ion-header>' . "\r\n";
    $newPage['header']['mid']['items'][0]['label'] = 'Tab 1';
    $newPage['header']['mid']['items'][0]['value'] = 'tab1';
    $newPage['header']['mid']['items'][1]['label'] = 'Tab 2';
    $newPage['header']['mid']['items'][1]['value'] = 'tab2';
    $newPage['header']['mid']['items'][2]['label'] = 'Tab 3';
    $newPage['header']['mid']['items'][2]['value'] = 'tab3';
    // TODO: GENERATOR --|-- PAGE --|--  SHIPPING --|-- MODULES
    $z = 0;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'Observable';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = 'rxjs';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'ToastController';
    $newPage['modules']['angular'][$z]['var'] = 'toastController';
    $newPage['modules']['angular'][$z]['path'] = '@ionic/angular';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'WoocommerceService';
    $newPage['modules']['angular'][$z]['var'] = 'woocommerceService';
    $newPage['modules']['angular'][$z]['path'] = './../../services/woocommerce/woocommerce.service';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'StorageService';
    $newPage['modules']['angular'][$z]['var'] = 'storageService';
    $newPage['modules']['angular'][$z]['path'] = './../../services/storage/storage.service';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'Validators';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = '@angular/forms';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'FormBuilder';
    $newPage['modules']['angular'][$z]['var'] = 'formBuilder';
    $newPage['modules']['angular'][$z]['path'] = '@angular/forms';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'FormGroup';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = '@angular/forms';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'FormControl';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = '@angular/forms';
    // TODO: GENERATOR --|-- PAGE --|--  SHIPPING --|-- CONTENT --|-- HTML
    $newPage['content']['html'] = null;
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-list-header *ngIf="dataCountries.length != 0">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-text color="' . $addons['page-header-color'] . '">' . $addons['label-for-shipping-address'] . '</ion-text>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-list-header>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-list lines="full" class="ion-no-margin ion-no-padding" *ngIf="dataCountries.length != 0">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-checkbox slot="start" [(ngModel)]="same_billing" (ionChange)="asBilling($event)"></ion-checkbox>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-label>' . $addons['label-for-same-as-the-billing-address'] . '</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-list>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<form [formGroup]="formShipping">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-list lines="full" class="ion-no-margin ion-no-padding" *ngIf="dataCountries.length != 0">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="stacked">' . $addons['label-for-first-name'] . '<ion-text color="danger">*</ion-text></ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-input formControlName="first_name" type="text" placeholder="Ahmad"></ion-input>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="stacked">' . $addons['label-for-last-name'] . '</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-input formControlName="last_name" type="text" placeholder="Jhony"></ion-input>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="stacked">' . $addons['label-for-address'] . '<ion-text color="danger">*</ion-text></ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-input formControlName="address_1" type="text" placeholder="' . $addons['label-for-address_1'] . '"></ion-input>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-input formControlName="address_2" type="text" placeholder="' . $addons['label-for-address_2'] . '"></ion-input>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item lines="none">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="floating">' . $addons['label-for-country'] . '<ion-text color="danger">*</ion-text></ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-select formControlName="country" #country placeholder="' . $addons['label-for-choose-your-country'] . '" (ionChange)="updateStates(country.value)" okText="' . $addons['label-for-ok'] . '" cancelText="' . $addons['label-for-cancel'] . '">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-select-option *ngFor="let item of dataCountries" [value]="item.code" [innerHTML]="item.name" ></ion-select-option>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-select>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item *ngIf="dataStates.length != 0">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="floating">' . $addons['label-for-state'] . '</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-select formControlName="state" placeholder="' . $addons['label-for-choose-your-state'] . '" okText="' . $addons['label-for-ok'] . '" cancelText="' . $addons['label-for-cancel'] . '">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-select-option *ngFor="let item of dataStates" [value]="item.code" [innerHTML]="item.name" ></ion-select-option>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-select>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="floating">' . $addons['label-for-city'] . '<ion-text color="danger">*</ion-text></ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-input formControlName="city" type="text" placeholder="West Pasaman"></ion-input>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="floating">' . $addons['label-for-postcode'] . '<ion-text color="danger">*</ion-text></ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-input formControlName="postcode" type="text" placeholder="12345678"></ion-input>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-list>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-list lines="full" class="ion-no-margin ion-no-padding" *ngIf="dataCountries.length == 0">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item *ngFor="let x of [1,2,3,4,5]">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-skeleton-text animated></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-skeleton-text animated></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-list>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</form>' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  SHIPPING --|-- CONTENT --|-- SCSS
    $newPage['content']['scss'] = null;
    $newPage['content']['scss'] .= "\t" . 'ion-card {--background: #fff;opacity:0.9;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-list-header{margin-top: .5em;font-variant: petite-caps;padding-top: 0;padding-bottom:0;font-size: 1.2em;background-color: #fff;opacity:0.9;font-weight: 600;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-list-header ion-text{padding-top: 0.5em;padding-bottom: 0.5em;}' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  SHIPPING --|-- FOOTER
    $newPage['footer']['color'] = 'none';
    $newPage['footer']['type'] = 'code';
    $newPage['footer']['title'] = '';
    $newPage['footer']['code'] = null;
    $newPage['footer']['code'] .= "\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t" . '<ion-grid>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t" . '<ion-row>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-col size="2">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-button [routerDirection]="\'forward\'" [routerLink]="[\'/billing\']" color="medium" size="small" fill="outline" expand="block">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon slot="icon-only" name="arrow-back-outline"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-col size="4">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-button (click)="saveShipping()" size="small" fill="outline" expand="block" color="' . $addons['page-header-color'] . '">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '' . $addons['label-for-save'] . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-col size="6">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-button *ngIf="nextButton == true" (click)="goToPayment()" fill="solid" expand="block" color="' . $addons['page-header-color'] . '">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '' . $addons['label-for-continue-to-payment'] . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-button *ngIf="nextButton != true" disabled="true" fill="solid" expand="block" color="' . $addons['page-header-color'] . '">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '' . $addons['label-for-continue-to-payment'] . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t" . '</ion-row>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t" . '</ion-grid>' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  SHIPPING --|-- CODE --|-- OTHER
    $newPage['code']['export'] = null;
    $newPage['code']['constructor'] = null;
    $newPage['code']['other'] = null;
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* Variables' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'countries: Observable<any>;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataCountries: any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'formShipping: FormGroup;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataStates: any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'nextButton:boolean = true;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'same_billing:any = false;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataShipping: any = {' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'first_name: ``,' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'last_name: ``,' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'address_1: ``,' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'address_2: ``,' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'city: ``,' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'state: ``,' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'postcode: ``,' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'country: ``,' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  SHIPPING --|-- CODE --|-- OTHER --|-- getCountries()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ShippingPage.getCountries()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public getCountries(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.countries = this.woocommerceService.getCountries();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.countries.subscribe(data => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.dataCountries = data ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  SHIPPING --|-- CODE --|-- OTHER --|-- updateStates()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ShippingPage.updateStates(selected:string)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public updateStates(selected:string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataCountries.forEach((iVal, iKey, iIndex) => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'let code : string = iVal.code;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if(code == selected){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.dataStates = iVal.states;' . "\r\n";
    if ($is_debug == true)
    {
        $newPage['code']['other'] .= "\t\t\t\t" . 'console.log(`updateStates`,selected,iVal.states);' . "\r\n";
    }
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  SHIPPING --|-- CODE --|-- OTHER --|-- formInstance()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ShippingPage.formInstance()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public formInstance(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.formShipping = this.formBuilder.group({' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'first_name: [this.dataShipping.first_name, Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'last_name: [this.dataShipping.last_name, Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'address_1: [this.dataShipping.address_1, Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'address_2: [this.dataShipping.address_2, Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'city: [this.dataShipping.city, Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'state: [this.dataShipping.state, Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'postcode: [this.dataShipping.postcode, Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'country: [this.dataShipping.country, Validators.required]' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.onChangesShipping();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  SHIPPING --|-- CODE --|-- OTHER --|-- onChangesShipping()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ShippingPage.onChangesShipping()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'private onChangesShipping():void{' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.formShipping.valueChanges.subscribe(shipping => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.same_billing = false;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if((shipping.first_name != "") && (shipping.address_1 != "") && (shipping.city != "") && (shipping.postcode != "") && (shipping.country != "")){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.nextButton = true;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}else{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.nextButton = false;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  SHIPPING --|-- CODE --|-- OTHER --|-- saveShipping()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ShippingPage.saveShipping()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public saveShipping(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let shipping:any = this.formShipping.value;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'shipping["state_html"] = this.getStateLabel(shipping.state);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'shipping["country_html"] = this.getCountryLabel(shipping.country);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storageService.setItem(`order`,`shipping`,shipping).then((data)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.showToast(`' . $addons['label-for-successfully-saved'] . '`);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  SHIPPING --|-- CODE --|-- OTHER --|-- goToPayment()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ShippingPage.goToPayment()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public goToPayment(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let shipping:any = this.formShipping.value;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'shipping["state_html"] = this.getStateLabel(shipping.state);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'shipping["country_html"] = this.getCountryLabel(shipping.country);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'if((shipping.first_name != "") && (shipping.address_1 != "") && (shipping.city != "") && (shipping.postcode != "") && (shipping.country != "")){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.storageService.setItem(`order`,`shipping`,this.formShipping.value).then((data)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.showToast(`' . $addons['label-for-successfully-saved'] . '`);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.router.navigate([`/payment`]);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}else{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.showToast(`' . $addons['label-for-data-is-incomplete'] . '`);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  SHIPPING --|-- CODE --|-- OTHER --|-- showToast()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ShippingPage.showToast($message)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'async showToast(message: string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'const toast = await this.toastController.create({' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'position: "bottom",' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'color: "dark",' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'duration: 500' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'await toast.present();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  SHIPPING --|-- CODE --|-- OTHER --|-- asBilling()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ShippingPage.asBilling()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public asBilling(event){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let checked:boolean = event.detail.checked ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'if(checked==true){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.storageService.getItem(`order`,`billing`).then((billing)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'if(billing){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.nextButton = true;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.dataShipping.first_name = billing.first_name ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.dataShipping.last_name = billing.last_name ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.dataShipping.address_1 = billing.address_1 ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.dataShipping.address_2 = billing.address_2 ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.dataShipping.city = billing.city ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.dataShipping.state = billing.state ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.dataShipping.postcode = billing.postcode ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.dataShipping.country = billing.country ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.formInstance();' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  SHIPPING --|-- CODE --|-- OTHER --|-- getCountryLabel(code)
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ShippingPage.getCountryLabel()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public getCountryLabel(code:string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let label:string = "" ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataCountries.forEach((data) => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if(code == data.code){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'label = data.name;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'return label;' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  SHIPPING --|-- CODE --|-- OTHER --|-- getStateLabel(code)
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ShippingPage.getStateLabel()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public getStateLabel(code:string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let label:string = "" ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataStates.forEach((data) => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if(code == data.code){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'label = data.name;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'return label;' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  SHIPPING --|-- CODE --|-- OTHER --|-- ngOnInit()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ShippingPage.ngOnInit()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public ngOnInit(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataCountries = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getCountries();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.formInstance();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storageService.getItem(`order`,`shipping`).then((shipping)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if(shipping){' . "\r\n";
    if ($is_debug == true)
    {
        $newPage['code']['other'] .= "\t\t\t\t" . 'console.log(`storage`,shipping);' . "\r\n";
    }
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.dataShipping = shipping; ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.formInstance();' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.updateStates(this.dataShipping.country);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.formInstance();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}, 2000);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  SHIPPING --|-- CODE --|-- OTHER --|-- doRefresh()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ShippingPage.doRefresh()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public doRefresh(refresher){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataCountries = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getCountries();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.formInstance();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storageService.getItem(`order`,`shipping`).then((shipping)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if(shipping){' . "\r\n";
    if ($is_debug == true)
    {
        $newPage['code']['other'] .= "\t\t\t\t" . 'console.log(`storage`,shipping);' . "\r\n";
    }
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.dataShipping = shipping; ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.formInstance();' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.updateStates(this.dataShipping.country);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.formInstance();' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'refresher.target.complete();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}, 2000);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['init'] = null;
    //generate page code
    $db->savePage($newPage);
    // TODO: ----------------------------------------------------------------------------------------------------
    // TODO: GENERATOR --|-- PAGE --|--  PAYMENT
    $newPage = null;
    $newPage['title'] = $addons['label-for-checkout'];
    $newPage['name'] = "payment";
    $newPage['icon-left'] = 'cash-outline';
    $newPage['back-button'] = '/shipping';
    $newPage['code-by'] = 'woocommerce';
    $newPage['statusbar']['style'] = 'lightcontent';
    $newPage['statusbar']['backgroundcolor'] = $db->getRawColorLevel($addons['page-header-color']);
    $newPage['icon-right'] = '';
    $newPage['header']['color'] = $addons['page-header-color'];
    $newPage['content']['color'] = 'none';
    $newPage['content']['custom-color'] = '#ffffff';
    $newPage['content']['background'] = $addons['page-content-background'];
    // TODO: GENERATOR --|-- PAGE --|--  PAYMENT --|-- HEADER
    $newPage['header']['mid']['type'] = 'custom-header';
    $newPage['header']['mid']['custom-code'] = '';
    $newPage['header']['mid']['custom-code'] .= "" . '<ion-header page-billing-header class="page-billing-header">' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t" . '<ion-toolbar color="' . $addons['page-header-color'] . '">' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t" . '<ion-buttons slot="start">' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t" . '<ion-back-button defaultHref="shipping"></ion-back-button>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t" . '</ion-buttons>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t" . '<ion-title>' . $addons['label-for-checkout'] . '</ion-title>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t" . '<ion-buttons slot="end">' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t" . '<ion-button (click)="showPopover($event)"><ion-icon name="ellipsis-vertical"></ion-icon></ion-button>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t" . '</ion-buttons>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t" . '</ion-toolbar>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t" . '<ion-toolbar>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t" . '<ion-tabs>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t" . '<ion-tab-bar slot="bottom">' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '<ion-tab-button>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="golf-outline"></ion-icon>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-address'] . '</ion-label>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '<ion-tab-button>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="boat-outline"></ion-icon>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-shipping'] . '</ion-label>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '<ion-tab-button>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="cash-outline"></ion-icon>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-payment'] . '</ion-label>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '<ion-tab-button>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t\t" . '<ion-icon name="eye-outline"></ion-icon>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t\t" . '<ion-label>' . $addons['label-for-review'] . '</ion-label>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t" . '</ion-tab-bar>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t" . '</ion-tabs>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t" . '</ion-toolbar>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "" . '</ion-header>' . "\r\n";
    $newPage['header']['mid']['items'][0]['label'] = 'Tab 1';
    $newPage['header']['mid']['items'][0]['value'] = 'tab1';
    $newPage['header']['mid']['items'][1]['label'] = 'Tab 2';
    $newPage['header']['mid']['items'][1]['value'] = 'tab2';
    $newPage['header']['mid']['items'][2]['label'] = 'Tab 3';
    $newPage['header']['mid']['items'][2]['value'] = 'tab3';
    // TODO: GENERATOR --|-- PAGE --|--  PAYMENT --|-- MODULES
    $z = 0;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'Observable';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = 'rxjs';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'ToastController';
    $newPage['modules']['angular'][$z]['var'] = 'toastController';
    $newPage['modules']['angular'][$z]['path'] = '@ionic/angular';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'WoocommerceService';
    $newPage['modules']['angular'][$z]['var'] = 'woocommerceService';
    $newPage['modules']['angular'][$z]['path'] = './../../services/woocommerce/woocommerce.service';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'StorageService';
    $newPage['modules']['angular'][$z]['var'] = 'storageService';
    $newPage['modules']['angular'][$z]['path'] = './../../services/storage/storage.service';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'Validators';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = '@angular/forms';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'FormBuilder';
    $newPage['modules']['angular'][$z]['var'] = 'formBuilder';
    $newPage['modules']['angular'][$z]['path'] = '@angular/forms';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'FormGroup';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = '@angular/forms';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'FormControl';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = '@angular/forms';
    // TODO: GENERATOR --|-- PAGE --|--  PAYMENT --|-- CONTENT --|-- HTML
    $newPage['content']['html'] = null;
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-list-header *ngIf="dataPaymentGateways.length != 0">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-text color="' . $addons['page-header-color'] . '">' . $addons['label-for-payment-method'] . '</ion-text>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-list-header>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-list *ngIf="dataPaymentGateways.length != 0">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<form [formGroup]="formPayment" >' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-radio-group formControlName="payment_method">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<div *ngFor="let item of dataPaymentGateways">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-item *ngIf="item.enabled == true">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-label>{{ item.title }}</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-radio slot="start" value="{{ item.id }}"></ion-radio>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</div>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-radio-group>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</form>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-list>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-list *ngIf="dataPaymentGateways.length == 0">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-skeleton-text animated></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-skeleton-text animated></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-skeleton-text animated></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-skeleton-text animated></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-list>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-card *ngIf="paymentSelected && paymentSelected.title">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-title>{{ paymentSelected.title }}</ion-card-title>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<p [innerHTML]="paymentSelected.description"></p>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-card *ngIf="!paymentSelected || !paymentSelected.title">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-skeleton-text animated></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-skeleton-text animated></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-skeleton-text animated></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-skeleton-text animated></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-skeleton-text animated></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-skeleton-text animated></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  PAYMENT --|-- CONTENT --|-- SCSS
    $newPage['content']['scss'] = null;
    $newPage['content']['scss'] .= "\t" . 'ion-list-header{margin-top: .5em;font-variant: petite-caps;padding-top: 0;padding-bottom:0;font-size: 1.2em;background-color: #fff;opacity:0.9;font-weight: 600;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-list-header ion-text{padding-top: 0.5em;padding-bottom: 0.5em;}' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  PAYMENT --|-- FOOTER
    $newPage['footer']['color'] = 'none';
    $newPage['footer']['type'] = 'code';
    $newPage['footer']['title'] = '';
    $newPage['footer']['code'] = null;
    $newPage['footer']['code'] .= "\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t" . '<ion-grid>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t" . '<ion-row>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-col size="2">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-button [routerDirection]="\'forward\'" [routerLink]="[\'/shipping\']" color="medium" size="small" fill="outline" expand="block">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon slot="icon-only" name="arrow-back-outline"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-col size="4">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-button (click)="savePayment()"  size="small" fill="outline" expand="block" color="' . $addons['page-header-color'] . '">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '' . $addons['label-for-save'] . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-col size="6">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-button (click)="goToReview()" size="small" fill="solid" expand="block" color="' . $addons['page-header-color'] . '">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '' . $addons['label-for-continue-to-review'] . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t" . '</ion-row>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t" . '</ion-grid>' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  PAYMENT --|-- CODE --|-- OTHER
    $newPage['code']['export'] = null;
    $newPage['code']['constructor'] = null;
    $newPage['code']['other'] = null;
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'paymentGateways : Observable<any>;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataPaymentGateways : any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'formPayment : FormGroup;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataPayment : any = {id:`bacs`};' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'paymentSelected:any = {};' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'nextButton:boolean = true;' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  PAYMENT --|-- CODE --|-- OTHER --|-- getPaymentGateways()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* PaymentPage.getPaymentGateways()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public getPaymentGateways(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.paymentGateways = this.woocommerceService.getPaymentGateways();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.paymentGateways.subscribe(data => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.dataPaymentGateways = data ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  PAYMENT --|-- CODE --|-- OTHER --|-- formInstance()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* PaymentPage.formInstance()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public formInstance(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.formPayment = this.formBuilder.group({' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'payment_method : [this.dataPayment.id, Validators.required]' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.onChangesPayment();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  PAYMENT --|-- CODE --|-- OTHER --|-- onChangesPayment()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* PaymentPage.onChangesPayment()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public onChangesPayment(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.formPayment.valueChanges.subscribe(payment => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.paymentInfo(payment.payment_method);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  PAYMENT --|-- CODE --|-- OTHER --|-- paymentInfo()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* PaymentPage.paymentInfo()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'private paymentInfo(selected:string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataPaymentGateways.forEach((iVal, iKey, iIndex) => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if(iVal.id == selected){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.paymentSelected = iVal;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  PAYMENT --|-- CODE --|-- OTHER --|-- goToReview()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* PaymentPage.goToReview()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public goToReview(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storageService.setItem(`order`,`payment_method`,this.paymentSelected).then((data)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.showToast(`' . $addons['label-for-successfully-saved'] . '`);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.router.navigate(["/review"]);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  PAYMENT --|-- CODE --|-- OTHER --|-- savePayment()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* PaymentPage.savePayment()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public savePayment(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storageService.setItem(`order`,`payment_method`,this.paymentSelected).then((data)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.showToast(`' . $addons['label-for-successfully-saved'] . '`);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  PAYMENT --|-- CODE --|-- OTHER --|-- showToast()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* PaymentPage.showToast($message)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'async showToast(message: string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'const toast = await this.toastController.create({' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'position: "bottom",' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'color: "dark",' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'duration: 500' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'await toast.present();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  PAYMENT --|-- CODE --|-- OTHER --|-- ngOnInit()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* PaymentPage.ngOnInit()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public ngOnInit(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataPaymentGateways = []' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getPaymentGateways();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.formInstance();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storageService.getItem(`order`,`payment_method`).then((payment)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if(payment){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.dataPayment = payment; ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.formInstance();' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'setTimeout(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.paymentInfo(payment.id);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '}, 3000);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  PAYMENT --|-- CODE --|-- OTHER --|-- doRefresh()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* PaymentPage.doRefresh()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public doRefresh(refresher){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataPaymentGateways = []' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getPaymentGateways();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.formInstance();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storageService.getItem(`order`,`payment_method`).then((payment)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if(payment){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.dataPayment = payment; ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.formInstance();' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'setTimeout(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.paymentInfo(payment.id);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '}, 3000);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'refresher.target.complete();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}, 2000);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['init'] = null;
    //generate page code
    $db->savePage($newPage);
    // TODO: ----------------------------------------------------------------------------------------------------
    // TODO: GENERATOR --|-- PAGE --|--  REVIEW
    $newPage = null;
    $newPage['title'] = $addons['label-for-checkout'];
    $newPage['name'] = "review";
    $newPage['back-button'] = '/payment';
    $newPage['code-by'] = 'woocommerce';
    $newPage['icon-left'] = 'eye-outline';
    $newPage['statusbar']['style'] = 'lightcontent';
    $newPage['statusbar']['backgroundcolor'] = $db->getRawColorLevel($addons['page-header-color']);
    $newPage['icon-right'] = '';
    $newPage['header']['color'] = $addons['page-header-color'];
    $newPage['content']['color'] = 'none';
    $newPage['content']['custom-color'] = '#ffffff';
    $newPage['content']['background'] = $addons['page-content-background'];
    // TODO: GENERATOR --|-- PAGE --|--  REVIEW --|-- HEADER
    $newPage['header']['mid']['type'] = 'custom-header';
    $newPage['header']['mid']['custom-code'] = '';
    $newPage['header']['mid']['custom-code'] .= "" . '<ion-header page-billing-header class="page-billing-header">' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t" . '<ion-toolbar color="' . $addons['page-header-color'] . '">' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t" . '<ion-buttons slot="start">' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t" . '<ion-back-button defaultHref="payment"></ion-back-button>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t" . '</ion-buttons>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t" . '<ion-title>' . $addons['label-for-checkout'] . '</ion-title>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t" . '<ion-buttons slot="end">' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t" . '<ion-button (click)="showPopover($event)"><ion-icon name="ellipsis-vertical"></ion-icon></ion-button>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t" . '</ion-buttons>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t" . '</ion-toolbar>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t" . '<ion-toolbar>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t" . '<ion-tabs>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t" . '<ion-tab-bar slot="bottom">' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '<ion-tab-button>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="golf-outline"></ion-icon>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-address'] . '</ion-label>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '<ion-tab-button>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="boat-outline"></ion-icon>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-shipping'] . '</ion-label>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '<ion-tab-button>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="cash-outline"></ion-icon>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-payment'] . '</ion-label>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '<ion-tab-button>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="eye-outline"></ion-icon>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-review'] . '</ion-label>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t" . '</ion-tab-bar>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t" . '</ion-tabs>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t" . '</ion-toolbar>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "" . '</ion-header>' . "\r\n";
    $newPage['header']['mid']['items'][0]['label'] = 'Tab 1';
    $newPage['header']['mid']['items'][0]['value'] = 'tab1';
    $newPage['header']['mid']['items'][1]['label'] = 'Tab 2';
    $newPage['header']['mid']['items'][1]['value'] = 'tab2';
    $newPage['header']['mid']['items'][2]['label'] = 'Tab 3';
    $newPage['header']['mid']['items'][2]['value'] = 'tab3';
    // TODO: GENERATOR --|-- PAGE --|--  REVIEW --|-- MODULES
    $z = 0;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'Observable';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = 'rxjs';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'WoocommerceService';
    $newPage['modules']['angular'][$z]['var'] = 'woocommerceService';
    $newPage['modules']['angular'][$z]['path'] = './../../services/woocommerce/woocommerce.service';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'StorageService';
    $newPage['modules']['angular'][$z]['var'] = 'storageService';
    $newPage['modules']['angular'][$z]['path'] = './../../services/storage/storage.service';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'AlertController';
    $newPage['modules']['angular'][$z]['var'] = 'alertController';
    $newPage['modules']['angular'][$z]['path'] = '@ionic/angular';
    // TODO: GENERATOR --|-- PAGE --|--  REVIEW --|-- CONTENT --|-- HTML --|--
    $newPage['content']['html'] = null;
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  REVIEW --|-- CONTENT --|-- HTML --|-- LINE-ITEMS
    $newPage['content']['html'] .= "\t" . '<ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-subtitle>' . $addons['label-for-order-details'] . '</ion-card-subtitle>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-title *ngIf="order && order.line_items">' . $addons['label-for-products'] . '</ion-card-title>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-title *ngIf="!order || !order.line_items"><ion-skeleton-text animated style="width: 80%"></ion-skeleton-text></ion-card-title>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-content *ngIf="order && order.line_items">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item *ngFor="let item of order.line_items">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-thumbnail slot="start">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-img *ngIf="item.image" [src]="item.image"></ion-img>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-skeleton-text animated *ngIf="!item.image"></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-thumbnail>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label class="product-data">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<h2 [innerHTML]="item.name"></h2>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<h3>{{ item.quantity }} ' . $addons['label-for-item'] . '</h3>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<p class="price" [innerHTML]="item.price_html"></p>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-note slot="end" *ngFor="let metadata of item.meta_data">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-text>{{ metadata.value }}</ion-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-note>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-content *ngIf="!order || !order.line_items">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-thumbnail slot="start">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-skeleton-text animated style="width: 100%"></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-thumbnail>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-skeleton-text animated style="width: 60%"></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-skeleton-text animated></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-skeleton-text animated style="width: 80%"></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-subtitle>' . $addons['label-for-billing-address'] . '</ion-card-subtitle>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-title *ngIf="order && order.billing">{{ order.billing.first_name }} {{ order.billing.last_name }}</ion-card-title>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-title *ngIf="!order || !order.billing"><ion-skeleton-text animated style="width: 80%"></ion-skeleton-text></ion-card-title>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-content *ngIf="order && order.billing">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-text *ngIf="order.billing.address_1">{{ order.billing.address_1 }}</ion-text><br/>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-text *ngIf="order.billing.address_2">{{ order.billing.address_2 }}</ion-text><br/>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-text *ngIf="order.billing.city">{{ order.billing.city }}</ion-text><br/>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-text *ngIf="order.billing.state">{{ order.billing.state_html }} ({{ order.billing.state }})</ion-text> - ' . $addons['label-for-postcode'] . ': <ion-text *ngIf="order.billing.postcode">{{ order.billing.postcode }}</ion-text><br/>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-text *ngIf="order.billing.country">{{ order.billing.country_html }} ({{ order.billing.country }})</ion-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<h3 class="subtitle">' . $addons['label-for-email'] . '</h3>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-text *ngIf="order.billing.email">{{ order.billing.email }}</ion-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<h3 class="subtitle">' . $addons['label-for-phone'] . '</h3>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-text *ngIf="order.billing.phone">{{ order.billing.phone }}</ion-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-content *ngIf="!order || !order.billing">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-skeleton-text animated style="width: 60%"></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-skeleton-text animated></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-skeleton-text animated style="width: 80%"></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-subtitle>' . $addons['label-for-shipping-address'] . '</ion-card-subtitle>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-title *ngIf="order && order.shipping">{{ order.shipping.first_name }} {{ order.shipping.last_name }}</ion-card-title>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-title *ngIf="!order || !order.shipping"><ion-skeleton-text animated style="width: 80%"></ion-skeleton-text></ion-card-title>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-content *ngIf="order && order.shipping">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-text *ngIf="order.shipping.address_1">{{ order.shipping.address_1 }}</ion-text><br/>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-text *ngIf="order.shipping.address_2">{{ order.shipping.address_2 }}</ion-text><br/>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-text *ngIf="order.shipping.city">{{ order.shipping.city }}</ion-text><br/>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-text *ngIf="order.shipping.state">{{ order.shipping.state_html }} ({{ order.shipping.state }})</ion-text> - ' . $addons['label-for-postcode'] . ': <ion-text *ngIf="order.shipping.postcode">{{ order.shipping.postcode }}</ion-text><br/>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-text *ngIf="order.shipping.country">{{ order.shipping.country_html }} ({{ order.shipping.country }})</ion-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-content *ngIf="!order || !order.shipping">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-skeleton-text animated style="width: 60%"></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-skeleton-text animated></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-skeleton-text animated style="width: 80%"></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-subtitle>' . $addons['label-for-payment-method'] . '</ion-card-subtitle>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-title *ngIf="order && order.payment_method && order.payment_method_title">{{ order.payment_method_title }} ({{ order.payment_method }})</ion-card-title>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-title *ngIf="!order || !order.payment_method || !order.payment_method_title"><ion-skeleton-text animated style="width: 100%"></ion-skeleton-text></ion-card-title>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-subtitle>' . $addons['label-for-coupon-code'] . '</ion-card-subtitle>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<div *ngIf="order && order.coupon_lines">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-title *ngFor="let item of order.coupon_lines">{{ item.code }}</ion-card-title>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</div>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<div *ngIf="!order || !order.coupon_lines">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-title>-</ion-card-title>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</div>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  REVIEW --|-- CONTENT --|-- SCSS
    $newPage['content']['scss'] = null;
    $newPage['content']['scss'] .= "\t" . 'ion-card{opacity:0.9; padding-top:1em; margin-top: 0.5em;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '.subtitle{margin-top: 12px !important;margin-bottom: 2px !important;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '.price {color:' . $db->getRawColorLevel('danger') . ';font-weight:600}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '.product-data p, .product-data h2, .product-data h3, product-data h4{ margin-top: 0 !important; margin-bottom: 0 !important;}' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  REVIEW --|-- FOOTER
    $newPage['footer']['color'] = 'none';
    $newPage['footer']['type'] = 'code';
    $newPage['footer']['title'] = '';
    $newPage['footer']['code'] = null;
    $newPage['footer']['code'] .= "\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t" . '<ion-grid>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t" . '<ion-row>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-col size="2">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-button [routerDirection]="\'forward\'" [routerLink]="[\'/payment\']" color="medium" size="small" fill="outline" expand="block">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon slot="icon-only" name="arrow-back-outline"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-col size="2">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-button [routerDirection]="\'forward\'" [routerLink]="[\'/cart\']" color="medium" size="small" fill="outline" expand="block">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon slot="icon-only" name="cart-outline"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-col size="2">' . "\r\n";

    $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-col size="6">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-button *ngIf="order && order.line_items && order.billing && order.shipping && order.payment_method" (click)="placeOrder();" size="small" fill="solid" expand="block" color="' . $addons['page-header-color'] . '">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '' . $addons['label-for-place-order'] . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t" . '</ion-row>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t" . '</ion-grid>' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  REVIEW --|-- CODE --|-- OTHER
    $newPage['code']['export'] = null;
    $newPage['code']['constructor'] = null;
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'order:any = {};' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'newOrder: Observable<any>;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataNewOrder: any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  REVIEW --|-- CODE --|-- OTHER --|-- placeOrder()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ReviewPage.placeOrder()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public placeOrder(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.newOrder = this.woocommerceService.newOrder(this.order);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.newOrder.subscribe(data => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.dataNewOrder = data;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if(data.number){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.storageService.clearItems(`cart`).then(()=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.storageService.removeItem(`order`,`line_items`).then(()=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.showDialog(data.number);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  REVIEW --|-- CODE --|-- OTHER --|-- showDialog()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ReviewPage.showDialog()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'async showDialog(number:string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'const alert = await this.alertController.create({' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'header: `' . $addons['label-for-place-order'] . '`,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'subHeader: `' . $addons['label-for-order-number'] . ': ${number}`,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'message: `' . $addons['label-for-order-received'] . '`,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'buttons:[' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'text: `' . $addons['label-for-ok'] . '`,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'handler: (form_input) => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . 'this.router.navigate([`/order-received`,number]);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . ']' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'await alert.present();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  REVIEW --|-- CODE --|-- OTHER --|-- getBilling()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ReviewPage.getBilling()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public getBilling(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storageService.getItem(`order`,`billing`).then((billing:any)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if(billing){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.order["billing"] = billing; ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  REVIEW --|-- CODE --|-- OTHER --|-- getShipping()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ReviewPage.getShipping()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public getShipping(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storageService.getItem(`order`,`shipping`).then((shipping:any)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if(shipping){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.order["shipping"] = shipping; ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  REVIEW --|-- CODE --|-- OTHER --|-- getLineItems()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ReviewPage.getLineItems()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public getLineItems(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storageService.getItem(`order`,`line_items`).then((line_items:any)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if(line_items){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.order["line_items"] = line_items; ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  REVIEW --|-- CODE --|-- OTHER --|-- getCouponLines()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ReviewPage.getCouponLines()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public getCouponLines(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storageService.getItem(`order`,`coupon_lines`).then((coupon_lines:any)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if(coupon_lines && coupon_lines[0] && coupon_lines[0].code){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'if(coupon_lines[0].code != ""){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.order["coupon_lines"] = coupon_lines; ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  REVIEW --|-- CODE --|-- OTHER --|-- getPaymentGateways()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ReviewPage.getPaymentGateways()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public getPaymentGateways(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storageService.getItem(`order`,`payment_method`).then((payment:any)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if(payment && payment.id){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.order["payment_method"] = payment.id; ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.order["payment_method_title"] = payment.title; ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'switch(payment.id){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'case "paypal":' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . 'this.order["status"] = "pending"; ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . 'break;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'case "cod":' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . 'this.order["status"] = "processing"; ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . 'break;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'case "bacs":' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . 'this.order["status"] = "on-hold"; ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . 'break;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'case "cheque":' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . 'this.order["status"] = "on-hold"; ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . 'break;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    // TODO: GENERATOR --|-- PAGE --|--  REVIEW --|-- CODE --|-- OTHER --|-- doRefresh()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ReviewPage.doRefresh()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public doRefresh(refresher){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getBilling();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getShipping();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getLineItems();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getCouponLines();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getPaymentGateways();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    //$newPage['code']['other'] .= "\t\t\t" . 'console.log(`order`,this.order);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'refresher.target.complete();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}, 2000);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    // TODO: GENERATOR --|-- PAGE --|--  REVIEW --|-- CODE --|-- OTHER --|-- ngOnInit()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ReviewPage.ngOnInit()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public ngOnInit(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getBilling();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getShipping();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getLineItems();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getCouponLines();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getPaymentGateways();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    //$newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    //$newPage['code']['other'] .= "\t\t\t" . 'console.log(`order`,this.order);' . "\r\n";
    //$newPage['code']['other'] .= "\t\t" . '}, 2000);' . "\r\n";
    //$newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['init'] = null;
    //generate page code
    $db->savePage($newPage);
    // TODO: ----------------------------------------------------------------------------------------------------
    // TODO: ----------------------------------------------------------------------------------------------------
    // TODO: GENERATOR --|-- PAGE --|--  ACCOUNT
    $newPage = null;
    $newPage['title'] = $addons['label-for-account'];
    $newPage['name'] = "account";
    $newPage['code-by'] = 'woocommerce';
    $newPage['icon-left'] = 'person-outline';
    $newPage['statusbar']['style'] = 'lightcontent';
    $newPage['statusbar']['backgroundcolor'] = $db->getRawColorLevel($addons['page-header-color']);
    $newPage['icon-right'] = '';
    $newPage['header']['color'] = $addons['page-header-color'];
    $newPage['content']['color'] = 'none';
    $newPage['content']['custom-color'] = '#ffffff';
    $newPage['content']['background'] = $addons['page-content-background'];
    $newPage['header']['mid']['type'] = 'title';
    $newPage['header']['mid']['custom-code'] = '';
    // TODO: GENERATOR --|-- PAGE --|--  ACCOUNT --|-- HEADER
    $newPage['header']['mid']['items'][0]['label'] = 'Tab 1';
    $newPage['header']['mid']['items'][0]['value'] = 'tab1';
    $newPage['header']['mid']['items'][1]['label'] = 'Tab 2';
    $newPage['header']['mid']['items'][1]['value'] = 'tab2';
    $newPage['header']['mid']['items'][2]['label'] = 'Tab 3';
    $newPage['header']['mid']['items'][2]['value'] = 'tab3';
    // TODO: GENERATOR --|-- PAGE --|--  ACCOUNT --|-- MODULES
    $z = 0;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'Observable';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = 'rxjs';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'StorageService';
    $newPage['modules']['angular'][$z]['var'] = 'storageService';
    $newPage['modules']['angular'][$z]['path'] = './../../services/storage/storage.service';
    // TODO: GENERATOR --|-- PAGE --|--  ACCOUNT --|-- CONTENT --|-- HTML
    $newPage['content']['html'] = null;
    $newPage['content']['html'] .= "\t" . '<ion-card>' . "\r\n";

    $newPage['content']['html'] .= "\t\t" . '<ion-item [routerDirection]="\'forward\'" [routerLink]="[\'/billing-address/\']">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . $addons['label-for-billing-address'] . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";

    $newPage['content']['html'] .= "\t\t" . '<ion-item [routerDirection]="\'forward\'" [routerLink]="[\'/shipping-address/\']">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . $addons['label-for-shipping-address'] . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";

    $newPage['content']['html'] .= "\t\t" . '<ion-item [routerDirection]="\'forward\'" [routerLink]="[\'/order-histories/\']">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . $addons['label-for-order-history'] . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";

    $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  ACCOUNT --|-- CONTENT --|-- SCSS
    $newPage['content']['scss'] = null;
    $newPage['content']['scss'] .= "\t" . 'ion-card {--background: #fff;opacity:0.9;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-list-header{margin-top: .5em;font-variant: petite-caps;padding-top: 0;padding-bottom:0;font-size: 1.2em;background-color: #fff;opacity:0.9;font-weight: 600;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-list-header ion-text{padding-top: 0.5em;padding-bottom: 0.5em;}' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  ACCOUNT --|-- FOOTER
    $newPage['footer']['color'] = 'none';
    $newPage['footer']['type'] = 'code';
    $newPage['footer']['title'] = '';
    $newPage['footer']['code'] = null;
    $newPage['footer']['code'] .= "\t\t" . '<ion-toolbar>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t" . '<ion-tabs>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-tab-bar slot="bottom">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-tab-button [routerDirection]="\'root\'" [routerLink]="[\'/home\']">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-home'] . '</ion-label>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="home-outline"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-tab-button [routerDirection]="\'root\'" [routerLink]="[\'/products-by-category/0\']">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-products'] . '</ion-label>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="wine-outline"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-tab-button [routerDirection]="\'root\'" [routerLink]="[\'/wishlist\']">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-wishlist'] . '</ion-label>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="heart-circle"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-badge *ngIf="count_wishlist!=0" color="danger">{{ count_wishlist }}</ion-badge>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-tab-button  [routerDirection]="\'root\'" [routerLink]="[\'/cart\']">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-cart'] . '</ion-label>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="cart-outline"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-badge *ngIf="count_cart!=0" color="danger">{{ count_cart }}</ion-badge>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-tab-button disabled="true" [routerDirection]="\'root\'" [routerLink]="[\'/account\']">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-account'] . '</ion-label>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="person-outline"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-tab-bar>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t" . '</ion-tabs>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t" . '</ion-toolbar>' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  ACCOUNT --|-- CODE --|-- OTHER
    $newPage['code']['export'] = null;
    $newPage['code']['constructor'] = null;
    $newPage['code']['constructor'] .= "\t\t" . '//badge for wishlist and cart' . "\r\n";
    $newPage['code']['constructor'] .= "\t\t" . 'this.createBadge();' . "\r\n";
    $newPage['code']['constructor'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] = null;
    $newPage['code']['other'] .= createBadge("account");
    $newPage['code']['init'] = null;
    //generate page code
    $db->savePage($newPage);
    // TODO: ----------------------------------------------------------------------------------------------------
    // TODO: GENERATOR --|-- PAGE --|--  ORDER-RECEIVED
    $newPage = null;
    $newPage['title'] = $addons['label-for-account'];
    $newPage['name'] = "order-received";
    $newPage['code-by'] = 'woocommerce';
    $newPage['icon-left'] = 'person-outline';
    $newPage['statusbar']['style'] = 'lightcontent';
    $newPage['statusbar']['backgroundcolor'] = $db->getRawColorLevel($addons['page-header-color']);
    $newPage['icon-right'] = '';
    $newPage['param'] = 'order_id';
    $newPage['back-button'] = '/order_histories';
    $newPage['header']['color'] = $addons['page-header-color'];
    $newPage['content']['color'] = 'none';
    $newPage['content']['custom-color'] = '#ffffff';
    //$newPage['content']['background'] = $addons['page-content-background'];
    $newPage['header']['mid']['type'] = 'title';
    $newPage['header']['mid']['custom-code'] = '';
    // TODO: GENERATOR --|-- PAGE --|--  ORDER-RECEIVED --|-- HEADER
    $newPage['header']['mid']['items'][0]['label'] = 'Tab 1';
    $newPage['header']['mid']['items'][0]['value'] = 'tab1';
    $newPage['header']['mid']['items'][1]['label'] = 'Tab 2';
    $newPage['header']['mid']['items'][1]['value'] = 'tab2';
    $newPage['header']['mid']['items'][2]['label'] = 'Tab 3';
    $newPage['header']['mid']['items'][2]['value'] = 'tab3';
    // TODO: GENERATOR --|-- PAGE --|--  ORDER-RECEIVED --|-- MODULES
    $z = 0;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'Observable';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = 'rxjs';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'ToastController';
    $newPage['modules']['angular'][$z]['var'] = 'toastController';
    $newPage['modules']['angular'][$z]['path'] = '@ionic/angular';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'WoocommerceService';
    $newPage['modules']['angular'][$z]['var'] = 'woocommerceService';
    $newPage['modules']['angular'][$z]['path'] = './../../services/woocommerce/woocommerce.service';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'StorageService';
    $newPage['modules']['angular'][$z]['var'] = 'storageService';
    $newPage['modules']['angular'][$z]['path'] = './../../services/storage/storage.service';
    // TODO: GENERATOR --|-- PAGE --|--  ORDER-RECEIVED --|-- CONTENT --|-- HTML
    $newPage['content']['html'] = null;

    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-subtitle>' . $addons['label-for-order-details'] . '</ion-card-subtitle>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-content *ngIf="dataOrderRecieved && dataOrderRecieved.number">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<table class="table noborder">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<tbody>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<tr>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td>' . $addons['label-for-order-number'] . '</td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td>: <ion-text color="dark">{{ dataOrderRecieved.number }}</ion-text></td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</tr>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<tr>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td>' . $addons['label-for-status'] . '</td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td>: <ion-text color="dark">{{ dataOrderRecieved.status }}</ion-text></td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</tr>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<tr>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td>' . $addons['label-for-currency'] . '</td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td>: <ion-text color="dark">{{ dataOrderRecieved.currency }}</ion-text></td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</tr>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<tr>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td>' . $addons['label-for-date-created'] . '</td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td>: <ion-text color="dark">{{ dataOrderRecieved.date_created | date:\'short\' }}</ion-text></td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</tr>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<tr>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td>' . $addons['label-for-payment-method'] . '</td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td>: <ion-text color="dark">{{ dataOrderRecieved.payment_method_title }} ({{ dataOrderRecieved.payment_method }})</ion-text></td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</tr>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</tbody>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</table>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-content *ngIf="!dataOrderRecieved || !dataOrderRecieved.number">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-skeleton-text animated style="width: 80%"></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-skeleton-text animated style="width: 100%"></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-skeleton-text animated style="width: 90%"></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-skeleton-text animated style="width: 50%"></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-subtitle>' . $addons['label-for-products'] . '</ion-card-subtitle>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-content *ngIf="dataOrderRecieved && dataOrderRecieved.line_items">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<div class="table-responsive">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<table class="table">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<thead>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<tr>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '<th class="text-left">' . $addons['label-for-products'] . '</th>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '<th class="text-right">' . $addons['label-for-quantity'] . '</th>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '<th class="text-right">' . $addons['label-for-price'] . '</th>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '<th class="text-right">' . $addons['label-for-subtotal'] . '</th>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '<th class="text-right">' . $addons['label-for-subtotal-tax'] . '</th>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '<th class="text-right">' . $addons['label-for-total'] . '</th>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '<th class="text-right">' . $addons['label-for-total-tax'] . '</th>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '</tr>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</thead>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<tbody>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<tr *ngFor="let item of dataOrderRecieved.line_items">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '<td class="text-left">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t\t\t" . '<h4 [routerDirection]="\'root\'" [routerLink]="[\'/product-detail\',item.product_id]"><ion-text [innerHTML]="item.name"></ion-text></h4>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t\t\t" . '<p *ngIf="item.meta_data && item.meta_data[0][\'value\']">' . $addons['label-for-note'] . ': <ion-text *ngFor="let metadata of item.meta_data">{{ metadata.value }} </ion-text></p>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '</td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '<td class="text-right"><ion-text>{{ item.quantity }}</ion-text></td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '<td class="text-right"><ion-text>{{ item.price }}</ion-text></td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '<td class="text-right"><ion-text>{{ item.subtotal }}</ion-text></td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '<td class="text-right"><ion-text>{{ item.subtotal_tax }}</ion-text></td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '<td class="text-right"><ion-text>{{ item.total }}</ion-text></td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '<td class="text-right"><ion-text>{{ item.total_tax }}</ion-text></td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '</tr>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</tbody>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</table>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</div>' . "\r\n";

    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t" . '<table class="table noborder">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<tbody>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t\t\t" . '<tr>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td>' . $addons['label-for-discount-total'] . '</td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td>:</td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td class="text-right">{{ dataOrderRecieved.discount_total }}</td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</tr>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t\t\t" . '<tr>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td>' . $addons['label-for-discount-tax'] . '</td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td>:</td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td class="text-right">{{ dataOrderRecieved.discount_tax }}</td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</tr>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t\t\t" . '<tr>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td>' . $addons['label-for-shipping-total'] . '</td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td>:</td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td class="text-right">{{ dataOrderRecieved.shipping_total }}</td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</tr>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t\t\t" . '<tr>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td>' . $addons['label-for-shipping-tax'] . '</td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td>:</td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td class="text-right">{{ dataOrderRecieved.shipping_tax }}</td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</tr>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t\t\t" . '<tr>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td>' . $addons['label-for-cart-tax'] . '</td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td>:</td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td class="text-right">{{ dataOrderRecieved.cart_tax }}</td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</tr>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t\t\t" . '<tr>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td>' . $addons['label-for-total'] . '</td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td>:</td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td class="text-right">{{ dataOrderRecieved.total }}</td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</tr>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t\t\t" . '<tr>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td>' . $addons['label-for-total-tax'] . '</td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td>:</td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td class="text-right">{{ dataOrderRecieved.total_tax }}</td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</tr>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t\t" . '</tbody>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</table>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";

    $newPage['content']['html'] .= "\t\t" . '<ion-card-content *ngIf="!dataOrderRecieved || !dataOrderRecieved.number">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-skeleton-text animated style="width: 80%"></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-skeleton-text animated style="width: 100%"></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-skeleton-text animated style="width: 90%"></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-skeleton-text animated style="width: 50%"></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";


    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-subtitle>' . $addons['label-for-billing-address'] . '</ion-card-subtitle>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-title *ngIf="dataOrderRecieved && dataOrderRecieved.billing">{{ dataOrderRecieved.billing.first_name }} {{ dataOrderRecieved.billing.last_name }}</ion-card-title>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-title *ngIf="!dataOrderRecieved || !dataOrderRecieved.billing"><ion-skeleton-text animated style="width: 80%"></ion-skeleton-text></ion-card-title>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-content *ngIf="dataOrderRecieved && dataOrderRecieved.billing">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-text *ngIf="dataOrderRecieved.billing.address_1">{{ dataOrderRecieved.billing.address_1 }}</ion-text><br/>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-text *ngIf="dataOrderRecieved.billing.address_2">{{ dataOrderRecieved.billing.address_2 }}</ion-text><br/>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-text *ngIf="dataOrderRecieved.billing.city">{{ dataOrderRecieved.billing.city }}</ion-text><br/>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-text *ngIf="dataOrderRecieved.billing.state">' . $addons['label-for-state'] . ': {{ dataOrderRecieved.billing.state }}</ion-text>, ' . $addons['label-for-postcode'] . ': <ion-text *ngIf="dataOrderRecieved.billing.postcode">{{ dataOrderRecieved.billing.postcode }}</ion-text><br/>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-text *ngIf="dataOrderRecieved.billing.country">' . $addons['label-for-country'] . ': {{ dataOrderRecieved.billing.country }}</ion-text>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t" . '<h3 class="subtitle">' . $addons['label-for-email'] . '</h3>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-text *ngIf="dataOrderRecieved.billing.email">{{ dataOrderRecieved.billing.email }}</ion-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<h3 class="subtitle">' . $addons['label-for-phone'] . '</h3>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-text *ngIf="dataOrderRecieved.billing.phone">{{ dataOrderRecieved.billing.phone }}</ion-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-content *ngIf="!dataOrderRecieved || !dataOrderRecieved.billing">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-skeleton-text animated style="width: 60%"></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-skeleton-text animated></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-skeleton-text animated style="width: 80%"></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-subtitle>' . $addons['label-for-shipping-address'] . '</ion-card-subtitle>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-title *ngIf="dataOrderRecieved && dataOrderRecieved.shipping">{{ dataOrderRecieved.shipping.first_name }} {{ dataOrderRecieved.shipping.last_name }}</ion-card-title>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-title *ngIf="!dataOrderRecieved || !dataOrderRecieved.shipping"><ion-skeleton-text animated style="width: 80%"></ion-skeleton-text></ion-card-title>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-content *ngIf="dataOrderRecieved && dataOrderRecieved.shipping">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-text *ngIf="dataOrderRecieved.shipping.address_1">{{ dataOrderRecieved.shipping.address_1 }}</ion-text><br/>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-text *ngIf="dataOrderRecieved.shipping.address_2">{{ dataOrderRecieved.shipping.address_2 }}</ion-text><br/>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-text *ngIf="dataOrderRecieved.shipping.city">{{ dataOrderRecieved.shipping.city }}</ion-text><br/>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-text *ngIf="dataOrderRecieved.shipping.state">' . $addons['label-for-state'] . ': {{ dataOrderRecieved.shipping.state }}</ion-text>, ' . $addons['label-for-postcode'] . ': <ion-text *ngIf="dataOrderRecieved.shipping.postcode">{{ dataOrderRecieved.shipping.postcode }}</ion-text><br/>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-text *ngIf="dataOrderRecieved.shipping.country">' . $addons['label-for-country'] . ': {{ dataOrderRecieved.shipping.country }}</ion-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-content *ngIf="!dataOrderRecieved || !dataOrderRecieved.shipping">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-skeleton-text animated style="width: 60%"></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-skeleton-text animated></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-skeleton-text animated style="width: 80%"></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";


    // TODO: GENERATOR --|-- PAGE --|--  ORDER-RECEIVED --|-- CONTENT --|-- SCSS
    $newPage['content']['scss'] = null;
    $newPage['content']['scss'] .= "\t" . 'ion-card{opacity:0.9; padding-top:1em; margin-top: 0.5em;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '.subtitle{margin-top: 12px !important;margin-bottom: 2px !important;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '.price {color:' . $db->getRawColorLevel('danger') . ';font-weight:600}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '.product-data p, .product-data h2, .product-data h3, product-data h4{ margin-top: 0 !important; margin-bottom: 0 !important;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '.table-responsive{overflow: scroll;}' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  ORDER-RECEIVED --|-- FOOTER
    $newPage['footer']['color'] = 'none';
    $newPage['footer']['type'] = 'code';
    $newPage['footer']['title'] = '';
    $newPage['footer']['code'] = null;
    $newPage['footer']['code'] .= "\t\t" . '<ion-toolbar>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t" . '<ion-tabs>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-tab-bar slot="bottom">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-tab-button [routerDirection]="\'root\'" [routerLink]="[\'/home\']">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-home'] . '</ion-label>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="home-outline"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-tab-button [routerDirection]="\'root\'" [routerLink]="[\'/products-by-category/0\']">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-products'] . '</ion-label>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="wine-outline"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-tab-button [routerDirection]="\'root\'" [routerLink]="[\'/wishlist\']">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-wishlist'] . '</ion-label>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="heart-circle"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-badge *ngIf="count_wishlist!=0" color="danger">{{ count_wishlist }}</ion-badge>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-tab-button  [routerDirection]="\'root\'" [routerLink]="[\'/cart\']">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-cart'] . '</ion-label>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="cart-outline"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-badge *ngIf="count_cart!=0" color="danger">{{ count_cart }}</ion-badge>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-tab-button [routerDirection]="\'root\'" [routerLink]="[\'/account\']">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-account'] . '</ion-label>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="person-outline"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-tab-bar>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t" . '</ion-tabs>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t" . '</ion-toolbar>' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  ORDER-RECEIVED --|-- CODE --|-- OTHER
    $newPage['code']['export'] = null;
    $newPage['code']['constructor'] = null;
    $newPage['code']['constructor'] .= "\t\t" . '//badge for wishlist and cart' . "\r\n";
    $newPage['code']['constructor'] .= "\t\t" . 'this.createBadge();' . "\r\n";
    $newPage['code']['constructor'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] = null;
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* OrderReceivedPage:Variable' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'orderRecieved: Observable<any>;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataOrderRecieved:any = {};' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* OrderReceivedPage:getOrderReceived()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'getOrderReceived(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.orderRecieved = this.woocommerceService.getOrder(this.orderId);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.orderRecieved.subscribe(data => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.dataOrderRecieved = data ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if(data.number){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.storageService.setItem(`order-received`,data.number,data).then(()=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* OrderReceivedPage:doRefresh()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public doRefresh(refresher){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getOrderReceived();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'refresher.target.complete();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}, 2000);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* OrderReceivedPage:ngOnInit()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'ngOnInit(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getOrderReceived();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= createBadge("order-received");
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['init'] = null;
    //generate page code
    $db->savePage($newPage);

    // TODO: ----------------------------------------------------------------------------------------------------
    // TODO: GENERATOR --|-- PAGE --|--  ORDER-HISTORIES
    $newPage = null;
    $newPage['title'] = $addons['label-for-account'];
    $newPage['name'] = "order-histories";
    $newPage['code-by'] = 'woocommerce';
    $newPage['icon-left'] = 'person-outline';
    $newPage['statusbar']['style'] = 'lightcontent';
    $newPage['statusbar']['backgroundcolor'] = $db->getRawColorLevel($addons['page-header-color']);
    $newPage['icon-right'] = '';
    $newPage['back-button'] = '/account';
    $newPage['header']['color'] = $addons['page-header-color'];
    $newPage['content']['color'] = 'none';
    $newPage['content']['custom-color'] = '#ffffff';
    $newPage['content']['background'] = $addons['page-content-background'];
    $newPage['header']['mid']['type'] = 'title';
    $newPage['header']['mid']['custom-code'] = '';
    // TODO: GENERATOR --|-- PAGE --|--  ORDER-HISTORIES --|-- HEADER
    $newPage['header']['mid']['items'][0]['label'] = 'Tab 1';
    $newPage['header']['mid']['items'][0]['value'] = 'tab1';
    $newPage['header']['mid']['items'][1]['label'] = 'Tab 2';
    $newPage['header']['mid']['items'][1]['value'] = 'tab2';
    $newPage['header']['mid']['items'][2]['label'] = 'Tab 3';
    $newPage['header']['mid']['items'][2]['value'] = 'tab3';
    // TODO: GENERATOR --|-- PAGE --|--  ORDER-HISTORIES --|-- MODULES
    $z = 0;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'Observable';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = 'rxjs';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'StorageService';
    $newPage['modules']['angular'][$z]['var'] = 'storageService';
    $newPage['modules']['angular'][$z]['path'] = './../../services/storage/storage.service';
    // TODO: GENERATOR --|-- PAGE --|--  ORDER-HISTORIES --|-- CONTENT --|-- HTML
    $newPage['content']['html'] = null;
    $newPage['content']['html'] .= "\t" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-list-header *ngIf="dataHistories.length != 0">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-text color="' . $addons['page-header-color'] . '">' . $addons['label-for-order-history'] . '</ion-text>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-list-header>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-card  >' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-item *ngFor="let item of dataHistories" [routerDirection]="\'forward\'" [routerLink]="[\'/order-received\',item.id]">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<h3>' . $addons['label-for-order-number'] . ' #{{ item.number }}</h3>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<p>{{ item.date_created | date:\'long\' }}</p>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-badge color="secondary" *ngIf="item.status ==\'pending\'">{{ item.status }}</ion-badge>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-badge color="success" *ngIf="item.status ==\'processing\'">{{ item.status }}</ion-badge>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-badge color="tertiary" *ngIf="item.status ==\'on-hold\'">{{ item.status }}</ion-badge>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-badge color="medium" *ngIf="item.status ==\'completed\'">{{ item.status }}</ion-badge>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-badge color="warning" *ngIf="item.status ==\'cancelled\'">{{ item.status }}</ion-badge>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-badge color="danger" *ngIf="item.status ==\'refunded\'">{{ item.status }}</ion-badge>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-badge color="dark" *ngIf="item.status ==\'failed\'">{{ item.status }}</ion-badge>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-list-header *ngIf="dataHistories.length == 0">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-text color="' . $addons['page-header-color'] . '">' . $addons['label-for-no-order-history'] . '</ion-text>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-list-header>' . "\r\n";

    // TODO: GENERATOR --|-- PAGE --|--  ORDER-HISTORIES --|-- CONTENT --|-- SCSS
    $newPage['content']['scss'] = null;
    $newPage['content']['scss'] .= "\t" . 'ion-list-header{margin-top: .5em;font-variant: petite-caps;padding-top: 0;padding-bottom:0;font-size: 1.2em;background-color: #fff;opacity:0.9;font-weight: 600;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-list-header ion-text{padding-top: 0.5em;padding-bottom: 0.5em;}' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  ORDER-HISTORIES --|-- FOOTER
    $newPage['footer']['color'] = 'none';
    $newPage['footer']['type'] = 'code';
    $newPage['footer']['title'] = '';
    $newPage['footer']['code'] = null;
    $newPage['footer']['code'] .= "\t\t" . '<ion-toolbar>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t" . '<ion-tabs>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-tab-bar slot="bottom">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-tab-button [routerDirection]="\'root\'" [routerLink]="[\'/home\']">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-home'] . '</ion-label>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="home-outline"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-tab-button [routerDirection]="\'root\'" [routerLink]="[\'/products-by-category/0\']">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-products'] . '</ion-label>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="wine-outline"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-tab-button [routerDirection]="\'root\'" [routerLink]="[\'/wishlist\']">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-wishlist'] . '</ion-label>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="heart-circle"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-badge *ngIf="count_wishlist!=0" color="danger">{{ count_wishlist }}</ion-badge>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-tab-button  [routerDirection]="\'root\'" [routerLink]="[\'/cart\']">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-cart'] . '</ion-label>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="cart-outline"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-badge *ngIf="count_cart!=0" color="danger">{{ count_cart }}</ion-badge>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-tab-button [routerDirection]="\'root\'" [routerLink]="[\'/account\']">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-account'] . '</ion-label>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="person-outline"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-tab-bar>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t" . '</ion-tabs>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t" . '</ion-toolbar>' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  ORDER-HISTORIES --|-- CODE --|-- OTHER
    $newPage['code']['export'] = null;
    $newPage['code']['constructor'] = null;
    $newPage['code']['constructor'] .= "\t\t" . '//badge for wishlist and cart' . "\r\n";
    $newPage['code']['constructor'] .= "\t\t" . 'this.createBadge();' . "\r\n";
    $newPage['code']['constructor'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] = null;
    $newPage['code']['other'] .= "\t" . 'dataHistories:any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* OrderHistoryPage:getHistories()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'getHistories(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataHistories = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storageService.getItems(`order-received`).then((histories:any)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.dataHistories = histories;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'console.log(`histories`,histories);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* OrderHistoryPage:doRefresh()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public doRefresh(refresher){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getHistories();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'refresher.target.complete();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}, 2000);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* OrderHistoryPage:ngOnInit()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'ngOnInit(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getHistories();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= createBadge("account");
    $newPage['code']['init'] = null;
    //generate page code
    $db->savePage($newPage);


    // TODO: ----------------------------------------------------------------------------------------------------
    // TODO: GENERATOR --|-- PAGE --|--  BILLING-ADDRESS
    $newPage = null;
    $newPage['title'] = $addons['label-for-account'];
    $newPage['name'] = "billing-address";
    $newPage['code-by'] = 'woocommerce';
    $newPage['icon-left'] = 'golf-outline';
    $newPage['back-button'] = '/account';
    $newPage['statusbar']['style'] = 'lightcontent';
    $newPage['statusbar']['backgroundcolor'] = $db->getRawColorLevel($addons['page-header-color']);
    $newPage['icon-right'] = '';
    $newPage['header']['color'] = $addons['page-header-color'];
    $newPage['content']['color'] = 'none';
    $newPage['content']['custom-color'] = '#ffffff';
    $newPage['content']['background'] = $addons['page-content-background'];
    // TODO: GENERATOR --|-- PAGE --|--  BILLING-ADDRESS --|-- HEADER
    $newPage['header']['mid']['type'] = 'title';
    $newPage['header']['mid']['items'][0]['label'] = 'Tab 1';
    $newPage['header']['mid']['items'][0]['value'] = 'tab1';
    $newPage['header']['mid']['items'][1]['label'] = 'Tab 2';
    $newPage['header']['mid']['items'][1]['value'] = 'tab2';
    $newPage['header']['mid']['items'][2]['label'] = 'Tab 3';
    $newPage['header']['mid']['items'][2]['value'] = 'tab3';
    // TODO: GENERATOR --|-- PAGE --|--  BILLING-ADDRESS --|-- MODULES
    $z = 0;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'Observable';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = 'rxjs';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'ToastController';
    $newPage['modules']['angular'][$z]['var'] = 'toastController';
    $newPage['modules']['angular'][$z]['path'] = '@ionic/angular';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'WoocommerceService';
    $newPage['modules']['angular'][$z]['var'] = 'woocommerceService';
    $newPage['modules']['angular'][$z]['path'] = './../../services/woocommerce/woocommerce.service';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'StorageService';
    $newPage['modules']['angular'][$z]['var'] = 'storageService';
    $newPage['modules']['angular'][$z]['path'] = './../../services/storage/storage.service';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'Validators';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = '@angular/forms';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'FormBuilder';
    $newPage['modules']['angular'][$z]['var'] = 'formBuilder';
    $newPage['modules']['angular'][$z]['path'] = '@angular/forms';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'FormGroup';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = '@angular/forms';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'FormControl';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = '@angular/forms';
    // TODO: GENERATOR --|-- PAGE --|--  BILLING-ADDRESS --|-- CONTENT --|-- HTML
    $newPage['content']['html'] = null;
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<form [formGroup]="formBilling">' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-list-header *ngIf="dataCountries.length != 0">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-text color="' . $addons['page-header-color'] . '">' . $addons['label-for-billing-address'] . '</ion-text>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-list-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-list lines="full" class="ion-no-margin ion-no-padding" *ngIf="dataCountries.length != 0">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="stacked">' . $addons['label-for-first-name'] . '<ion-text color="danger">*</ion-text></ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-input formControlName="first_name" type="text" placeholder="Ahmad"></ion-input>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="stacked">' . $addons['label-for-last-name'] . '</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-input formControlName="last_name" type="text" placeholder="Jhony"></ion-input>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="stacked">' . $addons['label-for-address'] . '<ion-text color="danger">*</ion-text></ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-input formControlName="address_1" type="text" placeholder="' . $addons['label-for-address_1'] . '"></ion-input>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-input formControlName="address_2" type="text" placeholder="' . $addons['label-for-address_2'] . '"></ion-input>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item lines="none">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="floating">' . $addons['label-for-country'] . '<ion-text color="danger">*</ion-text></ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-select formControlName="country" #country placeholder="' . $addons['label-for-choose-your-country'] . '" (ionChange)="updateStates(country.value)" okText="' . $addons['label-for-ok'] . '" cancelText="' . $addons['label-for-cancel'] . '">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-select-option *ngFor="let item of dataCountries" [value]="item.code" [innerHTML]="item.name" ></ion-select-option>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-select>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item  *ngIf="dataStates.length != 0" >' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="floating">' . $addons['label-for-state'] . '</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-select formControlName="state" placeholder="' . $addons['label-for-choose-your-state'] . '" okText="' . $addons['label-for-ok'] . '" cancelText="' . $addons['label-for-cancel'] . '">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-select-option *ngFor="let item of dataStates" [value]="item.code" [innerHTML]="item.name" ></ion-select-option>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-select>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="floating">' . $addons['label-for-city'] . '<ion-text color="danger">*</ion-text></ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-input formControlName="city" type="text" placeholder="West Pasaman"></ion-input>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="floating">' . $addons['label-for-postcode'] . '<ion-text color="danger">*</ion-text></ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-input formControlName="postcode" type="text" placeholder="12345678"></ion-input>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="floating">' . $addons['label-for-email'] . '<ion-text color="danger">*</ion-text></ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-input formControlName="email" type="email" placeholder="your@domain.com"></ion-input>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="floating">' . $addons['label-for-phone'] . '<ion-text color="danger">*</ion-text></ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-input formControlName="phone" type="tel" placeholder="612345678"></ion-input>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-button slot="end" size="normal" (click)="saveBilling()" color="' . $addons['page-header-color'] . '">' . $addons['label-for-save'] . '</ion-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-list>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-list lines="full" class="ion-no-margin ion-no-padding" *ngIf="dataCountries.length == 0">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item *ngFor="let x of [1,2,3,4,5]">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-skeleton-text animated></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-skeleton-text animated></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-list>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</form>' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  BILLING-ADDRESS --|-- CONTENT --|-- SCSS
    $newPage['content']['scss'] = null;
    $newPage['content']['scss'] .= "\t" . 'ion-list-header{margin-top: .5em;font-variant: petite-caps;padding-top: 0;padding-bottom:0;font-size: 1.2em;background-color: #fff;opacity:0.9;font-weight: 600;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-list-header ion-text{padding-top: 0.5em;padding-bottom: 0.5em;}' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  BILLING-ADDRESS --|-- FOOTER
    $newPage['footer']['color'] = 'none';
    $newPage['footer']['type'] = 'code';
    $newPage['footer']['title'] = '';
    $newPage['footer']['code'] = null;
    $newPage['footer']['code'] .= "\t\t" . '<ion-toolbar>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t" . '<ion-tabs>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-tab-bar slot="bottom">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-tab-button [routerDirection]="\'root\'" [routerLink]="[\'/home\']">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-home'] . '</ion-label>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="home-outline"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-tab-button [routerDirection]="\'root\'" [routerLink]="[\'/products-by-category/0\']">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-products'] . '</ion-label>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="wine-outline"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-tab-button [routerDirection]="\'root\'" [routerLink]="[\'/wishlist\']">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-wishlist'] . '</ion-label>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="heart-circle"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-badge *ngIf="count_wishlist!=0" color="danger">{{ count_wishlist }}</ion-badge>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-tab-button  [routerDirection]="\'root\'" [routerLink]="[\'/cart\']">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-cart'] . '</ion-label>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="cart-outline"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-badge *ngIf="count_cart!=0" color="danger">{{ count_cart }}</ion-badge>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-tab-button [routerDirection]="\'root\'" [routerLink]="[\'/account\']">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-account'] . '</ion-label>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="person-outline"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-tab-bar>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t" . '</ion-tabs>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t" . '</ion-toolbar>' . "\r\n";

    // TODO: GENERATOR --|-- PAGE --|--  BILLING-ADDRESS --|-- CODE --|-- OTHER
    $newPage['code']['export'] = null;
    $newPage['code']['constructor'] = null;
    $newPage['code']['constructor'] .= "\t\t" . '//badge for wishlist and cart' . "\r\n";
    $newPage['code']['constructor'] .= "\t\t" . 'this.createBadge();' . "\r\n";
    $newPage['code']['constructor'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] = null;
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* Variables' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'countries: Observable<any>;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataCountries: any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'formBilling: FormGroup;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataStates: any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataBilling: any = {' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'first_name: ``,' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'last_name: ``,' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'address_1: ``,' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'address_2: ``,' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'city: ``,' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'state: ``,' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'postcode: ``,' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'country: ``,' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'email: ``,' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'phone: ``' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  BILLING-ADDRESS --|-- CODE --|-- OTHER --|-- getCountries()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* BillingPage.getCountries()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public getCountries(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.countries = this.woocommerceService.getCountries();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.countries.subscribe(data => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.dataCountries = data ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  BILLING-ADDRESS --|-- CODE --|-- OTHER --|-- updateStates()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* BillingPage.updateStates(selected:string)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public updateStates(selected:string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataCountries.forEach((iVal, iKey, iIndex) => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'let code : string = iVal.code;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if(code == selected){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.dataStates = iVal.states;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  BILLING-ADDRESS --|-- CODE --|-- OTHER --|-- formInstance()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* BillingPage.formInstance()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public formInstance(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.formBilling = this.formBuilder.group({' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'first_name: [this.dataBilling.first_name, Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'last_name: [this.dataBilling.last_name, Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'address_1: [this.dataBilling.address_1, Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'address_2: [this.dataBilling.address_2, Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'city: [this.dataBilling.city, Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'state: [this.dataBilling.state, Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'postcode: [this.dataBilling.postcode, Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'country: [this.dataBilling.country, Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'email: [this.dataBilling.email, Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'phone: [this.dataBilling.phone, Validators.required]' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.onChangesBilling();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  BILLING-ADDRESS --|-- CODE --|-- OTHER --|-- onChangesBilling()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* BillingPage.onChangesBilling()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'private onChangesBilling():void{' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.formBilling.valueChanges.subscribe(billing => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  BILLING-ADDRESS --|-- CODE --|-- OTHER --|-- saveBilling()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* BillingPage.saveBilling()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public saveBilling(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let billing:any = this.formBilling.value;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'billing["state_html"] = this.getStateLabel(billing.state);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'billing["country_html"] = this.getCountryLabel(billing.country);' . "\r\n";
    if ($is_debug == true)
    {
        $newPage['code']['other'] .= "\t\t" . 'console.log(`billing`,`save`,billing);' . "\r\n";
    }
    $newPage['code']['other'] .= "\t\t" . 'this.storageService.setItem(`order`,`billing`,billing).then((data)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.showToast(`' . $addons['label-for-successfully-saved'] . '`);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  BILLING-ADDRESS --|-- CODE --|-- OTHER --|-- showToast()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* BillingPage.showToast($message)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'async showToast(message: string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'const toast = await this.toastController.create({' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'position: "bottom",' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'color: "dark",' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'duration: 500' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'await toast.present();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  BILLING-ADDRESS --|-- CODE --|-- OTHER --|-- getCountryLabel(code)
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* BillingPage.getCountryLabel()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public getCountryLabel(code:string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let label:string = "" ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataCountries.forEach((data) => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if(code == data.code){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'label = data.name;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'return label;' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  BILLING-ADDRESS --|-- CODE --|-- OTHER --|-- getStateLabel(code)
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* BillingPage.getStateLabel()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public getStateLabel(code:string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let label:string = "" ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataStates.forEach((data) => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if(code == data.code){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'label = data.name;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'return label;' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  BILLING-ADDRESS --|-- CODE --|-- OTHER --|-- ngOnInit()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* BillingPage.ngOnInit()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public ngOnInit(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataCountries = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getCountries();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.formInstance();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storageService.getItem(`order`,`billing`).then((billing)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if(billing){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.dataBilling = billing; ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.formInstance();' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.updateStates(this.dataBilling.country);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.formInstance();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}, 2000);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  BILLING-ADDRESS --|-- CODE --|-- OTHER --|-- doRefresh()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* BillingPage.doRefresh()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public doRefresh(refresher){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataCountries = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getCountries();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.formInstance();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storageService.getItem(`order`,`billing`).then((billing)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if(billing){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.dataBilling = billing; ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.formInstance();' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.updateStates(this.dataBilling.country);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.formInstance();' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'refresher.target.complete();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}, 2000);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= createBadge("account");
    $newPage['code']['init'] = null;
    //generate page code
    $db->savePage($newPage);


    // TODO: ----------------------------------------------------------------------------------------------------
    // TODO: GENERATOR --|-- PAGE --|--  SHIPPING-ADDRESS
    $newPage = null;
    $newPage['title'] = $addons['label-for-account'];
    $newPage['name'] = "shipping-address";
    $newPage['icon-left'] = 'boat-outline';
    $newPage['back-button'] = '/account';
    $newPage['code-by'] = 'woocommerce';
    $newPage['statusbar']['style'] = 'lightcontent';
    $newPage['statusbar']['backgroundcolor'] = $db->getRawColorLevel($addons['page-header-color']);
    $newPage['icon-right'] = '';
    $newPage['header']['color'] = $addons['page-header-color'];
    $newPage['content']['color'] = 'none';
    $newPage['content']['custom-color'] = '#ffffff';
    $newPage['content']['background'] = $addons['page-content-background'];
    // TODO: GENERATOR --|-- PAGE --|--  SHIPPING-ADDRESS --|-- HEADER
    $newPage['header']['mid']['type'] = 'title';
    $newPage['header']['mid']['items'][0]['label'] = 'Tab 1';
    $newPage['header']['mid']['items'][0]['value'] = 'tab1';
    $newPage['header']['mid']['items'][1]['label'] = 'Tab 2';
    $newPage['header']['mid']['items'][1]['value'] = 'tab2';
    $newPage['header']['mid']['items'][2]['label'] = 'Tab 3';
    $newPage['header']['mid']['items'][2]['value'] = 'tab3';
    // TODO: GENERATOR --|-- PAGE --|--  SHIPPING-ADDRESS --|-- MODULES
    $z = 0;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'Observable';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = 'rxjs';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'ToastController';
    $newPage['modules']['angular'][$z]['var'] = 'toastController';
    $newPage['modules']['angular'][$z]['path'] = '@ionic/angular';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'WoocommerceService';
    $newPage['modules']['angular'][$z]['var'] = 'woocommerceService';
    $newPage['modules']['angular'][$z]['path'] = './../../services/woocommerce/woocommerce.service';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'StorageService';
    $newPage['modules']['angular'][$z]['var'] = 'storageService';
    $newPage['modules']['angular'][$z]['path'] = './../../services/storage/storage.service';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'Validators';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = '@angular/forms';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'FormBuilder';
    $newPage['modules']['angular'][$z]['var'] = 'formBuilder';
    $newPage['modules']['angular'][$z]['path'] = '@angular/forms';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'FormGroup';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = '@angular/forms';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'FormControl';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = '@angular/forms';
    // TODO: GENERATOR --|-- PAGE --|--  SHIPPING-ADDRESS --|-- CONTENT --|-- HTML
    $newPage['content']['html'] = null;
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-list-header *ngIf="dataCountries.length != 0">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-text color="' . $addons['page-header-color'] . '">' . $addons['label-for-shipping-address'] . '</ion-text>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-list-header>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-list lines="full" class="ion-no-margin ion-no-padding" *ngIf="dataCountries.length != 0">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-checkbox slot="start" [(ngModel)]="same_billing" (ionChange)="asBilling($event)"></ion-checkbox>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-label>' . $addons['label-for-same-as-the-billing-address'] . '</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-list>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<form [formGroup]="formShipping">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-list lines="full" class="ion-no-margin ion-no-padding" *ngIf="dataCountries.length != 0">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="stacked">' . $addons['label-for-first-name'] . '<ion-text color="danger">*</ion-text></ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-input formControlName="first_name" type="text" placeholder="Ahmad"></ion-input>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="stacked">' . $addons['label-for-last-name'] . '</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-input formControlName="last_name" type="text" placeholder="Jhony"></ion-input>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="stacked">' . $addons['label-for-address'] . '<ion-text color="danger">*</ion-text></ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-input formControlName="address_1" type="text" placeholder="' . $addons['label-for-address_1'] . '"></ion-input>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-input formControlName="address_2" type="text" placeholder="' . $addons['label-for-address_2'] . '"></ion-input>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item lines="none">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="floating">' . $addons['label-for-country'] . '<ion-text color="danger">*</ion-text></ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-select formControlName="country" #country placeholder="' . $addons['label-for-choose-your-country'] . '" (ionChange)="updateStates(country.value)" okText="' . $addons['label-for-ok'] . '" cancelText="' . $addons['label-for-cancel'] . '">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-select-option *ngFor="let item of dataCountries" [value]="item.code" [innerHTML]="item.name" ></ion-select-option>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-select>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item *ngIf="dataStates.length != 0">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="floating">' . $addons['label-for-state'] . '</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-select formControlName="state" placeholder="' . $addons['label-for-choose-your-state'] . '" okText="' . $addons['label-for-ok'] . '" cancelText="' . $addons['label-for-cancel'] . '">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-select-option *ngFor="let item of dataStates" [value]="item.code" [innerHTML]="item.name" ></ion-select-option>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-select>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="floating">' . $addons['label-for-city'] . '<ion-text color="danger">*</ion-text></ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-input formControlName="city" type="text" placeholder="West Pasaman"></ion-input>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="floating">' . $addons['label-for-postcode'] . '<ion-text color="danger">*</ion-text></ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-input formControlName="postcode" type="text" placeholder="12345678"></ion-input>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-button slot="end" size="normal" (click)="saveShipping()" color="' . $addons['page-header-color'] . '">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '' . $addons['label-for-save'] . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";

    $newPage['content']['html'] .= "\t\t" . '</ion-list>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-list lines="full" class="ion-no-margin ion-no-padding" *ngIf="dataCountries.length == 0">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item *ngFor="let x of [1,2,3,4,5]">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-skeleton-text animated></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-skeleton-text animated></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-list>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</form>' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  SHIPPING-ADDRESS --|-- CONTENT --|-- SCSS
    $newPage['content']['scss'] = null;
    $newPage['content']['scss'] .= "\t" . 'ion-card {--background: #fff;opacity:0.9;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-list-header{margin-top: .5em;font-variant: petite-caps;padding-top: 0;padding-bottom:0;font-size: 1.2em;background-color: #fff;opacity:0.9;font-weight: 600;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-list-header ion-text{padding-top: 0.5em;padding-bottom: 0.5em;}' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  SHIPPING-ADDRESS --|-- FOOTER
    $newPage['footer']['color'] = 'none';
    $newPage['footer']['type'] = 'code';
    $newPage['footer']['title'] = '';
    $newPage['footer']['code'] = null;
    $newPage['footer']['code'] .= "\t\t" . '<ion-toolbar>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t" . '<ion-tabs>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-tab-bar slot="bottom">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-tab-button [routerDirection]="\'root\'" [routerLink]="[\'/home\']">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-home'] . '</ion-label>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="home-outline"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-tab-button [routerDirection]="\'root\'" [routerLink]="[\'/products-by-category/0\']">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-products'] . '</ion-label>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="wine-outline"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-tab-button [routerDirection]="\'root\'" [routerLink]="[\'/wishlist\']">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-wishlist'] . '</ion-label>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="heart-circle"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-badge *ngIf="count_wishlist!=0" color="danger">{{ count_wishlist }}</ion-badge>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-tab-button  [routerDirection]="\'root\'" [routerLink]="[\'/cart\']">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-cart'] . '</ion-label>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="cart-outline"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-badge *ngIf="count_cart!=0" color="danger">{{ count_cart }}</ion-badge>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-tab-button [routerDirection]="\'root\'" [routerLink]="[\'/account\']">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $addons['label-for-account'] . '</ion-label>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="person-outline"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-tab-bar>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t" . '</ion-tabs>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t" . '</ion-toolbar>' . "\r\n";


    // TODO: GENERATOR --|-- PAGE --|--  SHIPPING-ADDRESS --|-- CODE --|-- OTHER
    $newPage['code']['export'] = null;
    $newPage['code']['constructor'] = null;
    $newPage['code']['constructor'] .= "\t\t" . '//badge for wishlist and cart' . "\r\n";
    $newPage['code']['constructor'] .= "\t\t" . 'this.createBadge();' . "\r\n";
    $newPage['code']['constructor'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] = null;
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* Variables' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'countries: Observable<any>;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataCountries: any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'formShipping: FormGroup;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataStates: any = [];' . "\r\n";

    $newPage['code']['other'] .= "\t" . 'same_billing:any = false;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataShipping: any = {' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'first_name: ``,' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'last_name: ``,' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'address_1: ``,' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'address_2: ``,' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'city: ``,' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'state: ``,' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'postcode: ``,' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'country: ``,' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  SHIPPING-ADDRESS --|-- CODE --|-- OTHER --|-- getCountries()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ShippingPage.getCountries()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public getCountries(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.countries = this.woocommerceService.getCountries();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.countries.subscribe(data => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.dataCountries = data ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  SHIPPING-ADDRESS --|-- CODE --|-- OTHER --|-- updateStates()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ShippingPage.updateStates(selected:string)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public updateStates(selected:string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataCountries.forEach((iVal, iKey, iIndex) => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'let code : string = iVal.code;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if(code == selected){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.dataStates = iVal.states;' . "\r\n";
    if ($is_debug == true)
    {
        $newPage['code']['other'] .= "\t\t\t\t" . 'console.log(`updateStates`,selected,iVal.states);' . "\r\n";
    }
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  SHIPPING-ADDRESS --|-- CODE --|-- OTHER --|-- formInstance()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ShippingPage.formInstance()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public formInstance(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.formShipping = this.formBuilder.group({' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'first_name: [this.dataShipping.first_name, Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'last_name: [this.dataShipping.last_name, Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'address_1: [this.dataShipping.address_1, Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'address_2: [this.dataShipping.address_2, Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'city: [this.dataShipping.city, Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'state: [this.dataShipping.state, Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'postcode: [this.dataShipping.postcode, Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'country: [this.dataShipping.country, Validators.required]' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.onChangesShipping();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  SHIPPING-ADDRESS --|-- CODE --|-- OTHER --|-- onChangesShipping()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ShippingPage.onChangesShipping()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'private onChangesShipping():void{' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.formShipping.valueChanges.subscribe(shipping => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.same_billing = false;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  SHIPPING-ADDRESS --|-- CODE --|-- OTHER --|-- saveShipping()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ShippingPage.saveShipping()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public saveShipping(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let shipping:any = this.formShipping.value;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'shipping["state_html"] = this.getStateLabel(shipping.state);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'shipping["country_html"] = this.getCountryLabel(shipping.country);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storageService.setItem(`order`,`shipping`,shipping).then((data)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.showToast(`' . $addons['label-for-successfully-saved'] . '`);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    // TODO: GENERATOR --|-- PAGE --|--  SHIPPING-ADDRESS --|-- CODE --|-- OTHER --|-- showToast()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ShippingPage.showToast($message)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'async showToast(message: string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'const toast = await this.toastController.create({' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'position: "bottom",' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'color: "dark",' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'duration: 500' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'await toast.present();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  SHIPPING-ADDRESS --|-- CODE --|-- OTHER --|-- asBilling()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ShippingPage.asBilling()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public asBilling(event){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let checked:boolean = event.detail.checked ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'if(checked==true){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.storageService.getItem(`order`,`billing`).then((billing)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'if(billing){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.dataShipping.first_name = billing.first_name ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.dataShipping.last_name = billing.last_name ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.dataShipping.address_1 = billing.address_1 ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.dataShipping.address_2 = billing.address_2 ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.dataShipping.city = billing.city ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.dataShipping.state = billing.state ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.dataShipping.postcode = billing.postcode ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.dataShipping.country = billing.country ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.formInstance();' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  SHIPPING-ADDRESS --|-- CODE --|-- OTHER --|-- getCountryLabel(code)
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ShippingPage.getCountryLabel()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public getCountryLabel(code:string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let label:string = "" ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataCountries.forEach((data) => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if(code == data.code){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'label = data.name;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'return label;' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  SHIPPING-ADDRESS --|-- CODE --|-- OTHER --|-- getStateLabel(code)
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ShippingPage.getStateLabel()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public getStateLabel(code:string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let label:string = "" ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataStates.forEach((data) => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if(code == data.code){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'label = data.name;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'return label;' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  SHIPPING-ADDRESS --|-- CODE --|-- OTHER --|-- ngOnInit()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ShippingPage.ngOnInit()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public ngOnInit(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataCountries = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getCountries();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.formInstance();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storageService.getItem(`order`,`shipping`).then((shipping)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if(shipping){' . "\r\n";
    if ($is_debug == true)
    {
        $newPage['code']['other'] .= "\t\t\t\t" . 'console.log(`storage`,shipping);' . "\r\n";
    }
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.dataShipping = shipping; ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.formInstance();' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.updateStates(this.dataShipping.country);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.formInstance();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}, 2000);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|--  SHIPPING-ADDRESS --|-- CODE --|-- OTHER --|-- doRefresh()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ShippingPage.doRefresh()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public doRefresh(refresher){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataCountries = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getCountries();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.formInstance();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storageService.getItem(`order`,`shipping`).then((shipping)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if(shipping){' . "\r\n";
    if ($is_debug == true)
    {
        $newPage['code']['other'] .= "\t\t\t\t" . 'console.log(`storage`,shipping);' . "\r\n";
    }
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.dataShipping = shipping; ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.formInstance();' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.updateStates(this.dataShipping.country);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.formInstance();' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'refresher.target.complete();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}, 2000);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= createBadge("account");
    $newPage['code']['init'] = null;
    //generate page code
    $db->savePage($newPage);


    $db->current();
    rebuild();
    header('Location: ./?p=addons&addons=woocommerce&' . time());
}
// TODO: INIT --|-- CURRENT SETTINGS
$disabled = null;
$current_setting = $db->getAddOns('woocommerce', 'core');
if (!isset($current_setting['page-header-color']))
{
    $current_setting['page-header-color'] = 'primary';
}
if (!isset($current_setting['page-content-background']))
{
    $current_setting['page-content-background'] = 'assets/images/background/bg-01.png';
}
if (!isset($current_setting['wordpress-url']))
{
    $current_setting['wordpress-url'] = '';
}
if (!isset($current_setting['consumer-key']))
{
    $current_setting['consumer-key'] = '';
}
if (!isset($current_setting['consumer-secret']))
{
    $current_setting['consumer-secret'] = '';
}
if (!isset($current_setting['per-page']))
{
    $current_setting['per-page'] = '10';
}
if (!isset($current_setting['contact-call']))
{
    $current_setting['contact-call'] = '';
}
if (!isset($current_setting['contact-sms']))
{
    $current_setting['contact-sms'] = '';
}
if (!isset($current_setting['contact-whatsapp']))
{
    $current_setting['contact-whatsapp'] = '';
}
if (!isset($current_setting['contact-email']))
{
    $current_setting['contact-email'] = '';
}
if (!isset($current_setting['label-for-home']))
{
    $current_setting['label-for-home'] = 'Home';
}
if (!isset($current_setting['label-for-products']))
{
    $current_setting['label-for-products'] = 'Products';
}
if (!isset($current_setting['label-for-product']))
{
    $current_setting['label-for-product'] = 'Product';
}
if (!isset($current_setting['label-for-wishlist']))
{
    $current_setting['label-for-wishlist'] = 'Wishlist';
}
if (!isset($current_setting['label-for-cart']))
{
    $current_setting['label-for-cart'] = 'Cart';
}
if (!isset($current_setting['label-for-account']))
{
    $current_setting['label-for-account'] = 'Account';
}
if (!isset($current_setting['label-for-please-wait']))
{
    $current_setting['label-for-please-wait'] = 'Please wait...';
}
if (!isset($current_setting['label-for-no-products-found']))
{
    $current_setting['label-for-no-products-found'] = 'No products found';
}
if (!isset($current_setting['label-for-add-to-cart']))
{
    $current_setting['label-for-add-to-cart'] = 'Add To Cart';
}
if (!isset($current_setting['label-for-buy']))
{
    $current_setting['label-for-buy'] = 'Buy!';
}
if (!isset($current_setting['label-for-contact-us']))
{
    $current_setting['label-for-contact-us'] = 'Contact Us';
}
if (!isset($current_setting['label-for-ordering-information']))
{
    $current_setting['label-for-ordering-information'] = 'Ordering Information';
}
if (!isset($current_setting['label-for-dimensions']))
{
    $current_setting['label-for-dimensions'] = 'Dimensions';
}
if (!isset($current_setting['label-for-weight']))
{
    $current_setting['label-for-weight'] = 'Weight';
}
if (!isset($current_setting['label-for-additional-information']))
{
    $current_setting['label-for-additional-information'] = 'Additional Information';
}
if (!isset($current_setting['label-for-clean-up']))
{
    $current_setting['label-for-clean-up'] = 'Clean Up';
}
if (!isset($current_setting['label-for-delete']))
{
    $current_setting['label-for-delete'] = 'Delete';
}
if (!isset($current_setting['label-for-added-to-your-cart']))
{
    $current_setting['label-for-added-to-your-cart'] = 'Item has been added to your cart';
}
if (!isset($current_setting['label-for-privacy-policy']))
{
    $current_setting['label-for-privacy-policy'] = 'Privacy Policy';
}
if (!isset($current_setting['label-for-about-us']))
{
    $current_setting['label-for-about-us'] = 'About Us';
}
if (!isset($current_setting['label-for-administrator']))
{
    $current_setting['label-for-administrator'] = 'Administrator';
}
if (!isset($current_setting['label-for-dashboard']))
{
    $current_setting['label-for-dashboard'] = 'Dashboard';
}
if (!isset($current_setting['label-for-help']))
{
    $current_setting['label-for-help'] = 'Help';
}
if (!isset($current_setting['label-for-rate-this-app']))
{
    $current_setting['label-for-rate-this-app'] = 'Rate This App';
}
if (!isset($current_setting['label-for-featured-products']))
{
    $current_setting['label-for-featured-products'] = 'Featured Products';
}
if (!isset($current_setting['label-for-latest-products']))
{
    $current_setting['label-for-latest-products'] = 'Latest Products';
}
if (!isset($current_setting['label-for-tags']))
{
    $current_setting['label-for-tags'] = 'Tags';
}
if (!isset($current_setting['label-for-categories']))
{
    $current_setting['label-for-categories'] = 'Categories';
}
if (!isset($current_setting['label-for-all']))
{
    $current_setting['label-for-all'] = 'All';
}
if (!isset($current_setting['label-for-continue-shopping']))
{
    $current_setting['label-for-continue-shopping'] = 'Continue Shopping';
}
if (!isset($current_setting['label-for-products-in-your-wishlist']))
{
    $current_setting['label-for-products-in-your-wishlist'] = 'Products in Your Wishlist';
}
if (!isset($current_setting['label-for-status']))
{
    $current_setting['label-for-status'] = 'Status';
}
if (!isset($current_setting['label-for-quantity']))
{
    $current_setting['label-for-quantity'] = 'Quantity';
}
if (!isset($current_setting['label-for-subtotal']))
{
    $current_setting['label-for-subtotal'] = 'Subtotal';
}
if (!isset($current_setting['label-for-shipping']))
{
    $current_setting['label-for-shipping'] = 'Shipping';
}
if (!isset($current_setting['label-for-total']))
{
    $current_setting['label-for-total'] = 'Total';
}
if (!isset($current_setting['label-for-edit']))
{
    $current_setting['label-for-edit'] = 'Edit';
}
if (!isset($current_setting['label-for-products-in-your-cart']))
{
    $current_setting['label-for-products-in-your-cart'] = 'Products in Your Cart';
}
if (!isset($current_setting['label-for-checkout']))
{
    $current_setting['label-for-checkout'] = 'Checkout';
}
if (!isset($current_setting['label-for-apply']))
{
    $current_setting['label-for-apply'] = 'Apply';
}
if (!isset($current_setting['label-for-coupon-code']))
{
    $current_setting['label-for-coupon-code'] = 'Coupon Code';
}
if (!isset($current_setting['label-for-ok']))
{
    $current_setting['label-for-ok'] = 'OK';
}
if (!isset($current_setting['label-for-cancel']))
{
    $current_setting['label-for-cancel'] = 'Cancel';
}
if (!isset($current_setting['label-for-discount']))
{
    $current_setting['label-for-discount'] = 'Discount';
}
if (!isset($current_setting['label-for-shipping-total']))
{
    $current_setting['label-for-shipping-total'] = 'Shipping Total';
}
if (!isset($current_setting['label-for-discount-total']))
{
    $current_setting['label-for-discount-total'] = 'Discount Total';
}
if (!isset($current_setting['label-for-billing-address']))
{
    $current_setting['label-for-billing-address'] = 'Billing Address';
}
if (!isset($current_setting['label-for-shipping-address']))
{
    $current_setting['label-for-shipping-address'] = 'Shipping Address';
}
if (!isset($current_setting['label-for-state']))
{
    $current_setting['label-for-state'] = 'State';
}
if (!isset($current_setting['label-for-postcode']))
{
    $current_setting['label-for-postcode'] = 'Postcode';
}
if (!isset($current_setting['label-for-city']))
{
    $current_setting['label-for-city'] = 'City';
}
if (!isset($current_setting['label-for-address_1']))
{
    $current_setting['label-for-address_1'] = 'Address 1';
}
if (!isset($current_setting['label-for-address_2']))
{
    $current_setting['label-for-address_2'] = 'Address 2';
}
if (!isset($current_setting['label-for-email']))
{
    $current_setting['label-for-email'] = 'Email';
}
if (!isset($current_setting['label-for-phone']))
{
    $current_setting['label-for-phone'] = 'Phone';
}
if (!isset($current_setting['label-for-first-name']))
{
    $current_setting['label-for-first-name'] = 'First Name';
}
if (!isset($current_setting['label-for-last-name']))
{
    $current_setting['label-for-last-name'] = 'Last Name';
}
if (!isset($current_setting['label-for-country']))
{
    $current_setting['label-for-country'] = 'Country';
}
if (!isset($current_setting['label-for-address']))
{
    $current_setting['label-for-address'] = 'Address';
}
if (!isset($current_setting['label-for-choose-your-country']))
{
    $current_setting['label-for-choose-your-country'] = 'Choose Your Country';
}
if (!isset($current_setting['label-for-choose-your-state']))
{
    $current_setting['label-for-choose-your-state'] = 'Choose Your State';
}
if (!isset($current_setting['label-for-same-as-the-billing-address']))
{
    $current_setting['label-for-same-as-the-billing-address'] = 'Same as the billing address';
}
if (!isset($current_setting['label-for-save']))
{
    $current_setting['label-for-save'] = 'Save';
}
if (!isset($current_setting['label-for-review']))
{
    $current_setting['label-for-review'] = 'Review';
}
if (!isset($current_setting['label-for-payment']))
{
    $current_setting['label-for-payment'] = 'Payment';
}
if (!isset($current_setting['label-for-continue-to-shipping']))
{
    $current_setting['label-for-continue-to-shipping'] = 'Continue To Shipping';
}
if (!isset($current_setting['label-for-successfully-saved']))
{
    $current_setting['label-for-successfully-saved'] = 'The data has been successfully saved!';
}
if (!isset($current_setting['label-for-continue-to-review']))
{
    $current_setting['label-for-continue-to-review'] = 'Continue To Review';
}
if (!isset($current_setting['label-for-continue-to-payment']))
{
    $current_setting['label-for-continue-to-payment'] = 'Continue To Payment';
}
if (!isset($current_setting['label-for-data-is-incomplete']))
{
    $current_setting['label-for-data-is-incomplete'] = 'The requested data is incomplete!';
}
if (!isset($current_setting['label-for-coupon-saved']))
{
    $current_setting['label-for-coupon-saved'] = 'Coupon code saved successfully!';
}
if (!isset($current_setting['label-for-payment-method']))
{
    $current_setting['label-for-payment-method'] = 'Payment Method';
}
if (!isset($current_setting['label-for-order-details']))
{
    $current_setting['label-for-order-details'] = 'Order details';
}
if (!isset($current_setting['label-for-place-order']))
{
    $current_setting['label-for-place-order'] = 'Place Order';
}
if (!isset($current_setting['label-for-order-received']))
{
    $current_setting['label-for-order-received'] = 'Your order has been received';
}
if (!isset($current_setting['label-for-order-number']))
{
    $current_setting['label-for-order-number'] = 'Order Number';
}
if (!isset($current_setting['label-for-detail']))
{
    $current_setting['label-for-detail'] = 'Detail';
}
if (!isset($current_setting['label-for-ordered-products']))
{
    $current_setting['label-for-ordered-products'] = 'Ordered Products';
}
if (!isset($current_setting['label-for-item']))
{
    $current_setting['label-for-item'] = 'Item';
}
if (!isset($current_setting['label-for-order-history']))
{
    $current_setting['label-for-order-history'] = 'Order History';
}
if (!isset($current_setting['label-for-subtotal-tax']))
{
    $current_setting['label-for-subtotal-tax'] = 'Subtotal Tax';
}
if (!isset($current_setting['label-for-total-tax']))
{
    $current_setting['label-for-total-tax'] = 'Total Tax';
}
if (!isset($current_setting['label-for-price']))
{
    $current_setting['label-for-price'] = 'Price';
}
if (!isset($current_setting['label-for-note']))
{
    $current_setting['label-for-note'] = 'Note';
}
if (!isset($current_setting['label-for-connection-lost']))
{
    $current_setting['label-for-connection-lost'] = 'Connection lost, please check your connection!';
}
if (!isset($current_setting['label-for-no-order-history']))
{
    $current_setting['label-for-no-order-history'] = 'No order history';
}
if (!isset($current_setting['label-for-coupon-is-invalid']))
{
    $current_setting['label-for-coupon-is-invalid'] = 'The coupon is invalid!';
}
if (!isset($current_setting['label-for-currency']))
{
    $current_setting['label-for-currency'] = 'Currency';
}

if (!isset($current_setting['label-for-date-created']))
{
    $current_setting['label-for-date-created'] = 'Date Created';
}

if (!isset($current_setting['label-for-discount-tax']))
{
    $current_setting['label-for-discount-tax'] = 'Discount Tax';
}

if (!isset($current_setting['label-for-shipping-tax']))
{
    $current_setting['label-for-shipping-tax'] = 'Shipping Tax';
}
if (!isset($current_setting['label-for-cart-tax']))
{
    $current_setting['label-for-cart-tax'] = 'Cart Tax';
}
if (!isset($current_setting['slides-per-view']))
{
    $current_setting['slides-per-view'] = '2';
}
if (!isset($current_setting['auto-play']))
{
    $current_setting['auto-play'] = false;
}
if (!isset($current_setting['label-for-actual-prices-note']))
{
    $current_setting['label-for-actual-prices-note'] = 'Actual prices will appear after checkout is complete';
}
if (!isset($current_setting['label-for-note']))
{
    $current_setting['label-for-note'] = 'Note';
}


if (!isset($current_setting['label-for-dark-mode']))
{
    $current_setting['label-for-dark-mode'] = 'Dark Mode';
}


if (!isset($current_setting['auth-type']))
{
    $current_setting['auth-type'] = 'basic';
}
if (!isset($current_setting['show-featured']))
{
    $current_setting['show-featured'] = false;
}
if (!isset($current_setting['show-tags']))
{
    $current_setting['show-tags'] = false;
}
if (!isset($current_setting['show-banners']))
{
    $current_setting['show-banners'] = false;
}

if (!isset($current_setting['banner-helper']))
{
    $current_setting['banner-helper'] = '';
}

if (!isset($current_setting['banner-by-cat-posts']))
{
    $current_setting['banner-by-cat-posts'] = '';
}

if (!isset($current_setting['banner-custom-api-url']))
{
    $current_setting['banner-custom-api-url'] = '';
}

if (!isset($current_setting['banner-custom-api-variable']))
{
    $current_setting['banner-custom-api-variable'] = '';
}


// TODO: LAYOUT --|-- FORM
$content .= '<form action="" method="post"><!-- ./form -->';
$content .= '<div class="row"><!-- row -->';
$content .= '<div class="col-md-7"><!-- col-md-7 -->';
$content .= '<div class="box box-danger">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-magic"></i> ' . __e('General') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse" >';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
$content .= '<div class="callout callout-default">' . __e('Please complete the form below to let us know how we can help you build code:') . '</div>';
$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- PAGE-HEADER-COLOR
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-header-color">' . __e('Header Color') . '</label>';
$content .= '<select name="woocommerce[page-header-color]" class="form-control select-color" data-color="' . $current_setting['page-header-color'] . '">';
foreach ($color_names as $color_name)
{
    $selected = '';
    if ($color_name['value'] == $current_setting['page-header-color'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . $color_name['value'] . '" ' . $selected . '>' . $color_name['label'] . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('Color variation from the header') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';
// TODO: LAYOUT --|-- FORM --|-- PAGE-CONTENT-BACKGROUND
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-background">' . __e('Background Image') . '</label>';
$content .= '<div class="input-group">';
$content .= '<input id="page-content-background" type="text" name="woocommerce[page-content-background]" class="form-control" placeholder="assets/images/bg-01.png"  value="' . $current_setting['page-content-background'] . '"  ' . $disabled . ' required />';
$content .= '<span class="input-group-btn"><button type="button" data-type="file-picker" data-target="#page-content-background" class="btn btn-info btn-flat"><i class="fa fa-folder-open"></i></button></span>';
$content .= '</div>';
$content .= '<p class="help-block">' . __e('The background image of content ') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div>';
// TODO: LAYOUT --|-- FORM --|-- WORDPRESS-URL --|-- URL
$content .= '<div class="row"><!-- row -->';

$content .= '<div id="field-wordpress-url" class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-wordpress-url">' . __e('WordPress URL') . '</label>';
$content .= '<input id="page-wordpress-url" type="url" name="woocommerce[wordpress-url]" class="form-control" placeholder="https://yourwordpress.com/"  value="' . $current_setting['wordpress-url'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Your wordpress site address, only works on websites that have ssl <code>https://</code>') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';

// TODO: LAYOUT --|-- FORM --|-- AUTH-TYPE --|-- SELECT
$options = array();
$options[] = array('value' => 'basic', 'label' => 'HTTP - Basic');
$options[] = array('value' => 'url', 'label' => 'URL');

$content .= '<div id="field-auth-type" class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-auth-type">' . __e('Auth Type') . '</label>';
$content .= '<select id="page-auth-type" name="woocommerce[auth-type]" class="form-control" ' . $disabled . ' >';
foreach ($options as $option)
{
    $selected = '';
    if ($option['value'] == $current_setting['auth-type'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . htmlentities($option['value']) . '" ' . $selected . '>' . htmlentities($option['label']) . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('Please choose the type of authorization supported by your server') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';


$content .= '</div><!-- ./row -->';
// TODO: LAYOUT --|-- FORM --|-- CONSUMER-KEY --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-consumer-key" class="col-md-5"><!-- col-md-5 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-consumer-key">' . __e('Consumer Key') . '</label>';
$content .= '<input id="page-consumer-key" type="text" name="woocommerce[consumer-key]" class="form-control" placeholder="ck_e6e4ba2119feeedf0b389666bfdb52e6bba89b9f"  value="' . $current_setting['consumer-key'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('This value is obtained from WooCommerce -&raquo; Settings -&raquo; Advanced -&raquo; REST API, readmore: <a target="_blank" href="https://docs.woocommerce.com/document/woocommerce-rest-api/">WooCommerce REST API</a>') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-5 -->';
// TODO: LAYOUT --|-- FORM --|-- CONSUMER-SECRET --|-- TEXT
$content .= '<div id="field-consumer-secret" class="col-md-5"><!-- col-md-5 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-consumer-secret">' . __e('Consumer Secret') . '</label>';
$content .= '<input id="page-consumer-secret" type="text" name="woocommerce[consumer-secret]" class="form-control" placeholder="cs_74803b6297637bb392d49ae8e31acc2199245b32"  value="' . $current_setting['consumer-secret'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('This value is obtained from WooCommerce -&raquo; Settings -&raquo; Advanced -&raquo; REST API, readmore: <a target="_blank" href="https://docs.woocommerce.com/document/woocommerce-rest-api/">WooCommerce REST API</a>') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-5 -->';
// TODO: LAYOUT --|-- FORM --|-- PER-PAGE --|-- TEXT
$content .= '<div id="field-per-page" class="col-md-2"><!-- col-md-2 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-per-page">' . __e('Per Page') . '</label>';
$content .= '<input id="page-per-page" type="text" name="woocommerce[per-page]" class="form-control" placeholder="10"  value="' . $current_setting['per-page'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Filter the number of items per page to show') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-2 -->';
$content .= '</div><!-- ./row -->';


$content .= '<hr/>';
$content .= '<h4>' . __e('Home Page') . '</h4>';

$content .= '<table class="table table-striped">';

$content .= '<tr>';
if ($current_setting['show-banners'] == true)
{
    $content .= '<td><input checked="checked" class="flat-red" type="checkbox" id="page-show-banners" name="woocommerce[show-banners]" ' . $disabled . '/></td>';
} else
{
    $content .= '<td><input class="flat-red" type="checkbox" id="page-show-banners" name="woocommerce[show-banners]" ' . $disabled . '/></td>';
}
$content .= '<td><label>' . __e('Show Banners') . '</label><br/><small>' . __e('Featured images will be used as banner images') . '</small></td>';
$content .= '<td>';
$options = array();

$options[] = array('value' => 'default', 'label' => 'WP Posts ~ Default');
$options[] = array('value' => 'rest-api-helper', 'label' => 'WP Posts ~ REST-API Helper Plugin');
$options[] = array('value' => 'jackpat', 'label' => 'WP Posts ~ Jackpat Plugin');
$options[] = array('value' => 'custom-api', 'label' => 'Custom API');

$content .= '<div class="form-group">';
$content .= '<label for="page-banner-helper">' . __e('API Helper') . '</label>';
$content .= '<select id="page-banner-helper" name="woocommerce[banner-helper]" class="form-control" ' . $disabled . ' >';
foreach ($options as $option)
{
    $selected = '';
    if ($option['value'] == $current_setting['banner-helper'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . htmlentities($option['value']) . '" ' . $selected . '>' . htmlentities($option['label']) . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block" id="page-banner-helper-help" style="color: #F39C12;border: 1px dashed #F39C12;padding: 3px;background: #5b5858;">' . __e('') . '</p>';
$content .= '</div>';
$content .= '</td>';

$content .= '<td>';
$content .= '<div class="form-group">';
$content .= '<label for="page-banner-by-cat-posts">' . __e('WP Posts by Categories Id') . '</label>';
$content .= '<input id="page-banner-by-cat-posts" type="text" name="woocommerce[banner-by-cat-posts]" class="form-control" placeholder="1,2,3"  value="' . $current_setting['banner-by-cat-posts'] . '"  ' . $disabled . ' />';
$content .= '<p class="help-block">' . __e('') . '</p>';
$content .= '</div>';
$content .= '</td>';
$content .= '</tr>';

$content .= '<tr id="custom-api-box">';
$content .= '<td></td>';
$content .= '<td></td>';
$content .= '<td>';
$content .= '<div class="form-group">';
$content .= '<label for="page-banner-custom-api-url">' . __e('API Url') . '</label>';
$content .= '<input id="page-banner-custom-api-url" type="text" name="woocommerce[banner-custom-api-url]" class="form-control" placeholder="https://site.com/wp-json/wp/v2/xxx_banner"  value="' . $current_setting['banner-custom-api-url'] . '"  ' . $disabled . ' />';
$content .= '<p class="help-block">' . __e('Write the endpoint url for the image to be displayed') . '</p>';
$content .= '</div>';
$content .= '</td>';

$content .= '<td>';
$content .= '<div class="form-group">';
$content .= '<label for="page-banner-custom-api-variable">' . __e('Image Variable') . '</label>';
$content .= '<input id="page-banner-custom-api-variable" type="text" name="woocommerce[banner-custom-api-variable]" class="form-control" placeholder="images"  value="' . $current_setting['banner-custom-api-variable'] . '"  ' . $disabled . ' />';
$content .= '<p class="help-block">' . __e('Write the variable used by the image') . '</p>';
$content .= '</div>';
$content .= '</td>';
$content .= '</tr>';


// TODO: LAYOUT --|-- FORM --|-- SHOW-FEATURED --|-- CHECKBOX
$content .= '<tr>';
if ($current_setting['show-featured'] == true)
{
    $content .= '<td><input checked="checked" class="flat-red" type="checkbox" id="page-show-featured" name="woocommerce[show-featured]" ' . $disabled . '/></td>';
} else
{
    $content .= '<td><input class="flat-red" type="checkbox" id="page-show-featured" name="woocommerce[show-featured]" ' . $disabled . '/></td>';
}
$content .= '<td><label>' . __e('Show Featured Products') . '</label></td>';
$content .= '<td>';
// TODO: LAYOUT --|-- FORM --|-- SLIDES-PER-VIEW --|-- SELECT
$options = array();
$options[] = array('value' => '1', 'label' => '1');
$options[] = array('value' => '2', 'label' => '2');
$options[] = array('value' => '3', 'label' => '3');
$options[] = array('value' => '4', 'label' => '4');
$options[] = array('value' => '5', 'label' => '5');
$options[] = array('value' => '6', 'label' => '6');

$content .= '<div class="form-group">';
$content .= '<label for="page-slides-per-view">' . __e('Slides Per View') . '</label>';
$content .= '<select id="page-slides-per-view" name="woocommerce[slides-per-view]" class="form-control" ' . $disabled . ' >';
foreach ($options as $option)
{
    $selected = '';
    if ($option['value'] == $current_setting['slides-per-view'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . htmlentities($option['value']) . '" ' . $selected . '>' . htmlentities($option['label']) . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('The number of slides displayed in one view') . '</p>';
$content .= '</div>';
$content .= '</td>';

$content .= '<td>';
// TODO: LAYOUT --|-- FORM --|-- AUTO-PLAY --|-- CHECKBOX
$content .= '<label for="page-slides-per-view">' . __e('Auto Play') . '</label>';
$content .= '<table class="table">';
$content .= '<tr>';
if ($current_setting['auto-play'] == true)
{
    $content .= '<td><input checked="checked" class="flat-red" type="checkbox" id="page-auto-play" name="woocommerce[auto-play]" ' . $disabled . '/></td>';
} else
{
    $content .= '<td><input class="flat-red" type="checkbox" id="page-auto-play" name="woocommerce[auto-play]" ' . $disabled . '/></td>';
}
$content .= '<td>' . __e('Automatically change slides') . '</td>';
$content .= '</tr>';
$content .= '</table>';


$content .= '</td>';
$content .= '</tr>';

// TODO: LAYOUT --|-- FORM --|-- SHOW-TAGS --|-- CHECKBOX
$content .= '<tr>';
if ($current_setting['show-tags'] == true)
{
    $content .= '<td><input checked="checked" class="flat-red" type="checkbox" id="page-show-tags" name="woocommerce[show-tags]" ' . $disabled . '/></td>';
} else
{
    $content .= '<td><input class="flat-red" type="checkbox" id="page-show-tags" name="woocommerce[show-tags]" ' . $disabled . '/></td>';
}
$content .= '<td><label>' . __e('Show Tags') . '</label></td>';
$content .= '<td></td>';
$content .= '<td></td>';
$content .= '</tr>';


$content .= '</table>';


// TODO: LAYOUT --|-- FORM --|-- CONTACT-US --|-- DEVIDER
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-contact-us" class="col-md-12"><!-- col-md-12 -->';
$content .= '<hr/>';
$content .= '<h4>' . __e('Additional Directives') . '</h4>';
$content .= '</div><!-- ./col-md-12 -->';
$content .= '</div><!-- ./row -->';
$content .= '<table class="table table-striped">';
if (isset($current_app['directives']['preview-any-file']['var']))
{
    $content .= '<tr>';
    $content .= '<td><strong>Preview Any File</strong><br/><small>' . __e('Required to display images') . '</small></td>';
    $content .= '<td><span class="label label-success">' . __e('available') . '</span></td>';
    $content .= '</tr>';
} else
{
    $content .= '<tr>';
    $content .= '<td><strong>Preview Any File</strong><br/><small>' . __e('Required to display images') . '</small></td>';
    $content .= '<td><span class="label label-danger">' . __e('Not available') . '</span></td>';
    $content .= '</tr>';
}

if (isset($current_app['directives']['paypal']['var']))
{
    //$content .= '<tr>';
    //$content .= '<td><strong>PayPal</strong><br/><small>' . __e('Payment via paypal') . '</small></td>';
    //$content .= '<td><span class="label label-success">' . __e('available') . '</span></td>';
    //$content .= '</tr>';
} else
{
    //$content .= '<tr>';
    //$content .= '<td><strong>PayPal</strong><br/><small>' . __e('Payment via paypal') . '</small></td>';
    //$content .= '<td><span class="label label-danger">' . __e('Not available') . '</span></td>';
    //$content .= '</tr>';
}
$content .= '</table>';
$content .= '<p>' . __e('To activate: go to the <code>(IMAB) Directives</code> Menu -&raquo; <code>Additional Directives</code>') . '</p>';


$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-contact-us" class="col-md-12"><!-- col-md-12 -->';
$content .= '<hr/>';
$content .= '<h4>' . __e('Contact Us') . '</h4>';
$content .= '</div><!-- ./col-md-12 -->';
$content .= '</div><!-- ./row -->';
// TODO: LAYOUT --|-- FORM --|-- CONTACT-CALL --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-contact-call" class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-contact-call">' . __e('Call') . '</label>';
$content .= '<input id="page-contact-call" type="text" name="woocommerce[contact-call]" class="form-control" placeholder="628123456789"  value="' . $current_setting['contact-call'] . '"  ' . $disabled . '  />';
$content .= '<p class="help-block">' . __e('Write down the telephone number') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
// TODO: LAYOUT --|-- FORM --|-- CONTACT-SMS --|-- TEXT
$content .= '<div id="field-contact-sms" class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-contact-sms">' . __e('SMS') . '</label>';
$content .= '<input id="page-contact-sms" type="text" name="woocommerce[contact-sms]" class="form-control" placeholder="628123456789"  value="' . $current_setting['contact-sms'] . '"  ' . $disabled . '  />';
$content .= '<p class="help-block">' . __e('Write down the phone number') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
// TODO: LAYOUT --|-- FORM --|-- CONTACT-WHATSAPP --|-- TEXT
$content .= '<div id="field-contact-whatsapp" class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-contact-whatsapp">' . __e('WhatsApp') . '</label>';
$content .= '<input id="page-contact-whatsapp" type="text" name="woocommerce[contact-whatsapp]" class="form-control" placeholder="628123456789"  value="' . $current_setting['contact-whatsapp'] . '"  ' . $disabled . '  />';
$content .= '<p class="help-block">' . __e('Write down the WhatsApp number') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
// TODO: LAYOUT --|-- FORM --|-- CONTACT-EMAIL --|-- TEXT
$content .= '<div id="field-contact-email" class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-contact-email">' . __e('Email') . '</label>';
$content .= '<input id="page-contact-email" type="text" name="woocommerce[contact-email]" class="form-control" placeholder="info@ihsana.com"  value="' . $current_setting['contact-email'] . '"  ' . $disabled . '  />';
$content .= '<p class="help-block">' . __e('Write down the email address') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '</div><!-- ./row -->';
$content .= '</div>';
$content .= '<div class="box-footer pad">';
$content .= '<input name="save-woocommerce" type="submit" class="btn btn-danger btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
$content .= '</div>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-7 -->';
$content .= '<div class="col-md-5"><!-- col-md-5 -->';
$content .= '<div class="box box-warning">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-cubes"></i> ' . __e('Labels') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
$content .= '<div class="responsive" style="height: 800px;overflow-y: scroll;overflow-x: hidden;">';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-HOME --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-home" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-home">' . __e('Label for `Home`') . '</label>';
$content .= '<input id="page-label-for-home" type="text" name="woocommerce[label-for-home]" class="form-control" placeholder="Home"  value="' . $current_setting['label-for-home'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Home`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-PRODUCTS --|-- TEXT
$content .= '<div id="field-label-for-products" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-products">' . __e('Label for `Products`') . '</label>';
$content .= '<input id="page-label-for-products" type="text" name="woocommerce[label-for-products]" class="form-control" placeholder="Products"  value="' . $current_setting['label-for-products'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Products`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-WISHLIST --|-- TEXT
$content .= '<div id="field-label-for-wishlist" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-wishlist">' . __e('Label for `Wishlist`') . '</label>';
$content .= '<input id="page-label-for-wishlist" type="text" name="woocommerce[label-for-wishlist]" class="form-control" placeholder="Wishlist"  value="' . $current_setting['label-for-wishlist'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Wishlist`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-CART --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-cart" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-cart">' . __e('Label for `Cart`') . '</label>';
$content .= '<input id="page-label-for-cart" type="text" name="woocommerce[label-for-cart]" class="form-control" placeholder="Cart"  value="' . $current_setting['label-for-cart'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Shopping Cart`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '<div id="field-label-for-account" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-account">' . __e('Label for `Account`') . '</label>';
$content .= '<input id="page-label-for-account" type="text" name="woocommerce[label-for-account]" class="form-control" placeholder="Account"  value="' . $current_setting['label-for-account'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Account`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-PLEASE-WAIT --|-- TEXT
$content .= '<div id="field-label-for-please-wait" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-please-wait">' . __e('Label for `Please Wait`') . '</label>';
$content .= '<input id="page-label-for-please-wait" type="text" name="woocommerce[label-for-please-wait]" class="form-control" placeholder="Please Wait..."  value="' . $current_setting['label-for-please-wait'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Please Wait`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-NO-PRODUCTS-FOUND --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-no-products-found" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-no-products-found">' . __e('Label for `No products found!`') . '</label>';
$content .= '<input id="page-label-for-no-products-found" type="text" name="woocommerce[label-for-no-products-found]" class="form-control" placeholder="No products found!"  value="' . $current_setting['label-for-no-products-found'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `No products found!`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-ADD-TO-CART --|-- TEXT
$content .= '<div id="field-label-for-add-to-cart" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-add-to-cart">' . __e('Label for `Add to Cart`') . '</label>';
$content .= '<input id="page-label-for-add-to-cart" type="text" name="woocommerce[label-for-add-to-cart]" class="form-control" placeholder="Add to Cart"  value="' . $current_setting['label-for-add-to-cart'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Add to Cart`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-BUY --|-- TEXT
$content .= '<div id="field-label-for-buy" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-buy">' . __e('Label for `Buy!`') . '</label>';
$content .= '<input id="page-label-for-buy" type="text" name="woocommerce[label-for-buy]" class="form-control" placeholder="Buy!"  value="' . $current_setting['label-for-buy'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Buy!`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-CONTACT-US --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-contact-us" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-contact-us">' . __e('Label for `Contact Us`') . '</label>';
$content .= '<input id="page-label-for-contact-us" type="text" name="woocommerce[label-for-contact-us]" class="form-control" placeholder="Contact Us"  value="' . $current_setting['label-for-contact-us'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Contact Us`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-ORDERING-INFORMATION --|-- TEXT
$content .= '<div id="field-label-for-ordering-information" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-ordering-information">' . __e('Label for `Ordering Information`') . '</label>';
$content .= '<input id="page-label-for-ordering-information" type="text" name="woocommerce[label-for-ordering-information]" class="form-control" placeholder=""  value="' . $current_setting['label-for-ordering-information'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Ordering Information`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-DIMENSIONS --|-- TEXT
$content .= '<div id="field-label-for-dimensions" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-dimensions">' . __e('Label for `Dimensions`') . '</label>';
$content .= '<input id="page-label-for-dimensions" type="text" name="woocommerce[label-for-dimensions]" class="form-control" placeholder="Dimensions"  value="' . $current_setting['label-for-dimensions'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Dimensions`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';
$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-WEIGHT --|-- TEXT
$content .= '<div id="field-label-for-weight" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-weight">' . __e('Label for `Weight`') . '</label>';
$content .= '<input id="page-label-for-weight" type="text" name="woocommerce[label-for-weight]" class="form-control" placeholder="Weight"  value="' . $current_setting['label-for-weight'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Weight`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-ADDITIONAL-INFORMATION --|-- TEXT
$content .= '<div id="field-label-for-additional-information" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-additional-information">' . __e('Label for `Additional-Information`') . '</label>';
$content .= '<input id="page-label-for-additional-information" type="text" name="woocommerce[label-for-additional-information]" class="form-control" placeholder="Additional Information"  value="' . $current_setting['label-for-additional-information'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Additional-Information`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-CLEAN-UP --|-- TEXT
$content .= '<div id="field-label-for-clean-up" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-clean-up">' . __e('Label for `Clean Up`') . '</label>';
$content .= '<input id="page-label-for-clean-up" type="text" name="woocommerce[label-for-clean-up]" class="form-control" placeholder="Clean Up"  value="' . $current_setting['label-for-clean-up'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Clean Up`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-DELETE --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-delete" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-delete">' . __e('Label for `Delete`') . '</label>';
$content .= '<input id="page-label-for-delete" type="text" name="woocommerce[label-for-delete]" class="form-control" placeholder="Delete"  value="' . $current_setting['label-for-delete'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Delete`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-ADDED-TO-YOUR-CART --|-- TEXT
$content .= '<div id="field-label-for-added-to-your-cart" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-added-to-your-cart">' . __e('Label for `Item has been added to your cart`') . '</label>';
$content .= '<input id="page-label-for-added-to-your-cart" type="text" name="woocommerce[label-for-added-to-your-cart]" class="form-control" placeholder="Item has been added to your cart"  value="' . $current_setting['label-for-added-to-your-cart'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Item has been added to your cart`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-ALL --|-- TEXT
$content .= '<div id="field-label-for-all" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-all">' . __e('Label for `All`') . '</label>';
$content .= '<input id="page-label-for-all" type="text" name="woocommerce[label-for-all]" class="form-control" placeholder="All"  value="' . $current_setting['label-for-all'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `All`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-PRIVACY-POLICY --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-privacy-policy" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-privacy-policy">' . __e('Label for `Privacy Policy`') . '</label>';
$content .= '<input id="page-label-for-privacy-policy" type="text" name="woocommerce[label-for-privacy-policy]" class="form-control" placeholder="Privacy Policy"  value="' . $current_setting['label-for-privacy-policy'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Privacy Policy`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-ABOUT-US --|-- TEXT
$content .= '<div id="field-label-for-about-us" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-about-us">' . __e('Label for `About Us`') . '</label>';
$content .= '<input id="page-label-for-about-us" type="text" name="woocommerce[label-for-about-us]" class="form-control" placeholder="About Us"  value="' . $current_setting['label-for-about-us'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `About Us`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-ADMINISTRATOR --|-- TEXT
$content .= '<div id="field-label-for-administrator" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-administrator">' . __e('Label for `Administrator`') . '</label>';
$content .= '<input id="page-label-for-administrator" type="text" name="woocommerce[label-for-administrator]" class="form-control" placeholder=""  value="' . $current_setting['label-for-administrator'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Administrator`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-DASHBOARD --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-dashboard" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-dashboard">' . __e('Label for `Dashboard`') . '</label>';
$content .= '<input id="page-label-for-dashboard" type="text" name="woocommerce[label-for-dashboard]" class="form-control" placeholder="Dashboard"  value="' . $current_setting['label-for-dashboard'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Dashboard`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-HELP --|-- TEXT
$content .= '<div id="field-label-for-help" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-help">' . __e('Label for `Help`') . '</label>';
$content .= '<input id="page-label-for-help" type="text" name="woocommerce[label-for-help]" class="form-control" placeholder="About UsHelp"  value="' . $current_setting['label-for-help'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Help`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-RATE-THIS-APP --|-- TEXT
$content .= '<div id="field-label-for-rate-this-app" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-rate-this-app">' . __e('Label for `Rate This App`') . '</label>';
$content .= '<input id="page-label-for-rate-this-app" type="text" name="woocommerce[label-for-rate-this-app]" class="form-control" placeholder=""  value="' . $current_setting['label-for-rate-this-app'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Rate This App`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-FEATURED-PRODUCTS --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-featured-products" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-featured-products">' . __e('Label for `Featured products`') . '</label>';
$content .= '<input id="page-label-for-featured-products" type="text" name="woocommerce[label-for-featured-products]" class="form-control" placeholder="Featured products"  value="' . $current_setting['label-for-featured-products'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Featured products`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-LATEST-PRODUCTS --|-- TEXT
$content .= '<div id="field-label-for-latest-products" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-latest-products">' . __e('Label for `Latest Products`') . '</label>';
$content .= '<input id="page-label-for-latest-products" type="text" name="woocommerce[label-for-latest-products]" class="form-control" placeholder="Latest Products"  value="' . $current_setting['label-for-latest-products'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Latest Products`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-TAGS --|-- TEXT
$content .= '<div id="field-label-for-tags" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-tags">' . __e('Label for `Tags`') . '</label>';
$content .= '<input id="page-label-for-tags" type="text" name="woocommerce[label-for-tags]" class="form-control" placeholder="Tags"  value="' . $current_setting['label-for-tags'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Tags`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-CATEGORIES --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-categories" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-categories">' . __e('Label for `Categories`') . '</label>';
$content .= '<input id="page-label-for-categories" type="text" name="woocommerce[label-for-categories]" class="form-control" placeholder="Categories"  value="' . $current_setting['label-for-categories'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Categories`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-CONTINUE-SHOPPING --|-- TEXT
$content .= '<div id="field-label-for-continue-shopping" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-continue-shopping">' . __e('Label for `Continue Shopping`') . '</label>';
$content .= '<input id="page-label-for-continue-shopping" type="text" name="woocommerce[label-for-continue-shopping]" class="form-control" placeholder="Continue Shopping"  value="' . $current_setting['label-for-continue-shopping'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Continue Shopping`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-YOUR-WISHLIST --|-- TEXT
$content .= '<div id="field-label-for-your-wishlist" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-your-wishlist">' . __e('Label for `Products in Your Wishlist`') . '</label>';
$content .= '<input id="page-label-for-your-wishlist" type="text" name="woocommerce[label-for-products-in-your-wishlist]" class="form-control" placeholder="Products in Your Wishlist"  value="' . $current_setting['label-for-products-in-your-wishlist'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Your Wishlist`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-STATUS --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-status" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-status">' . __e('Label for `Status`') . '</label>';
$content .= '<input id="page-label-for-status" type="text" name="woocommerce[label-for-status]" class="form-control" placeholder="Status"  value="' . $current_setting['label-for-status'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Status`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-QUANTITY --|-- TEXT
$content .= '<div id="field-label-for-quantity" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-quantity">' . __e('Label for `Quantity`') . '</label>';
$content .= '<input id="page-label-for-quantity" type="text" name="woocommerce[label-for-quantity]" class="form-control" placeholder="Quantity"  value="' . $current_setting['label-for-quantity'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Quantity`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-SUBTOTAL --|-- TEXT
$content .= '<div id="field-label-for-subtotal" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-note">' . __e('Label for `Note`') . '</label>';
$content .= '<input id="page-label-for-note" type="text" name="woocommerce[label-for-note]" class="form-control" placeholder="Note"  value="' . $current_setting['label-for-note'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Note`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-SHIPPING --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-shipping" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-shipping">' . __e('Label for `Shipping`') . '</label>';
$content .= '<input id="page-label-for-shipping" type="text" name="woocommerce[label-for-shipping]" class="form-control" placeholder="Shipping"  value="' . $current_setting['label-for-shipping'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Shipping`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-TOTAL --|-- TEXT
$content .= '<div id="field-label-for-total" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-total">' . __e('Label for `Total`') . '</label>';
$content .= '<input id="page-label-for-total" type="text" name="woocommerce[label-for-total]" class="form-control" placeholder="Total"  value="' . $current_setting['label-for-total'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Total`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-EDIT --|-- TEXT
$content .= '<div id="field-label-for-total" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-total">' . __e('Label for `Edit`') . '</label>';
$content .= '<input id="page-label-for-total" type="text" name="woocommerce[label-for-edit]" class="form-control" placeholder="Edit"  value="' . $current_setting['label-for-edit'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Edit`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';
$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-PRODUCTS-IN-YOUR-CART --|-- TEXT
$content .= '<div id="field-label-for-products-in-your-cart" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-products-in-your-cart">' . __e('Label for `Products in your cart`') . '</label>';
$content .= '<input id="page-label-for-products-in-your-cart" type="text" name="woocommerce[label-for-products-in-your-cart]" class="form-control" placeholder="Products in your cart"  value="' . $current_setting['label-for-products-in-your-cart'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Products in your cart`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-CHECKOUT --|-- TEXT
$content .= '<div id="field-label-for-checkout" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-checkout">' . __e('Label for `Checkout`') . '</label>';
$content .= '<input id="page-label-for-checkout" type="text" name="woocommerce[label-for-checkout]" class="form-control" placeholder="Checkout"  value="' . $current_setting['label-for-checkout'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Checkout`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-APPLY --|-- TEXT
$content .= '<div id="field-label-for-apply" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-apply">' . __e('Label for `Apply`') . '</label>';
$content .= '<input id="page-label-for-apply" type="text" name="woocommerce[label-for-apply]" class="form-control" placeholder="Apply"  value="' . $current_setting['label-for-apply'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Apply`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';

$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-COUPON-CODE --|-- TEXT
$content .= '<div id="field-label-for-coupon-code" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-coupon-code">' . __e('Label for `Coupon Code`') . '</label>';
$content .= '<input id="page-label-for-coupon-code" type="text" name="woocommerce[label-for-coupon-code]" class="form-control" placeholder="Coupon Code"  value="' . $current_setting['label-for-coupon-code'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Coupon Code`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-PRODUCT --|-- TEXT
$content .= '<div id="field-label-for-product" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-product">' . __e('Label for `Product`') . '</label>';
$content .= '<input id="page-label-for-product" type="text" name="woocommerce[label-for-product]" class="form-control" placeholder="Product"  value="' . $current_setting['label-for-product'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Product`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-OK --|-- TEXT
$content .= '<div id="field-label-for-ok" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-ok">' . __e('Label for `OK`') . '</label>';
$content .= '<input id="page-label-for-ok" type="text" name="woocommerce[label-for-ok]" class="form-control" placeholder="OK"  value="' . $current_setting['label-for-ok'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `OK`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';


$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-CANCEL --|-- TEXT
$content .= '<div id="field-label-for-cancel" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-cancel">' . __e('Label for `Cancel`') . '</label>';
$content .= '<input id="page-label-for-cancel" type="text" name="woocommerce[label-for-cancel]" class="form-control" placeholder="Cancel"  value="' . $current_setting['label-for-cancel'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Cancel`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-DISCOUNT --|-- TEXT
$content .= '<div id="field-label-for-discount" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-discount">' . __e('Label for `Discount`') . '</label>';
$content .= '<input id="page-label-for-discount" type="text" name="woocommerce[label-for-discount]" class="form-control" placeholder="Discount"  value="' . $current_setting['label-for-discount'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Discount`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-SHIPPING-TOTAL --|-- TEXT
$content .= '<div id="field-label-for-shipping-total" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-shipping-total">' . __e('Label for `Shipping Total`') . '</label>';
$content .= '<input id="page-label-for-shipping-total" type="text" name="woocommerce[label-for-shipping-total]" class="form-control" placeholder="Shipping Total"  value="' . $current_setting['label-for-shipping-total'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Shipping Total`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';

$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-DISCOUNT-TOTAL --|-- TEXT
$content .= '<div id="field-label-for-discount-total" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-discount-total">' . __e('Label for `Discount Total`') . '</label>';
$content .= '<input id="page-label-for-discount-total" type="text" name="woocommerce[label-for-discount-total]" class="form-control" placeholder="Discount Total"  value="' . $current_setting['label-for-discount-total'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Discount Total`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-BILLING-ADDRESS --|-- TEXT
$content .= '<div id="field-label-for-billing-address" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-billing-address">' . __e('Label for `Billing Address`') . '</label>';
$content .= '<input id="page-label-for-billing-address" type="text" name="woocommerce[label-for-billing-address]" class="form-control" placeholder="Billing Address"  value="' . $current_setting['label-for-billing-address'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Billing Address`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-SHIPPING-ADDRESS --|-- TEXT
$content .= '<div id="field-label-for-shipping-address" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-shipping-address">' . __e('Label for `Shipping Address`') . '</label>';
$content .= '<input id="page-label-for-shipping-address" type="text" name="woocommerce[label-for-shipping-address]" class="form-control" placeholder="Shipping Address"  value="' . $current_setting['label-for-shipping-address'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Shipping Address`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-STATE --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-state" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-state">' . __e('Label for `State`') . '</label>';
$content .= '<input id="page-label-for-state" type="text" name="woocommerce[label-for-state]" class="form-control" placeholder="State"  value="' . $current_setting['label-for-state'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `State`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-POSTCODE --|-- TEXT
$content .= '<div id="field-label-for-postcode" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-postcode">' . __e('Label for `Postcode`') . '</label>';
$content .= '<input id="page-label-for-postcode" type="text" name="woocommerce[label-for-postcode]" class="form-control" placeholder="Postcode"  value="' . $current_setting['label-for-postcode'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Postcode`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-CITY --|-- TEXT
$content .= '<div id="field-label-for-city" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-city">' . __e('Label for `City`') . '</label>';
$content .= '<input id="page-label-for-city" type="text" name="woocommerce[label-for-city]" class="form-control" placeholder="City"  value="' . $current_setting['label-for-city'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `City`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-ADDRESS_1 --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-address_1" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-address_1">' . __e('Label for `Address 1`') . '</label>';
$content .= '<input id="page-label-for-address_1" type="text" name="woocommerce[label-for-address_1]" class="form-control" placeholder="Address 1"  value="' . $current_setting['label-for-address_1'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Address 1`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-ADDRESS_2 --|-- TEXT
$content .= '<div id="field-label-for-address_2" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-address_2">' . __e('Label for `Address 2`') . '</label>';
$content .= '<input id="page-label-for-address_2" type="text" name="woocommerce[label-for-address_2]" class="form-control" placeholder="Address 2"  value="' . $current_setting['label-for-address_2'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Address 2`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-EMAIL --|-- TEXT
$content .= '<div id="field-label-for-email" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-email">' . __e('Label for `Email`') . '</label>';
$content .= '<input id="page-label-for-email" type="text" name="woocommerce[label-for-email]" class="form-control" placeholder="Email"  value="' . $current_setting['label-for-email'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Email`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-PHONE --|-- TEXT
$content .= '<div id="field-label-for-phone" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-phone">' . __e('Label for `Phone`') . '</label>';
$content .= '<input id="page-label-for-phone" type="text" name="woocommerce[label-for-phone]" class="form-control" placeholder="Phone"  value="' . $current_setting['label-for-phone'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Phone`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-FIRST-NAME --|-- TEXT
$content .= '<div id="field-label-for-first-name" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-first-name">' . __e('Label for `First Name`') . '</label>';
$content .= '<input id="page-label-for-first-name" type="text" name="woocommerce[label-for-first-name]" class="form-control" placeholder="First Name"  value="' . $current_setting['label-for-first-name'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `First Name`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-LAST-NAME --|-- TEXT
$content .= '<div id="field-label-for-last-name" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-last-name">' . __e('Label for `Last Name`') . '</label>';
$content .= '<input id="page-label-for-last-name" type="text" name="woocommerce[label-for-last-name]" class="form-control" placeholder="Last Name"  value="' . $current_setting['label-for-last-name'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Last Name`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-COUNTRY --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-country" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-country">' . __e('Label for `country`') . '</label>';
$content .= '<input id="page-label-for-country" type="text" name="woocommerce[label-for-country]" class="form-control" placeholder="Country"  value="' . $current_setting['label-for-country'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Country`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-ADDRESS --|-- TEXT
$content .= '<div id="field-label-for-address" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-address">' . __e('Label for `Address`') . '</label>';
$content .= '<input id="page-label-for-address" type="text" name="woocommerce[label-for-address]" class="form-control" placeholder="Address"  value="' . $current_setting['label-for-address'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Address`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-CHOOSE-YOUR-COUNTRY --|-- TEXT
$content .= '<div id="field-label-for-choose-your-country" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-choose-your-country">' . __e('Label for `Choose Your Country`') . '</label>';
$content .= '<input id="page-label-for-choose-your-country" type="text" name="woocommerce[label-for-choose-your-country]" class="form-control" placeholder="Choose Your Country"  value="' . $current_setting['label-for-choose-your-country'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Choose Your Country`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';
$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-CHOOSE-YOUR-STATE --|-- TEXT
$content .= '<div id="field-label-for-choose-your-state" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-choose-your-state">' . __e('Label for `Choose Your State`') . '</label>';
$content .= '<input id="page-label-for-choose-your-state" type="text" name="woocommerce[label-for-choose-your-state]" class="form-control" placeholder="Choose Your State"  value="' . $current_setting['label-for-choose-your-state'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `State`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-SAME-AS-THE-BILLING-ADDRESS --|-- TEXT
$content .= '<div id="field-label-for-same-as-the-billing-address" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-same-as-the-billing-address">' . __e('Label for `Same as the billing address`') . '</label>';
$content .= '<input id="page-label-for-same-as-the-billing-address" type="text" name="woocommerce[label-for-same-as-the-billing-address]" class="form-control" placeholder="Same as the billing address"  value="' . $current_setting['label-for-same-as-the-billing-address'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Same as the billing address`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-SAVE --|-- TEXT
$content .= '<div id="field-label-for-save" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-save">' . __e('Label for `Save`') . '</label>';
$content .= '<input id="page-label-for-save" type="text" name="woocommerce[label-for-save]" class="form-control" placeholder="Save"  value="' . $current_setting['label-for-save'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Save`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-REVIEW --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-review" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-review">' . __e('Label for `Review`') . '</label>';
$content .= '<input id="page-label-for-review" type="text" name="woocommerce[label-for-review]" class="form-control" placeholder="Review"  value="' . $current_setting['label-for-review'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Review`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-PAYMENT --|-- TEXT
$content .= '<div id="field-label-for-payment" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-payment">' . __e('Label for `Payment`') . '</label>';
$content .= '<input id="page-label-for-payment" type="text" name="woocommerce[label-for-payment]" class="form-control" placeholder="Payment"  value="' . $current_setting['label-for-payment'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Payment`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-CONTINUE-TO-SHIPPING --|-- TEXT
$content .= '<div id="field-label-for-continue-to-shipping" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-continue-to-shipping">' . __e('Label for `Continue To Shipping`') . '</label>';
$content .= '<input id="page-label-for-continue-to-shipping" type="text" name="woocommerce[label-for-continue-to-shipping]" class="form-control" placeholder="Continue To Shipping"  value="' . $current_setting['label-for-continue-to-shipping'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Continue To Shipping`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-SUCCESSFULLY-SAVED --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-successfully-saved" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-successfully-saved">' . __e('Label for `The data has been successfully saved!`') . '</label>';
$content .= '<input id="page-label-for-successfully-saved" type="text" name="woocommerce[label-for-successfully-saved]" class="form-control" placeholder="The data has been successfully saved!"  value="' . $current_setting['label-for-successfully-saved'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `The data has been successfully saved!`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-CONTINUE-TO-REVIEW --|-- TEXT
$content .= '<div id="field-label-for-continue-to-review" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-continue-to-review">' . __e('Label for `Continue To Review`') . '</label>';
$content .= '<input id="page-label-for-continue-to-review" type="text" name="woocommerce[label-for-continue-to-review]" class="form-control" placeholder="Continue To Review"  value="' . $current_setting['label-for-continue-to-review'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Continue To Review`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-CONTINUE-TO-PAYMENT --|-- TEXT
$content .= '<div id="field-label-for-continue-to-payment" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-continue-to-payment">' . __e('Label for `Continue To Payment`') . '</label>';
$content .= '<input id="page-label-for-continue-to-payment" type="text" name="woocommerce[label-for-continue-to-payment]" class="form-control" placeholder="Continue To Payment"  value="' . $current_setting['label-for-continue-to-payment'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Continue To Payment`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-DATA-IS-INCOMPLETE --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-data-is-incomplete" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-data-is-incomplete">' . __e('Label for `The requested data is incomplete!`') . '</label>';
$content .= '<input id="page-label-for-data-is-incomplete" type="text" name="woocommerce[label-for-data-is-incomplete]" class="form-control" placeholder="The requested data is incomplete!"  value="' . $current_setting['label-for-data-is-incomplete'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `The requested data is incomplete!`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-COUPON-SAVED --|-- TEXT
$content .= '<div id="field-label-for-coupon-saved" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-coupon-saved">' . __e('Label for `Coupon code saved successfully!`') . '</label>';
$content .= '<input id="page-label-for-coupon-saved" type="text" name="woocommerce[label-for-coupon-saved]" class="form-control" placeholder="Coupon code saved successfully!"  value="' . $current_setting['label-for-coupon-saved'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Coupon code saved successfully!`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-PAYMENT-METHOD --|-- TEXT
$content .= '<div id="field-label-for-payment-method" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-payment-method">' . __e('Label for `Payment Method`') . '</label>';
$content .= '<input id="page-label-for-payment-method" type="text" name="woocommerce[label-for-payment-method]" class="form-control" placeholder="Payment Method"  value="' . $current_setting['label-for-payment-method'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Payment Method`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-ORDER-DETAILS --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-order-details" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-order-details">' . __e('Label for `Order details`') . '</label>';
$content .= '<input id="page-label-for-order-details" type="text" name="woocommerce[label-for-order-details]" class="form-control" placeholder="Order details"  value="' . $current_setting['label-for-order-details'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Order details`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-PLACE-ORDER --|-- TEXT
$content .= '<div id="field-label-for-place-order" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-place-order">' . __e('Label for `Place Order`') . '</label>';
$content .= '<input id="page-label-for-place-order" type="text" name="woocommerce[label-for-place-order]" class="form-control" placeholder="Place Order"  value="' . $current_setting['label-for-place-order'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Place Order`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-ORDER-RECEIVED --|-- TEXT
$content .= '<div id="field-label-for-order-received" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-order-received">' . __e('Label for `Your order has been received`') . '</label>';
$content .= '<input id="page-label-for-order-received" type="text" name="woocommerce[label-for-order-received]" class="form-control" placeholder="Your order has been received"  value="' . $current_setting['label-for-order-received'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Your order has been received`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-ORDER-NUMBER --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-order-number" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-order-number">' . __e('Label for `Order Number`') . '</label>';
$content .= '<input id="page-label-for-order-number" type="text" name="woocommerce[label-for-order-number]" class="form-control" placeholder="Order Number"  value="' . $current_setting['label-for-order-number'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Order Number`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-DETAIL --|-- TEXT
$content .= '<div id="field-label-for-detail" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-detail">' . __e('Label for `Detail`') . '</label>';
$content .= '<input id="page-label-for-detail" type="text" name="woocommerce[label-for-detail]" class="form-control" placeholder="Detail"  value="' . $current_setting['label-for-detail'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Detail`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-ORDERED-PRODUCTS --|-- TEXT
$content .= '<div id="field-label-for-ordered-products" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-ordered-products">' . __e('Label for `Ordered Products`') . '</label>';
$content .= '<input id="page-label-for-ordered-products" type="text" name="woocommerce[label-for-ordered-products]" class="form-control" placeholder="Ordered Products"  value="' . $current_setting['label-for-ordered-products'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Ordered Products`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-ITEM --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-item" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-item">' . __e('Label for `Item`') . '</label>';
$content .= '<input id="page-label-for-item" type="text" name="woocommerce[label-for-item]" class="form-control" placeholder="Item"  value="' . $current_setting['label-for-item'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Item`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-ORDER-HISTORY --|-- TEXT
$content .= '<div id="field-label-for-order-history" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-order-history">' . __e('Label for `Order History`') . '</label>';
$content .= '<input id="page-label-for-order-history" type="text" name="woocommerce[label-for-order-history]" class="form-control" placeholder="Order History"  value="' . $current_setting['label-for-order-history'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Order History`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-SUBTOTAL --|-- TEXT
$content .= '<div id="field-label-for-subtotal" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-subtotal">' . __e('Label for `Subtotal`') . '</label>';
$content .= '<input id="page-label-for-subtotal" type="text" name="woocommerce[label-for-subtotal]" class="form-control" placeholder="Subtotal"  value="' . $current_setting['label-for-subtotal'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Subtotal`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-SUBTOTAL-TAX --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-subtotal-tax" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-subtotal-tax">' . __e('Label for `Subtotal Tax`') . '</label>';
$content .= '<input id="page-label-for-subtotal-tax" type="text" name="woocommerce[label-for-subtotal-tax]" class="form-control" placeholder="Subtotal Tax"  value="' . $current_setting['label-for-subtotal-tax'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Subtotal Tax`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-TOTAL-TAX --|-- TEXT
$content .= '<div id="field-label-for-total-tax" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-total-tax">' . __e('Label for `Total Tax`') . '</label>';
$content .= '<input id="page-label-for-total-tax" type="text" name="woocommerce[label-for-total-tax]" class="form-control" placeholder="Total Tax"  value="' . $current_setting['label-for-total-tax'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Total Tax`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-PRICE --|-- TEXT
$content .= '<div id="field-label-for-price" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-price">' . __e('Label for `Price`') . '</label>';
$content .= '<input id="page-label-for-price" type="text" name="woocommerce[label-for-price]" class="form-control" placeholder="Price"  value="' . $current_setting['label-for-price'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Price`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';

$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-CONNECTION-LOST --|-- TEXT
$content .= '<div id="field-label-for-connection-lost" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-connection-lost">' . __e('Label for `Connection lost`') . '</label>';
$content .= '<input id="page-label-for-connection-lost" type="text" name="woocommerce[label-for-connection-lost]" class="form-control" placeholder="Connection lost, please check your connection!"  value="' . $current_setting['label-for-connection-lost'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Connection lost, please check your connection!`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-NO-ORDER-HISTORY --|-- TEXT

$content .= '<div id="field-label-for-no-order-history" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-no-order-history">' . __e('Label for `No order history`') . '</label>';
$content .= '<input id="page-label-for-no-order-history" type="text" name="woocommerce[label-for-no-order-history]" class="form-control" placeholder="No order history"  value="' . $current_setting['label-for-no-order-history'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `No order history`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-COUPON-IS-INVALID --|-- TEXT

$content .= '<div id="field-label-for-coupon-is-invalid" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-coupon-is-invalid">' . __e('Label for `The coupon is invalid!') . '</label>';
$content .= '<input id="page-label-for-coupon-is-invalid" type="text" name="woocommerce[label-for-coupon-is-invalid]" class="form-control" placeholder="The coupon is invalid!"  value="' . $current_setting['label-for-coupon-is-invalid'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `The coupon is invalid!`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-CURRENCY --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-currency" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-currency">' . __e('Label for `Currency`') . '</label>';
$content .= '<input id="page-label-for-currency" type="text" name="woocommerce[label-for-currency]" class="form-control" placeholder="Currency"  value="' . $current_setting['label-for-currency'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Currency`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-DATE-CREATED --|-- TEXT

$content .= '<div id="field-label-for-date-created" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-date-created">' . __e('Label for `Date Created`') . '</label>';
$content .= '<input id="page-label-for-date-created" type="text" name="woocommerce[label-for-date-created]" class="form-control" placeholder="Date Created"  value="' . $current_setting['label-for-date-created'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Currency`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-DISCOUNT-TAX --|-- TEXT

$content .= '<div id="field-label-for-discount-tax" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-discount-tax">' . __e('Label for `Discount Tax`') . '</label>';
$content .= '<input id="page-label-for-discount-tax" type="text" name="woocommerce[label-for-discount-tax]" class="form-control" placeholder="Discount Tax"  value="' . $current_setting['label-for-discount-tax'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Discount Tax`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-SHIPPING-TAX --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-shipping-tax" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-shipping-tax">' . __e('Label for `Shipping Tax`') . '</label>';
$content .= '<input id="page-label-for-shipping-tax" type="text" name="woocommerce[label-for-shipping-tax]" class="form-control" placeholder="Shipping Tax"  value="' . $current_setting['label-for-shipping-tax'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Shipping Tax`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-CART-TAX --|-- TEXT

$content .= '<div id="field-label-for-cart-tax" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-cart-tax">' . __e('Label for `Cart Tax`') . '</label>';
$content .= '<input id="page-label-for-cart-tax" type="text" name="woocommerce[label-for-cart-tax]" class="form-control" placeholder="Cart Tax"  value="' . $current_setting['label-for-cart-tax'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Cart Tax`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-ACTUAL-PRICES-NOTE --|-- TEXT

$content .= '<div id="field-label-for-actual-prices-note" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-actual-prices-note">' . __e('Label for `Actual prices note`') . '</label>';
$content .= '<input id="page-label-for-actual-prices-note" type="text" name="woocommerce[label-for-actual-prices-note]" class="form-control" placeholder="Actual prices will appear after checkout is complete"  value="' . $current_setting['label-for-actual-prices-note'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Info`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';


$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-DARK-MODE --|-- TEXT

$content .= '<div id="field-label-for-dark-mode" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-dark-mode">' . __e('Label for `Dark Mode`') . '</label>';
$content .= '<input id="page-label-for-dark-mode" type="text" name="woocommerce[label-for-dark-mode]" class="form-control" placeholder="Dark Mode"  value="' . $current_setting['label-for-dark-mode'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Dark Mode`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';



$content .= '</div><!-- ./responsive -->';
$content .= '</div><!-- ./box-body -->';
$content .= '<div class="box-footer pad">';
$content .= '<input name="save-woocommerce" type="submit" class="btn btn-warning btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
$content .= '</div>';
$content .= '</div><!-- ./box -->';


$content .= '<div class="box box-info">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-help"></i> ' . __e('Technical Guide') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';

$content .= '<p>' . __e('This app works independently from woocommerce default: cart, checkout and payment gateway. Cart, checkout and payment gateway related plugin feature may not work') . '</p>';

$content .= '<h4>CORS Issue</h4>';
$content .= '<p>' . __e('Most of shared hosting has disabled the HTTP Authorization Header by default. To enable this option you\'ll need to edit your <code>.htaccess</code> file adding the following:');
$content .= '<pre>';
$content .= htmlentities('<IfModule mod_rewrite.c>') . "\r\n";
$content .= htmlentities('# Add this code') . "\r\n";
$content .= htmlentities('RewriteCond %{HTTP:Authorization} ^(.*)') . "\r\n";
$content .= htmlentities('RewriteRule ^(.*) - [E=HTTP_AUTHORIZATION:%1]') . "\r\n";
$content .= htmlentities('</IfModule>') . "\r\n";
$content .= htmlentities('') . "\r\n";
$content .= htmlentities('# And this code') . "\r\n";
$content .= htmlentities('SetEnvIf Authorization "(.*)" HTTP_AUTHORIZATION=$1') . "\r\n";
$content .= htmlentities('') . "\r\n";
$content .= '</pre>';
$content .= '<p>' . __e('And <code>your web must use SSL (https://)</code>, so it can\'t be tried on localhost.') . '</p>';
$content .= '<h4>Other Issue</h4>';
$content .= '<p>' . __e('Woocommerce Plugin not compatible with JWT Authentication for WP REST API (Authorization: Bearer), This will cause the `Authorization header to malformed`') . '</p>';
$content .= '</div><!-- ./box-body -->';
$content .= '</div><!-- ./box -->';


$content .= '</div><!-- ./col-md-5 -->';
$content .= '</div><!-- ./row -->';
$content .= '</form><!-- ./form -->';
// TODO: LAYOUT --|-- JS
$page_js .= '$("#page-target").on("change",function(){return window.location="?p=addons&addons=woocommerce&page-target="+$("#page-target").val(),!1});';
$page_js .= '$(document).ready(function(){';
$page_js .= '$("#page-banner-helper").on("click",function(){';
$page_js .= 'initBannerHelper();';
$page_js .= '});';
$page_js .= 'initBannerHelper();';
$page_js .= '});';

$page_js .= 'function initBannerHelper(){';
$page_js .= 'var selected = $("#page-banner-helper").val();';
$page_js .= 'if(selected == "custom-api"){';
$page_js .= '$("#custom-api-box").removeClass("hide");';
$page_js .= '}else{';
$page_js .= '$("#custom-api-box").addClass("hide");';
$page_js .= '}';
$page_js .= 'var html_help = "' . __e('If the image does not appear try using other options!') . '";';
$page_js .= 'switch(selected){';
$page_js .= 'case "rest-api-helper":';
$page_js .= 'html_help = "' . __e('Please install <a target=\\"_blank\\" href=\\"https://wordpress.org/plugins/rest-api-helper/\\">REST-API Helper plugin</a>') . '";';
$page_js .= 'break;';
$page_js .= 'case "jackpat":';
$page_js .= 'html_help = "' . __e('This is used if you use an image from cdn jetpack') . '";';
$page_js .= 'break;';
$page_js .= 'case "custom-api":';
$page_js .= 'html_help = "' . __e('If you want to set variables manually, use this option') . '";';
$page_js .= 'break;';
$page_js .= '}';

$page_js .= '$("#page-banner-helper-help").html(html_help);';


$page_js .= '}';
