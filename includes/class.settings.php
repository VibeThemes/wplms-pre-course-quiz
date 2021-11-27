<?php

/**
 * SETTINGS
 *
 * @class       Wplms_Pre_Course_Quiz
 * @author      VibeThemes
 * @category    Admin
 * @package     wplms-pre-course-quiz
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
class Wplms_Pre_Course_Quiz{


    public static $instance;
    public static function init(){

        if ( is_null( self::$instance ) )
            self::$instance = new Wplms_Pre_Course_Quiz();
        return self::$instance;
    }

    private function __construct(){
        add_filter('wplms_quiz_metabox',array($this,'add_setting'));
        add_filter('custom_meta_box_type',array($this,'add_custom_meta_boxes'),10,3);
        
    }

    function add_setting($args){

        $args[] = array( // Text Input
                'label' => __('Assign courses on quiz evaluation','wplms-pre-course-quiz'), // <label>
                'desc'  => __('Courses are assigned based on quiz marks. Set the courses and the marks range','wplms-pre-course-quiz'), // description
                'id'    => 'vibe_pre_course_quiz', // field id and name
                'type'  => 'pre_course_quiz', // type of field
            );

     return $args;
    }

    function add_custom_meta_boxes($type,$meta,$id){

        if($type != 'pre_course_quiz')
            return $type;

        echo '<a class="meta_box_repeatable_add button button-primary button-large" href="#">'.__('Add More','wplms-pre-course-quiz').'</a>
            <ul id="' . $id . '-repeatable" class="meta_box_repeatable">';


    if ( $meta ) {
        
        if(!empty($meta['course']) && !empty($meta['min']) && !empty($meta['max'])){
            $courses = $meta['course'];
            $min = $meta['min'];
            $max = $meta['max'];
            foreach( $courses as $i => $course ) {
                if(!isset($min[$i]) || !$min[$i]) $min[$i]=0;
                if(!isset($max[$i]) || !$max[$i]) $max[$i]=0;

                echo '<li><span class="sort handle dashicons dashicons-sort"></span>
                        <input type="hidden" name="' . $id . '[course][]" value="'. $course.'" />
                        <strong>'.get_the_title($course). '</strong>
                        <input type="number" name="' . $id . '[min][]" placeholder="'.__('Min Marks','wplms-pre-course-quiz').'" value="'.esc_attr( $min[$i] ).'"/>
                         <input type="number" name="' . $id . '[max][]" placeholder="'.__('Max Marks','wplms-pre-course-quiz').'" value="'.esc_attr( $max[$i] ).'"/>
                        <a class="meta_box_repeatable_remove" href="#"><span class="dashicons dashicons-no"></span></a>
                        </li>';
            }
        }
    } 
    echo '<li class="hide">
            <select rel-name="' . $id . '[course][]"  data-id="'.$post->ID.'" data-cpt="course" data-placeholder="'.__('Select Course to assign post quiz','wplms-pre-course-quiz').'">';
          echo '</select>
         <input type="number" rel-name="' . $id . '[min][]" placeholder="'.__('Min marks','wplms-pre-course-quiz').'" value="0" /> 
         <input type="number" rel-name="' . $id . '[max][]" placeholder="'.__('Max marks','wplms-pre-course-quiz').'" value="0" /> 
         <a class="meta_box_repeatable_remove" href="#"><span class="dashicons dashicons-no"></span></a></li>';
    echo '</ul><br />
        <span class="description">' . $field['desc'] . '</span>';
        ?>
        <?php
        return $type;
    }
}

Wplms_Pre_Course_Quiz::init();


?>