<?php

class ProcessRDF extends Controller {

    public static function processFile($file) {
        $rdf = new EasyRdf_Graph();
        $rdf->parseFile($file);
        return $rdf->toRdfPhp();
    }
}
