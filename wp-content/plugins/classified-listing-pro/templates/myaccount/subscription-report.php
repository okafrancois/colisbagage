<?php
/**
 *
 * @author     RadiusTheme
 * @package    classified-listing-pro/templates
 * @version    2.1.0
 *
 * @var WP_User        $current_user
 * @var Subscription[] $subscriptions
 */


use Rtcl\Helpers\Functions;
use RtclPro\Models\Subscription;

if ( ! empty( $subscriptions ) ) {
	echo '<div class="rtcl-subs-reports">';
	echo '<h4>' . esc_html__( 'Subscription Report', 'classified-listing-pro' ) . '</h4>';
	echo '<div class="rtcl-subs">';
	foreach ( $subscriptions as $subscription ) {
		$gateway = Functions::get_payment_gateway( $subscription->getGatewayId() );
		if ( ! $gateway ) {
			continue;
		}
		$metaData = $subscription->getMeta();
		$product  = rtcl()->factory->get_pricing( $subscription->getProductId() )
		?>
		<div class="rtcl-sub-item" data-gateway="<?php echo esc_attr( $gateway->id ) ?>"
			 data-id="<?php echo absint( $subscription->getId() ) ?>">
			<div class="rtcl-sub-gateway"><?php echo esc_html( $gateway->get_method_title() ) ?></div>
			<div class="rtcl-sub-action">
				<a class="rtcl-sub-cancel rtcl-btn" data-id="<?php echo absint( $subscription->getId() ) ?>">Cancel</a>
			</div>
			<div class="rtcl-sub-info">
				<div class="rtcl-subi-label"><?php echo esc_html__( 'Name: ', 'classified-listing-pro' ) ?></div>
				<div class="rtcl-subi-value"><?php echo esc_html( $subscription->getName() ) ?></div>
			</div>
			<div class="rtcl-sub-info">
				<div class="rtcl-subi-label"><?php echo esc_html__( 'Status: ', 'classified-listing-pro' ) ?></div>
				<div class="rtcl-subi-value"><?php echo esc_html( $subscription->getStatus() ) ?></div>
			</div>
			<?php if ( $subscription->getExpiryAt() ): ?>
				<div class="rtcl-sub-info">
					<div
						class="rtcl-subi-label"><?php echo esc_html__( 'Renew at: ', 'classified-listing-pro' ) ?></div>
					<div class="rtcl-subi-value"><?php echo esc_html( $subscription->getExpiryAt() ) ?></div>
				</div>
			<?php endif; ?>
			<?php if ( ( $cc = $subscription->get_meta( 'cc', true ) ) && is_array( $cc ) ): ?>
				<div class="rtcl-sub-info cc-info">
					<div class="rtcl-subi-cc">
						<div class="cc-type"
							 data-id="<?php echo esc_attr( $cc['type'] ) ?>"><?php echo esc_html( $cc['type'] ) ?></div>
						<div class="cc-number"><?php echo esc_html( $cc['last4'] ) ?></div>
						<div class="cc-expiry">(<?php echo esc_html( $cc['expiry'] ) ?>)</div>
						<a class="update-card-info" href="#">Update card</a>
					</div>
				</div>
			<?php endif ?>
			<div class="sub-payment-update-wrap" style="display: none">
				<form id="rtcl-sub-update-payment" method="post">
					<?php echo $gateway->payment_fields(); ?>
					<input type="hidden" name="_subscription_id"
						   value="<?php echo absint( $subscription->getId() ); ?>"/>
					<div class="">
						<button type="submit" class="sub-update-btn rtcl-btn">Update</button>
					</div>
				</form>
			</div>
		</div>
		<?php
	}
	echo '</div>';
	echo '</div>';
}
