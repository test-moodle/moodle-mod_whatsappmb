<?php
/**
 * Capabilities definition for the mod_whatsappmb module in Moodle.
 *
 * This file defines the different permissions that can be assigned to users
 * in the WhatsAppMB module. It specifies which roles can add, view, and 
 * interact with the module.
 *
 * @package   mod_whatsappmb
 * @author    Marcial Cahuaya | Marbot
 * @link      https://marbot.bo
 * @copyright 2025
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die(); // Prevent direct script access.

/**
 * Defines the capabilities available for the mod_whatsappmb plugin.
 *
 * The `$capabilities` array specifies different access levels for users
 * based on their roles (e.g., students, teachers, managers).
 *
 * @var array $capabilities
 */
$capabilities = array(

    /**
     * Capability to add a new instance of the WhatsAppMB module.
     *
     * This permission allows users to create a new instance of the WhatsAppMB module
     * within a Moodle course.
     *
     * @riskbitmask RISK_XSS Potential risk of cross-site scripting (XSS) if improperly handled.
     * @captype write This capability allows modifications to the course structure.
     * @contextlevel CONTEXT_COURSE The capability applies at the course level.
     * @archetypes Defines which roles have this capability by default.
     * @clonepermissionsfrom moodle/course:manageactivities Inherits permissions from the activity management capability.
     */
    'mod/whatsappmb:addinstance' => array(
        'riskbitmask' => RISK_XSS, // Indicates potential security risks.
        'captype' => 'write', // Write permission (modifies the course).
        'contextlevel' => CONTEXT_COURSE, // Applies at the course level.
        'archetypes' => array(
            'editingteacher' => CAP_ALLOW, // Teachers with editing permissions can add the module.
            'manager' => CAP_ALLOW // Managers can also add the module.
        ),
        'clonepermissionsfrom' => 'moodle/course:manageactivities' // Inherits activity management permissions.
    ),

    /**
     * Capability to view the WhatsAppMB module.
     *
     * This permission allows users to view the WhatsAppMB module. It is read-only,
     * meaning users with this capability can access the module but cannot modify it.
     *
     * @captype read This capability allows read-only access.
     * @contextlevel CONTEXT_MODULE The capability applies at the module level.
     * @archetypes Defines which roles have this capability by default.
     */
    'mod/whatsappmb:view' => array(
        'captype' => 'read', // Read-only permission.
        'contextlevel' => CONTEXT_MODULE, // Applies at the module level.
        'archetypes' => array(
            'guest' => CAP_ALLOW, // Guests can view the module.
            'student' => CAP_ALLOW, // Students can view the module.
            'teacher' => CAP_ALLOW, // Teachers can view the module.
            'editingteacher' => CAP_ALLOW, // Editing teachers can view the module.
            'manager' => CAP_ALLOW // Managers can view the module.
        )
    )
);
