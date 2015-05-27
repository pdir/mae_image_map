mae_image_map
=============

purpose:
--------
Define responsive ImageMaps and assign them to a ImageMap content element



description:
------------
you can define image maps with any number of rectangular areas with links and background-images.
This extension uses html and css only. There is no JavaScript necessary, because it does not use ordinary <map> or <area> tags.
It uses the same code, the standard contao image uses to display (responsive) images, but adds the links to the <figcaption> block.
The pixel coordinates you enter are being tranlated into percentages for the absolutely positioned area links.
You may add your own :hover, :active styles for those areas.

First you create a new ImageMap in the backend and specify the base width and height of your underlying image as well as the
default dimensionsand backgrounds for the areas.

Then you add the areas with their title, position, image, link and description.

To add an image map to an article, you have to select the new media content element "ImageMap" and select the appropriate map
in its properties.



customized places within contao:
--------------------------------
new backend module "ImageMaps"
new media content element "ImageMap"



visit:
http://www.martin-eberhardt.com
for more information