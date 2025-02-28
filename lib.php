<?php
/**
 * Instance management functions for the mod_whatsappmb plugin in Moodle.
 *
 * @package   mod_whatsappmb
 * @author    Marcial Cahuaya | Marbot
 * @link      https://marbot.bo
 * @copyright 2025
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Adds a new instance of the WhatsAppMB activity.
 *
 * @param object $whatsappmb The data object containing instance details.
 * @param object|null $mform Optional form instance.
 * @return int The ID of the newly inserted record.
 */
function whatsappmb_add_instance($whatsappmb, $mform = null) {
    global $DB;

    // Ensure default values
    $whatsappmb->intro = $whatsappmb->intro ?? '';
    $whatsappmb->introformat = $whatsappmb->introformat ?? FORMAT_MOODLE;
    $whatsappmb->timecreated = time();
    $whatsappmb->timemodified = time();
    $whatsappmb->linktype = $whatsappmb->linktype ?? 'personal';
    $whatsappmb->whatsappnumber = $whatsappmb->whatsappnumber ?? '';
    $whatsappmb->message = $whatsappmb->message ?? '';
    $whatsappmb->grouplink = $whatsappmb->grouplink ?? '';

    // Insert the new instance into the database
    return $DB->insert_record('whatsappmb', $whatsappmb);
}

/**
 * Updates an existing instance of the WhatsAppMB activity.
 *
 * @param object $whatsappmb The data object containing updated instance details.
 * @return bool True if the update was successful, false otherwise.
 */
function whatsappmb_update_instance($whatsappmb) {
    global $DB;

    // Ensure default values
    $whatsappmb->intro = $whatsappmb->intro ?? '';
    $whatsappmb->introformat = $whatsappmb->introformat ?? FORMAT_MOODLE;
    $whatsappmb->timemodified = time();
    $whatsappmb->id = $whatsappmb->instance;

    // Update the existing record in the database
    return $DB->update_record('whatsappmb', $whatsappmb);
}

/**
 * Deletes an instance of the WhatsAppMB activity.
 *
 * @param int $id The ID of the instance to delete.
 * @return bool True if the deletion was successful, false otherwise.
 */
function whatsappmb_delete_instance($id) {
    global $DB;

    // Delete the instance from the database
    return $DB->delete_records('whatsappmb', ['id' => $id]);
}

/**
 * Retrieves course module information for display.
 *
 * @param object $coursemodule The course module object.
 * @return cached_cm_info Course module information including dynamic link handling.
 */
function whatsappmb_get_coursemodule_info($coursemodule) {
    global $DB;

    // Retrieve the WhatsAppMB instance from the database
    $whatsappmb = $DB->get_record('whatsappmb', ['id' => $coursemodule->instance], '*', MUST_EXIST);

    // Create a new course module info object
    $info = new cached_cm_info();
    $info->name = $whatsappmb->name;

    // Construct the WhatsApp link based on the type
    if ($whatsappmb->linktype === 'personal') {
        $number = $whatsappmb->whatsappnumber;
        $message = urlencode($whatsappmb->message);
        $link = "https://wa.me/{$number}?text={$message}";
    } else {
        $link = $whatsappmb->grouplink;
    }

    // Set the onclick event to open the WhatsApp link in a new tab
    $info->onclick = "window.open('$link', '_blank'); return false;";

    return $info;
}
