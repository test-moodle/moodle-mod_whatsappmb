<?php
/**
 * Privacy provider for the mod_whatsappmb plugin.
 *
 * @package   mod_whatsappmb
 * @copyright 2025 Marcial Cahuaya | Marbot
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_whatsappmb\privacy;

use core_privacy\local\metadata\collection;
use core_privacy\local\request\contextlist;
use core_privacy\local\request\approved_contextlist;
use core_privacy\local\request\writer;
use core_privacy\local\request\userlist;
use core_privacy\local\request\approved_userlist;

defined('MOODLE_INTERNAL') || die();

/**
 * Privacy provider class for the mod_whatsappmb plugin.
 */
class provider implements
    \core_privacy\local\metadata\provider,
    \core_privacy\local\request\plugin\provider {

    /**
     * Returns metadata about the mod_whatsappmb plugin.
     *
     * @param collection $collection The initialised collection to add items to.
     * @return collection A listing of user data stored by the plugin.
     */
    public static function get_metadata(collection $collection): collection {
        // Describe the data stored by the plugin.
        $collection->add_database_table(
            'whatsappmb',
            [
                'course' => 'privacy:metadata:whatsappmb:course',
                'name' => 'privacy:metadata:whatsappmb:name',
                'intro' => 'privacy:metadata:whatsappmb:intro',
                'introformat' => 'privacy:metadata:whatsappmb:introformat',
                'linktype' => 'privacy:metadata:whatsappmb:linktype',
                'whatsappnumber' => 'privacy:metadata:whatsappmb:whatsappnumber',
                'message' => 'privacy:metadata:whatsappmb:message',
                'grouplink' => 'privacy:metadata:whatsappmb:grouplink',
                'timecreated' => 'privacy:metadata:whatsappmb:timecreated',
                'timemodified' => 'privacy:metadata:whatsappmb:timemodified',
            ],
            'privacy:metadata:whatsappmb'
        );

        return $collection;
    }

    /**
     * Get the list of contexts that contain user information for the specified user.
     *
     * @param int $userid The user to search.
     * @return contextlist The contextlist containing the list of contexts used in this plugin.
     */
    public static function get_contexts_for_userid(int $userid): contextlist {
        // This plugin does not store any user-specific data, so return an empty contextlist.
        return new contextlist();
    }

    /**
     * Export all user data for the specified user, in the specified contexts.
     *
     * @param approved_contextlist $contextlist The approved contexts to export information for.
     */
    public static function export_user_data(approved_contextlist $contextlist) {
        // This plugin does not store any user-specific data, so no data is exported.
    }

    /**
     * Delete all data for all users in the specified context.
     *
     * @param \context $context The specific context to delete data for.
     */
    public static function delete_data_for_all_users_in_context(\context $context) {
        // This plugin does not store any user-specific data, so no data is deleted.
    }

    /**
     * Delete all user data for the specified user, in the specified contexts.
     *
     * @param approved_contextlist $contextlist The approved contexts and user information to delete information for.
     */
    public static function delete_data_for_user(approved_contextlist $contextlist) {
        // This plugin does not store any user-specific data, so no data is deleted.
    }
}