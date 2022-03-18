# gsap-marquee
GSAP Marquee SM_ Plugin

## How To Install

Clone this git into mu-plugins folder.

Make sure to add a .php file as direct child of mu-plugins containing the following
```
require WPMU_PLUGIN_DIR . '/gsap-marquee/gsap-marquee.php';
```


## How To Use
Add the following shortcode
```[gsap-marquee]```

Available parameters
```
'text'      => 'Insert a text inside the shortcode',  || Text to display
'separator' => '·',                                   || Goes in between the text above
'clone'     => 3,                                     || Text multiplier factor
'hover_pause' => false,                               || If animation is paused when hovered
'reversed'  => false,                                 || If animation shoulg go left to right
'speed'  => false,                                    || Controls animation speed
'extra_class'   => ''                                 || Add extra class

```
