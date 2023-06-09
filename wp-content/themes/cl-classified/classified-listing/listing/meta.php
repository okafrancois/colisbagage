<?php
/**
 * Listing meta
 *
 * @author     RadiusTheme
 * @package    classified-listing/templates
 * @version    1.0.0
 */

use Rtcl\Helpers\Functions;

if ( ! $listing ) {
	global $listing;
}

if ( empty( $listing ) ) {
	return;
}

if ( ! $listing->can_show_date() && ! $listing->can_show_user() && ! $listing->can_show_category() && ! $listing->can_show_location() && ! $listing->can_show_views() ) {
	return;
}
?>

<ul class="rtcl-listing-meta-data">
	<?php if ( $listing->can_show_user() ) : ?>
        <li class="author">
            <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M13.4508 12.2412C13.0996 11.3992 12.5899 10.6344 11.9502 9.98932C11.3125 9.34242 10.557 8.82664 9.72551 8.47048C9.71807 8.46671 9.71062 8.46482 9.70317 8.46105C10.863 7.61307 11.617 6.23178 11.617 4.67337C11.617 2.09171 9.55052 0 7 0C4.44949 0 2.38301 2.09171 2.38301 4.67337C2.38301 6.23178 3.13699 7.61306 4.29683 8.46294C4.28938 8.46671 4.28193 8.46859 4.27449 8.47236C3.44045 8.82852 2.69205 9.3392 2.04977 9.99121C1.41067 10.6367 0.901113 11.4015 0.549245 12.2431C0.203571 13.0671 0.0171405 13.9505 4.65534e-05 14.8455C-0.000450341 14.8656 0.00303479 14.8856 0.0102967 14.9043C0.0175586 14.9231 0.0284503 14.9401 0.04233 14.9545C0.0562097 14.9689 0.0727966 14.9804 0.0911133 14.9882C0.10943 14.996 0.129106 15 0.148982 15H1.266C1.34791 15 1.41307 14.934 1.41493 14.853C1.45216 13.3982 2.02929 12.0358 3.04949 11.0031C4.10507 9.93467 5.50693 9.34673 7 9.34673C8.49308 9.34673 9.89493 9.93467 10.9505 11.0031C11.9707 12.0358 12.5478 13.3982 12.5851 14.853C12.5869 14.9359 12.6521 15 12.734 15H13.851C13.8709 15 13.8906 14.996 13.9089 14.9882C13.9272 14.9804 13.9438 14.9689 13.9577 14.9545C13.9715 14.9401 13.9824 14.9231 13.9897 14.9043C13.997 14.8856 14.0005 14.8656 14 14.8455C13.9813 13.9447 13.797 13.0685 13.4508 12.2412ZM7 7.91457C6.14548 7.91457 5.34123 7.57726 4.73619 6.96482C4.13114 6.35239 3.79789 5.53832 3.79789 4.67337C3.79789 3.80842 4.13114 2.99435 4.73619 2.38191C5.34123 1.76947 6.14548 1.43216 7 1.43216C7.85452 1.43216 8.65877 1.76947 9.26381 2.38191C9.86886 2.99435 10.2021 3.80842 10.2021 4.67337C10.2021 5.53832 9.86886 6.35239 9.26381 6.96482C8.65877 7.57726 7.85452 7.91457 7 7.91457Z" fill="#BEC2C9"></path>
            </svg>
			<?php esc_html_e( 'by ', 'cl-classified' ); ?>
			<?php if ( $listing->can_add_user_link() && ! is_author() ) : ?>
                <a href="<?php echo esc_url( $listing->get_the_author_url() ); ?>"><?php $listing->the_author(); ?></a>
			<?php else : ?>
				<?php $listing->the_author(); ?>
			<?php endif; ?>
			<?php do_action( 'rtcl_after_author_meta', $listing->get_owner_id() ); ?>
        </li>
	<?php endif; ?>
	<?php
	if ( $listing->can_show_ad_type() ) :
		$listing_types = Functions::get_listing_types();
		$types = ! empty( $listing_types ) && isset( $listing_types[ $listing->get_ad_type() ] ) ? $listing_types[ $listing->get_ad_type() ] : '';
		if ( $types ) {
			?>
            <li class="ad-type"><i class="rtcl-icon rtcl-icon-tags"></i><?php echo esc_html( $types ); ?></li>
		<?php } ?>
	<?php endif; ?>
	<?php
	if ( $listing->has_location() && $listing->can_show_location() ) :
		?>
        <li class="rt-location">
            <svg width="13" height="17" viewBox="0 0 13 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M6.5 9.71429C5.91565 9.71429 5.34442 9.53624 4.85854 9.20268C4.37267 8.86911 3.99398 8.39499 3.77036 7.84029C3.54674 7.28558 3.48823 6.6752 3.60223 6.08633C3.71623 5.49746 3.99762 4.95655 4.41082 4.532C4.82402 4.10745 5.35047 3.81832 5.9236 3.70119C6.49672 3.58405 7.09078 3.64417 7.63065 3.87394C8.17053 4.1037 8.63196 4.4928 8.95661 4.99202C9.28126 5.49124 9.45454 6.07816 9.45454 6.67857C9.4536 7.4834 9.14202 8.25498 8.58814 8.82408C8.03426 9.39318 7.28331 9.71332 6.5 9.71429ZM6.5 4.85714C6.14939 4.85714 5.80665 4.96397 5.51513 5.16411C5.2236 5.36425 4.99639 5.64872 4.86222 5.98154C4.72804 6.31436 4.69294 6.68059 4.76134 7.03391C4.82974 7.38724 4.99857 7.71178 5.24649 7.96652C5.49441 8.22125 5.81028 8.39472 6.15416 8.465C6.49803 8.53528 6.85447 8.49921 7.17839 8.36135C7.50232 8.22349 7.77918 7.99004 7.97397 7.6905C8.16876 7.39097 8.27273 7.03882 8.27273 6.67857C8.27226 6.19565 8.08534 5.73264 7.75299 5.39116C7.42064 5.04968 6.97001 4.85763 6.5 4.85714Z"
                      fill="#BEC2C9"></path>
                <path d="M6.5 17L1.5151 10.9595C1.44583 10.8688 1.37728 10.7776 1.30946 10.6857C0.457949 9.53323 -0.00205706 8.12553 6.91533e-06 6.67857C6.91533e-06 4.9073 0.684826 3.20858 1.90381 1.95611C3.1228 0.703633 4.77609 0 6.5 0C8.22391 0 9.8772 0.703633 11.0962 1.95611C12.3152 3.20858 13 4.9073 13 6.67857C13.0021 8.12487 12.5423 9.53193 11.6911 10.6839L11.6905 10.6857C11.6905 10.6857 11.5133 10.9249 11.4867 10.9571L6.5 17ZM2.25255 9.95411C2.25373 9.95411 2.39082 10.1411 2.42214 10.1812L6.5 15.1227L10.5832 10.1745C10.6092 10.1411 10.7474 9.95289 10.748 9.95229C11.4436 9.01068 11.8195 7.8607 11.8182 6.67857C11.8182 5.22935 11.2579 3.83949 10.2605 2.81474C9.26317 1.78999 7.91047 1.21429 6.5 1.21429C5.08953 1.21429 3.73683 1.78999 2.73948 2.81474C1.74213 3.83949 1.18182 5.22935 1.18182 6.67857C1.18058 7.86143 1.55633 9.01207 2.25255 9.95411Z"
                      fill="#BEC2C9"></path>
            </svg>
			<?php $listing->the_locations(); ?>
        </li>
	<?php endif; ?>
	<?php if ( $listing->can_show_date() ) : ?>
        <li class="updated">
            <i class="fa-regular fa-clock"></i>
			<?php $listing->the_time(); ?>
        </li>
	<?php endif; ?>
	<?php if ( $listing->can_show_views() ) : ?>
        <li class="rt-views">
            <i class="fa-regular fa-eye"></i>
			<?php echo sprintf( _n( '%s view', '%s views', $listing->get_view_counts(), 'cl-classified' ), number_format_i18n( $listing->get_view_counts() ) ); ?>
        </li>
	<?php endif; ?>
</ul>
