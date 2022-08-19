<?php

defined('MOODLE_INTERNAL') || die();


class backup_qtype_filemanagement_plugin extends backup_qtype_plugin
{

    protected static function qtype_name()
    {
        return 'filemanagement';
    }

    /**
     * Returns the qtype information to attach to question element
     */
    protected function define_question_plugin_structure()
    {
        $qtype = self::qtype_name();
        $plugin = $this->get_plugin_element(null, '../../qtype', $qtype);

        $pluginwrapper = new backup_nested_element($this->get_recommended_name());

        $plugin->add_child($pluginwrapper);

        $filemanagementoptions = new backup_nested_element(
            $qtype,
            array('id'),
            array()
        );

        $filemanagementoptions->set_source_table(
            'qtype_filemanagement_options',
            array('questionid' => backup::VAR_PARENTID)
        );

        return $plugin;
    }

    /**
     * Returns one array with filearea => mappingname elements for the qtype
     *
     * Used by {@link get_components_and_fileareas} to know about all the qtype
     * files to be processed both in backup and restore.
     */
    public static function get_qtype_fileareas()
    {
        $qtype = self::qtype_name();
        return array(
            'attachments' => 'qtype_filemanagement_options'
        );
    }
}
