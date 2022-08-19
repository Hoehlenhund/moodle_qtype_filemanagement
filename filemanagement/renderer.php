<?php

defined('MOODLE_INTERNAL') || die();


class qtype_filemanagement_renderer extends qtype_renderer
{
    public function formulation_and_controls(
        question_attempt $qa,
        question_display_options $options
    ) {

        $question = $qa->get_question();

        $questiontext = $question->format_questiontext($qa);

        $result = html_writer::tag('div', $questiontext, array('class' => 'qtext'));

        return $result;
    }

    public function specific_feedback(question_attempt $qa)
    {
        // TODO.
        return '';
    }

    public function correct_response(question_attempt $qa)
    {
        // TODO.
        return '';
    }
}
