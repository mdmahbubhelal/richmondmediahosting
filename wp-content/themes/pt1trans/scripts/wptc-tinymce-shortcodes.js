(function(){
	tinymce.create('tinymce.plugins.WPTCShortcodesPlugin', {
		init: function(ed, url) {
			ed.addButton('wptcScButton', {
                type: 'menubutton',
				title: 'Theme Shortcodes',
				image :  url +'/shortcodes.gif',
                menu: [	{ text: 'Margins', onclick: function() { tinymce.activeEditor.selection.setContent( '[wptc-margins margintop="0px" marginbottom="0px" marginright="0px" marginleft="0px" paddingtop="0px" paddingbottom="0px" paddingright="0px" paddingleft="0px" bordercolor="" borderstyle="solid" borderwidthtop="0px" borderwidthright="0px" borderwidthbottom="0px" borderwidthleft="0px"]' + tinymce.activeEditor.selection.getContent() + '[/wptc-margins]' ) } },
				        { text: 'Animate', onclick: function() {
							ed.windowManager.open({
								title: 'Animate',
								width: 400,
								height: 300,
								id: 'wptcanimatewindow',
								body: [
								    { type: 'listbox', name: 'wptcclass', label: 'Animation', values: [ { text: 'Zoom In', value: 'wow zoomIn' }, { text: 'Slide In Left', value: 'wow slideInLeft' }, { text: 'Slide In Right', value: 'wow slideInRight' }, { text: 'Flip', value: 'wow flip' }, { text: 'Fade In', value: 'wow fadeIn' }, { text: 'Bounce', value: 'wow bounce' }, { text: 'Flash', value: 'wow flash' } ] },
									{ type: 'textbox', name: 'wptcduration', label: 'Duration', value: '1' },
									{ type: 'textbox', name: 'wptcdelay', label: 'Delay', value: '0' },
									{ type: 'textbox', name: 'wptcoffset', label: 'Offset', value: '270' },
									{ type: 'textbox', name: 'wptciteration', label: 'Iteration', value: '1' }
								],
								onsubmit: function(e) {
										ed.insertContent( '[wptc-animate class="' + e.data.wptcclass + '" duration="' + e.data.wptcduration + '" delay="' + e.data.wptcdelay + '" offset="' + e.data.wptcoffset + '" iteration="' + e.data.wptciteration + '"]' + tinymce.activeEditor.selection.getContent() + '[/wptc-animate]' );
									}
							});
						} },
				        { text: 'Section', onclick: function() {
							ed.windowManager.open({
								title: 'Section',
								width: 400,
								height: 300,
								id: 'wptcsectionwindow',
								body: [
									{ type: 'checkbox', name: 'wptcsecfullwidth', label: 'Full Width', value: true },
									{ type: 'textbox', name: 'wptcseccolor', label: 'Color', value: '#ffffff' },
									{ type: 'textbox', name: 'wptcsecimgurl', label: 'Image URL', value: '' },
									{ type: 'button', name: 'wptcsecimgbutton', label: ' ', text: 'Select Image', onclick: function() {
											wptcsecimgframe = wp.media({
												className: 'media-frame',
												multiple: false,
												title: 'Select Image',
												library: { type: 'image' }
											});
											wptcsecimgframe.open();
											wptcsecimgframe.off('select');
											wptcsecimgframe.on('select',function(){
												var selection = wptcsecimgframe.state().get( 'selection' ).toJSON();
												var i;
												jQuery( '#wptcsectionwindow-body input' ).each( function( i ) { if ( i == 1 ) jQuery( this ).val( selection[0].url ); } );
											});
									}	},
									{ type: 'checkbox', name: 'wptcsecparallax', label: 'Parallax', value: 'false' },
									{ type: 'textbox', name: 'wptcsecpadding', label: 'Padding', value: '10' }
								],
								onsubmit: function(e) {
										var fullwidth = 'true', parallax = 'false';
										if ( ! e.data.wptcsecfullwidth ) fullwidth = 'false';
										if ( e.data.wptcsecparallax ) parallax = 'true';
										ed.insertContent( '[wptc-section fullwidth="' + fullwidth + '" color="' + e.data.wptcseccolor + '" image="' + e.data.wptcsecimgurl + '" parallax="' + parallax + '" padding="' + e.data.wptcsecpadding + '"]' + tinymce.activeEditor.selection.getContent() + '[/wptc-section]' );
									}
							});
						}	},
						{ text: 'Linkbox', onclick: function() {
							ed.windowManager.open({
								title: 'Linkbox',
								width: 400,
								height: 300,
								id: 'wptclinkboxwindow',
								body: [
								    { type: 'textbox', name: 'wptclinkboxlink', label: 'Link Url', value: 'javascript:;' },
									{ type: 'listbox', name: 'wptclinkboxtarget', label: 'Target:', values: [ { text: 'Self', value: '_self' }, { text: 'New Tab', value: '_blank' } ] },
									{ type: 'textbox', name: 'wptclinkboximgurl', label: 'Image URL', value: 'http://goo.gl/m2pkvN' },
									{ type: 'button', name: 'wptclinkboximgbutton', label: ' ', text: 'Select Image', onclick: function() {
											wptcsecimgframe = wp.media({
												className: 'media-frame',
												multiple: false,
												title: 'Select Image',
												library: { type: 'image' }
											});
											wptcsecimgframe.open();
											wptcsecimgframe.off('select');
											wptcsecimgframe.on('select',function(){
												var selection = wptcsecimgframe.state().get( 'selection' ).toJSON();
												var i;
												jQuery( '#wptclinkboxwindow-body input' ).each( function( i ) { if ( i == 1 ) jQuery( this ).val( selection[0].url ); } );
											});
									}	},
									{ type: 'textbox', name: 'wptclinkboxwidth', label: 'Width', value: '25%' },
									{ type: 'textbox', name: 'wptclinkboxtitle', label: 'Title', value: 'Linkbox Title' }
									
								],
								onsubmit: function(e) {
										ed.insertContent( '[wptc-linkbox link="' + e.data.wptclinkboxlink + '" target="' + e.data.wptclinkboxtarget + '" image="' + e.data.wptclinkboximgurl + '" width="' + e.data.wptclinkboxwidth + '" title="' + e.data.wptclinkboxtitle + '"]' + tinymce.activeEditor.selection.getContent() + '[/wptc-linkbox]' );
									}
							});
						}	},
						{ text: 'Read More', onclick: function() { tinymce.activeEditor.selection.setContent( '[wptc-more more="Read more" less="Read less" align="left" color="red" size="80%"]' + tinymce.activeEditor.selection.getContent() + '[/wptc-more]' ) } },
						{ text: 'Box', onclick: function() { tinymce.activeEditor.selection.setContent( '[wptc-box background="#444444" color="#dedede" size="16px" radius="10px" width="90%" opacity="1"]' + tinymce.activeEditor.selection.getContent() + '[/wptc-box]' ) } },
						{ text: 'Box2', onclick: function() { tinymce.activeEditor.selection.setContent( '[wptc-box2 classname="box1" width="100%" color="white" backcolor1="black" backcolor2="blue" hovercolor="black" hoverbackcolor1="green" hoverbackcolor2="yellow"]' + tinymce.activeEditor.selection.getContent() + '[/wptc-box2]' ) } },
						{ text: 'Delaybox', onclick: function() { tinymce.activeEditor.selection.setContent( '[wptc-delaybox classname="delaybox1" width="100%" color="yellow" backcolor="black" hovercolor="#000000" hoverbackcolor="#dddddd" duration="1"]' + tinymce.activeEditor.selection.getContent() + '[/wptc-delaybox]' ) } },
						{ text: 'Image', onclick: function() {
							ed.windowManager.open({
								title: 'Image',
								width: 400,
								height: 500,
								id: 'wptccalloutwindow',
								body: [
								    { type: 'listbox', name: 'wptccorners', label: 'Rounded Corners:', values: [ { text: 'No', value: '' }, { text: '5', value: 'rounded5' }, { text: '10', value: 'rounded10' }, { text: '15', value: 'rounded15' }, { text: '20', value: 'rounded20' }, { text: '25', value: 'rounded25' }, { text: '30', value: 'rounded30' }, { text: 'Round', value: 'round' }, ] },
									{ type: 'listbox', name: 'wptcimgalign', label: 'Align:', values: [ { text: 'Center', value: 'aligncenter' }, { text: 'Left', value: 'alignleft' }, { text: 'Right', value: 'alignright' }, ] },
									{ type: 'listbox', name: 'wptclightbox', label: 'Lightbox:', values: [ { text: 'No', value: '' }, { text: 'Yes', value: 'lightbox' }, ] },
									{ type: 'textbox', name: 'wptcwidth', label: 'Width', value: '100%' },
									{ type: 'textbox', name: 'wptccallimgurl', label: 'Image URL', value: '' },
									{ type: 'button', name: 'wptccallimgbutton', label: ' ', text: 'Select Image', onclick: function() {
											wptcsecimgframe = wp.media({
												className: 'media-frame',
												multiple: false,
												title: 'Select Image',
												library: { type: 'image' }
											});
											wptcsecimgframe.open();
											wptcsecimgframe.off('select');
											wptcsecimgframe.on('select',function(){
												var selection = wptcsecimgframe.state().get( 'selection' ).toJSON();
												var i;
												jQuery( '#wptccalloutwindow-body input' ).each( function( i ) { if ( i == 1 ) jQuery( this ).val( selection[0].url ); } );
											});
									}	},
									{ type: 'listbox', name: 'wptcshadow', label: 'Shadow:', values: [ { text: 'No', value: '' }, { text: 'Yes', value: 'shadow' }, ] },
									
									{ type: 'textbox', name: 'wptcalt', label: 'Alt', value: '' },
									{ type: 'textbox', name: 'wptctop', label: 'Margin Top', value: '' },
									{ type: 'textbox', name: 'wptcright', label: 'Margin Right', value: '' },
									{ type: 'textbox', name: 'wptcbottom', label: 'Margin Bottom', value: '' },
									{ type: 'textbox', name: 'wptcleft', label: 'Margin Left', value: '' }
									
								],
								onsubmit: function(e) {
										ed.insertContent( '[wptc-image align="' + e.data.wptcimgalign + '" width="' + e.data.wptcwidth + '" shadow="' + e.data.wptcshadow + '" corners="' + e.data.wptccorners + '" lightbox="' + e.data.wptclightbox + '" alt="' + e.data.wptcalt + '" url="' + e.data.wptccallimgurl + '" margintop="' + e.data.wptctop + '" marginright="' + e.data.wptcright + '" marginbottom="' + e.data.wptcbottom + '" marginleft="' + e.data.wptcleft + '"]' );
									}
							});
						}	},
						{ text: 'Heading', onclick: function() { tinymce.activeEditor.selection.setContent( '[wptc-heading topmargin="0px" bottommargin="0px" align="center" iconsize="75px" iconcolor="" icon="home" iconpadding="30px" headingsize="75px" headingcolor="" heading="Heading"]' ) } },
						{ text: 'Highlight', onclick: function() { tinymce.activeEditor.selection.setContent( '[wptc-highlight size="" color="#ffffff" backcolor="#000000"]' + tinymce.activeEditor.selection.getContent() + '[/wptc-highlight]' ) } },
						{ text: 'LogoText', onclick: function() { tinymce.activeEditor.selection.setContent( '[wptc-logotext topmargin="0px" bottommargin="0px" align="center" link="javascript:;" size="50px" color="" icon1="home" text1="LOGO TEXT" icon2="" text2="" icon3=""]' ) } },
						{ text: 'Neon', onclick: function() { tinymce.activeEditor.selection.setContent( '[wptc-neon classname="neon1" topmargin="0px" bottommargin="0px" align="center" link="javascript:;" size="50px" color="#000000" shadowcolor="#789AFF" icon1="home" text1="NEON TEXT" icon2="" text2="" icon3=""]' ) } },
						{ text: 'Alert', onclick: function() {
							ed.windowManager.open({
								title: 'Alert',
								width: 400,
								height: 100,
								id: 'wptcalertwindow',
								body: [
									{ type: 'listbox', name: 'wptcalerttype', label: 'Type', values: [ { text: 'none', value: '' }, { text: 'Danger', value: 'danger' }, { text: 'Success', value: 'success' }, { text: 'Info', value: 'info' }, { text: 'Section', value: 'section' }, { text: 'Full-Section', value: 'fullsection' } ] },
									{ type: 'listbox', name: 'wptcalertalign', label: 'Text Align:', values: [ { text: 'none', value: '' }, { text: 'Left', value: 'left' }, { text: 'Right', value: 'right' }, { text: 'Center', value: 'center' }, { text: 'Justify', value: 'justify' } ] }
								],
								onsubmit: function(e) {
										ed.insertContent( '[wptc-alert type="' + e.data.wptcalerttype + '" ' + ' textalign="' + e.data.wptcalertalign + '"]' + tinymce.activeEditor.selection.getContent() + '[/wptc-alert]' );
									}
							});
						} },
						{ text: 'Callout', onclick: function() {
							ed.windowManager.open({
								title: 'Callout',
								width: 400,
								height: 300,
								id: 'wptccalloutwindow',
								body: [
									{ type: 'listbox', name: 'wptccalloutalign', label: 'Text Align:', values: [ { text: 'Center', value: 'center' }, { text: 'Left', value: 'left' }, { text: 'Right', value: 'right' }, { text: 'Justify', value: 'justify' } ] },
									{ type: 'textbox', name: 'wptcicon', label: 'Icon', value: 'home' },
									{ type: 'textbox', name: 'wptccallimgurl', label: 'Image URL', value: 'http://goo.gl/m2pkvN' },
									{ type: 'button', name: 'wptccallimgbutton', label: ' ', text: 'Select Image', onclick: function() {
											wptcsecimgframe = wp.media({
												className: 'media-frame',
												multiple: false,
												title: 'Select Image',
												library: { type: 'image' }
											});
											wptcsecimgframe.open();
											wptcsecimgframe.off('select');
											wptcsecimgframe.on('select',function(){
												var selection = wptcsecimgframe.state().get( 'selection' ).toJSON();
												var i;
												jQuery( '#wptccalloutwindow-body input' ).each( function( i ) { if ( i == 1 ) jQuery( this ).val( selection[0].url ); } );
											});
									}	},
									{ type: 'textbox', name: 'wptciconcolor', label: 'Icon Color', value: '' },
									{ type: 'textbox', name: 'wptctitle', label: 'Title', value: '' },
									{ type: 'textbox', name: 'wptctitlecolor', label: 'Title Color', value: '' }
									
								],
								onsubmit: function(e) {
										ed.insertContent( '[wptc-callout align="' + e.data.wptccalloutalign + '" icon="' + e.data.wptcicon + '" iconcolor="' + e.data.wptciconcolor + '" title="' + e.data.wptctitle + '" titlecolor="' + e.data.wptctitlecolor + '" image="' + e.data.wptccallimgurl + '"]' + tinymce.activeEditor.selection.getContent() + '[/wptc-callout]' );
									}
							});
						}	},
						{ text: 'Autocolumns', onclick: function() { tinymce.activeEditor.selection.setContent( '[wptc-autocolumns columns="3" columngap="40px" paddingright="20px" paddingleft="20px"]' + tinymce.activeEditor.selection.getContent() + '[/wptc-autocolumns]' ) } },
						{ text: 'Call To Action', onclick: function() {
							ed.windowManager.open({
								title: 'Call To Action',
								width: 400,
								height: 400,
								id: 'ctawindow',
								body: [
									{ type: 'textbox', name: 'opacity', label: 'Opacity', value: '1' },
									{ type: 'textbox', name: 'ctaimgurl', label: 'Image URL', value: '' },
									{ type: 'button', name: 'ctaimgbutton', label: ' ', text: 'Select Image', onclick: function() {
											wptcsecimgframe = wp.media({
												className: 'media-frame',
												multiple: false,
												title: 'Select Image',
												library: { type: 'image' }
											});
											wptcsecimgframe.open();
											wptcsecimgframe.off('select');
											wptcsecimgframe.on('select',function(){
												var selection = wptcsecimgframe.state().get( 'selection' ).toJSON();
												var i;
												jQuery( '#ctawindow-body input' ).each( function( i ) { if ( i == 1 ) jQuery( this ).val( selection[0].url ); } );
											});
									}	},
									{ type: 'textbox', name: 'iconcolor', label: 'Icon Color', value: '' },
									{ type: 'listbox', name: 'iconname', label: 'Icon Name', values: [ { text: 'home', value: 'home' }, { text: 'coffee', value: 'coffee' }, { text: 'check', value: 'check' }, { text: 'lock', value: 'lock' }, { text: 'briefcase', value: 'briefcase' }, { text: 'bar-chart', value: 'bar-chart' }, { text: 'balance-scale', value: 'balance-scale' }, { text: 'cogs', value: 'cogs' }, { text: 'plug', value: 'plug' }, { text: 'signal', value: 'signal' }, { text: 'wrench', value: 'wrench' } ] },
									{ type: 'textbox', name: 'title', label: 'Title', value: 'Call To Action Title' },
									{ type: 'textbox', name: 'titlecolor', label: 'Title Color', value: '' },
									{ type: 'textbox', name: 'buttonlabel', label: 'Button Label', value: 'Button' },
									{ type: 'textbox', name: 'buttonlink', label: 'Button Link', value: 'javascript:;' },
								],
								onsubmit: function(e) {
										ed.insertContent( '[wptc-cta background="url(' + e.data.ctaimgurl + ') center center fixed" iconcolor="' + e.data.iconcolor + '" iconname="' + e.data.iconname + '" title="' + e.data.title + '" titlecolor="' + e.data.titlecolor + '" buttonlabel="' + e.data.buttonlabel + '" buttonlink="' + e.data.buttonlink + '" opacity="' + e.data.opacity + '"]' + tinymce.activeEditor.selection.getContent() + '[/wptc-cta]' );
									}
							});
						}	},
						{ text: 'Call To Action Small', onclick: function() {
							ed.windowManager.open({
								title: 'Call To Action Small',
								width: 400,
								height: 400,
								id: 'ctaswindow',
								body: [
									{ type: 'textbox', name: 'opacity', label: 'Opacity', value: '1' },
									{ type: 'textbox', name: 'ctaimgurl', label: 'Image URL', value: '' },
									{ type: 'button', name: 'ctaimgbutton', label: ' ', text: 'Select Image', onclick: function() {
											wptcsecimgframe = wp.media({
												className: 'media-frame',
												multiple: false,
												title: 'Select Image',
												library: { type: 'image' }
											});
											wptcsecimgframe.open();
											wptcsecimgframe.off('select');
											wptcsecimgframe.on('select',function(){
												var selection = wptcsecimgframe.state().get( 'selection' ).toJSON();
												var i;
												jQuery( '#ctaswindow-body input' ).each( function( i ) { if ( i == 1 ) jQuery( this ).val( selection[0].url ); } );
											});
									}	},
									{ type: 'textbox', name: 'iconcolor', label: 'Icon Color', value: '' },
									{ type: 'listbox', name: 'iconname', label: 'Icon Name', values: [ { text: 'home', value: 'home' }, { text: 'coffee', value: 'coffee' }, { text: 'check', value: 'check' }, { text: 'lock', value: 'lock' }, { text: 'briefcase', value: 'briefcase' }, { text: 'bar-chart', value: 'bar-chart' }, { text: 'balance-scale', value: 'balance-scale' }, { text: 'cogs', value: 'cogs' }, { text: 'plug', value: 'plug' }, { text: 'signal', value: 'signal' }, { text: 'wrench', value: 'wrench' } ] },
									{ type: 'textbox', name: 'title', label: 'Title', value: 'Call To Action Title' },
									{ type: 'textbox', name: 'titlecolor', label: 'Title Color', value: '' },
									{ type: 'textbox', name: 'buttonlabel', label: 'Button Label', value: 'Button' },
									{ type: 'textbox', name: 'buttonlink', label: 'Button Link', value: 'javascript:;' },
								],
								onsubmit: function(e) {
										ed.insertContent( '[wptc-cta-small background="url(' + e.data.ctaimgurl + ') center center fixed" iconcolor="' + e.data.iconcolor + '" iconname="' + e.data.iconname + '" title="' + e.data.title + '" titlecolor="' + e.data.titlecolor + '" buttonlabel="' + e.data.buttonlabel + '" buttonlink="' + e.data.buttonlink + '" opacity="' + e.data.opacity + '"]' + tinymce.activeEditor.selection.getContent() + '[/wptc-cta-small]' );
									}
							});
						}	},
						{ text: 'Space', onclick: function() { tinymce.activeEditor.selection.setContent( '[wptc-space height="200px"]' ) } },
						{ text: 'Theme Button', onclick: function() { tinymce.activeEditor.selection.setContent( '[wptc-themebutton icon="home" label="Button" link="javascript:;" target="_self" align="center"]' ) } },
						{ text: 'Directions', onclick: function() { tinymce.activeEditor.selection.setContent( '[wptc-directions location=""]' ) } },
						{ text: 'Stitched Content', onclick: function() { tinymce.activeEditor.selection.setContent( '[wptc-stitch background="#444444" color="#dedede" size="21px"]' + tinymce.activeEditor.selection.getContent() + '[/wptc-stitch]' ) } },
						{ text: 'No IE', onclick: function() { tinymce.activeEditor.selection.setContent( '[wptc-noie]' + tinymce.activeEditor.selection.getContent() + '[/wptc-noie]' ) } },
						{ text: 'Vimeo', onclick: function() { tinymce.activeEditor.selection.setContent( '[wptc-vimeo id="" autoplay="0"]' ) } },
						{ text: 'Youtube', onclick: function() { tinymce.activeEditor.selection.setContent( '[wptc-youtube id="" autoplay="0"]' ) } },
						{ text: 'Iframe', onclick: function() { tinymce.activeEditor.selection.setContent( '[wptc-iframe url=""]' ) } },
						{ text: 'Vimeo Card', onclick: function() { tinymce.activeEditor.selection.setContent( '[wptc-vimeo-card id="" autoplay="0" title="Vimeo Card Title" title_color="" title_size="30px" border="wptc-3d"]' + tinymce.activeEditor.selection.getContent() + '[/wptc-vimeo-card]' ) } },
						{ text: 'Youtube Card', onclick: function() { tinymce.activeEditor.selection.setContent( '[wptc-youtube-card id="" autoplay="0" title="Youtube Card Title" title_color="" title_size="30px" border="wptc-3d"]' + tinymce.activeEditor.selection.getContent() + '[/wptc-youtube-card]' ) } },
						{ text: 'Card', onclick: function() {
							ed.windowManager.open({
								title: 'Card',
								width: 400,
								height: 300,
								id: 'cardwindow',
								body: [
									{ type: 'textbox', name: 'title', label: 'Title', value: '' },
									{ type: 'textbox', name: 'cardimgurl', label: 'Image URL', value: 'http://goo.gl/m2pkvN' },
									{ type: 'button', name: 'cardimgbutton', label: ' ', text: 'Select Image', onclick: function() {
											wptcsecimgframe = wp.media({
												className: 'media-frame',
												multiple: false,
												title: 'Select Image',
												library: { type: 'image' }
											});
											wptcsecimgframe.open();
											wptcsecimgframe.off('select');
											wptcsecimgframe.on('select',function(){
												var selection = wptcsecimgframe.state().get( 'selection' ).toJSON();
												var i;
												jQuery( '#cardwindow-body input' ).each( function( i ) { if ( i == 1 ) jQuery( this ).val( selection[0].url ); } );
											});
									}	},
									{ type: 'textbox', name: 'titlecolor', label: 'Title Color', value: '' },
									{ type: 'textbox', name: 'titlesize', label: 'Title Size', value: '30px' },
									{ type: 'listbox', name: 'cardborder', label: 'Border:', values: [ { text: '3D', value: 'wptc-3d' }, { text: 'Flat', value: 'wptc-flat' }, { text: 'None', value: 'wptc-' } ] },
									{ type: 'listbox', name: 'cardlightbox', label: 'Lightbox:', values: [ { text: 'Lightbox', value: 'lightbox' }, { text: 'No Lightbox', value: 'none' } ] },
									
								],
								onsubmit: function(e) {
										ed.insertContent( '[wptc-card title="' + e.data.title + '" title_color="' + e.data.titlecolor + '" title_size="' + e.data.titlesize + '"  image="' + e.data.cardimgurl + '" border="' + e.data.cardborder + '" lightbox="' + e.data.cardlightbox + '"]' + tinymce.activeEditor.selection.getContent() + '[/wptc-card]' );
									}
							});
						}	},
						{ text: 'Feature', onclick: function() {
							ed.windowManager.open({
								title: 'Feature',
								width: 400,
								height: 420,
								id: 'featurewindow',
								body: [
									{ type: 'listbox', name: 'border', label: 'Border:', values: [ { text: '3D', value: 'wptc-3d' }, { text: 'Flat', value: 'wptc-flat' }, { text: 'None', value: 'wptc-' } ] },
									{ type: 'textbox', name: 'link', label: 'URL', value: 'javascript:;' },
									{ type: 'listbox', name: 'target', label: 'Target:', values: [ { text: 'Self', value: '_self' }, { text: 'New Tab', value: '_blank' } ] },
									{ type: 'textbox', name: 'size', label: 'Size', value: '300%' },
									{ type: 'listbox', name: 'icon1', label: 'Icon1:', values: [ { text: 'circle-thin', value: 'circle-thin' }, { text: 'circle', value: 'circle' }, { text: 'square-o', value: 'square-o' }, { text: 'square', value: 'square' }, { text: 'tv', value: 'tv' }, { text: 'sun-o', value: 'sun-o' }, { text: 'star-o', value: 'star-o' }, { text: 'heart-o', value: 'heart-o' } ] },
									{ type: 'textbox', name: 'icon1color', label: 'Icon1 Color', value: '#000000' },
									{ type: 'listbox', name: 'icon2', label: 'Icon2:', values: [ { text: 'home', value: 'home' }, { text: 'coffee', value: 'coffee' }, { text: 'check', value: 'check' }, { text: 'lock', value: 'lock' }, { text: 'briefcase', value: 'briefcase' }, { text: 'bar-chart', value: 'bar-chart' }, { text: 'balance-scale', value: 'balance-scale' }, { text: 'cogs', value: 'cogs' }, { text: 'plug', value: 'plug' }, { text: 'signal', value: 'signal' }, { text: 'wrench', value: 'wrench' } ] },
									{ type: 'textbox', name: 'icon2color', label: 'Icon2 Color', value: '#000000' },
									{ type: 'textbox', name: 'title', label: 'Title', value: 'Feature Title' },
									{ type: 'textbox', name: 'titlecolor', label: 'Title Color', value: '' },
								],
								onsubmit: function(e) {
										ed.insertContent( '[wptc-feature border="' + e.data.border + '" link="' + e.data.link + '" target="' + e.data.target + '"  size="' + e.data.size + '" icon1="' + e.data.icon1 + '" icon1color="' + e.data.icon1color + '" icon2="' + e.data.icon2 + '" icon2color="' + e.data.icon2color + '" title="' + e.data.title + '" titlecolor="' + e.data.titlecolor + '"]' + tinymce.activeEditor.selection.getContent() + '[/wptc-feature]' );
									}
							});
						}	},
						{ text: 'Trends', onclick: function() { tinymce.activeEditor.selection.setContent( '[wptc-trends h="330" w="1050" q="wordpress,joomla,drupal" geo=""]' ) } },
						{ text: 'Large Desktop', onclick: function() { tinymce.activeEditor.selection.setContent( '[wptc-desktop]' + tinymce.activeEditor.selection.getContent() + '[/wptc-desktop]' ) } },
						{ text: 'Laptop & Smaller', onclick: function() { tinymce.activeEditor.selection.setContent( '[wptc-laptop]' + tinymce.activeEditor.selection.getContent() + '[/wptc-laptop]' ) } },
						{ text: 'No Desktop', onclick: function() { tinymce.activeEditor.selection.setContent( '[wptc-nodesktop]' + tinymce.activeEditor.selection.getContent() + '[/wptc-nodesktop]' ) } },
						{ text: 'No Tablet', onclick: function() { tinymce.activeEditor.selection.setContent( '[wptc-notablet]' + tinymce.activeEditor.selection.getContent() + '[/wptc-notablet]' ) } },
						{ text: 'No Phone', onclick: function() { tinymce.activeEditor.selection.setContent( '[wptc-nophone]' + tinymce.activeEditor.selection.getContent() + '[/wptc-nophone]' ) } },
						{ text: 'No Responsive', onclick: function() { tinymce.activeEditor.selection.setContent( '[wptc-noresponsive]' + tinymce.activeEditor.selection.getContent() + '[/wptc-noresponsive]' ) } },
						{ text: 'Custom Background', onclick: function() {
							ed.windowManager.open({
								title: 'Custom Background',
								width: 400,
								height: 300,
								id: 'cusbackwindow',
								body: [
									{ type: 'textbox', name: 'color', label: 'Color', value: '' },
									{ type: 'textbox', name: 'cusbackurl', label: 'Image URL', value: '' },
									{ type: 'button', name: 'cusbackimgbutton', label: ' ', text: 'Select Image', onclick: function() {
											wptcsecimgframe = wp.media({
												className: 'media-frame',
												multiple: false,
												title: 'Select Image',
												library: { type: 'image' }
											});
											wptcsecimgframe.open();
											wptcsecimgframe.off('select');
											wptcsecimgframe.on('select',function(){
												var selection = wptcsecimgframe.state().get( 'selection' ).toJSON();
												var i;
												jQuery( '#cusbackwindow-body input' ).each( function( i ) { if ( i == 1 ) jQuery( this ).val( selection[0].url ); } );
											});
									}	},
								],
								onsubmit: function(e) {
										ed.insertContent( '[wptc-single-bg color="' + e.data.color + '" url="' + e.data.cusbackurl + '"]' );
									}
							});
						}	},
					    { text: 'Grid Row', onclick: function() { tinymce.activeEditor.selection.setContent( '[wptc-grid-row]' + tinymce.activeEditor.selection.getContent() + '[/wptc-grid-row]' ) } },
						{ text: 'Grid Column', onclick: function() { tinymce.activeEditor.selection.setContent( '[wptc-grid-column size="1"]' + tinymce.activeEditor.selection.getContent() + '[/wptc-grid-column]' ) } },
						{ text: 'Button', onclick: function() {
							ed.windowManager.open({
								title: 'Button',
								width: 400,
								height: 300,
								id: 'wptcbuttonwindow',
								body: [
								    { type: 'textbox', name: 'wptcbuticon', label: 'Icon', value: '' },
									{ type: 'textbox', name: 'wptcbutlink', label: 'Link URL', value: 'javascript:;' },
									{ type: 'checkbox', name: 'wptcbuttarget', label: 'Open in New Window', value: 'false' },
									{ type: 'listbox', name: 'wptcbuttype', label: 'Type', values: [ { text: 'none', value: '' }, { text: 'Primary', value: 'primary' }, { text: 'Warning', value: 'warning' }, { text: 'Danger', value: 'danger' }, { text: 'Success', value: 'success' }, { text: 'Info', value: 'info' }, { text: 'Inverse', value: 'inverse' } ] },
									{ type: 'listbox', name: 'wptcbutsize', label: 'Size', values: [ { text: 'none', value: '' }, { text: 'Small', value: 'small' }, { text: 'Smaller', value: 'smaller' }, { text: 'Extra Small', value: 'xsmall' }, { text: 'Extra Extra Small', value: 'xxsmall' }, { text: 'Large', value: 'large' }, { text: 'Larger', value: 'larger' }, { text: 'Extra Large', value: 'xlarge' }, { text: 'Extra Extra Large', value: 'xxlarge' } ] },
									{ type: 'textbox', name: 'wptcbutstyle', label: 'Style', value: '' }
								],
								onsubmit: function(e) {
										var target = '';
										if ( e.data.wptcbuttarget ) target = '_blank';
										ed.insertContent( '[wptc-button icon="' + e.data.wptcbuticon + '" link="' + e.data.wptcbutlink + '" target="' + target + '" type="' + e.data.wptcbuttype + '" size="' + e.data.wptcbutsize + '" style="' + e.data.wptcbutstyle + '"]' + tinymce.activeEditor.selection.getContent() + '[/wptc-button]' );
									}
							});
						} },
						{ text: 'List Pages', onclick: function() { tinymce.activeEditor.selection.setContent( '[wptc-list-pages include="" grid="1"]' ) } },
						{ text: 'List Posts', onclick: function() { tinymce.activeEditor.selection.setContent( '[wptc-list-posts post_type="post" category="" grid="3" thumbnail_size="full" thumbnail_align="center" posts_per_page="20"]' ) } },
						{ text: 'Members Only Content', onclick: function() { tinymce.activeEditor.selection.setContent( '[wptc-members]' + tinymce.activeEditor.selection.getContent() + '[/wptc-members]' ) } },
						{ text: 'Guests Only Content', onclick: function() { tinymce.activeEditor.selection.setContent( '[wptc-guests]' + tinymce.activeEditor.selection.getContent() + '[/wptc-guests]' ) } },
						{ text: 'Login Form', onclick: function() { tinymce.activeEditor.selection.setContent( '[wptc-login avatarsize="70"]' ) } },
						{ text: 'Search Form', onclick: function() { tinymce.activeEditor.selection.setContent( '[wptc-search-form]' ) } },
						{ text: 'Current Year', onclick: function() { tinymce.activeEditor.selection.setContent( '[wptc-year]' ) } },
						{ text: 'Website Snapshot', onclick: function() { tinymce.activeEditor.selection.setContent( '[wptc-snap url="http://www.google.com/" alt="Google" w="400" h="300"]' ) } },
						{ text: 'RSS Feed', onclick: function() { tinymce.activeEditor.selection.setContent( '[wptc-rss rss="https://wordpress.org/plugins/browse/new/feed/" target="_blank" feeds="10" size="22px" color="red" hovercolor="blue"]' ) } },
						{ text: 'Paypal Button', onclick: function() { tinymce.activeEditor.selection.setContent( '[wptc-paypal name="" price="" align="center"]' ) } },
						{ text: 'Parent Theme URI', onclick: function() { tinymce.activeEditor.selection.setContent( '[wptc-parent-uri]' ) } },
						{ text: 'Child Theme URI', onclick: function() { tinymce.activeEditor.selection.setContent( '[wptc-child-uri]' ) } } ]
			});
			ed.addButton('wptcColumnsButton', {
				type: 'menubutton',
				title: 'Columns',
				image: url + '/columns.gif',
				menu: [ { text: '1 Column',
						  onclick: function() {
							ed.selection.setContent( '&nbsp;<div class="content-layout"><div class="content-layout-row"><div class="layout-cell layout-cell-size1"><p>Column 1</p></div></div></div>&nbsp;' );
						} },
						{ text: '2 Columns 25/75',
						  onclick: function() {
							ed.selection.setContent( '&nbsp;<div class="content-layout"><div class="content-layout-row"><div class="layout-cell layout-cell-size2"><p>Column 1</p></div><div class="layout-cell layout-cell-size34"><p>Column 2</p></div></div></div>&nbsp;' );
						} },
						{ text: '2 Columns 50/50',
						  onclick: function() {
							ed.selection.setContent( '&nbsp;<div class="content-layout"><div class="content-layout-row"><div class="layout-cell layout-cell-size2"><p>Column 1</p></div><div class="layout-cell layout-cell-size2"><p>Column 2</p></div></div></div>&nbsp;' );
						} },
						{ text: '2 Columns 75/25',
						  onclick: function() {
							ed.selection.setContent( '&nbsp;<div class="content-layout"><div class="content-layout-row"><div class="layout-cell layout-cell-size34"><p>Column 1</p></div><div class="layout-cell layout-cell-size2"><p>Column 2</p></div></div></div>&nbsp;' );
						} },
						{ text: '3 Columns 25/25/50',
						  onclick: function() {
							ed.selection.setContent( '&nbsp;<div class="content-layout"><div class="content-layout-row"><div class="layout-cell layout-cell-size4"><p>Column 1</p></div><div class="layout-cell layout-cell-size4"><p>Column 2</p></div><div class="layout-cell layout-cell-size2"><p>Column 3</p></div></div></div>&nbsp;' );
						} },
						{ text: '3 Columns 25/50/25',
						  onclick: function() {
							ed.selection.setContent( '&nbsp;<div class="content-layout"><div class="content-layout-row"><div class="layout-cell layout-cell-size4"><p>Column 1</p></div><div class="layout-cell layout-cell-size2"><p>Column 2</p></div><div class="layout-cell layout-cell-size4"><p>Column 3</p></div></div></div>&nbsp;' );
						} },
						{ text: '3 Columns 33/33/33',
						  onclick: function() {
							ed.selection.setContent( '&nbsp;<div class="content-layout"><div class="content-layout-row"><div class="layout-cell layout-cell-size3"><p>Column 1</p></div><div class="layout-cell layout-cell-size3"><p>Column 2</p></div><div class="layout-cell layout-cell-size3"><p>Column 3</p></div></div></div>&nbsp;' );
						} },
						{ text: '3 Columns 50/25/25',
						  onclick: function() {
							ed.selection.setContent( '&nbsp;<div class="content-layout"><div class="content-layout-row"><div class="layout-cell layout-cell-size2"><p>Column 1</p></div><div class="layout-cell layout-cell-size4"><p>Column 2</p></div><div class="layout-cell layout-cell-size4"><p>Column 3</p></div></div></div>&nbsp;' );
						} },
						{ text: '4 Columns 25/25/25/25',
						  onclick: function() {
							ed.selection.setContent( '&nbsp;<div class="content-layout"><div class="content-layout-row"><div class="layout-cell layout-cell-size4"><p>Column 1</p></div><div class="layout-cell layout-cell-size4"><p>Column 2</p></div><div class="layout-cell layout-cell-size4"><p>Column 3</p></div><div class="layout-cell layout-cell-size4"><p>Column 4</p></div></div></div>&nbsp;' );
						} }
					]
			});
		}
	});
	tinymce.PluginManager.add('wptc_shortcodes', tinymce.plugins.WPTCShortcodesPlugin);
})();
