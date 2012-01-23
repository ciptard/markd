#!/usr/bin/php -dmemory_limit=512M -dsafe_mode=Off
<?php
error_reporting(E_ALL ^ E_NOTICE);
/**
 *   Developer: Matt Walters
 *   Copyright (C) 2012 Matthew Walters
 *
 *    This program is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    This program is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *
 *    You should have received a copy of the GNU General Public License
 *    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 **/

define('MARKD_VERSION', 'v.1.0.1');

echo "
markd " . MARKD_VERSION . " Copyright (C) 2012 Matthew Walters

This program comes with ABSOLUTELY NO WARRANTY.
This is free software, and you are welcome to redistribute it under certain conditions.
See the file GPLv3.txt for these warranty details and distribution conditions.";

require_once('./config.php');
require_once(THEMES_PATH . '/' . ACTIVE_THEME . '/config.php');
require_once('./helpers.php');
require_once('./libraries/markdown/markdown.php');
require_once('./classes/Markd.php');
require_once('./classes/Filesystem.php');
require_once('./classes/Post.php');
require_once('./classes/Posts.php');
require_once('./classes/Feed.php');
require_once('./classes/Theme.php');

$msw = new Markd();