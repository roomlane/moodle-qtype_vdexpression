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
 * Defines the editing form for the Venn diagram question type.
 *
 * @package    rs_questiontypes
 * @subpackage vdexpression
 * @author     immor@hot.ee
 * @copyright  &copy; 2012 Rommi Saar
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */ 

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/question/type/vdmarker/edit_vdmarker_form_base.php');

/**
 * Venn diagram expression question definition editing form.
 *
 * @copyright  2009 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_vdexpression_edit_form extends qtype_vdmarker_edit_form_base {

    public function qtype() {
        return 'vdexpression';
    }
    
    protected function definition_inner($mform) {
        parent::definition_inner($mform);
        
        $this->add_vd_fields($mform);
        
        $mform->addElement('text', 'vd_expression_maxlen', get_string('expression_max_len', 'qtype_vdexpression'),
                array('size' => 3));
        $mform->setType('vd_expression_maxlen', PARAM_INT);
        $mform->addHelpButton('vd_expression_maxlen', 'expression_max_len', 'qtype_vdexpression');
        
        $mform->addElement('text', 'vd_expression_chars', get_string('expression_allowed_chars', 'qtype_vdexpression'),
                array('size' => 12));
        $mform->setType('vd_expression_chars', PARAM_TEXT);
        $mform->addHelpButton('vd_expression_chars', 'expression_allowed_chars', 'qtype_vdexpression');
        $mform->setDefault('vd_expression_chars', qtype_vdmarker_vd3_expression::ALLOWED_CHARS);
        
        $this->add_combined_feedback_fields(true);

        $this->add_interactive_settings(true, true);
   }
  
}