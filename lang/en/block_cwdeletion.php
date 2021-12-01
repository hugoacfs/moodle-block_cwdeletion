<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Language file, English.
 *
 * @package    block_mrdeclaration
 * @copyright  2021 University of Chichester {@link http://www.chi.ac.uk}
 * @author     Hugo Soares <h.soares@chi.ac.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
*/

defined('MOODLE_INTERNAL') || die();

// Plugin related strings.
$string['pluginname'] = 'CW Deletion';
$string['blocktitle'] = 'Deletion Status for this Course';

// Settings.
$string['settings_showinallcourses'] = 'Show in All Courses';
$string['settings_showinallcourses_desc'] = 'Show in all courses within Moodle.';

$string['settings_protectshowonlysiteadmins'] = 'Do Not Show \'Protect\'';
$string['settings_protectshowonlysiteadmins_desc'] = 'Shows the protect status to site admins only.';

$string['settings_deleteshowonlysiteadmins'] = 'Do Not Show \'Delete\'';
$string['settings_deleteshowonlysiteadmins_desc'] = 'Shows the delete status to site admins only.';

$string['settings_showmanageoption'] = 'Admins See \'Manage\'';
$string['settings_showmanageoption_desc'] = 'Show or hide the manage block from site admins.';

// Templates.
$string['template_courseprotected'] = 'This course/page is currently <b>protected</b> from automatic deletion.';
$string['template_coursedeletion'] = 'This course has been marked for deletion and is scheduled to be deleted soon.';
$string['template_warning'] = 'WARNING';
$string['template_currentstatus'] = 'Current Status';
$string['template_moreinfo'] = 'More Information';
$string['template_reportdetails'] = 'Course Report Details';
$string['template_coursewranglertable'] = 'Report Table';
$string['template_manageexplanation'] = 'Quick links to Course Wrangler tools. Be warned, the report details link might not work, depending if this course exists in the report data.';
$string['template_nostatus'] = 'This course has no status in Course Wrangler.';
