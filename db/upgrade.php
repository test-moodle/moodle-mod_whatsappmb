<?php
/**
 * Upgrade script for mod_whatsappmb
 *
 * @package   mod_whatsappmb
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Upgrade script for mod_whatsappmb
 *
 * @param int $oldversion La versión anterior instalada del plugin
 * @return bool Éxito o fallo en la actualización
 */
function xmldb_whatsappmb_upgrade($oldversion) {
    global $DB;

    $dbman = $DB->get_manager();

    if ($oldversion < 2025022801) {
        // Guardar el punto de actualización en la base de datos
        upgrade_mod_savepoint(true, 2025022801, 'whatsappmb');
    }

    return true;
}
