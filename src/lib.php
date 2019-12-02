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
 * Theme functions.
 *
 * @package    theme_recit
 * @copyright 2017 Willian Mano - http://conecti.me
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Post process the CSS tree.
 *
 * @param string $tree The CSS tree.
 * @param theme_config $theme The theme config object.
 */
/*function theme_recit_css_tree_post_processor($tree, $theme) {
    $prefixer = new theme_recit\autoprefixer($tree);
    $prefixer->prefix();
}*/

/**
 * Inject additional SCSS.
 *
 * @param theme_config $theme The theme config object.
 * @return string
 */
function theme_recit_get_extra_scss($theme) { 
    $scss = $theme->settings->scss;

    $scss .= theme_recit_set_headerimg($theme);
    $scss .= theme_recit_set_topfooterimg($theme);
    $scss .= theme_recit_set_loginbgimg($theme);
    //$scss .= theme_recit_set_course_banner_img($theme);

    return $scss;
}

/**
 * Adds the cover to CSS.
 *
 * @param theme_config $theme The theme config object.
 * @return string
 */
function theme_recit_set_headerimg($theme) {
    global $OUTPUT;

    $headerimg = $theme->setting_file_url('headerimg', 'headerimg');

    if (is_null($headerimg)) {
        $headerimg = $OUTPUT->image_url('headerimg', 'theme');
    }

    $headercss = "#page-site-index.notloggedin #page-header {background-image: url('$headerimg');}";

    return $headercss;
}

/**
 * Adds the footer image to CSS.
 *
 * @param theme_config $theme The theme config object.
 * @return string
 */
function theme_recit_set_topfooterimg($theme) {
    global $OUTPUT;

    $topfooterimg = $theme->setting_file_url('topfooterimg', 'topfooterimg');

    if (is_null($topfooterimg)) {
        $topfooterimg = $OUTPUT->image_url('footer-bg', 'theme');
    }

    $headercss = "#top-footer {background-image: url('$topfooterimg');}";

    return $headercss;
}

/**
 * Adds the login page background image to CSS.
 *
 * @param theme_config $theme The theme config object.
 * @return string
 */
function theme_recit_set_loginbgimg($theme) {
    global $OUTPUT;

    $loginbgimg = $theme->setting_file_url('loginbgimg', 'loginbgimg');

    if (is_null($loginbgimg)) {
        $loginbgimg = $OUTPUT->image_url('login_bg', 'theme');
    }

    $headercss = "#page-login-index.recit-login #page-wrapper #page {background-image: url('$loginbgimg');}";

    return $headercss;
}

/**
 * Adds the course banner
 *
 * @param theme_config $theme The theme config object.
 * @return string
 */
/*function theme_recit_set_course_banner_img($theme) {
    global $OUTPUT;

    $img = $theme->setting_file_url('coursebanner', 'coursebanner');

    if (is_null($img)) {
        $img = $OUTPUT->image_url('banner-course', 'theme');
    }

    $css = "#page-header .card{background-image: url('$img');}";

    return $css;
}*/

/**
 * Returns the main SCSS content.
 *
 * @param theme_config $theme The theme config object.
 * @return string
 */
function theme_recit_get_main_scss_content($theme) {
    global $CFG;

    $scss = '';
   /* $filename = !empty($theme->settings->preset) ? $theme->settings->preset : null;
    $fs = get_file_storage();*/

    /*$context = context_system::instance();
    if ($filename == 'default.scss') {
        $scss .= file_get_contents($CFG->dirroot . '/theme/recit/scss/preset/default.scss');
    } else if ($filename == 'plain.scss') {
        $scss .= file_get_contents($CFG->dirroot . '/theme/recit/scss/preset/plain.scss');
    } else if ($filename && ($presetfile = $fs->get_file($context->id, 'theme_recit', 'preset', 0, '/', $filename))) {
        // This preset file was fetched from the file area for theme_recit and not theme_boost (see the line above).
        $scss .= $presetfile->get_content();
    } else {
        // Safety fallback - maybe new installs etc.
        $scss .= file_get_contents($CFG->dirroot . '/theme/recit/scss/preset/default.scss');
    }*/

    //$scss .= file_get_contents($CFG->dirroot . '/theme/recit/scss/bootstrap.scss');
    //$scss .= file_get_contents($CFG->dirroot . '/theme/recit/scss/fontawesome.scss');
    //$scss .= theme_recit_get_precompiled_css();

    /*if ($filename && ($presetfile = $fs->get_file($context->id, 'theme_recit', 'preset', 0, '/', $filename))) {
        // This preset file was fetched from the file area for theme_recit and not theme_boost (see the line above).
        $scss .= $presetfile->get_content();
    } */

    // Recit scss.
    //$recitvariables = file_get_contents($CFG->dirroot . '/theme/recit/scss/recit/_variables.scss');
    //$recit = file_get_contents($CFG->dirroot . '/theme/recit/scss/recit.scss');

    // Combine them together.
    //return $scss . "\n" . $recit;
    //return $scss . "\n" . $recit;

    return $scss;
}

/*
function theme_recit_get_local_scss_content($theme, $variables) {
    global $CFG;

    $scss = '';
    $filename = !empty($theme->settings->preset) ? $theme->settings->preset : null;
    $fs = get_file_storage();

    $context = context_system::instance();
    if ($filename == 'default.scss') {
        $scss .= file_get_contents($CFG->dirroot . '/theme/recit/scss/preset/default.scss');
    } else if ($filename == 'plain.scss') {
        $scss .= file_get_contents($CFG->dirroot . '/theme/recit/scss/preset/plain.scss');
    } else if ($filename && ($presetfile = $fs->get_file($context->id, 'theme_recit', 'preset', 0, '/', $filename))) {
        // This preset file was fetched from the file area for theme_recit and not theme_boost (see the line above).
        $scss .= $presetfile->get_content();
    } else {
        // Safety fallback - maybe new installs etc.
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/default.scss');
    }

    // Recit scss.
    $recitvariables = file_get_contents($CFG->dirroot . $variables);
    $recit = file_get_contents($CFG->dirroot . '/theme/recit/scss/recit.scss');

    // Combine them together.
    return $recitvariables . "\n" . $scss . "\n" . $recit;
}*/

/**
 * Get compiled css.
 *
 * @return string compiled css
 */
/*function theme_recit_get_precompiled_css() {
    global $CFG;
    return file_get_contents($CFG->dirroot . '/theme/recit/style/moodle.css');
}*/

/**
 * Get SCSS to prepend.
 *
 * @param theme_config $theme The theme config object.
 * @return string
 */
function theme_recit_get_pre_scss($theme) {
    $scss = '';
    $configurable = [
        // Config key => [variableName, ...].
        'brandcolor' => ['brand-primary'],
        'navbarheadercolor' => 'navbar-header-color'
    ];

    // Prepend variables first.
    foreach ($configurable as $configkey => $targets) {
        $value = isset($theme->settings->{$configkey}) ? $theme->settings->{$configkey} : null;
        if (empty($value)) {
            continue;
        }
        array_map(function($target) use (&$scss, $value) {
            $scss .= '$' . $target . ': ' . $value . ";\n";
        }, (array) $targets);
    }

    // Prepend pre-scss.
    if (!empty($theme->settings->scsspre)) {
        $scss .= $theme->settings->scsspre;
    }

    return $scss;
}

/**
 * Serves any files associated with the theme settings.
 *
 * @param stdClass $course
 * @param stdClass $cm
 * @param context $context
 * @param string $filearea
 * @param array $args
 * @param bool $forcedownload
 * @param array $options
 * @return mixed
 */
function theme_recit_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options = array()) {
    $theme = theme_config::load('recit');

    if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'logo') {
        return $theme->setting_file_serve('logo', $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'headerimg') {
        return $theme->setting_file_serve('headerimg', $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'marketing1icon') {
        return $theme->setting_file_serve('marketing1icon', $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'marketing2icon') {
        return $theme->setting_file_serve('marketing2icon', $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'marketing3icon') {
        return $theme->setting_file_serve('marketing3icon', $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'marketing4icon') {
        return $theme->setting_file_serve('marketing4icon', $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'topfooterimg') {
        return $theme->setting_file_serve('topfooterimg', $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'loginbgimg') {
        return $theme->setting_file_serve('loginbgimg', $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'favicon') {
        return $theme->setting_file_serve('favicon', $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and preg_match("/^sliderimage[1-9][0-9]?$/", $filearea) !== false) {
        return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and preg_match("/^sponsorsimage[1-9][0-9]?$/", $filearea) !== false) {
        return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and preg_match("/^clientsimage[1-9][0-9]?$/", $filearea) !== false) {
        return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
    } else {
        send_file_not_found();
    }
}

/**
 * Get theme setting
 *
 * @param string $setting
 * @param bool $format
 * @return string
 */
function theme_recit_get_setting($setting, $format = false) {
    $theme = theme_config::load('recit');

    if (empty($theme->settings->$setting)) {
        return false;
    } else if (!$format) {
        return $theme->settings->$setting;
    } else if ($format === 'format_text') {
        return format_text($theme->settings->$setting, FORMAT_PLAIN);
    } else if ($format === 'format_html') {
        return format_text($theme->settings->$setting, FORMAT_HTML, array('trusted' => true, 'noclean' => true));
    } else {
        return format_string($theme->settings->$setting);
    }
}

/**
 * Get course theme name
 *
 * @param string $setting
 * @param bool $format
 * @return string
 */
function theme_recit_get_course_theme() {
    global $COURSE;

    switch($COURSE->theme){
        case 'recit_art':
            return 'theme-recit-art';
		case 'recit_ecr':
            return 'theme-recit-ecr';
		case 'recit_mathematique':
            return 'theme-recit-mathematique';
		case 'recit_science':
            return 'theme-recit-science';
		case 'recit_anglais':
            return 'theme-recit-anglais';
		case 'recit_francais':
            return 'theme-recit-francais';
        case 'recit_histoire':
            return 'theme-recit-histoire';
        default: 
            return "theme-recit";
    }
}

/**
 * Extend the Recit navigation
 *
 * @param flat_navigation $flatnav
 */
/*function theme_recit_extend_flat_navigation(\flat_navigation $flatnav) {
    theme_recit_rebuildcoursesections($flatnav);
    theme_recit_delete_menuitems($flatnav);
    theme_recit_add_user_menu($flatnav);   
}*/

/*function theme_recit_add_user_menu(\flat_navigation $flatnav) {
    global $USER, $PAGE;
    $opts = user_get_user_navigation_info($USER, $PAGE);
    
    $options = [
            'text' => get_string('usermenu', 'theme_recit'),
            'shorttext' => get_string('usermenu', 'theme_recit'),
            'icon' => new pix_icon('t/viewdetails', ''),
            'type' => \navigation_node::COURSE_CURRENT,
            'key' => 'user_menu',
            'parent' => null
        ];
        
   $nav_node = new \flat_navigation_node($options, $flatnav);
        
   $flatnav->add($nav_node, null);
}*/

/**
 * Remove items from navigation
 *
 * @param flat_navigation $flatnav
 */
/*function theme_recit_delete_menuitems(\flat_navigation $flatnav) {

    $itemstodelete = [
        'coursehome'
    ];

    foreach ($flatnav as $item) {
        if (in_array($item->key, $itemstodelete)) {
            $flatnav->remove($item->key);

            continue;
        }

        if (isset($item->parent->key) && $item->parent->key == 'mycourses' &&
            isset($item->type) && $item->type == \navigation_node::TYPE_COURSE) {

            $flatnav->remove($item->key);

            continue;
        }
        
        if(isset($item->key) && ($item->key == 'mycourses' || $item->key == "course-sections"))
        {
            $flatnav->remove($item->key);
            continue;
        }
    }
}*/

/**
 * Improve flat navigation menu
 *
 * @param flat_navigation $flatnav
 */
/*function theme_recit_rebuildcoursesections(\flat_navigation $flatnav) {
    global $PAGE;

    $participantsitem = $flatnav->find('participants', \navigation_node::TYPE_CONTAINER);

    if (!$participantsitem) {
        return;
    }

    if ($PAGE->course->format != 'singleactivity') {
        $coursesectionsoptions = [
            'text' => get_string('coursesections', 'theme_recit'),
            'shorttext' => get_string('coursesections', 'theme_recit'),
            'icon' => new pix_icon('t/viewdetails', ''),
            'type' => \navigation_node::COURSE_CURRENT,
            'key' => 'course-sections',
            'parent' => $participantsitem->parent
        ];

        $coursesections = new \flat_navigation_node($coursesectionsoptions, 0);

        foreach ($flatnav as $item) {
            if ($item->type == \navigation_node::TYPE_SECTION) {
                $coursesections->add_node(new \navigation_node([
                    'text' => $item->text,
                    'shorttext' => $item->shorttext,
                    'icon' => $item->icon,
                    'type' => $item->type,
                    'key' => $item->key,
                    'parent' => $coursesections,
                    'action' => $item->action
                ]));
            }
        }

        $flatnav->add($coursesections, $participantsitem->key);
    }

    $mycourses = $flatnav->find('mycourses', \navigation_node::NODETYPE_LEAF);

    if ($mycourses) {
        $flatnav->remove($mycourses->key);

        $flatnav->add($mycourses, 'privatefiles');
    }
}*/
