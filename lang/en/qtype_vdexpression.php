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
 * The language strings for the Venn diagram question type.
 *
 * @package    rs_questiontypes
 * @subpackage vdexpression
 * @author     immor@hot.ee
 * @copyright  &copy; 2012 Rommi Saar
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */ 

// required by qtype standard
$string['addingvdexpression'] = 'Adding Venn diagram to expression.';
$string['editingvdexpression'] = 'Editing Venn diagram to expression.';
$string['vdexpression'] = 'Venn diagram to expression';
$string['vdexpressionsummary'] = 'Construct set theory expression according to shown Venn diagram.';
$string['vdexpression_help'] = 'Teacher can define the question text and correct answer as a Venn diagram. Student has to produce a set theory formual according to the shown Venn diagram.';

// other
$string['default_question_text'] = 'Construct a set theory expression according to the shown Venn\'s diagram. You can copy-paste the valid characters.'; // this text will appear initially in the question text field for teacher
$string['corresponds_to_diagram'] = 'This expression corresponds to the following Venn diagram:';
$string['expression_max_len'] = 'Expression max. length';
$string['expression_max_len_help'] = 'Expression max. allowed length. Anything below 1 means unlimited.';
$string['expression_allowed_chars'] = 'Allowed characters';
$string['expression_allowed_chars_help'] = 'Allowed characters in expression. Anyting other than (∅ABCU∩∪\\Δ\') is ignored. Leave empty for no limits.';
