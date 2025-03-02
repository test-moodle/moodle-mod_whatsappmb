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
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle. If not, see <http://www.gnu.org/licenses/>.

/**
 * Capabilities definition for the mod_whatsappmb module in Moodle.
 *
 * @package   mod_whatsappmb
 * @copyright 2025 Marcial Cahuaya | Marbot
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

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
