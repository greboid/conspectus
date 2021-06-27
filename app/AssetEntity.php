<?php

class AssetEntity extends EntityObject {
    private $class_id = null;
    private $class = null;
    private $closed = null;
    private $excluded = null;

    public function __construct(&$data) {
        $this->id = $data['id'];
        $this->description = $data['description'];
        $this->class_id = $data['class_id'];
        $this->class = $data['class'];
        $this->closed = $data['closed'];
        $this->excluded = $data['excluded'];
    }

    public function getClass() {
        return $this->class;
    }

    public function getClassID() {
        return $this->class_id;
    }

    public function isClosed() {
        return $this->closed;
    }

    public function isExcluded() {
        return $this->excluded;
    }
}