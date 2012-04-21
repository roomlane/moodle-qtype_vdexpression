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
 * Venn diagram marker question type renderer.
 *
 * @package    rs_questiontypes
 * @subpackage vdformula
 * @author     immor@hot.ee
 * @copyright  &copy; 2012 Rommi Saar
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */ 

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/question/type/vdmarker/venndiagram.php');

/**
 * Generates the output for drag-and-drop markers questions.
 *
 * @copyright  2010 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_vdformula_renderer extends qtype_with_combined_feedback_renderer {

    public function formulation_and_controls(question_attempt $qa, question_display_options $options) {
        $question = $qa->get_question();

        $questiontext = $question->format_questiontext($qa);

        $output = html_writer::tag('div', $questiontext, array('class' => 'qtext'));
        
        $vdid = str_replace(':', '_', $qa->get_qt_field_name('vdqa'));
        $vdformula = $question->get_response($qa);
        
        //TODO: convert $vdformula to $vdstate
        //      also should show if the formula was syntactically correct
        //$vdstate = qtype_vdmarker_vd3::state_from_formula($vdformula);
        
        if (question_display_options::VISIBLE == $options->rightanswer) {
            $t = new html_table();
            $t->attributes = array('class' => 'vd-compare-table');
            $t->head = array(get_string('answer', 'question'), get_string('correct_answer', 'qtype_vdmarker'));

            $leftcell = $this->output_diagram_readonly($vdid . '_response', $vdstate);
            $rightcell = $this->output_diagram_readonly($vdid . '_correct', $question->vd_correctanswer);
 
            $t->data = array( array($vdformula, ''),
                              array($leftcell, $rightcell) );
            
            $output .= html_writer::table($t);
        } else if ($options->readonly) {
            $output .= html_writer::tag('div', $vdformula, array('class' => 'vdformula-answer'));
            $output .= $this->output_diagram_readonly($vdid, $vdstate);
        } else {
            $output .= $this->output_diagram_readonly($vdid, $question->vd_correctanswer);
            
            $output .= html_writer::tag('div', get_string('chars_for_copy_paste_caption', 'qtype_vdmarker') . ': ', array('class' => 'vdmarker-for-copy-paste-caption'));
            $output .= html_writer::tag('div', qtype_vdmarker_vd3::ALLOWED_CHARS, array('class' => 'vdmarker-for-copy-paste'));
            
            
            $formulafield = array('type'  => 'text', //TODO: something else here!
                                  'name'  => $qa->get_qt_field_name('vdformula'),
                                  'value' => s($vdformula));
            $output .= html_writer::empty_tag('input', $formulafield);
        }

        if ($qa->get_state() == question_state::$invalid) {
            $output .= html_writer::nonempty_tag('div',
                                        $question->get_validation_error($qa->get_last_qt_data()),
                                        array('class' => 'validationerror'));
        }
        
        return $output;
    }
    
    private function output_diagram_readonly($id, $state) {
        $vd = new qtype_vdmarker_vd3($id);
        $vd->set_state($state);
        $vd->readonly = true;
        return $vd->render();
    }
}
