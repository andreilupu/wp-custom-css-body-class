=== Custom Body Class ===
Contributors: euthelup
Tags: custom, body, css, class
Requires at least: 5.2.0
Tested up to: 6.8.2
Stable tag: 0.7.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A plain simple plugin which allows you to add a custom CSS class the HTML body tag.

== Description ==

You can use this plugin to add a unique CSS class to your pages or posts.

= Demo =

[TasteWP](https://tastewp.com/) has prepared a quick WordPress instance with this plugin, so you can give it a try [in this demo](https://demo.tastewp.com/wp-custom-body-class)

= Responsiveness =
There's a way to add a class to appear only on mobile devices. You can do that by simply adding `mobile-` on the front of
the class. For example, if you want to have the class "car" for mobile side, you need to use "mobile-car".

= Support me =

If you find this plugin helpful, or you just want to send me a coffee here are the ways:

* Use the Github Sponsor button
* [Ko-fi](https://ko-fi.com/thelup)
* Watch me coding on [twitch.tv/thelup](https://www.twitch.tv/thelup/)
* Or simply visit my site [lup.dev](https://a.lup.dev/) and make those analytics ring the bells.

== Installation ==

1. Install Custom Body Class either via the WordPress.org plugin directory, or by uploading the files to your `/wp-content/plugins/` directory
2. After activating Custom Body Class go to any edit page and see the Custom Body Class metabox in the right sidebar.

== Changelog ==

= 0.7.5 =
* Fix: Fixed a notice about textdomain loaded too early.
* Update: Check compatibility with WordPress 6.8.2 and PHP 8.3.*

= 0.7.4 =
* Update: Check compatibility with WordPress 6.7.1 and PHP 8.2.*

= 0.7.3 =
* Update: Check compatibility with 6.0.0.

= 0.7.2 =
* Fix: Properly instantiate plugin default settings.

= 0.7.1 =
* Update: Check for nonce existence on settings page form.

= 0.7.0 =
* Update: Better escapes for the plugin's settings page.
* Update: Modified textdomain as the plugin's name.
* Add: Nonce verification for the plugin's settings page.

= 0.6.0 =
* Fix: Now the metabox will load even if the Autocomplete feature is off.
* Add: The capability to restrict the metabox for Administrators only.

= 0.5.0 =
* Add an option for a global class

= 0.4.0 =
* Add support for classes on mobile devices

= 0.3.0 =
* Add a tag selector with autocomplete for all post types

= 0.0.3 =
* Quick archives fix

= 0.0.2 =
* Small fixes, and typos

= 0.0.1 =
* We are on
