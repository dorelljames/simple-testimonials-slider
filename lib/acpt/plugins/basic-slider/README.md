ACPT Basic Slider: 1.0
===

This is a basic slider plugin for ACPT. It automatically creates a slide post type for you with the needed fields. However, it will not add the need jQuery/JS, CSS or HTML for a slider to appear in your theme.

However, "Basic Slider" has a templating function 'list_slides()'. Lets look at the code example to use in your theme files.

```php
<?php list_slides(); ?>
```

This basic function will spit out an unordered list of slides. If a slide has its headline and description enabled it will put them in a div next to the image within an li and add the class 'caption' to it.

```html
<ul class="slides">
  <li><img alt="Slide title" src="img.png" height="350" width="940"></li>
  <li><img alt="Slide title" src="img.png" height="350" width="940"></li>
  <li>
    <img alt="Slide title" src="img.png" height="350" width="940">
    <div class="caption">
      <h2>Headline</h2>
      <p>Description</p>
    </div>
  </li>
</ul>
```

Once the HTML is in your theme you can add the jQuery and CSS to style the list as a slider. If the HTML is not to your liking you do have a few options.

Advanced
==

In the 'list_slides()' function you have the ability to select a group to list (See UI 'Group' taxonomy), modify the standard post query, and edit basic HTML. Lets take a look:

```php
<?php
// setup
$group = 'feature';
$args = array('numberposts' => 2);
$settings = array('width' => 300, 'height' => 300);

// list slides
list_slides($group, $args, $settings);
?>
```

This example would list the slides in the group 'feature' only, limit the number of slides to 2 by editing the default args (you can not change the 'post_type'), and sets each image to a new height and width.

Settings
==

Here is a list of all the settings options:

```php
$settings = array(
  'width' => '940',
  'height' => '350',
  'alt' => true,
  'caption_classes' => 'caption',
  'classes' => 'slides');
```

- width: sets images width attr
- height: sets images height attr
- alt: defines if the alt attr should be used (slide title is always the alt)
- caption_classes: sets the caption html classes
- classes: sets the ul elements classess

Shortcode
==

If you need to add a slider within a post you can do so with the shortcode.

```php
[slider width="940" height="350" group="example"]
```

Configuring and Editing Files
==

If you need more control over the slider output see the template.php file and make edits there. There are a few places you can edit HTML without breaking anything and should be apparent (like the wrapper vars). You will want to do the more than likely simple because jQuery sliders require different types of HTML and classes to work.

The only issues with editing these files is of course when an update is made on the plugin and you may have conflicts. I recommend renaming the plugin to avoid your custom changes being removed on an update.