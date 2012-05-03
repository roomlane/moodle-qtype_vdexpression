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

require_once($CFG->dirroot . '/question/type/vdmarker/expression.php');

// required by qtype standard
$string['addingvdexpression'] = 'Venn\'i diagramm avaldiseks küsimuse lisamine';
$string['editingvdexpression'] = 'Venn\'i diagramm avaldiseks küsimuse muutmine';
$string['vdexpression'] = 'Venn\'i diagramm avaldiseks';
$string['vdexpressionsummary'] = 'Koostada hulgateooria avaldis ette antud Venn\'i diagrammi põhjal';
$string['vdexpression_help'] = 'Õpetaja kirjutab ülesande teksti ning defineerib õige vastuse Venn\'i diagrammil vastavad piirkonnad märgituks valides. Õpilane koostab nähtud diagrammi põhjal hulgateooria avaldise';

// other
$string['default_question_text'] = 'Koostada nähtud Venn\'i diagrammi põhjal hulgateooria avaldis. Soovitatav on kopeerida märgid lubatud tähemärkide nimekirjast.'; // this text will appear initially in the question text field for teacher
$string['corresponds_to_diagram'] = 'See avaldis vastab järgnevale Venn\'i diagrammile:';
$string['expression_max_len'] = 'Maksimaalne avaldise pikkus';
$string['expression_max_len_help'] = 'Maksimaalne avaldise pikkus. Vähem kui 1 tähendab, et ei ole piirangut.';
$string['expression_allowed_chars'] = 'Lubatud tähemärgid';
$string['expression_allowed_chars_help'] = 'Avaldises lubatud tähemärgid. Kõike peale ' . qtype_vdmarker_vd3_expression::get_chars_formatted(qtype_vdmarker_vd3_expression::ALLOWED_CHARS) . ' eiratakse. Tühi lahter tähendab, et piirangut pole.';
