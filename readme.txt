=== Upside Down Text ===
Contributors: pulegium
Donate link: http://www.grenadepod.com/projects/upside-down-text-plugin-for-wordpress/
Tags: post, text, convert, upsidedown, reverse, mirror, plugin, filter, unicode
Requires at least: 2.0.0
Tested up to: 2.8.6
Stable tag: 1.1.0

This plugin introduces new tag and shortcode that turns any text between the tags upside down. This is achieved using unicode characters.

== Description ==

This plugin introduces new tag to use in our WordPress documents: &lt;upsidedown&gt;. Any text placed within this tag will be turned 180 degrees and will appear as if it has been turned upside down. It will read just fine, but from right to left. Alternatively, you can turn your monitor upside down and read it.

Version 1.1.0 implements a shortode - [upsidedown], which has exactly the same functionality as the tag does, but is also Visual editor safe. Shortcodes are treated as regular text so can safely be used in both HTML and Visual editors and switching between them will not break anything. <strong>Using shortcodes is prefered way of applying modifications to the text.</strong> Support for tags is still there, but will be depreciated soon.

You might have noticed when quite a few blogs use strokes as if to delete what's been written earlier. Do this no more - it's a thing of the past. Let's set a new trend by turning the text you want to 'hide' upside down.

This looks particularly good when you have a small paragraph reversed. Could be used to type in some nasty details in otherwise 'proper' post.

Also if your post raises some question you could use this to provide the answers, but turned upside down.

This does not involve any image manipulation and achieved by replacing characters with corresponding Unicode characters that look like a mirror image of the 'normal' symbols.

Please note that ALL characters within these tags will be converted, so you will loose any other HTML tags. Also please note that switching between visual and HTML editor will remove &lt;upsidedown&gt; tags (text in between will not be lost though). So create your post, save it, switch to HTML editor, add tags where necessary, save and publish without switching back to visual editor.

== Installation ==

1. Upload and unpack upside-down-text.zip to `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Enclose any text in your posts with <upsidedown> tags to display it upside down.

== Frequently Asked Questions ==

= Can I use formatting HTML tags within tags? =

No, all formatting text will be lost. You can use formatting outside, in which case your flipped text will appear with formatting applied to it.

= Why some symbols are not displayed correctly? =

Well, that's a question to browser developers, I think. Unicode character support is bit flakey in some of them, and not all characters are rendered properly. It also seems to be position and neighbouring characters related too. So far I've noticed issues with letter 'p', so just try to rephrase your sentences and experiment to get the best result.

== Screenshots ==

1. Text as it appears turned upside-down
2. Using shortcodes in visual editor

== Changelog ==

= 1.1.0 =

* Introducing shortcode [upsidedown]

= 1.0.0 =

* Initial version
