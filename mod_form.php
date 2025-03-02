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
 * Form definition for the mod_whatsappmb activity in Moodle.
 *
 * @package   mod_whatsappmb
 * @copyright 2025 Marcial Cahuaya | Marbot
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();


require_once($CFG->dirroot . '/course/moodleform_mod.php');

/**
 * Class mod_whatsappmb_mod_form
 * Defines the form for configuring the WhatsAppMB module in Moodle.
 */
class mod_whatsappmb_mod_form extends moodleform_mod {
    
    /**
     * Defines the form elements for the WhatsAppMB module.
     */
    public function definition() {
        $mform = $this->_form;

        // General section header
        $mform->addElement('header', 'general', get_string('general', 'form'));

        // Activity name field
        $mform->addElement('text', 'name', get_string('name'), ['size' => '64']);
        $mform->setType('name', PARAM_TEXT);
        $mform->addRule('name', null, 'required', null, 'client');

        // Standard description (intro) field
        $this->standard_intro_elements();

        // Dropdown to select link type (personal or group)
        $mform->addElement('select', 'linktype', get_string('linktype', 'whatsappmb'), [
            'personal' => get_string('personalnumber', 'whatsappmb'),
            'group' => get_string('grouplink', 'whatsappmb')
        ]);
        $mform->setDefault('linktype', 'personal');

        // WhatsApp number field (only for personal links)
        $mform->addElement('text', 'whatsappnumber', get_string('whatsappnumber', 'whatsappmb'), ['size' => '15']);
        $mform->setType('whatsappnumber', PARAM_TEXT);
        $mform->hideIf('whatsappnumber', 'linktype', 'eq', 'group'); // Hide if link type is "group"

        // Message field (only for personal links, optional)
        $mform->addElement('textarea', 'message', get_string('message', 'whatsappmb'));
        $mform->setType('message', PARAM_TEXT);
        $mform->hideIf('message', 'linktype', 'eq', 'group'); // Hide if link type is "group"

        // Group link field (only for group links)
        $mform->addElement('text', 'grouplink', get_string('grouplink', 'whatsappmb'), ['size' => '60']);
        $mform->setType('grouplink', PARAM_TEXT);
        $mform->hideIf('grouplink', 'linktype', 'eq', 'personal'); // Hide if link type is "personal"

        // Standard course module elements (availability, completion, etc.)
        $this->standard_coursemodule_elements();

        // Add save and cancel buttons
        $this->add_action_buttons(true, false);
    }

    /**
     * Validates the form input.
     *
     * @param array $data Form data.
     * @param array $files Uploaded files.
     * @return array Array of validation errors, if any.
     */
    public function validation($data, $files) {
        $errors = parent::validation($data, $files);

        // Validate input based on the selected link type
        if ($data['linktype'] === 'personal' && empty(trim($data['whatsappnumber']))) {
            $errors['whatsappnumber'] = get_string('required');
        }
        if ($data['linktype'] === 'group' && empty(trim($data['grouplink']))) {
            $errors['grouplink'] = get_string('required');
        }

        return $errors;
    }
}
