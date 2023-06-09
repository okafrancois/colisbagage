<?php
/**
 *
 * @author        RadiusTheme
 * @package    classified-listing/templates
 * @version     1.0.0
 *
 * @var array $fields
 * @var int $listing_id
 */


use Rtcl\Helpers\Functions;
use Rtcl\Models\RtclCFGField;


if ( count( $fields ) ) :
	ob_start();
	foreach ( $fields as $field ) :
		$field = new RtclCFGField( $field->ID );
		$value = $field->getFormattedCustomFieldValue( $listing_id );
		if ( $value ) :
			?>
            <div class='rtcl-listable-item <?php echo $field->getSlug()?> <?php Functions::print_html( $value );?>'>
                <span class='listable-label'><?php echo esc_html( $field->getLabel() ) ?></span>
                <span class='listable-value'>
                    <?php switch($field->getSlug()) {
                        case 'quantite-colis':
                            echo $value . ' <span class="listable-value__unit">Kg</span>';
                            break;
                        case 'quantite-courriel':
                            echo $value . ' <span class="listable-value__unit">g</span>';
                            break;
                        case 'quantite-bagage':
                            // split the value to get the number and the unit
                            $value = explode(' ', $value);
                            // get the number
                            $number = $value[0];
                            // get the unit
                            echo $number . ' <span class="listable-value__unit">Kg</span>';
                            break;
                        default:
                            echo $value;
                    } ?>
                </span>
            </div>
		<?php endif;
	endforeach;

	$fields_html = ob_get_clean();
	if ( $fields_html ) {
		printf( '<div class="rtcl-listable">%s</div>', $fields_html );
	}
endif;
