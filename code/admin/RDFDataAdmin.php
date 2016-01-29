<?php

/**
 * @author Kirk Mayo <kirk.mayo@solnet.co.nz>
 *
 * A Model admin for importing and exporting data
 */

class RDFDateFileUploadAdmin extends ModelAdmin {
    private static $managed_models = array(
        'RDFDataFileUpload',
        'RDFDataFileExport'
    );

    private static $url_segment = 'rdf';

    private static $menu_title = 'RDF Admin';
}
