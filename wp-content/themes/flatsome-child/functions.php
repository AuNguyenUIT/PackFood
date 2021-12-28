<?php
// Add custom Theme Functions here
function packfood_translations( $strings ) {
  $text = array(
    'Quick View' => 'Xem nhanh',
    'SHOPPING CART' => 'Giỏ hàng',
    'CHECKOUT DETAILS' => 'Thanh toán',
    'ORDER COMPLETE' => 'Hoàn thành',
    'Add To Cart'=> 'Thêm Vào Giỏ Hàng',
    'Price'=> 'Giá'
  );

  $strings = str_ireplace( array_keys( $text ), $text, $strings );
  return $strings;
}
add_filter( 'gettext', 'packfood_translations', 20 );
add_action('woocommerce_after_add_to_cart_button','packfood_quickbuy_after_addtocart_button');
function packfood_quickbuy_after_addtocart_button(){
  global $product;
  ?>

    <button type="button" class="button buy_now_button">
      <?php _e('Mua ngay', 'devvn'); ?>
    </button>
    <input type="hidden" name="is_buy_now" class="is_buy_now" value="0" autocomplete="off"/>
    <script>
      jQuery(document).ready(function(){
        jQuery('body').on('click', '.buy_now_button', function(e){
          e.preventDefault();
          var thisParent = jQuery(this).parents('form.cart');
          if(jQuery('.single_add_to_cart_button', thisParent).hasClass('disabled')) {
            jQuery('.single_add_to_cart_button', thisParent).trigger('click');
            return false;
          }
          thisParent.addClass('packfood-quickbuy');
          jQuery('.is_buy_now', thisParent).val('1');
          jQuery('.single_add_to_cart_button', thisParent).trigger('click');
        });
      });
    </script>
  <?php
}
add_filter('woocommerce_add_to_cart_redirect', 'redirect_to_checkout');
function redirect_to_checkout($redirect_url) {
  if (isset($_REQUEST['is_buy_now']) && $_REQUEST['is_buy_now']) {
    $redirect_url = wc_get_checkout_url(); //or wc_get_cart_url()
  }
  return $redirect_url;
}

add_filter('woocommerce_sale_flash', 'packfood_woocommerce_sale_flash', 10, 3);
function packfood_woocommerce_sale_flash($html, $post, $product){
  return '<div class="callout badge badge-circle"><div class="badge-inner secondary on-sale"><span class="onsale">'.packfood_presentage_bubble($product).'</span></div></div>';
}

function packfood_presentage_bubble( $product ) {
  $post_id = $product->get_id();

  if ( $product->is_type( 'simple' ) || $product->is_type( 'external' ) ) {
    $regular_price  = $product->get_regular_price();
    $sale_price     = $product->get_sale_price();
    $bubble_content = round( ( ( floatval( $regular_price ) - floatval( $sale_price ) ) / floatval( $regular_price ) ) * 100 );
  } elseif ( $product->is_type( 'variable' ) ) {
    if ( $bubble_content = devvn_percentage_get_cache( $post_id ) ) {
      return devvn_percentage_format( $bubble_content );
    }

    $available_variations = $product->get_available_variations();
    $maximumper           = 0;

    for ( $i = 0; $i < count( $available_variations ); ++ $i ) {
      $variation_id     = $available_variations[ $i ]['variation_id'];
      $variable_product = new WC_Product_Variation( $variation_id );
      if ( ! $variable_product->is_on_sale() ) {
        continue;
      }
      $regular_price = $variable_product->get_regular_price();
      $sale_price    = $variable_product->get_sale_price();
      $percentage    = round( ( ( floatval( $regular_price ) - floatval( $sale_price ) ) / floatval( $regular_price ) ) * 100 );
      if ( $percentage > $maximumper ) {
        $maximumper = $percentage;
      }
    }

    $bubble_content = sprintf( __( '%s', 'woocommerce' ), $maximumper );

    packfood_percentage_set_cache( $post_id, $bubble_content );
  } else {
    $bubble_content = __( 'Sale!', 'woocommerce' );

    return $bubble_content;
  }

  return packfood_percentage_format( $bubble_content );
}

function packfood_percentage_get_cache( $post_id ) {
  return get_post_meta( $post_id, '_packfood_product_percentage', true );
}

function packfood_percentage_set_cache( $post_id, $bubble_content ) {
  update_post_meta( $post_id, '_packfood_product_percentage', $bubble_content );
}

//Định dạng kết quả dạng -{value}%. Ví dụ -20%
function packfood_percentage_format( $value ) {
  return str_replace( '{value}', $value, '-{value}%' );
}

// Xóa cache khi sản phẩm hoặc biến thể thay đổi
function packfood_percentage_clear( $object ) {
  $post_id = 'variation' === $object->get_type()
    ? $object->get_parent_id()
    : $object->get_id();

  delete_post_meta( $post_id, '_packfood_product_percentage' );
}
add_action( 'woocommerce_before_product_object_save', 'packfood_percentage_clear' );

