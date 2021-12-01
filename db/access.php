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
 * Permissions file.
 *
 * @package    block_cwdeletion
 * @copyright  2021 University of Chichester {@link http://www.chi.ac.uk}
 * @author     Hugo Soares <h.soares@chi.ac.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
*/

defined('MOODLE_INTERNAL') || die();

$capabilities = [
    'block/cwdeletion:view' => [
        'captype'              => 'read',
        'contextlevel'         => CONTEXT_BLOCK,
        'archetypes'           => [
            'editingteacher'   => CAP_ALLOW,
            'manager'          => CAP_ALLOW,
            'student'          => CAP_PROHIBIT
            ]
        ],

    'block/cwdeletion:addinstance' => [
        'captype'              => 'read',
        'contextlevel'         => CONTEXT_BLOCK,
        'archetypes'           => [
            'editingteacher'  => CAP_PROHIBIT,
            'manager'         => CAP_PROHIBIT
        ],
        'clonepermissionsfrom' => 'moodle/site:manageblocks'
    ],

    'block/cwdeletion:manage' => [
        'captype'              => 'write',
        'contextlevel'         => CONTEXT_BLOCK,
        'archetypes'           => [
            'editingteacher'  => CAP_PROHIBIT,
            'manager'         => CAP_PROHIBIT,
            'student'          => CAP_PROHIBIT
            ]
        ]
];