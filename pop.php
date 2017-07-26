<?php require_once '../../../wp-load.php'; 

$productId = $_GET['id']; 
global $post, $product, $woocommerce;
$product = wc_get_product( $productId );
?>


<div id="wooclass">
	<div class="row pop">
		<div class="col-md-5">

<?php 

$product_attach_ids = $product->get_gallery_attachment_ids(); ?>









			<div id="bx-pager">
				
				<?php if ($product_attach_ids):
				$i = 0;
				foreach ($product_attach_ids as $product_attach_id): 
					$thumbnail1 = wp_get_attachment_image_src($product_attach_id,'woothumb', true); ?>
					<a data-slide-index="<?php echo $i; ?>" href=""><img src="<?php echo $thumbnail1[0]; ?>"></a>
				<?php 
				$i++;
				endforeach ?>
				<?php endif ?>

			</div>
			<ul class="bxslider">

				<?php if ($product_attach_ids):
				foreach ($product_attach_ids as $product_attach_id): 
				$thumbnail1 = wp_get_attachment_image_src($product_attach_id,'shop_catalog', true); ?>
					<li><img src="<?php echo $thumbnail1[0]; ?>"></li>
				<?php endforeach ?>
				<?php endif ?>


			</ul>
			<script>
			jQuery('.bxslider').bxSlider({
			pagerCustom: '#bx-pager'
			});
			</script>
		</div>
		<div class="col-md-7">
			<h2><?php echo $product->get_title(); ?></h2>
			<hr>
			<div class="wooprice"><?php echo $product->get_price_html(); ?></div>
			<p>
				<?php echo get_post_field('post_content', $productId); ?>
			</p>
			<form class="cartwoo" action="" method="post" enctype="multipart/form-data">
				<div class="quantity">
					<input type="button" value="-" class="minuswoo">
					<input type="number" class="input-text qty text" step="1" min="1" max="" name="quantity" value="1" title="Qty" size="4" pattern="[0-9]*" inputmode="numeric">
					<input type="button" value="+" class="pluswoo">
					<input type="hidden" name="add-to-cart" value="<?php echo $productId; ?>">
				</div>
				<button type="submit" style="border-radius: 3px !important;"><?php echo $product->single_add_to_cart_text(); ?></button>
			</form>
		</div>
	</div>
</div>