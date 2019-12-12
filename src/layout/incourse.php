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
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * A two column layout for the recit theme.
 *
 * @package   theme_recit
 * @copyright RÉCIT 2019
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once("common.php");
require_once($CFG->libdir . '/behat/lib.php');

ThemeRecitUtils::setUserPreferenceDrawer();

$blockshtml = $OUTPUT->blocks('side-pre');
$hasblocks = strpos($blockshtml, 'data-block=') !== false;

$extraclasses = [];

if (ThemeRecitUtils::isDrawerOpenRight() && $hasblocks) {
    $extraclasses[] = 'drawer-open-right';
}

$moduleswithnavinblocks = ['book', 'quiz'];

if (isset($PAGE->cm->modname) && in_array($PAGE->cm->modname, $moduleswithnavinblocks)) {
   // $navdraweropen = false;

    $extraclasses = [];
}
$extraclasses[] = theme_recit_get_course_theme();
$bodyattributes = $OUTPUT->body_attributes($extraclasses);
$regionmainsettingsmenu = $OUTPUT->region_main_settings_menu();
$templatecontext = [
    'sitename' => format_string($SITE->shortname, true, ['context' => context_course::instance(SITEID), "escape" => false]),
    'page' => $PAGE,
    'sidepreblocks' => $blockshtml,
    'hasblocks' => $hasblocks,
    'bodyattributes' => $bodyattributes,
    'hasdrawertoggle' => true,
    'navdraweropen' => ThemeRecitUtils::isNavDrawerOpen(),
    'draweropenright' => ThemeRecitUtils::isDrawerOpenRight(),
    'regionmainsettingsmenu' => $regionmainsettingsmenu,
    'hasregionmainsettingsmenu' => !empty($regionmainsettingsmenu)
];

$templatecontext = array_merge($templatecontext, ThemeRecitUtils::getTemplateContextCommon($OUTPUT, $PAGE, $USER));

$themesettings = new \theme_recit\util\theme_settings();

$templatecontext = array_merge($templatecontext, $themesettings->footer_items());

if (isset($PAGE->cm->modname) && in_array($PAGE->cm->modname, $moduleswithnavinblocks)) {
    echo $OUTPUT->render_from_template('theme_recit/incourse', $templatecontext);
} else {
    echo $OUTPUT->render_from_template('theme_recit/columns2', $templatecontext);
}
