<?php
/**
 * Plugin Name: WPLMS PRE COURSE QUIZ
 * Plugin URI: https://wplms.io
 * Description: The most advanced Learning management system for WordPress - wplms.io
 * Author: VibeThemes
 * Author URI: https://vibethemes.com
 * Version: 1.0
 * Text Domain: wplms-pre-course-quiz
 * Domain Path: /languages
 * Tested up to: 5.8.2
 *
 * @package WPLMS
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if(!defined('WPLMS_PRE_COURSE_QUIZ'))
define( 'WPLMS_PRE_COURSE_QUIZ', plugin_dir_path( __FILE__ ) );

define( 'WPLMS_PRE_COURSE_QUIZ_VERSION','1.0');


//require_once(dirname(__FILE__).'/includes/create-course/loader.php');

include_once 'includes/class.settings.php';


add_action('plugins_loaded','wplms_pre_course_quiz_translations');
function wplms_pre_course_quiz_translations(){
    $locale = apply_filters("plugin_locale", get_locale(), 'wplms-pre-course-quiz');
    $lang_dir = dirname( __FILE__ ) . '/languages/';
    $mofile        = sprintf( '%1$s-%2$s.mo', 'wplms-pre-course-quiz', $locale );
    $mofile_local  = $lang_dir . $mofile;
    $mofile_global = WP_LANG_DIR . '/plugins/' . $mofile;

    if ( file_exists( $mofile_global ) ) {
        load_textdomain( 'wplms-pre-course-quiz', $mofile_global );
    } else {
        load_textdomain( 'wplms-pre-course-quiz', $mofile_local );
    }  
}