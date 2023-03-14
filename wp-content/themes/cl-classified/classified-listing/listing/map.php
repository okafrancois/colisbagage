<?php
/**
 *
 * @author        RadiusTheme
 * @package       classified-listing/templates
 * @version       1.0.0
 *
 * @var bool $has_map
 * @var numeric $latitude
 * @var numeric $longitude
 * @var string $address
 * @var array $map_options // gmap ['zoom' => 15, 'scrollwheel' => false, 'center' => '', 'mapTypeId'=>'roadmap', 'zoomControl'=>bool , icon=>'icon_url']  ; osm ['zoom' => 15,  'center' => '', 'icon'=>['iconUrl'=>'iconUrl']]
 */


if ( $has_map ): ?>
    <div class="content-block-gap"></div>
    <div class="site-content-block classified-single-map">
        <div class="main-content">
            <h3 class="main-title"><?php esc_html_e( 'Location', 'cl-classified' ); ?></h3>
            <div class="embed-responsive embed-responsive-16by9">
                <div class="rtcl-map embed-responsive-item"
                     data-options="<?php echo htmlspecialchars( wp_json_encode( $map_options ) ); ?>">
                    <div class="marker" data-latitude="<?php echo esc_attr( $latitude ); ?>"
                         data-longitude="<?php echo esc_attr( $longitude ); ?>"
                         data-address="<?php echo esc_attr( $address ); ?>"><?php echo esc_html( $address ); ?></div>
                </div>
            </div>
        </div>
    </div>
<?php endif;