<?php

class RecordRefererComponent extends Object {

    private $models = array();

    public function findByModelNameAndRefName($modelName, $refName) {
        if (!array_key_exists($modelName, $this->models)) {
            $this->models[$modelName] = ClassRegistry::init($modelName);
        }

        $conditions = array($modelName . '.ref_name' => $refName);
        $result = $this->models[$modelName]->find('first', array('conditions' => $conditions));

        return $result;
    }

    public function getIdByModelNameAndRefName($modelName, $refName) {
        $result = $this->findByModelNameAndRefName($modelName, $refName);
        $id = $result[$modelName]['id'];

        return $id;
    }

}
