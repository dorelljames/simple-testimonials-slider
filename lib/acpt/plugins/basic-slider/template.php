<?php
// list functions
function list_slides($tax = false, $opts = array(), $settings = array()) {

// config wrapper
$wrapperStart = '<div class="slide-container">';
$wrapperEnd = '</div>';

// get slides
$args = array(
'numberposts' => 10,
'order'=> 'ASC',
'post_status' => 'publish',
'orderby' => 'menu_order',
'post_type' => 'slide');

$force = array(
'post_type' => 'slide'
);

if(!is_array($opts)) $opts = array();
if(is_string($tax) && isset($tax)) :
$tax = array('group' => $tax);
else :
$tax = array();
endif;

$args = array_merge($args, $opts, $tax, $force);

// setup html template
$setup = array(
'width' => '940',
'height' => '350',
'alt' => true,
'caption_classes' => 'caption',
'classes' => 'slides');
$settings = array_merge($setup, $settings);

if(isset($settings['width'])) $width = " width=\"{$settings['width']}\" ";
if(isset($settings['height'])) $height = " height=\"{$settings['height']}\" ";
if(isset($settings['alt'])) $alt = true;
if(isset($settings['caption_classes'])) :
$classCaption = $settings['caption_classes'];
else :
$classCaption = '';
endif;

if(isset($settings['classes'])) :
$classes = $settings['classes'];
else :
$classes = '';
endif;

// query and template
$slides = get_posts( $args );
echo $wrapperStart;	?>
<ul class="<?php echo $classes; ?>">
	<?php foreach ($slides as $slide) :  setup_postdata($slide); ?>
	<?php if($alt == true) $alt = ' alt="'.get_the_title($slide->ID).'" '; ?>
    <li>
      <img src="<?php echo get_post_meta($slide->ID, "acpt_slide_image_image", true); ?>" <?php echo $width.$height.$alt; ?>>

			<?php if (get_post_meta($slide->ID, "acpt_slide_select_showText", true) == 'Yes') : ?>
        <div class="<?php echo $classCaption; ?>">
            <h2><?php echo get_post_meta($slide->ID, "acpt_slide_text_headline", true); ?></h2>
            <p><?php echo get_post_meta($slide->ID, "acpt_slide_textarea_description", true); ?></p>
        </div>
			<?php endif; ?>
    </li>
	<?php endforeach; ?>
</ul>
<?php
echo $wrapperEnd;

}