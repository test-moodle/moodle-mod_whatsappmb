<?php
/**
 * Index file for mod_whatsappmb
 *
 * @package   mod_whatsappmb
 * @author    Marcial Cahuaya | Marbot
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../config.php');
require_login();

// Si alguien intenta abrir la página, lo redirigimos al curso
redirect($CFG->wwwroot . '/course/view.php?id=' . required_param('id', PARAM_INT));
