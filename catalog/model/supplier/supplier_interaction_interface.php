<?php

/**
 * Interface SupplierInteractionInterface
 * Этот интерфейс должны реализовывать все классы взаимодействия с серверами поставщиков.
 */
interface SupplierInteractionInterface {

    /**
     * Добавляет в БД opencart новый товар
     * @param array $data массив, предсавляющей собой стркутру продукта в opencart
     * @return mixed
     */
    public function addPartToCatalog($data);

    /**
     * Удаляет из БД opencart товар
     * @return mixed
     */
    public function deletePartFromCatalog();


    /**
     * Обновляет товар в БД - прежде всего цену, а также возможно другие аттрибуты
     * У каждого товара должен быть уникальный ID, который есть на сервере поставщика и у нас в БД.
     * По этому ID мы можем сделать вывод, что товар уже есть у нас в БД, и обновлять его,
     * а не добавлять новый каждый раз при поиске или иный действиях.
     * @param array $product_data массив данных о продукте.
     * @return mixed
     */
    public function updatePartInCatalog($product_data);

    /**
     * Возвращает данные о товаре, полученные от поставщика
     * @param $search_str
     * @return mixed
     */
    public function getPartData($search_str);

    /**
     * Возвращает стуктуру продукта в виде массива, используемого внутри opencart
     * @param $product - объект (массив) продукта, полученный от поставщика
     * @return array
     */
    public function getProductItem($product);

}