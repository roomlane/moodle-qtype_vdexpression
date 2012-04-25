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

defined('MOODLE_INTERNAL') || die();
require_once($CFG->dirroot . '/question/type/vdmarker/venndiagram.php');

/**
 * Venn diagram question definition class.
 *
 * @package    rs_questiontypes
 * @subpackage vdformula
 * @author     immor@hot.ee
 * @copyright  &copy; 2012 Rommi Saar
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */ 
class qtype_vdformula_question extends question_graded_automatically {
    /**
     * Correct answer (coded) from question definition.
     * This variable is set by question engine automatically.
     *  
     * @var byte 
     */
    public $vd_correctanswer;

    /**
     * Max allowed lenght of the formula.
     * Anything less than 1 means unlimited
     * 
     * @var int
     */
    public $vd_formula_maxlen;
    
    /**
     * Allowed characters in the formula defined by teacher.
     * Empty or undefined means that all legal characrters are allowed.
     * Characters not in qtype_vdmarker_vd3_formula::ALLOWED_CHARS are just ignored
     * 
     * @var string 
     */
    public $vd_formula_chars;

    public function get_expected_data() {
        return array('vdformula' => PARAM_TEXT);
    }

    public function get_correct_response() {
	return null;
    }

    public function get_validation_error(array $response) {
        $f = new qtype_vdmarker_vd3_formula($this->vd_formula_maxlen, $this->vd_formula_chars);
        return $f->syntax_check($response['vdformula']);
    }

    public function grade_response(array $response) {
        $f = new qtype_vdmarker_vd3_formula($this->vd_formula_maxlen, $this->vd_formula_chars);
        $state = $f->formula_to_state($response['vdformula']);
        if ($state == $this->vd_correctanswer) {
            $fraction = 1;
        } else {
            $fraction = 0;
        }
        return array($fraction, question_state::graded_state_for_fraction($fraction));
    }

    public function is_complete_response(array $response) {
        $f = new qtype_vdmarker_vd3_formula($this->vd_formula_maxlen, $this->vd_formula_chars);
        $error =  $f->syntax_check($response['vdformula']);
        if (null === $error) {
            return true;
        }
	return false;
    }
    
    public function is_gradable_response(array $response) {
        return true;
    }

    public function is_same_response(array $prevresponse, array $newresponse) {
    	if (!question_utils::arrays_same_at_key($prevresponse, $newresponse, 'vdformula')) {
            return false;
        }
        return true;
    }

    public function summarise_response(array $response) {
        return null;
    }
    
    /**
     * Last response
     * 
     * @param question_attempt $qa
     * @return string, null if no previous attempt 
     */
    public function get_response(question_attempt $qa) {
        return $qa->get_last_qt_var('vdformula', null);
    }
}