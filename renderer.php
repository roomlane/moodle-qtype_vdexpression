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
 * @subpackage vdexpression
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
class qtype_vdexpression_renderer extends qtype_with_combined_feedback_renderer {

    public function formulation_and_controls(question_attempt $qa, question_display_options $options) {
        $question = $qa->get_question();

        $questiontext = $question->format_questiontext($qa);

        $output = html_writer::tag('div', $questiontext, array('class' => 'qtext'));

        $vdid = str_replace(':', '_', $qa->get_qt_field_name('vdqa'));
        $output .= $this->output_diagram_readonly($vdid, $question->vd_correctanswer);

        $f = new qtype_vdmarker_vd3_expression($question->vd_expression_maxlen, $question->vd_expression_chars);

        $output .= html_writer::tag('div', 
                                    get_string('chars_for_copy_paste_caption', 'qtype_vdmarker') . ': ' . 
                                               $f->get_allowed_chars_formatted(), 
                                    array('class' => 'vdmarker-for-copy-paste'));
        
        if ($f->get_max_len() >= 1) {
            $output .= html_writer::tag('div', 
                                       get_string('expression_max_len', 'qtype_vdexpression') . ': ' . 
                                                  $f->get_max_len(), 
                                       array('class' => 'vdexpression-length-limit'));
        }
        
        $vdexpression = $question->get_response($qa);
        
        $expressionfield = array('type'  => 'text',
                                'name'  => $qa->get_qt_field_name('vdexpression'),
                                'value' => s($vdexpression),
                                'size' => 80);
        if ($options->readonly) {
            $expressionfield['readonly'] = 'readonly';
        }

        $output .= html_writer::empty_tag('input', $expressionfield);
        
        $error = $f->syntax_check($vdexpression);
        if (isset($error)) {
            $output .= html_writer::nonempty_tag('div',
                                        $error,
                                        array('class' => 'vdexpression-validationerror'));
        }
        if ($options->readonly) {
            $vdstate = $f->expression_to_state($vdexpression);
            if (isset($vdstate)) {
                $output .= html_writer::nonempty_tag('div',
                                            get_string('corresponds_to_diagram', 'qtype_vdexpression'),
                                            array('class' => 'vdexpression-responsecomment'));
                $output .= $this->output_diagram_readonly($vdid . '_response', $vdstate);
            }
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
