(function(){
    var ICONS = ["adjust", "adn", "align-center", "align-justify", "align-left", "align-right", "ambulance", "anchor", "android", "angellist", "angle-double-down", "angle-double-left", "angle-double-right", "angle-double-up", "angle-down", "angle-left", "angle-right", "angle-up", "apple", "archive", "area-chart", "arrow-circle-down", "arrow-circle-left", "arrow-circle-o-down", "arrow-circle-o-left", "arrow-circle-o-right", "arrow-circle-o-up", "arrow-circle-right", "arrow-circle-up", "arrow-down", "arrow-left", "arrow-right", "arrow-up", "arrows", "arrows-alt", "arrows-h", "arrows-v", "asterisk", "at", "automobilealias", "backward", "ban", "bankalias", "bar-chart", "bar-chart-oalias", "barcode", "bars", "beer", "behance", "behance-square", "bell", "bell-o", "bell-slash", "bell-slash-o", "bicycle", "binoculars", "birthday-cake", "bitbucket", "bitbucket-square", "bitcoinalias", "bold", "bolt", "bomb", "book", "bookmark", "bookmark-o", "briefcase", "btc", "bug", "building", "building-o", "bullhorn", "bullseye", "bus", "cabalias", "calculator", "calendar", "calendar-o", "camera", "camera-retro", "car", "caret-down", "caret-left", "caret-right", "caret-square-o-down", "caret-square-o-left", "caret-square-o-right", "caret-square-o-up", "caret-up", "cc", "cc-amex", "cc-discover", "cc-mastercard", "cc-paypal", "cc-stripe", "cc-visa", "certificate", "chainalias", "chain-broken", "check", "check-circle", "check-circle-o", "check-square", "check-square-o", "chevron-circle-down", "chevron-circle-left", "chevron-circle-right", "chevron-circle-up", "chevron-down", "chevron-left", "chevron-right", "chevron-up", "child", "circle", "circle-o", "circle-o-notch", "circle-thin", "clipboard", "clock-o", "closealias", "cloud", "cloud-download", "cloud-upload", "cnyalias", "code", "code-fork", "codepen", "coffee", "cog", "cogs", "columns", "comment", "comment-o", "comments", "comments-o", "compass", "compress", "copyalias", "copyright", "credit-card", "crop", "crosshairs", "css3", "cube", "cubes", "cutalias", "cutlery", "dashboardalias", "database", "dedentalias", "delicious", "desktop", "deviantart", "digg", "dollaralias", "dot-circle-o", "download", "dribbble", "dropbox", "drupal", "editalias", "eject", "ellipsis-h", "ellipsis-v", "empire", "envelope", "envelope-o", "envelope-square", "eraser", "eur", "euroalias", "exchange", "exclamation", "exclamation-circle", "exclamation-triangle", "expand", "external-link", "external-link-square", "eye", "eye-slash", "eyedropper", "facebook", "facebook-square", "fast-backward", "fast-forward", "fax", "female", "fighter-jet", "file", "file-archive-o", "file-audio-o", "file-code-o", "file-excel-o", "file-image-o", "file-movie-oalias", "file-o", "file-pdf-o", "file-photo-oalias", "file-picture-oalias", "file-powerpoint-o", "file-sound-oalias", "file-text", "file-text-o", "file-video-o", "file-word-o", "file-zip-oalias", "files-o", "film", "filter", "fire", "fire-extinguisher", "flag", "flag-checkered", "flag-o", "flashalias", "flask", "flickr", "floppy-o", "folder", "folder-o", "folder-open", "folder-open-o", "font", "forward", "foursquare", "frown-o", "futbol-o", "gamepad", "gavel", "gbp", "gealias", "gearalias", "gearsalias", "gift", "git", "git-square", "github", "github-alt", "github-square", "gittip", "glass", "globe", "google", "google-plus", "google-plus-square", "google-wallet", "graduation-cap", "groupalias", "h-square", "hacker-news", "hand-o-down", "hand-o-left", "hand-o-right", "hand-o-up", "hdd-o", "header", "headphones", "heart", "heart-o", "history", "home", "hospital-o", "html5", "ils", "imagealias", "inbox", "indent", "info", "info-circle", "inr", "instagram", "institutionalias", "ioxhost", "italic", "joomla", "jpy", "jsfiddle", "key", "keyboard-o", "krw", "language", "laptop", "lastfm", "lastfm-square", "leaf", "legalalias", "lemon-o", "level-down", "level-up", "life-bouyalias", "life-buoyalias", "life-ring", "life-saveralias", "lightbulb-o", "line-chart", "link", "linkedin", "linkedin-square", "linux", "list", "list-alt", "list-ol", "list-ul", "location-arrow", "lock", "long-arrow-down", "long-arrow-left", "long-arrow-right", "long-arrow-up", "magic", "magnet", "mail-forwardalias", "mail-replyalias", "mail-reply-allalias", "male", "map-marker", "maxcdn", "meanpath", "medkit", "meh-o", "microphone", "microphone-slash", "minus", "minus-circle", "minus-square", "minus-square-o", "mobile", "mobile-phonealias", "money", "moon-o", "mortar-boardalias", "music", "naviconalias", "newspaper-o", "openid", "outdent", "pagelines", "paint-brush", "paper-plane", "paper-plane-o", "paperclip", "paragraph", "pastealias", "pause", "paw", "paypal", "pencil", "pencil-square", "pencil-square-o", "phone", "phone-square", "photoalias", "picture-o", "pie-chart", "pied-piper", "pied-piper-alt", "pinterest", "pinterest-square", "plane", "play", "play-circle", "play-circle-o", "plug", "plus", "plus-circle", "plus-square", "plus-square-o", "power-off", "print", "puzzle-piece", "qq", "qrcode", "question", "question-circle", "quote-left", "quote-right", "raalias", "random", "rebel", "recycle", "reddit", "reddit-square", "refresh", "removealias", "renren", "reorderalias", "repeat", "reply", "reply-all", "retweet", "rmbalias", "road", "rocket", "rotate-leftalias", "rotate-rightalias", "roublealias", "rss", "rss-square", "rub", "rublealias", "rupeealias", "savealias", "scissors", "search", "search-minus", "search-plus", "sendalias", "send-oalias", "share", "share-alt", "share-alt-square", "share-square", "share-square-o", "shekelalias", "sheqelalias", "shield", "shopping-cart", "sign-in", "sign-out", "signal", "sitemap", "skype", "slack", "sliders", "slideshare", "smile-o", "soccer-ball-oalias", "sort", "sort-alpha-asc", "sort-alpha-desc", "sort-amount-asc", "sort-amount-desc", "sort-asc", "sort-desc", "sort-downalias", "sort-numeric-asc", "sort-numeric-desc", "sort-upalias", "soundcloud", "space-shuttle", "spinner", "spoon", "spotify", "square", "square-o", "stack-exchange", "stack-overflow", "star", "star-half", "star-half-emptyalias", "star-half-fullalias", "star-half-o", "star-o", "steam", "steam-square", "step-backward", "step-forward", "stethoscope", "stop", "strikethrough", "stumbleupon", "stumbleupon-circle", "subscript", "suitcase", "sun-o", "superscript", "supportalias", "table", "tablet", "tachometer", "tag", "tags", "tasks", "taxi", "tencent-weibo", "terminal", "text-height", "text-width", "th", "th-large", "th-list", "thumb-tack", "thumbs-down", "thumbs-o-down", "thumbs-o-up", "thumbs-up", "ticket", "times", "times-circle", "times-circle-o", "tint", "toggle-downalias", "toggle-leftalias", "toggle-off", "toggle-on", "toggle-rightalias", "toggle-upalias", "trash", "trash-o", "tree", "trello", "trophy", "truck", "try", "tty", "tumblr", "tumblr-square", "turkish-liraalias", "twitch", "twitter", "twitter-square", "umbrella", "underline", "undo", "university", "unlinkalias", "unlock", "unlock-alt", "unsortedalias", "upload", "usd", "user", "user-md", "users", "video-camera", "vimeo-square", "vine", "vk", "volume-down", "volume-off", "volume-up", "warningalias", "wechatalias", "weibo", "weixin", "wheelchair", "wifi", "windows", "wonalias", "wordpress", "wrench", "xing", "xing-square", "yahoo", "yelp", "yenalias", "youtube", "youtube-play", "youtube-square"];
	var icon = function(id) {
		return '<i class="fa fa-' + id + '">&nbsp;</i>';
	}
	tinymce.create('tinymce.plugins.TuxFontAwesomePlugin', {
		init: function(ed, url) {
                        var iconvalsoc = [];
                        var iconvals = [];
			for (var i = 0; i < ICONS.length; i++) {
				iconvalsoc.push({
				    text: ICONS[i],
				    onclick: function() { tinymce.activeEditor.selection.setContent(icon(this.text())); }
				});
                                iconvals.push({
                                    text: ICONS[i],
                                    value: ICONS[i]
                                });
			}
			ed.addButton('wptcFAButton', {
                                type: 'splitbutton',
				title: 'Font Awesome',
				image: url + '/fontawesome.gif',
                                menu: iconvalsoc,
                                onclick: function() {
                                    // Open window
                                    ed.windowManager.open({
                                        title: 'Font Awesome',
                                        width: 400,
                                        height: 300,
                                        body: [
                                            {type: 'listbox', name: 'faicon', label: 'Icon', values: iconvals },
                                            {type: 'listbox', name: 'falarger', label: 'Larger', values: [{text: 'none', value: ''},{text: '33% increase', value: ' fa-lg'},{text: '2x', value: ' fa-2x'},{text: '3x', value: ' fa-3x'},{text: '4x', value: ' fa-4x'},{text: '5x', value: ' fa-5x'}] },
                                            {type: 'listbox', name: 'farotflip', label: 'Rotate/Flip', values: [{text: 'none', value: ''},{text: 'Rotate 90', value: ' fa-rotate-90'},{text: 'Rotate 180', value: ' fa-rotate-180'},{text: 'Rotate 270', value: ' fa-rotate-270'},{text: 'Flip Horizontal', value: ' fa-flip-horizontal'},{text: 'Flip Vertical', value: ' fa-flip-vertical'}] },
                                            {type: 'listbox', name: 'fapull', label: 'Pull', values: [{text: 'none', value: ''},{text: 'Left', value: ' pull-left'},{text: 'Right', value: ' pull-right'}] },
                                            {type: 'checkbox', name: 'fabordered', label: 'Bordered', value: 'false'},
                                            {type: 'checkbox', name: 'faspin', label: 'Spin', value: 'false'},
                                            {type: 'checkbox', name: 'fafixedwidth', label: 'Fixed Width', value: 'false'},
                                            {type: 'checkbox', name: 'fashortcode', label: 'Insert as Shortcode', value: 'false'},
                                        ],
                                        onsubmit: function(e) {
                                            // Insert content when the window form is submitted
                                            var fafw = '';
                                            var faborder = '';
                                            var faspin = '';
                                            if (e.data.fafixedwidth) { fafw = ' fa-fw'; }
                                            if (e.data.fabordered) { faborder = ' fa-border'; }
                                            if (e.data.faspin) { faspin = ' fa-spin'; }
                                            if (e.data.fashortcode) {
                                                ed.insertContent('[wptc-icon name="' + e.data.faicon + e.data.falarger + fafw + e.data.fapull + faborder + faspin + e.data.farotflip + '"]');
                                            } else {
                                                ed.insertContent('<i class="fa fa-' + e.data.faicon + e.data.falarger + fafw + e.data.fapull + faborder + faspin + e.data.farotflip + '">&nbsp;</i>');
                                            }
                                        }
                                    });
                                }
			});
		}
	});
	tinymce.PluginManager.add('wptc_font_awesome', tinymce.plugins.TuxFontAwesomePlugin);
})();
