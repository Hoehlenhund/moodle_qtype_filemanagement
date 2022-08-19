<?php

defined('MOODLE_INTERNAL') || die();


class qtype_filemanagement_edit_form extends question_edit_form
{
    public function qtype()
    {
        return 'filemanagement';
    }

    protected function definition_inner($mform)
    {
        $mform->addElement(
            'filemanager',
            'attachments',
            get_string('attachment', 'qtype_filemanagement'),
            null,
            array('subdirs' => 0, 'maxbytes' => 420, 'maxfiles' => 1, 'accepted_types' => array('pdf'), 'return_types' => FILE_INTERNAL | FILE_EXTERNAL)
        );

        parent::definition_inner($mform);
    }

    public static function file_manager_options()
    {
        $filemanageroptions = array();
        $filemanageroptions['accepted_types'] = array('pdf');
        $filemanageroptions['maxbytes'] = 0;
        $filemanageroptions['maxfiles'] = 1;
        $filemanageroptions['subdirs'] = 0;
        return $filemanageroptions;
    }

    public function data_preprocessing($question)
    {

        $question = parent::data_preprocessing($question);

        // Initialise file picker for bgimage.
        $draftitemid = file_get_submitted_draft_itemid('attachments');

        file_prepare_draft_area(
            $draftitemid,
            $this->context->id,
            'qtype_filemanagement',
            'attachments',
            !empty($question->id) ? (int) $question->id : null,
            self::file_manager_options()
        );

        $question->attachments = $draftitemid;

        return $question;
    }
}
