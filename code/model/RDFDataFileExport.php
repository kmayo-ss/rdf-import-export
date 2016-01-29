<?php

/**
 * @author Kirk Mayo <kirk.mayo@solnet.co.nz>
 *
 * A data class representing a RDF export
 */

class RDFDataFileExport extends DataObject {
    private static $singular_name = 'RDF Data File Export';
    private static $plural_name = 'RDF Data Files Export';

    private static $db = array(
        'Title' => 'Varchar(45)',
        'Model' => 'Varchar'
    );

    private static $has_one = array(
        'File' => 'File'
    );

    private static $summary_fields = array(
        'Title',
        'Created'
    );

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $fields->removeByName('File');
   
        return $fields;
    }

    public function onAfterWrite() {
        parent::onAfterWrite();
        // create the RDF File
    }
}
