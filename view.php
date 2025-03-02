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
 * Redirects users to a WhatsApp link based on the configured phone number and message.
 *
 * @package   mod_whatsappmb
 * @copyright 2025 Marcial Cahuaya | Marbot
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once('../../config.php');
require_once('lib.php');

// Retrieve the required course module ID from the request.
$id = required_param('id', PARAM_INT);

// Get the course module data from the database.
$cm = get_coursemodule_from_id('whatsappmb', $id, 0, false, MUST_EXIST);

// Retrieve the course record from the database.
$course = $DB->get_record('course', ['id' => $cm->course], '*', MUST_EXIST);

// Retrieve the WhatsAppMB module instance from the database.
$whatsappmb = $DB->get_record('whatsappmb', ['id' => $cm->instance], '*', MUST_EXIST);

// Ensure the user is logged in and has access to the course module.
require_login($course, true, $cm);

// Build the WhatsApp link using the configured phone number and message.
$number = $whatsappmb->whatsappnumber; // WhatsApp phone number.
$message = urlencode($whatsappmb->message); // Predefined message.
$whatsapp_link = "https://wa.me/{$number}?text={$message}";

// Redirect the user directly to the WhatsApp link.
redirect($whatsapp_link);
