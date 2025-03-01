<?php
/**
 * Defines the steps to backup the whatsappmb activity.
 *
 * @package   mod_whatsappmb
 * @copyright 2025 Marcial Cahuaya | Marbot
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Class to define the steps for backing up the whatsappmb activity.
 */
class backup_whatsappmb_activity_structure_step extends backup_activity_structure_step {

    protected function define_structure() {
        // Define the structure of the backup.
        $whatsappmb = new backup_nested_element('whatsappmb', array('id'), array(
            'course', 'name', 'intro', 'introformat', 'linktype', 'whatsappnumber', 'message', 'grouplink', 'timecreated', 'timemodified'
        ));

        // Define the source table for the backup.
        $whatsappmb->set_source_table('whatsappmb', array('id' => backup::VAR_ACTIVITYID));

        // Annotate files (if any) associated with the activity.
        $whatsappmb->annotate_files('mod_whatsappmb', 'intro', null);

        // Return the structure wrapped in the activity element.
        return $this->prepare_activity_structure($whatsappmb);
    }
}