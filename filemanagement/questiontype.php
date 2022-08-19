<?php

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/questionlib.php');
require_once($CFG->dirroot . '/question/engine/lib.php');
require_once($CFG->dirroot . '/question/type/filemanagement/question.php');

class qtype_filemanagement extends question_type
{
    public function save_question($question, $form)
    {
        return parent::save_question($question, $form);
    }
    public function save_question_options($question)
    {
        parent::save_question_options($question);

        global $DB;
        $options = $DB->get_record('qtype_filemanagement_options', array('questionid' => $question->id));
        if (!$options) {
            $options = new stdClass();
            $options->questionid = $question->id;
            $options->id = $DB->insert_record('qtype_filemanagement_options', $options);
        }

        $fs = get_file_storage();

        file_save_draft_area_files(
            $question->attachments,
            $question->context->id,
            'qtype_filemanagement',
            'attachments',
            $question->id,
            array('subdirs' => 0, 'maxbytes' => 420, 'maxfiles' => 1)
        );
    }

    public function get_question_options($question)
    {
        //TODO
        parent::get_question_options($question);
    }


    protected function initialise_question_instance(question_definition $question, $questiondata)
    {
        parent::initialise_question_instance($question, $questiondata);
    }

    public function initialise_question_answers(question_definition $question, $questiondata, $forceplaintextanswers = true)
    {
        //TODO
    }

    public function import_from_xml($data, $question, qformat_xml $format, $extra = null)
    {
        return 0;
    }


    public function get_random_guess_score($questiondata)
    {
        // TODO.
        return 0;
    }

    public function get_possible_responses($questiondata)
    {
        // TODO.
        return array();
    }
}
