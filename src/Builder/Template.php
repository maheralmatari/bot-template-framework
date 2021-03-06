<?php

namespace BotTemplateFramework\Builder;

use BotTemplateFramework\Builder\Blocks\Block;
use BotTemplateFramework\Builder\Drivers\Driver;

class Template implements \JsonSerializable {

    protected $name;

    protected $blocks = [];

    protected $drivers = [];

    protected $options = [];

    protected $fallback;

    protected  $locale;

    public function __construct($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function addBlocks(array $blocks) {
        $this->blocks = array_merge($this->blocks, $blocks);
        return $this;
    }

    public function getBlocks() {
        return $this->blocks;
    }

    public function addDrivers(array $drivers) {
        $this->drivers = array_merge($this->drivers, $drivers);
        return $this;
    }

    public function getDrivers() {
        return $this->drivers;
    }

    public function addOption($key, $value) {
        $this->options[$key] = $value;
    }

    /**
     * @param string|Block|array $message
     * @return $this
     */
    public function fallback($message) {
        $this->fallback = $message;
        return $this;
    }

    public function locale($locale){
        $this->locale = $locale;
        return $this;
    }

    public function jsonSerialize() {
        return $this->toArray();
    }

    public function toArray() {
        $array = [
            'name' => $this->name,
            'fallback' => $this->fallback instanceof Block ? [
                'type' => 'block',
                'name' => $this->fallback->getName()
            ] : $this->fallback,
            'blocks' => array_map(function (Block $block) {
                return $block->jsonSerialize();
            }, $this->blocks),
            'drivers' => array_map(function (Driver $driver) {
                return $driver->jsonSerialize();
            }, $this->drivers),
            'options' => $this->options
        ];

        if ($this->locale) {
            $array['locale'] = $this->locale;
        }

        return $array;
    }

}