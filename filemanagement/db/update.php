<?php

defined('MOODLE_INTERNAL') || die();

function xmldb_qtype_filemanagement_upgrade($oldversion)
{
    global $CFG, $DB;
    $dbman = $DB->get_manager();

    if ($oldversion < 2022081906) {

        // Define table qtype_filemanagement_options to be created.
        $table = new xmldb_table('qtype_filemanagement_options');

        // Adding fields to table qtype_filemanagement_options.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('questionid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);

        // Adding keys to table qtype_filemanagement_options.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);
        $table->add_key('questionid', XMLDB_KEY_FOREIGN_UNIQUE, ['questionid'], 'question', ['id']);

        // Conditionally launch create table for qtype_filemanagement_options.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Filemanagement savepoint reached.
        upgrade_plugin_savepoint(true, 2022081906, 'qtype', 'filemanagement');
    }
}
