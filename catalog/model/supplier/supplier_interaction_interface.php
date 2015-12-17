<?php

interface SupplierInteractionInterface {

    public function addPartToCatalog();

    public function deletePartFromCatalog();

    public function updatePartInCatalog();

    public function getPartData($supplier);

}