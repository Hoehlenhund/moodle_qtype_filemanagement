<?php


defined('MOODLE_INTERNAL') || die();


class qtype_filemanagement_question extends question_graded_automatically_with_countback
{

    /* it may make more sense to think of this as get expected data types */
    public function get_expected_data()
    {
        // TODO.
        return array();
    }

    public function start_attempt(question_attempt_step $step, $variant)
    {
        //TODO
    }

    public function summarise_response(array $response)
    {
        // TODO.
        return null;
    }

    public function is_complete_response(array $response)
    {
        // TODO.
        /* You might want to check that the user has done something
            before returning true, e.g. clicked a radio button or entered some 
            text 
            */
        return true;
    }

    public function get_validation_error(array $response)
    {
        // TODO.
        return '';
    }


    public function is_same_response(array $prevresponse, array $newresponse)
    {
        // TODO.
        return false;
    }

    public function get_correct_response()
    {
        // TODO.        
        return array();
    }

    public function clear_wrong_from_response(array $response)
    {
        foreach ($response as $key => $value) {
            /*clear the wrong response/s*/
        }
        return $response;
    }

    public function check_file_access(
        $qa,
        $options,
        $component,
        $filearea,
        $args,
        $forcedownload
    ) {
        // TODO.
        if ($component == 'qtype_filemanagement' && $filearea == 'attachments') {
            return $this->check_hint_file_access($qa, $options, $args);
        } else {
            return parent::check_file_access(
                $qa,
                $options,
                $component,
                $filearea,
                $args,
                $forcedownload
            );
        }
    }

    public function grade_response(array $response)
    {
        // TODO.
        $fraction = 0;
        return array($fraction, question_state::graded_state_for_fraction($fraction));
    }

    public function compute_final_grade($responses, $totaltries)
    {
        return 0;
    }
}
