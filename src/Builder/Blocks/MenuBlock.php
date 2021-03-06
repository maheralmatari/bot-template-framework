<?php

namespace BotTemplateFramework\Builder\Blocks;


use BotTemplateFramework\Builder\Button;

class MenuBlock extends Block {
    protected $buttons;

    protected $text;

    protected $quickMode;

    public function __construct($name = null) {
        parent::__construct('menu', $name);
    }

    public function text($text) {
        $this->text = $text;
        return $this;
    }

    /**
     * @param Button[] $buttons
     * @return ImageBlock
     */
    public function buttons($buttons) {
        $this->buttons = $buttons;
        return $this;
    }

    public function quickMode() {
        $this->quickMode = true;
    }

    public function toArray() {
        $array = parent::toArray();

        $content = [
            'text' => $this->text
        ];

        if ($this->quickMode) {
            $content['mode'] = 'quick';
        }

        if ($this->buttons) {
            $content['buttons'] = [];
            $content['buttons'][] = [];
            foreach ($this->buttons as $button) {
                /** @var Button $button */
                $content['buttons'][0][$button->getCallback()] = $button->getTitle();
            }
        }

        $array['content'] = $content;

        return $array;
    }

}