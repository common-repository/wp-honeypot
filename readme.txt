=== WP-HoneyPot ===
Contributors: secludedhabitat
Donate link: https://wiki.geekyhabitat.com/tiki-index.php?page=Donate
Tags: spam, project honeypot, BadBehavior, http:BL, blacklist, anti-spam
Requires at least: 2.0.11
Tested up to: 2.6.3
Stable tag: 1.0

Provides a simple means to integrate tools provided by Project Honeypot to capture spammers and link harvesters that visit your blog.

== Description ==

[Project HoneyPot](http://www.projecthoneypot.org/?rf=48756 "Project HoneyPot") is a platform which uses HoneyPot "traps" to catch spammers and
automated bots in the act of the processes they are performing.<br>

Other plugins such as BadBehavior provide the ability to use the Project HoneyPot http:BL (blacklist), however in order to use this you need to be a contributing member to the Project Honeypot project. This is where the idea for WP-HoneyPot came from.<br>

WP-HoneyPot enables you to add a hidden link on your blog in one of several randomised locations to ensure that spammers are less able to adapt to the solution and once you are a contributing member to Project HoneyPot then you are able to use the http:BL.<br>

Any bugs with this plugin should be reported on [BugZilla](https://bugzilla.geekyhabitat.com/ "Bugzilla").<BR>

**Please Note:** This plugin has now been extensively tested and released as Version 1.0. I have also tested for backwards compatibility all the way back to version 2.0.11 (but it should work with any 2.0 release).

== Installation ==

1. Sign up for an account on [Project HoneyPot.org](http://www.projecthoneypot.org/?rf=48756 "Project HoneyPot")
1. Generate either a HoneyPot (that you can host yourself) or a QuickLink through the Project Honeypot Site
1. Upload the plugin directory to the wp-content/plugins folder on your wordpress installation.
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Go to the Options Page, enter the link to your HoneyPot or QuickLink (that was provided in step 2 above)

== Frequently Asked Questions ==

= If I find a problem with this plugin how do I report it? = 

Pop on over to <a href="https://bugzilla.geekyhabitat.com/">GeekyHabitat BugZilla</a> and submit a bug for this plugin.

= If I would like to request an enhancement, can I do this? = 

I welcome any enhancement requests for this plugin. Please visit <a href="https://bugzilla.geekyhabitat.com/">GeekyHabitat BugZilla</a> and log an enhancement request for the plugin.

= How extensively do you test your plugins? = 

I try to perform as much testing as I can and have now tested this plugin on numerous versions of wordpress. See the [Release Testing](https://wiki.geekyhabitat.com/tiki-index.php?page=WP-HoneyPot-ReleaseTesting&structure=WP-HoneyPot "Release Testing") for complete details.

= Where can I find further information on this plugin? = 

You can get more information on this plugin at the <a href="https://wiki.geekyhabitat.com/tiki-index.php?page=WP-HoneyPot" target="_blank">GeekyHabitat Development Wiki - WP-HoneyPot</a>

== Change Log ==
Version 1.0:<br>
First Stable Release<br>
Resolved [Bug 2](https://bugzilla.geekyhabitat.com/show_bug.cgi?id=2) - Added notification to configure and enable plugin via WP-HoneyPot Settings Page<br>
Certified for Wordpress 2.6.3
<p>&nbsp;<p>
Version 0.11:<br>
Resolved [Bug 1](https://bugzilla.geekyhabitat.com/show_bug.cgi?id=1) - Outputting after the start_loop hook was causing issues with some templates. Plugging into this hook was removed.<br>
<p>&nbsp;<p>
Version 0.1:<br>
Initial Release