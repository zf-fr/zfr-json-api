# json-api

[![Build Status](https://travis-ci.org/zf-fr/zfr-json-api.svg)](https://travis-ci.org/zf-fr/zfr-json-api)

Library to create and manipulate JSON.API compliant payload


<?php

$document   = new Document();
$serializer = new PostSerializer();

$document->push($object, $serializer);
