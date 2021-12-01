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
 * Main class for block_cwdeletion.
 *
 * @package    block_cwdeletion
 * @copyright  2021 University of Chichester {@link http://www.chi.ac.uk}
 * @author     Hugo Soares <h.soares@chi.ac.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
*/

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/admin/tool/coursewrangler/locallib.php');

class block_cwdeletion extends block_base {

    /**
     * Initialize the plugin.
     */
    public function init() {
        $this->title = get_string('blocktitle', 'block_cwdeletion');
    }

    /**
     * Fetch html content for the block for those with permissions.
     *
     * @return stdClass
     */
    public function get_content() {
        global $COURSE, $OUTPUT, $USER;
        $issiteadmin = is_siteadmin($USER->id);
        if ($this->content !== NULL) {
            return $this->content;
        }
        $coursecontext = context_course::instance($COURSE->id);
        if (!has_capability('block/cwdeletion:view', $coursecontext)) {
            return $this->content;
        }

        $status = \tool_coursewrangler\get_course_action_status($COURSE->id) ?? 'Not set.';

        if (!isset($status->action) || ($status->action != 'delete' && $status->action != 'protect')) {
            $showmanage =
                    get_config('block_cwdeletion', 'showmanageoption') ?? false;
            if ($issiteadmin && $showmanage) {
                $linksarray = [];
                $linksarray['linkreportdetails'] = new moodle_url(
                        '/admin/tool/coursewrangler/report_details.php',
                        ['courseid' => $COURSE->id]
                    );
                $linksarray['linkreporttable'] = new moodle_url(
                        '/admin/tool/coursewrangler/table.php'
                    );
                $this->content->text =
                    $OUTPUT->render_from_template(
                        'block_cwdeletion/manage',
                        $linksarray
                    );
            }
            return $this->content;
        }

        $this->content = new stdClass();
        $this->content->footer = 'Last Updated: ' . userdate($status->lastupdated);

        switch ($status->action) {
            case 'delete':
                echo 'tf';
                // Showdelete prevents non site admins from seeing this.
                $showdelete =
                    get_config('block_cwdeletion', 'deleteshowonlysiteadmins') ?? false;
                if ($showdelete && !$issiteadmin) {
                    // return $this->content;
                }
                $mustarray = [];
                $mustarray['status'] = get_string(
                    "report_details_actionstatus_$status->status",
                    'tool_coursewrangler'
                );
                if ($issiteadmin) {
                    $mustarray['link'] = new moodle_url(
                        '/admin/tool/coursewrangler/report_details.php',
                        ['courseid' => $COURSE->id]
                    );
                }
                $this->content->text =
                    $OUTPUT->render_from_template(
                        'block_cwdeletion/delete',
                        $mustarray
                    );
                break;
            case 'protect':
                // Showprotect prevents non site admins from seeing this.
                $showprotect =
                    get_config('block_cwdeletion', 'protectshowonlysiteadmins') ?? false;
                if ($showprotect && !$issiteadmin) {
                    return $this->content;
                }
                $this->content->text =
                    $OUTPUT->render_from_template(
                        'block_cwdeletion/protect',
                        []
                    );
                break;
        }
        return $this->content;
    }

    /**
     * Tells Moodle there are some settings.
     *
     * @return boolean
     */
    public function has_config() {
        return true;
    }

    /**
     * Do any additional initialization you may need at the time a new block instance is created
     * @return boolean
     */
    function instance_create() {
        return true;
    }

    /**
     * Delete everything related to this instance if you have been using persistent storage other than the configdata field.
     * @return boolean
     */
    function instance_delete() {
        return true;
    }

    /**
     * Allows the block class to have a say in the user's ability to edit (i.e., configure) blocks of this type.
     * The framework has first say in whether this will be allowed (e.g., no editing allowed unless in edit mode)
     * but if the framework does allow it, the block can still decide to refuse.
     * @return boolean
     */
    function user_can_edit() {
        global $USER;

        if (has_capability('block/cwdeletion:manage', $this->context)) {
            return true;
        }

        // The blocks in My Moodle are a special case.  We want them to inherit from the user context.
        if (!empty($USER->id)
            && $this->instance->parentcontextid == $this->page->context->id   // Block belongs to this page
            && $this->page->context->contextlevel == CONTEXT_USER             // Page belongs to a user
            && $this->page->context->instanceid == $USER->id) {               // Page belongs to this user
            return has_capability('block/cwdeletion:manage', $this->page->context);
        }

        return false;
    }

    /**
     * Where this plugin can be added.
     *
     * @return array of pagetypes
     */
    public function applicable_formats() {
        return ['course-view' => true];
    }
}