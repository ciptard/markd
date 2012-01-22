<?php

// Paths and URL's should not have trailing slashes

date_default_timezone_set('America/New_York');										// Timezone
define('POSTS_PATH', '/path/to/your/markdown/posts');                               // Path to where your MarkDown posts are at
define('PUBLISHED_PATH', '/path/to/where/you/want/the/site/published');             // Path to where generated files should be placed
define('THEMES_PATH', '/path/to/themes');                                           // Path to themes
define('PLUGINS_PATH', '/path/to/plugins');                                         // Path to plugins
define('POSTS_PER_PAGE', 10);                                                       // Number of posts per page for post listing pages
define('MARKD_DEBUG', FALSE);                                                       // Can be used to turn on debug notices during generation
                                                                                    
define('SITE_TITLE', '');                                                           // Title for site
define('SITE_URL', '');                                                             // URL the generated site will sit at
define('SITE_DESC', '');                                                            // (Optional) Description/tagline for site
                                                                                    
define('ACTIVE_THEME', '/default');                                                 // Folder name of the active theme