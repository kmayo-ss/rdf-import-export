<?php

/**
 * @author Kirk Mayo <kirk.mayo@solnet.co.nz>
 *
 * A data class representing a RDF upload
 */

class RDFDataFileUpload extends DataObject {
    private static $singular_name = 'RDF Data File';
    private static $plural_name = 'RDF Data Files';

    private static $db = array(
        'Title' => 'Varchar(45)',
        'Status' => "Enum('Unprocessed, Proccessed', 'Unprocessed')",
        'ProcessFile' => 'Boolean'
    );

    private static $has_one = array(
        'File' => 'File'
    );

    private static $summary_fields = array(
        'Title',
        'Status'
    );

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $upload = UploadField::create('File', 'File');
        $upload->setValidator(new MimeUploadValidator());
        $upload->setAllowedExtensions(array('txt', 'xml'));

        $fields->replaceField('File', $upload);
        $fields->removeByName('Status');

        if (!$this->File()->exists()) {
            $note = HeaderField::create(
                'ProcessFileNote',
                'You need need to attach  a file and save the record before the file can be processed'
            );
            $fields->replaceField('ProcessFile', $note);
        }

        return $fields;
    }

    public function onBeforeWrite() {
        parent::onBeforeWrite();
        if ($this->File()->ID && $this->ProcessFile) {
            $ret = processRDF::processFile($this->File()->getFullPath());
Debug::Dump($ret); exit;
        }
        $this->ProcessFile = null;
    }
}

class RDFDateFileUploadAdmin extends ModelAdmin {
    private static $managed_models = array(
        'RDFDataFileUpload'
    );

    private static $url_segment = 'rdf';

    private static $menu_title = 'RDF Upload Admin';
}
