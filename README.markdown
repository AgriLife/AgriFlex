# AgriFlex 2 WordPress Theme

Custom theme created for the Texas A&M AgriLife network.

__Author__: Texas A&M AgriLife Communications

__Version__: 2.3

## Change Log

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
[4]:https://github.com/AgriLife/AgriLife-Social-Media