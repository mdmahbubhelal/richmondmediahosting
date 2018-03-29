<div class="wptc-admin-wrap">
<h2 class="wptc-super-headline"><?php _e( 'Shortcodes', 'wptc_theme_td' ); ?></h2>
<h3 class="wptc-headline"><?php _e( 'Margins, Paddings and Borders', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-margins margintop="0px" marginbottom="0px" marginright="0px" marginleft="0px" paddingtop="0px" paddingbottom="0px" paddingright="0px" paddingleft="0px" bordercolor="" borderstyle="solid" borderwidthtop="0px" borderwidthright="0px" borderwidthbottom="0px" borderwidthleft="0px"]Content[/wptc-margins]
    <ul class="wptc-indent-level-3">
        <li><?php _e( 'You can set margins, paddings and even borders for your content, as well as using negative values for the margins and paddings.', 'wptc_theme_td' ); ?></li>
    </ul>
</div>
<h3 class="wptc-headline"><?php _e( 'RSS Feeds', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-rss rss="" target="_blank" feeds="10" size="" color="" hovercolor=""]
    <ul class="wptc-indent-level-3">
        <li><?php _e( '<em>rss:</em> The URL of the RSS feed', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>target:</em> Choices are _blank or _self', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>feeds:</em> The number of feeds to be displayed. This number should be equak or less than the feeds outputed from the source site.', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>size:</em> The font size, if left empty the theme will decide the size', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>color:</em> The font color, if left empty the theme will decide the link color', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>hovercolor:</em> The hover color, if left empty the theme will decide the link hover color.=', 'wptc_theme_td' ); ?></li>
	</ul>
</div>
<h3 class="wptc-headline"><?php _e( 'Paypal', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode - *** NOTE: The Paypal Button Shortcode MUST be activated first from the Customizer->Site Identity, and then configured correctly from the Settings->Paypal Button menu found in the Dashboard. ***', 'wptc_theme_td' ); ?>:</strong> [wptc-paypal name="Sample Product" price="50" align="center"]
    <ul class="wptc-indent-level-3">
        <li><?php _e( '<em>name:</em> The name of the product or service you are selling', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>price:</em> Selling price', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>align:</em> left, center, or right', 'wptc_theme_td' ); ?></li>
	</ul>
</div>
<h3 class="wptc-headline"><?php _e( 'Read More', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-more more="Read more" less="Read less" align="left" color="red" size="80%"]Content[/wptc-more]
    <ul class="wptc-indent-level-3">
        <li><?php _e( '<em>more:</em> Label for the read more text', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>less:</em> Label for the read less text', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>align:</em> left, center, or right', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>color:</em> Color of the read more and read less labels', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>size:</em> The font size in px or % for the read more and read less labels', 'wptc_theme_td' ); ?></li>
	</ul>
</div>
<h3 class="wptc-headline"><?php _e( 'LinkBox', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-linkbox link="javascript:;" target="_self" image="http://goo.gl/m2pkvN" width="25%" title="Linkbox Title"]Content[/wptc-linkbox]
    <ul class="wptc-indent-level-3">
        <li><?php _e( '<em>link:</em> Set the link url assigned to the image and title', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>target:</em> Link target, ie: _self or _blank', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>image:</em> The image url', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>width:</em> The image width, in px or %. Using % will harvest you better responsive results', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>title:</em> Title for the LinkBox', 'wptc_theme_td' ); ?></li>
	</ul>
</div>
<h3 class="wptc-headline"><?php _e( 'Animations', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-animate class="wow zoomIn" duration="1" delay="0" offset="270" iteration="1"]Content[/wptc-animate]
    <ul class="wptc-indent-level-3">
        <li><?php _e( '<em>class:</em> The CSS class for the type of animation, example - wow flip, wow will activate the JavaSript to activate the animation when in view, followed by the name of the animation', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>duration:</em> How long will the animation take to complete in seconds, the default value is 1', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>delay:</em> The added delay time in seconds when the animation will start, the default value is 0', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>offset:</em> The offset value in pixels when the animation will start when you scroll in view, the default value is 270', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>iteration:</em> The number of times the animation will repeat itself, the default value is 1', 'wptc_theme_td' ); ?></li>
	</ul>
</div>
<h3 class="wptc-headline"><?php _e( 'Box', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-box background="#444444" color="#dedede" size="16px" radius="10px" width="90%" opacity="1"]Content[/wptc-box]
    <ul class="wptc-indent-level-3">
        <li><?php _e( 'You can create any size of a box, where you can configure the radius, back. color, font size and color, and the boxes opacity. Great for placing content in full width sections.', 'wptc_theme_td' ); ?></li>
    </ul>
</div>
<h3 class="wptc-headline"><?php _e( 'Box2', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-box2 classname="box1" width="100%" color="white" backcolor1="black" backcolor2="blue" hovercolor="black" hoverbackcolor1="green" hoverbackcolor2="yellow"]Content[/wptc-box2]
    <ul class="wptc-indent-level-3">
        <li><?php _e( 'You can create any size of a box, where you can have a gradient backgound and a hover background gradient, as well as a custom color for the text and the hovered text. You can set the classname to anything you want, however, each box2 shortcode in a page must have a unique classname.', 'wptc_theme_td' ); ?></li>
    </ul>
</div>
<h3 class="wptc-headline"><?php _e( 'Delaybox', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-delaybox classname="delaybox1" width="100%" color="yellow" backcolor="black" hovercolor="#000000" hoverbackcolor="#dddddd" duration="1"]Content[/delaybox-box2]
    <ul class="wptc-indent-level-3">
        <li><?php _e( 'You can create any size of a box, where you can have a timed hover effect by changing the background color and the text color. You can name the classname to anything you want, however, each box2 shortcode in a page must have a unique classname.', 'wptc_theme_td' ); ?></li>
    </ul>
</div>
<h3 class="wptc-headline"><?php _e( 'LogoText', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-logotext topmargin="0px" bottommargin="0px" align="center" link="" size="50px" color="" icon1="home" text1="LOGO TEXT" icon2="" text2="" icon3=""]
    <ul class="wptc-indent-level-3">
        <li><?php _e( 'You can create a Texted Logo, with up to 3 Font Awesome icons, 2 items of text, and a link. You can further customize the TextLogo by alignment and size.', 'wptc_theme_td' ); ?></li>
    </ul>
</div>
<h3 class="wptc-headline"><?php _e( 'Neon', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-neon classname="neon1" topmargin="0px" bottommargin="0px" align="center" link="" size="50px" color="#000000" shadowcolor="#789AFF" icon1="home" text1="NEON TEXT" icon2="" text2="" icon3=""]
    <ul class="wptc-indent-level-3">
        <li><?php _e( 'You can create a Neon shadowed text to be used as a header or logo, with up to 3 Font Awesome icons, 2 items of text, and a link. You can further customize the Neon text by alignment and size.  You can name the classname to anything you want, however, each Neon shortcode in a page must have a unique classname.', 'wptc_theme_td' ); ?></li>
    </ul>
</div>
<h3 class="wptc-headline"><?php _e( 'Images', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-image align="" width="" shadow="" corners="" lightbox="" alt="" url="" margintop="" marginright="" marginbottom="" marginleft=""]
    <ul class="wptc-indent-level-3">
        <li><?php _e( '<em>Parameters:</em> Use the popup box to insert an image and style it, in a post or page. The width can be in px or %, and the margins in px.', 'wptc_theme_td' ); ?></li>
   </ul>
</div>
<h3 class="wptc-headline"><?php _e( 'Headings', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-heading topmargin="0px" bottommargin="0px" align="center" iconsize="75px" iconcolor="" icon="home" iconpadding="30px" headingsize="75px" headingcolor="" heading="Heading"]
    <ul class="wptc-indent-level-3">
        <li><?php _e( '<em>Parameters:</em> No further explanations needed for this shortcode.', 'wptc_theme_td' ); ?></li>
   </ul>
</div>
<h3 class="wptc-headline"><?php _e( 'Highlights', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-highlight size="" color="#ffffff" backcolor="#000000"]Content[/wptc-highlight]
    <ul class="wptc-indent-level-3">
        <li><?php _e( '<em>Parameters:</em> The size should be in px, and the colors either a hexidecimal value, or the name of the color', 'wptc_theme_td' ); ?></li>
   </ul>
</div>
<h3 class="wptc-headline"><?php _e( 'No IE 10 or 11', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-noie]Content[/wptc-noie]
    <ul class="wptc-indent-level-3">
        <li><?php _e( '<em>Parameters:</em> There are no parameters for this shortcode!', 'wptc_theme_td' ); ?></li>
   </ul>
</div>
<h3 class="wptc-headline"><?php _e( 'Large Desktops', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-desktop]Content[/wptc-desktop]
    <ul class="wptc-indent-level-3">
        <li><?php _e( '<em>Note:</em> It will display the content only if the screen is larger than 1370px', 'wptc_theme_td' ); ?></li>
    </ul>
</div>
<h3 class="wptc-headline"><?php _e( 'Laptops and Smaller', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-laptop]Content[/wptc-laptop]
    <ul class="wptc-indent-level-3">
        <li><?php _e( '<em>Note:</em> It will display the content only if the screen is smaller than 1370px', 'wptc_theme_td' ); ?></li>
    </ul>
</div>
<h3 class="wptc-headline"><?php _e( 'Vimeo', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-vimeo id="" autoplay="0"]
    <ul class="wptc-indent-level-3">
        <li><?php _e( '<em>id:</em> The id of the vimeo video', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>autoplay:</em> 1 for autoplay and 0 for not autoplay when the page loads - have one autoplay video per page', 'wptc_theme_td' ); ?></li>
    </ul>
</div>
<h3 class="wptc-headline"><?php _e( 'Youtube', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-youtube id="" autoplay="0"]
    <ul class="wptc-indent-level-3">
        <li><?php _e( '<em>id:</em> The id of the vimeo video', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>autoplay:</em> 1 for autoplay and 0 for not autoplay when the page loads - have one autoplay video per page', 'wptc_theme_td' ); ?></li>
    </ul>
</div>
<h3 class="wptc-headline"><?php _e( 'Responsive Iframe', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-iframe url=""]
    <ul class="wptc-indent-level-3">
        <li><?php _e( '<em>url:</em> The url of the page to iframe', 'wptc_theme_td' ); ?></li>
    </ul>
</div>
<h3 class="wptc-headline"><?php _e( 'Vimeo Card', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-vimeo-card id="" autoplay="0" title="Vimeo Card Title" title_color="" title_size="30px" border="wptc-3d"]Content[/wptc-vimeo-card]
    <ul class="wptc-indent-level-3">
        <li><?php _e( '<em>id:</em> The id of the vimeo video', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>autoplay:</em> 1 for autoplay and 0 to not autoplay when the page loads - have one autoplay video per page', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>title:</em> The Vimeo Card title', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>title_color:</em> The title color -leave blank for theme default', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>title_size:</em> The title font size in px', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>border:</em> wptc-3d or wptc-flat or wptc-none', 'wptc_theme_td' ); ?></li>
    </ul>
</div>
<h3 class="wptc-headline"><?php _e( 'Youtube Card', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-youtube-card id="" autoplay="0" title="Youtube Card Title" title_color="" title_size="30px" border="wptc-3d"]Content[/wptc-youtube-card]
    <ul class="wptc-indent-level-3">
        <li><?php _e( '<em>id:</em> The id of the youtube video', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>autoplay:</em> 1 for autoplay and 0 to not autoplay when the page loads - have one autoplay video per page', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>title:</em> The Youtube Card title', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>title_color:</em> The title color -leave blank for theme default', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>title_size:</em> The title font size in px', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>border:</em> wptc-3d or wptc-flat or wptc-none', 'wptc_theme_td' ); ?></li>
    </ul>
</div>
<h3 class="wptc-headline"><?php _e( 'Card', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-card title="Card Title" title_color="" title_size="30px" image="http://goo.gl/m2pkvN" border="wptc-3d" lightbox="lightbox"]Contnet[/wptc-card]
    <ul class="wptc-indent-level-3">
        <li><?php _e( '<em>title:</em> The Card title', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>title_color:</em> The title color -leave blank for theme default', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>title_size:</em> The title font size in px', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>image:</em> The full path of the image url to use', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>border:</em> wptc-3d or wptc-flat or wptc-none', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>lightbox:</em> use lightbox to open the image in lightbox - anything else will not open the image', 'wptc_theme_td' ); ?></li>
    </ul>
</div>
<h3 class="wptc-headline"><?php _e( 'Feature', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-feature border="wptc-3d" link="http://google.com" target="_self" size="300%" icon1="circle-thin" icon1color="#000000" icon2="home" icon2color="#000000" title="Feature Title" titlecolor=""]Content[/wptc-feature]
    <ul class="wptc-indent-level-3">
	    <li><?php _e( '<em>border:</em> wptc-3d or wptc-flat or wptc-none', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>url:</em> The url to open when the icon is clicked', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>target:</em> _self to open the url on the same tab or _blank to open it in a new tab', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>size:</em> size of the icons in percentage - 300% is the default', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>icon1:</em> the name of the outside FA icon', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>icon1color:</em> The color of the outside icon', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>icon2:</em> the name of the inside FA icon', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>icon2color:</em> The color of the inside icon', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>title:</em> The Feature title', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>titlecolor:</em> The title color -leave blank for theme default', 'wptc_theme_td' ); ?></li>
    </ul>
</div>
<h3 class="wptc-headline"><?php _e( 'Google Trends', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-trends h="330" w="1050" q="wordpress,joomla,drupal" geo=""]
    <ul class="wptc-indent-level-3">
        <li><?php _e( '<em>h:</em> The chart height in px - just the number', 'wptc_theme_td' ); ?></li>
	    <li><?php _e( '<em>w:</em> The chart width in px - just the number', 'wptc_theme_td' ); ?></li>
		        <li><?php _e( '<em>q:</em> The terms to query separated with coma', 'wptc_theme_td' ); ?></li>
    </ul>
</div>
<h3 class="wptc-headline"><?php _e( 'Callouts', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-callout align="center" icon="home" iconcolor="" title="Title" titlecolor="" image=""]Content[/wptc-callout]
    <ul class="wptc-indent-level-3">
        <li><?php _e( '<em>align:</em> left, right, or center', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>icon:</em> Name of Font Awesome icon, example: cogs', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>iconcolor:</em> Name of color, or hexadecimal value, defaults to the theme set color if left blank', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>title:</em> The callout title', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>titlecolor:</em> The color of the title, defaults to the theme set color if left blank', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>image:</em> The url of the image, it is highly recommended tohave one', 'wptc_theme_td' ); ?></li>
    </ul>
</div>
<h3 class="wptc-headline"><?php _e( 'Boxed Sections', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-section-box background="#dddddd"]Content[/wptc-section-box]
    <ul class="wptc-indent-level-3">
        <li><?php _e( 'The background has to be the name of a color or a hexadecimal value, and not a url of an image', 'wptc_theme_td' ); ?></li>
    </ul>
</div>
<h3 class="wptc-headline"><?php _e( 'Call To Action', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-cta iconcolor="" iconname="home" title="Title" titlecolor="" buttonlabel="Button" buttonlink="#" buttontarget="_self" buttonalign="center" background="" opacity="1"]Content[/wptc-cta]
    <ul class="wptc-indent-level-3">
        <li><?php _e( '<em>iconcolor:</em> Name of color, or hexadecimal value, defaults to the theme set color if left blank', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>iconname:</em> Name of Font Awesome icon, example: cogs', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>title:</em> The Call To Action title', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>titlecolor:</em> The color of the title, defaults to the theme set color if left blank', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>buttonlabel:</em> The text on the button', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>buttonlink:</em> The url of the button', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>buttontarget:</em> The target for the button link. ex: _blank, _self, _parent, _top', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>buttalign:</em> left, right, or center', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>background:</em> The hex. color value, or colorname', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>opacity:</em> The opacity of the CTA box', 'wptc_theme_td' ); ?></li>
    </ul>
</div>
<h3 class="wptc-headline"><?php _e( 'Call To Action', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-cta iconcolor="" iconname="home" title="Title" titlecolor="" buttonlabel="Button" buttonlink="#" buttontarget="_self" buttonalign="center" background="" opacity="1"]Content[/wptc-cta]
    <ul class="wptc-indent-level-3">
        <li><?php _e( '<em>iconcolor:</em> Name of color, or hexadecimal value, defaults to the theme set color if left blank', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>iconname:</em> Name of Font Awesome icon, example: cogs', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>title:</em> The Call To Action title', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>titlecolor:</em> The color of the title, defaults to the theme set color if left blank', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>buttonlabel:</em> The text on the button', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>buttonlink:</em> The url of the button', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>buttontarget:</em> The target for the button link. ex: _blank, _self, _parent, _top', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>buttalign:</em> left, right, or center', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>background:</em> The hex. color value, or colorname', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>opacity:</em> The opacity of the CTA box', 'wptc_theme_td' ); ?></li>
    </ul>
</div>
<h3 class="wptc-headline"><?php _e( 'Auto Columns', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-autocolumns columns="3" columngap="40px" paddingright="20px" paddingleft="20px"]Content[/wptc-autocolumns]
    <ul class="wptc-indent-level-3">
        <li><?php _e( '<em>columns:</em> The number of columns for the text to be evenly distributed', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>columngap:</em> The gap between columns', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>paddingright and paddingleft:</em> The paddings on each side of the content', 'wptc_theme_td' ); ?></li>
    </ul>
</div>
<h3 class="wptc-headline"><?php _e( 'Spacer', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-space height="200px"]
    <ul class="wptc-indent-level-3">
        <li><?php _e( '<em>height:</em> The amount of vertical space in pixels', 'wptc_theme_td' ); ?></li>
	</ul>
</div>
<h3 class="wptc-headline"><?php _e( 'Directions', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-directions location=""]
    <ul class="wptc-indent-level-3">
        <li><?php _e( '<em>location:</em> The location to get directions for, it can be an address or the name of a location or business', 'wptc_theme_td' ); ?></li>
	</ul>
</div>
<h3 class="wptc-headline"><?php _e( 'Stitched Content', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-stitch]Content[/wptc-stitch]
    <ul class="wptc-indent-level-3">
        <li><?php _e( 'The content presented in a stitched like box', 'wptc_theme_td' ); ?></li>
	</ul>
</div>
<h3 class="wptc-headline"><?php _e( 'No Desktop', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-nodesktop]Content[/wptc-nodesktop]
    <ul class="wptc-indent-level-3">
        <li><?php _e( 'The content to be visible on tablets and phones', 'wptc_theme_td' ); ?></li>
	</ul>
</div>
<h3 class="wptc-headline"><?php _e( 'No Tablet', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-notablet]Content[/wptc-notablet]
    <ul class="wptc-indent-level-3">
        <li><?php _e( 'The content to be visible on large screens and phones', 'wptc_theme_td' ); ?></li>
	</ul>
</div>
<h3 class="wptc-headline"><?php _e( 'No Phone', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-nophone]Content[/wptc-nophone]
    <ul class="wptc-indent-level-3">
        <li><?php _e( 'The content to be visible on tablets and large screens', 'wptc_theme_td' ); ?></li>
	</ul>
</div>
<h3 class="wptc-headline"><?php _e( 'No Responsive', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-noresponsive]Content[/wptc-noresponsive]
    <ul class="wptc-indent-level-3">
        <li><?php _e( 'The content to be visible only on large screens', 'wptc_theme_td' ); ?></li>
	</ul>
</div>
<h3 class="wptc-headline"><?php _e( 'Single Background Color', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-single-bg color="" url=""]
    <ul class="wptc-indent-level-3">
        <li><?php _e( 'The background color or image only for this post or page. If both parameters are set, the image will be shown', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>color:</em> The color name or the hex. value for it', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>url:</em> The url of the background image', 'wptc_theme_td' ); ?></li>
	</ul>
</div>
<h3 class="wptc-headline"><?php _e( 'Theme Buttons', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-themebutton icon="home" label="Button" link="#" target="_self" align="center"]
    <ul>
        <li><?php _e( 'The self enclosed theme designed button', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>icon:</em> The name of the Font Awesome icon', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>label:</em> The text on the button', 'wptc_theme_td' ); ?></li>
		<li><?php _e( '<em>link:</em> The link for the button', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>target:</em> The target for the button link. ex: _blank, _self, _parent, _top', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>align:</em> left, right, or center', 'wptc_theme_td' ); ?></li>
    </ul>
</div>
<h3 class="wptc-headline"><?php _e( 'Buttons', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-button icon="home" link="#" target="" type="" size="" style=""]Button Text[/wptc-button]
    <ul>
	    <li><?php _e( '<em>icon:</em> The name of the Font Awesome icon', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>link:</em> The link for the button', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>target:</em> The target for the button link. ex: _blank, _self, _parent, _top', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>type:</em> The type of button. ex: primary, warning, danger, success, info, inverse, or blank for default', 'wptc_theme_td' ); ?>t</li>
        <li><?php _e( '<em>size:</em> The text size for the button. ex: small, smaller, xsmall, xxsmall, large, larger, xlarge, xxlarge', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>style:</em> Additional inline styles for the button. ex: padding:10px;', 'wptc_theme_td' ); ?></li>
    </ul>
</div>
<h3 class="wptc-headline"><?php _e( 'Alerts', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-alert type=]alert text[/wptc-alert]
    <ul class="wptc-indent-level-3">
        <li><?php _e( '<em>type:</em> The type of alert. ex: danger, success, info, section or blank for default. The section type is appropriate to be used in conjunction with the section shortcode when an image is used', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>textalign:</em> Alignment of alert text. ex: left, center, right, justify, or blank for default', 'wptc_theme_td' ); ?></li>
    </ul>
</div>
<h3 class="wptc-headline"><?php _e( 'Sections', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-section fullwidth= color= image= parallax= padding=]content[/wptc-section]
    <ul class="wptc-indent-level-3">
        <li><?php _e( '<em>fullwidth:</em> Full browser width, or container width. ex: true, false', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>color:</em> Background color. ex: #ffffff', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>image:</em> Background image url. ex: http://somesite.com/iamge.jpg', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>parallax:</em> Parallax effect on background image. ex: true, false', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>padding:</em> Padding in pixels. ex: 10', 'wptc_theme_td' ); ?></li>
    </ul>
</div>
<h3 class="wptc-headline"><?php _e( 'Grids', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-grid-row]content[/wptc-grid-row]
    <ul class="wptc-indent-level-3">
        <li><?php _e( 'Creates a grid row.', 'wptc_theme_td' ); ?></li>
    </ul>
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-grid-column size=]content[/wptc-grid-column]
    <ul>
        <li><?php _e( 'Creates a grid column.', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>size:</em> Number of columns in grid. ex: 1, 2, 3, 4', 'wptc_theme_td' ); ?></li>
    </ul>
    <strong><?php _e( 'Example Usage', 'wptc_theme_td' ); ?>:</strong> [wptc-grid-row][wptc-grid-column size=2]content[/wptc-grid-column][wptc-grid-column size=2]content[/wptc-grid-column][/wptc-grid-row]
</div>
<h3 class="wptc-headline"><?php _e( 'List Posts / Pages', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' );?>:</strong> [wptc-list-posts post_type="post" category="" grid="3" thumbnail_size="full" thumbnail_align="center" posts_per_page="20"]
    <ul class="wptc-indent-level-3">
        <li><?php _e( '<em>posts_per_page, offset, category, category_name, orderby, order, include, exclude, meta_key, meta_value, post_type, post_mime_type, post_parent, post_status, suppress_filters</em> Options explained here:', 'wptc_theme_td' ); ?> <a href="http://codex.wordpress.org/Template_Tags/get_posts" target="_blank">Template Tags/get posts</a></li>
        <li><?php _e( '<em>before</em> HTML before list. ex: &lt;p&gt;', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>after</em> HTML after list. ex: &lt;/p&gt;', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>before_title</em> HTML before title. ex: &lt;h3&gt;', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>after_title</em> HTML after title. ex: &lt;/h3&gt;', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>title</em> Show post title. ex: true, false', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>title_link</em> Title links to post. ex: true, false', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>before_content</em> HTML before content/excerpt. ex: &lt;p&gt;', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>after_content</em> HTML after content/excerpt. ex: &lt;/p&gt;', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>excerpt</em> Show post excerpt. ex: true, false', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>content</em> Show post content. ex: true, false', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>more_link_text</em> Content more link text. ex: Read More...', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>grid</em> Lists posts in a grid. ex: 2, 3, 4', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>thumbnail</em> Show post featured image with excerpt. ex: true, false', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>thumbnail_size</em> Thumbnail image size. ex: thumbnail, medium, large, full', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>thumbnail_align</em> Thumbnail alignment. ex: none, left, right, center', 'wptc_theme_td' ); ?></li>
    </ul>
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' );?>:</strong> [wptc-list-pages include=1]
    <ul class="wptc-indent-level-3">
        <li><?php _e( '<em>sort_order, sort_column, hierarchical, exclude, include, meta_key, meta_value, authors, child_of, parent, exclude_tree, number, offset, post_type, post_status</em> Options explained here:', 'wptc_theme_td' ); ?> <a href="http://codex.wordpress.org/Function_Reference/get_pages" target="_blank">Function Reference/get pages</a></li>
        <li><?php _e( '<em>before</em> HTML before list. ex: &lt;p&gt;', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>after</em> HTML after list. ex: &lt;/p&gt;', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>before_title</em> HTML before title. ex: &lt;h3&gt;', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>after_title</em> HTML after title. ex: &lt;/h3&gt;', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>title</em> Show post title. ex: true, false', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>title_link</em> Title links to post. ex: true, false', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>before_content</em> HTML before content/excerpt. ex: &lt;p&gt;', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>after_content</em> HTML after content/excerpt. ex: &lt;/p&gt;', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>content</em> Show post content. ex: true, false', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>grid</em> Lists posts in a grid. ex: 2, 3, 4', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>thumbnail</em> Show post featured image with excerpt. ex: true, false', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>thumbnail_size</em> Thumbnail image size. ex: thumbnail, medium, large, full', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>thumbnail_align</em> Thumbnail alignment. ex: none, left, right, center', 'wptc_theme_td' ); ?></li>
    </ul>
</div>
<h3 class="wptc-headline"><?php _e( 'Member / Guest Content', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-members]content[/wptc-members]
    <ul class="wptc-indent-level-3">
        <li><?php _e( 'Shows content to logged in users only.', 'wptc_theme_td' ); ?></li>
    </ul>
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-guests]content[/wptc-guests]
    <ul>
        <li><?php _e( 'Shows content to logged out users only.', 'wptc_theme_td' ); ?></li>
    </ul>
</div>
<h3 class="wptc-headline"><?php _e( 'Website Snapshot', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-snap url="http://somesite.com" alt="SomeSite.com Website" w="400" h="300"]
    <ul class="wptc-indent-level-3">
        <li><?php _e( 'Shows a snashot of any website.', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>url:</em> The url of the website. ex: http://somesite.com', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>alt:</em> Alt text for snapshop image. ex: SomeSite.com Website', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>w:</em> The width (in pixels) of the snapshot. ex: 400', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>h:</em> The height (in pixels) of the snapshot. ex: 300', 'wptc_theme_td' ); ?></li>
    </ul>
</div>
<h3 class="wptc-headline"><?php _e( 'Current Year', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-year]
    <ul class="wptc-indent-level-3">
        <li><?php _e( 'Displays the current year.', 'wptc_theme_td' ); ?></li>
    </ul>
</div>
<h3 class="wptc-headline"><?php _e( 'Login Form', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-login avatarsize="70"]
    <ul class="wptc-indent-level-3">
        <li><?php _e( 'Shows a login form.', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>avatarsize:</em> The size (in pixels) of the avatar to show for logged in users. ex: 70', 'wptc_theme_td' ); ?></li>
        <li><?php _e( 'An avatarsize of 0 will turn off avatar display.', 'wptc_theme_td' ); ?></li>
    </ul>
</div>
<h3 class="wptc-headline"><?php _e( 'Simple Sitemap', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-sitemap pages="true" categories="true" archives="true" postspercat="false"]
    <ul class="wptc-indent-level-3">
        <li><?php _e( 'Shows a simple sitemap.', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>pages:</em> Show pages in sitemap. ex: true, false', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>categories:</em> Show categories in sitemap. ex: true, false', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>archives:</em> Show archives in sitemap. ex: true, false', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>postspercat:</em> Show posts per category in sitemap. ex: true, false', 'wptc_theme_td' ); ?></li>
    </ul>
</div>
<h3 class="wptc-headline"><?php _e( 'Icons (Font Awesome)', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <strong><?php _e( 'Shortcode', 'wptc_theme_td' ); ?>:</strong> [wptc-icon name= style=]
    <ul class="wptc-indent-level-3">
        <li><?php _e( '<em>name:</em> The icon name to display. ex: flag', 'wptc_theme_td' ); ?></li>
        <li><?php _e( 'Name can also include extra classes. ex: pull-left', 'wptc_theme_td' ); ?></li>
        <li><?php _e( '<em>style:</em> Additional inline styles for the icon. ex: margin:10px;', 'wptc_theme_td' ); ?></li>
        <li><a href="http://fontawesome.io/cheatsheet/" target="_blank"><?php _e( 'Font Awesome Cheatsheet', 'wptc_theme_td' ); ?></a></li>
    </ul>
</div>
</div>
