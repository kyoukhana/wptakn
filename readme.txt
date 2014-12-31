= JPhotolio =

* by Jegtheme, http://jegtheme.com/forum

== Changelog ==

= 1.0.0 =
Init Themes

= 1.1.0 =
- fix major bug on javascript
- fix recreate thumb when processing masonry image 

= 1.1.1 = 
- fix inverted position of twitter & facebook
- fix javascript error when usage of slide curtain

= 1.1.2 =
- fix reported warning on portfolio single page when no category created

= 1.1.4 =
- fix multisite image not found bug
- add built in flickr sidebar widget
- provide link for download portfolio item, usefull for let client download their item
- portfolio shortcode & shortcode button to show portfolio image list on blog / page 
	just like how normal gallery does
- add option to disable right click
- fix versioning bug

= 1.1.5 =
- fix missing widget.php

= 1.1.6 =
- add zoom option when only 1 contact available
- change image processing to Aqua Resizer
- enable croping option for aqua resizer

= 1.1.7 =
- add font uploader feature (using font face)

= 1.1.8 =
- integration with WPML

= 1.1.9 =
- fix font bug when style manager used
- fix admin upload file bug on webkit
- add upload support for SVN & WOFF font file

= 1.2.0 =
- add feature to show facebook / twitter sharer on portfolio item
- add feature to show footer message
- update documentation

= 1.2.1 =
- comment on blog to use built in translation
- add option to choose if full blog content able to show on blog listing

= 1.2.2 =
- *NEW FEATURE* music playlist
- fix search bug
- make phone as optional option (location data)
- fix bug for front page sequence on admin
- option for slide transition, zoomed transition, and expanded transition
- (shared by www.diamondphotography.org.uk ) page template for framed content

= 1.2.3 =
- Fix youtube bug on front slider
- Add new feature (Linked Portfolio)

= 1.2.4 = 
- Add wmpl config in root folder
- fix wording on link metabox
- fix error on style option
- fix error when front slider not exist

= 1.2.5 =
- *NEW FEATURE* Image Gallery Template
- add new option for showing full image portfolio instead for croped one, so portfolio now able to show potrait image perfectly.
- add light icon for headphone music
- update google font, now its have 531 google font + all variant
- option to hide information box from front slider page
- add option to show location list first instead of contact form on contact page.
- fix bug deleted arrange slider that cause fatal error 

= 1.2.6 =
- fix bug on metabox, and chage checkbox to fancy iphone switch button
- add option not to crop image on front slider
- fix bug on croped image function
- don't show phone icon when phone on contact address is empty

 = 1.2.7 =
 - move option for portfolio filter to page instead of global option
 - move css & javascript enqueu to function instead of attach it on header.php
 
= 1.2.8 =
- add ablity to hide description
- show direction when user not included image on portfolio gallery
- fix bug when inserting image gallery on portfolio.
- fix several wrong translation
- add documentation for image gallery
- add option for changing footer line color.  

= 1.2.9 =
- give ability to support multi accordion on page & multi tab on a page.
- hot fix for translation error

= 1.3.0 =
- option for disable music completely on Internet Explorer
- fix overflow bug when title longer than container on the blog post
- change title to H1 on the blog post for better SEO
- fix notice on comment box
- open social on new tab instead replace current tab
- add option to add additional javascript file
- add option to enable direction navigation and disable control navigation

= 1.3.1 =
- add flickr & 500px for social icon
- add option to stop music on Blog post & Default page template (single page)

= 1.3.2 =
- implement arrow navigation on single portfolio
- fix bug on filtering portfolio when character used is not UTF 8
- fix login as lang lang on comments
- Add alt on logo
- fix several translation miscmatch & not translated
- add new facebook widget for sidebar
- add callback for override default comment functionlity on comment template
- fix url error reported by morilla rafa
- add rss icon suggested by enrico

= 2.0.0 =
- new implementation for setting up portfolio image gallery
- fix some error on google infobox
- fix several translation error
- update google analytic code
- add option to use default gallery implementation instead of using themes specific implementation for gallery
- fix image slider inside tabbed content if more than one tab available
- fix facebook to share on portfolio, now it will pointing to portfolio item instead of portfolio page.
- add pinterst & google share
- redue load time by removing unusable javascript when its not being used for google map and social share

= 2.0.1 =
- fix lost gallery for single portfolio when using new implementation of portfolio image gallery
- add option for background color of croped image on portfolio
- also add social sharing on porfolio expanded mode.

= 2.0.2 =
- apply new implementation from managing portfolio gallery to image gallery page type
- fix error found when switching from new portfolio & image gallery implementation for adding image 
- fix some bug not translateable text for comment
- fix cropping issues 

= 2.0.3 =
- quick fix for upgrading issues from version 1.x on portfolio & image gallery page type

= 3.0.0 =
- remove implementation of resparser and use basic usage of ajax. this will reduce load time for curtain effect by twice
- Fix random load error when try to accessing google map
- add new feature on portfolio, before and after image
- add new option for changing contact background using image instead of map
- add icon for instagram and light icon for flickr, 500px & rss
- fix comment number count translation

= 4.0.0 = 
- new option for put logo & menu on side instead of center
- fix category show as number on portfolio link type
- add implementation of new portfolio gallery on portfolio shortcode
- removing appended chunk on ajax request. so ajax response on portfolio will be faster
- update flexslider into version 2.1 and add lazy load feature for flexslide so now buyers can have unlimited number of image inside portfolio
- fill background & centered image when image is smaller than container
- implement portfolio load more so now buyers can have unlimited number of portfolio
- fix portfolio animation bug
- add option for enabling smpt debug, so it will be easier to analyze what happen on if email is not able to send
- add option for image gallery paging, image will loaded partially, so if user have many image, it will load fine
- fix image gallery animation bug 
- Opt out before & image feature from portfolio
- add sitemap template so ajax portfolio able to be crawled
- give border on portfolio arrow, so when image is white, it still able to show
- add option to show image description / title when portfolio expanded
- add option to set menu bar smaller
- new Black version of Jphotolio
- force youtube to play on HD display for front slider

= 4.1.0 = 
- Fix single image bug in portfolio
- Fix single portfolio page unable to load image for second request
- Add new option for changing font on Front Slider
- Reduce width of music player
- Fix random sequence error when zoom image on Portfolio 

= 4.2.0 =
- Hot Fix for title & language bug

= 4.3.0 =
- Search feature will only search for blog
- Add Prev & Next Portfolio bubble, so visitor will not confuse with image navigator
- fix left sidebar on resolution 768
- add feature for Next and Previous Blog item
- Fix Theather mode on IPhone
- Add image description on Single Portfolio page
- add option to switch from photoswipe to lightbox for page or blog

= 4.5.0 =
- fix filtering problem on chrome
- fix bug when using WPML
- font face now able to upload all font (EOT, WOFF, TTF, SVG)
- compatibility with wordpres 3.6
- give one more place to put mobile menu
- use get_template_part so themes can be compatible with child themes
- remove #! and use # instead to fix security problem on several hosting with IE

= 4.5.4 =
- give title on twitter sharing
- fix Pinterest sharing bug on portfolio theater mode 
- give og:image meta tag for facebook share image
- fix to use another method to fix facebook cropped share

= 4.5.5 =
- hide admin top bar on front page
- fix compatibility issues with version 3.9