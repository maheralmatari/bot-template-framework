<?php

namespace BotTemplateFramework\Builder\Blocks;


class CarouselBlock extends ListBlock {

    public function __construct($name = null) {
        parent::__construct($name);
        $this->type = 'carousel';
    }

}