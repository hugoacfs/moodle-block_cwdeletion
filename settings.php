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
 * Settings file.
 *
 * @package    block_cwdeletion
 * @copyright  2021 University of Chichester {@link http://www.chi.ac.uk}
 * @author     Hugo Soares <h.soares@chi.ac.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
*/

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    // This is only useful for other plugins, we use it in local_chi to override stuff.
    $settings->add(new admin_setting_configcheckbox('block_cwdeletion/showinallcourses',
        get_string('settings_showinallcourses', 'block_cwdeletion'),
        get_string('settings_showinallcourses_desc', 'block_cwdeletion'), 0));
}