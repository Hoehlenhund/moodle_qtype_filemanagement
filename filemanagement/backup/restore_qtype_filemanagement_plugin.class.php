<?php

defined('MOODLE_INTERNAL') || die();


class restore_qtype_filemanagement_plugin extends restore_qtype_plugin
{

    protected static function qtype_name()
    {
        return 'filemanagement';
    }

    protected function define_question_plugin_structure()
    {

        $paths = array();

        // Add own qtype stuff.
        $elename = 'filemanagementoptions';
        $elepath = $this->get_pathfor('/' . self::qtype_name());
        $paths[] = new restore_path_element($elename, $elepath);

        return $paths; // And we return the interesting paths.
    }


    public function process_filemanagementoptions($data)
    {
        global $DB;

        $prefix = 'qtype_' . self::qtype_name();

        $data = (object)$data;
        $oldid = $data->id;

        // Detect if the question is created or mapped.
        $oldquestionid   = $this->get_old_parentid('question');
        $newquestionid   = $this->get_new_parentid('question');
        $questioncreated = $this->get_mappingid('question_created', $oldquestionid) ? true : false;

        // If the question has been created by restore
        // we need to create its qtype_filemanagement too.
        if ($questioncreated) {
            // Adjust some columns.
            $data->questionid = $newquestionid;
            // Insert record.
            $newitemid = $DB->insert_record($prefix, $data);
            // Create mapping (needed for decoding links).
            $this->set_mapping($prefix, $oldid, $newitemid);
        }
    }
}
