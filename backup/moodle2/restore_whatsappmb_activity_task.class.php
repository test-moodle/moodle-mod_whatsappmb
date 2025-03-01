<?php
/**
 * Defines the restore task for the whatsappmb activity.
 *
 * @package   mod_whatsappmb
 * @copyright 2025 Marcial Cahuaya
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/mod/whatsappmb/backup/moodle2/restore_whatsappmb_stepslib.php');

/**
 * Class to define the restore task for the whatsappmb activity.
 */
class restore_whatsappmb_activity_task extends restore_activity_task {

    /**
     * Defines the settings for the restore task.
     */
    protected function define_my_settings() {
        // No specific settings are required for this activity.
    }

    /**
     * Defines the steps for the restore task.
     */
    protected function define_my_steps() {
        // Define the step to restore the activity.
        $this->add_step(new restore_whatsappmb_activity_structure_step('whatsappmb_structure', 'whatsappmb.xml'));
    }

    /**
     * Define the contents in the activity that must be
     * processed by the link decoder.
     */
    public static function define_decode_contents() {
        $contents = array();
        $contents[] = new restore_decode_content('whatsappmb', array('intro'), 'whatsappmb');
        return $contents;
    }

    /**
     * Define the decoding rules for links belonging
     * to the activity to be executed by the link decoder.
     */
    public static function define_decode_rules() {
        $rules = array();

        $rules[] = new restore_decode_rule('WHATSAPPMBVIEWBYID', '/mod/whatsappmb/view.php?id=$1', 'course_module');
        $rules[] = new restore_decode_rule('WHATSAPPMBINDEX', '/mod/whatsappmb/index.php?id=$1', 'course');

        return $rules;
    }

    /**
     * Define the restore log rules that will be applied
     * by the restore_logs_processor when restoring logs.
     */
    public static function define_restore_log_rules() {
        $rules = array();

        $rules[] = new restore_log_rule('whatsappmb', 'add', 'view.php?id={course_module}', '{whatsappmb}');
        $rules[] = new restore_log_rule('whatsappmb', 'update', 'view.php?id={course_module}', '{whatsappmb}');
        $rules[] = new restore_log_rule('whatsappmb', 'view', 'view.php?id={course_module}', '{whatsappmb}');

        return $rules;
    }

    /**
     * Define the restore log rules that will be applied
     * by the restore_logs_processor when restoring
     * course logs.
     */
    public static function define_restore_log_rules_for_course() {
        $rules = array();

        $rules[] = new restore_log_rule('whatsappmb', 'view all', 'index.php?id={course}', null);

        return $rules;
    }
}
