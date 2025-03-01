<?php
/**
 * Defines the backup task for the whatsappmb activity.
 *
 * @package   mod_whatsappmb
 * @copyright 2025 Marcial Cahuaya | Marbot
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/mod/whatsappmb/backup/moodle2/backup_whatsappmb_stepslib.php');

/**
 * Class to define the backup task for the whatsappmb activity.
 */
class backup_whatsappmb_activity_task extends backup_activity_task {

    /**
     * Defines the settings for the backup task.
     */
    protected function define_my_settings() {
        // No specific settings are required for this activity.
    }

    /**
     * Defines the steps for the backup task.
     */
    protected function define_my_steps() {
        // Define the step to backup the activity.
        $this->add_step(new backup_whatsappmb_activity_structure_step('whatsappmb_structure', 'whatsappmb.xml'));
    }

    /**
     * Encodes content links in the activity.
     *
     * @param string $content The content to encode.
     * @return string The encoded content.
     */
    static public function encode_content_links($content) {
        global $CFG;

        // Define the base URL for the activity.
        $base = preg_quote($CFG->wwwroot . '/mod/whatsappmb', '#');

        // Encode links to the view.php page.
        $pattern = "#(" . $base . "/view\.php\?id=)([0-9]+)#";
        $content = preg_replace($pattern, '$@WHATSMAPPVIEWBYID*$2@$', $content);

        // Encode links to the index.php page.
        $pattern = "#(" . $base . "/index\.php\?id=)([0-9]+)#";
        $content = preg_replace($pattern, '$@WHATSMAPPINDEX*$2@$', $content);

        return $content;
    }
}