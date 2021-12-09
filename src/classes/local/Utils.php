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

namespace theme_recit2\local;

require_once($CFG->dirroot . '/user/lib.php');
require_once($CFG->dirroot . '/message/output/popup/lib.php');

use theme_config;
use stdClass;

defined('MOODLE_INTERNAL') || die();

class CourseSectionNav{
    public $sections = array();
    public $isMenuM1 = false;
    public $isMenuM2 = false;
    public $isMenuM3 = false;
    public $isMenuM5 = false;

    public function addSection($level = 1,  $sectionId = '', $url, $sectionDesc = ""){
        $maxNbChars = 25;
        
        $obj = new stdClass();
        $obj->sectionId = $sectionId;
        $obj->url = $url;
        $obj->title = $sectionDesc;
        $obj->desc = mb_strimwidth($sectionDesc, 0, $maxNbChars, "...");
        $obj->subSections = array();

        if($level > 1){
            $lastIndex = count($this->sections) - 1;
            $this->sections[$lastIndex]->subSections[] = $obj;
            $this->sections[$lastIndex]->hasSubSections = true;
        }
        else{
            $this->sections[] = $obj;
        }
    }
}

/**
 * Helper to load a theme configuration.
 *
 * @package    theme_recit2
 * @copyright  2017 Willian Mano - http://conecti.me
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class ThemeSettings {

    public const COURSE_CUSTOM_FIELDS_SECTION = 'Thème RÉCIT';  // hardcodé car il ne peut pas être modifié
    
    public const MENU_MODEL_LIST = array('m1', 'm2', 'm3', 'm5');

    public const SUBTHEME_LIST = array('theme-recit-anglais', 'theme-recit-art', 'theme-recit-ecr', 'theme-recit-francais',  'theme-recit-histoire', 'theme-recit-math', 'theme-recit-science');

    public static function get_custom_field($name) {
        global $COURSE;

        if($COURSE->id > 1){
            $customFieldsRecit = theme_recit2_get_course_metadata($COURSE->id, self::COURSE_CUSTOM_FIELDS_SECTION);

            if(property_exists($customFieldsRecit, $name)){
                return $customFieldsRecit->$name;
            }
        }

        return null;
    }

    /**
     * Get config theme footer itens
     *
     * @return array
     */
    public function footer_items() {
        $theme = theme_config::load('recit2');

        $templatecontext = [];

        $footersettings = [
            'facebook', 'twitter', 'googleplus', 'linkedin', 'youtube', 'instagram', 'getintouchcontent',
            'website', 'mobile', 'mail', 'policyurl', 'termsurl'
        ];

        foreach ($footersettings as $setting) {
            if (!empty($theme->settings->$setting)) {
                $templatecontext[$setting] = $theme->settings->$setting;
            }
        }

        $footerfilesettings = [
            'footerlogo'
        ];

        foreach ($footerfilesettings as $setting) {
                $image = $theme->setting_file_url($setting, $setting);
                if (!empty($image)) {
                    $templatecontext[$setting] = $image;
                }
        }

        $templatecontext['disablebottomfooter'] = false;
        if (!empty($theme->settings->disablebottomfooter)) {
            $templatecontext['disablebottomfooter'] = true;
        }

        return $templatecontext;
    }

    /**
     * Get config theme slideshow
     *
     * @return array
     */
    public function slideshow() {
        global $OUTPUT;

        $theme = theme_config::load('recit2');

        $templatecontext['sliderenabled'] = $theme->settings->sliderenabled;

        if (empty($templatecontext['sliderenabled'])) {
            return $templatecontext;
        }

        $slidercount = $theme->settings->slidercount;

        for ($i = 1, $j = 0; $i <= $slidercount; $i++, $j++) {
            $sliderimage = "sliderimage{$i}";
            $slidertitle = "slidertitle{$i}";
            $slidercap = "slidercap{$i}";

            $templatecontext['slides'][$j]['key'] = $j;
            $templatecontext['slides'][$j]['active'] = false;

            $image = $theme->setting_file_url($sliderimage, $sliderimage);
            if (empty($image)) {
                $image = $OUTPUT->image_url("slide_default_img$i", 'theme');
            }
            $templatecontext['slides'][$j]['image'] = $image;
            $templatecontext['slides'][$j]['title'] = $theme->settings->$slidertitle;
            $templatecontext['slides'][$j]['caption'] = $theme->settings->$slidercap;

            if ($i === 1) {
                $templatecontext['slides'][$j]['active'] = true;
            }
        }

        return $templatecontext;
    }

    /**
     * Get config theme marketing itens
     *
     * @return array
     */
    public function marketing_items() {
        global $OUTPUT;

        $theme = theme_config::load('recit2');

        $templatecontext = [];

        for ($i = 1; $i < 5; $i++) {
            $marketingicon = 'marketing' . $i . 'icon';
            $marketingheading = 'marketing' . $i . 'heading';
            $marketingsubheading = 'marketing' . $i . 'subheading';
            $marketingcontent = 'marketing' . $i . 'content';
            $marketingurl = 'marketing' . $i . 'url';

            $templatecontext[$marketingicon] = $OUTPUT->image_url('icon_default', 'theme');
            if (!empty($theme->settings->$marketingicon)) {
                $templatecontext[$marketingicon] = $theme->setting_file_url($marketingicon, $marketingicon);
            }

            $templatecontext[$marketingheading] = '';
            if (!empty($theme->settings->$marketingheading)) {
                $templatecontext[$marketingheading] = theme_recit2_get_setting($marketingheading, true);
            }

            $templatecontext[$marketingsubheading] = '';
            if (!empty($theme->settings->$marketingsubheading)) {
                $templatecontext[$marketingsubheading] = theme_recit2_get_setting($marketingsubheading, true);
            }

            $templatecontext[$marketingcontent] = '';
            if (!empty($theme->settings->$marketingcontent)) {
                $templatecontext[$marketingcontent] = theme_recit2_get_setting($marketingcontent, true);
            }

            $templatecontext[$marketingurl] = '';
            if (!empty($theme->settings->$marketingurl)) {
                $templatecontext[$marketingurl] = $theme->settings->$marketingurl;
            }
        }

        return $templatecontext;
    }

    /**
     * Get the frontpage numbers
     *
     * @return array
     */
    public function numbers() {
        global $DB;

        $templatecontext['numberusers'] = $DB->count_records('user', array('deleted' => 0, 'suspended' => 0)) - 1;
        $templatecontext['numbercourses'] = $DB->count_records('course', array('visible' => 1)) - 1;
        $templatecontext['numberactivities'] = $DB->count_records('course_modules');

        return $templatecontext;
    }

    /**
     * Get config theme sponsors logos and urls
     *
     * @return array
     */
    public function sponsors() {
        $theme = theme_config::load('recit2');

        $templatecontext['sponsorstitle'] = $theme->settings->sponsorstitle;
        $templatecontext['sponsorssubtitle'] = $theme->settings->sponsorssubtitle;

        $sponsorscount = $theme->settings->sponsorscount;

        for ($i = 1, $j = 0; $i <= $sponsorscount; $i++, $j++) {
            $sponsorsimage = "sponsorsimage{$i}";
            $sponsorsurl = "sponsorsurl{$i}";

            $image = $theme->setting_file_url($sponsorsimage, $sponsorsimage);
            if (empty($image)) {
                continue;
            }

            $templatecontext['sponsors'][$j]['image'] = $image;
            $templatecontext['sponsors'][$j]['url'] = $theme->settings->$sponsorsurl;

        }

        return $templatecontext;
    }

    /**
     * Get config theme clients logos and urls
     *
     * @return array
     */
    public function clients() {
        $theme = theme_config::load('recit2');

        $templatecontext['clientstitle'] = $theme->settings->clientstitle;
        $templatecontext['clientssubtitle'] = $theme->settings->clientssubtitle;

        $clientscount = $theme->settings->clientscount;

        for ($i = 1, $j = 0; $i <= $clientscount; $i++, $j++) {
            $clientsimage = "clientsimage{$i}";
            $clientsurl = "clientsurl{$i}";

            $image = $theme->setting_file_url($clientsimage, $clientsimage);
            if (empty($image)) {
                continue;
            }

            $templatecontext['clients'][$j]['image'] = $image;
            $templatecontext['clients'][$j]['url'] = $theme->settings->$clientsurl;

        }

        return $templatecontext;
    }
}

class ThemeUtils
{
    public static function getUserRoles($courseId, $userId){
        // get the course context (there are system context, module context, etc.)
        $context = \context_course::instance($courseId);

        return self::getUserRolesOnContext($context, $userId);
    }

    public static function getUserRolesOnContext($context, $userId){
        $userRoles1 = get_user_roles($context, $userId);

        $userRoles2 = array();
        foreach($userRoles1 as $item){
            $userRoles2[] = $item->shortname;
        }

        $ret = self::moodleRoles2RecitRoles($userRoles2);

        if(is_siteadmin($userId)){
            $ret[] = 'ad';
        }
        
        return $ret;
    }
    
    public static function moodleRoles2RecitRoles($userRoles){
        $ret = array();

        foreach($userRoles as $name){
            switch($name){
                case 'manager': $ret[] = 'mg'; break;
                case 'coursecreator': $ret[] = 'cc'; break;
                case 'editingteacher': $ret[] = 'et'; break;
                case 'teacher': $ret[] = 'tc'; break;
                case 'student': $ret[] = 'sd'; break;
                case 'guest': $ret[] = 'gu'; break;
                case 'frontpage': $ret[] = 'fp'; break;
            }
        }

        return $ret;
    }
    
    public static function isAdminRole($roles){
        $adminRoles = array('ad', 'mg', 'cc', 'et', 'tc');

        if(empty($roles)){ return false;}

        foreach($roles as $role){
            if(in_array($role, $adminRoles)){
                return true;
            }
        }
        return false;
    }
}