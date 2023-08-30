# AgriFlex 2 WordPress Theme

Custom theme created for the Texas A&M AgriLife network.

__Author__: Texas A&M AgriLife Communications

__Version__: v2.3.11

## Theme Requirements

* [Advanced Custom Fields]: http://www.advancedcustomfields.com
* [Soliloquy]: http://soliloquywp.com


## Change Log
### v2.3.11

- Bump version to 2.3.11 [skip ci]


### 2.3.7

- Fix logo rendering in the header
- Got 4H footer working again
- Added label to search field for accessibility

### 2.3.6

- Added push capabilities to agrlife, txmg & txmn installs

### 2.3.5

- Added space before 'County' in site header
- Combined Dallam & Hartley counties

### 2.3.4

- Fix slideshow conflict with The Events Calendar

### 2.3.3

- Updated PV logo for TCE theme option
- Enabled TCE logo when option is selected
- Saving county info footer as transient to decrease API load

### 2.3.2

- Fixed JS in theme options
- Simplified filter to check for multiple agencies in theme options
- Fixed extension options showing after save when multiple agencies selected
- Fixed some Gravity Forms layout issues

### 2.3.1

- Fixed compatibility mode issue with menus
- Removed double underlines on home default blog list
- 'Read more' button visual fix
- Homepage Templates Loop Failure fixed
- Added basic 'The Event Calendar' Styles for widgets
- Added default for agriflex_front_page_content

### 2.3

- Fixed custom agency image not displaying
- Fixed Home: Featured Pages template
- Added a network admin-only UA code for Google Analytics
- Placed favicon call in action hook
- Added CSS for The Events Calendar
- Added TFS logo back into list of agency options

### 2.2.7

- Added option to make additional agency logo link to a site.

### 2.2.6

- Fixed search form action and results template

### 2.2.5

- Fixed feedburner RSS functionality

### 2.2.4

- Removed the college 'Explore' menu and button. The menu was no longer relevant with the new COALS site.

### 2.2.3

- Changed all calls to template directory to `get_template_directory_uri()` to allow for HTTPS
- Properly enqueuing lt IE9 stylesheet

### 2.2.2

- Removed the social media widget. It now lives in a plugin [here][4]
- Fixed the State Link Policy link in footer

### 2.2.1

- Fixed YouTube embeds in the Read, Watch, Listen widget for Firefox
- Removed google map functionality in the footer. Replaced map with some icons.

### 2.2

- Fixed issue where site title/logo would link to the base site in multisite.
- Fixed featured post checkbox saving on post and page edit screends.
- Now saves the map images as base64 encoded transient in the database.
- Map transient is reset when theme options are saved.

### 2.1.1

- Removed styles related to the staff custom post type
- Updated version number in style.css to clarify the information on the backend.

### 2.1

- Added some classes and ID's to accommodate off-canvas child themes more easily.
- Improved the .gitignore
- Moved flexslider & fitvids JS to properly enqueue.


### 2.0

- Complete code re-organization
- Added hooks and filters throughout! See: [AgriFlex Wiki][3]
- Theme options re-written to use [Options Framework][1]
- Theme options moved to 'Appearance' >> 'Theme Options'
- Now with fewer globals!
- Moved Staff custom post type to plugin
- Moved Jobs custom post type to plugin
- Removed TVMDL Tests custom post type
- County staff listing now used PHP-native SOAP
- Makes proper use of [post formats][2]
- Gave included widgets a good scrubbing
- Advanced cruft removal

### 1.x

- Not really sure. Dragons, maybe?


[1]:https://github.com/devinsays/options-framework-theme
[2]:http://codex.wordpress.org/Post_Formats
[3]:https://github.com/AgriLife/AgriFlex/wiki
[4]:https://github.com/AgriLife/AgriLife-Social-MediaLatest Version: 1.0.13
Latest Version: v2.3.10
Latest Commit: Bump version to 2.3.10 [skip ci]
