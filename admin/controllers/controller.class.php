<?php
abstract class AbstractController {
    abstract function addLine(AbstractModel $model);
    abstract function updateLine(AbstractModel $model);
    abstract function deleteLine(AbstractModel $model);
}