<?php

namespace BotTemplateFramework\Blocks;


use BotTemplateFramework\Prompt;
use BotTemplateFramework\Results\IntentResult;

class IntentBlock extends Block {

    const AMAZON_PROVIDER = "amazon";

    protected $provider;
    protected $content;

    /**
     * @var IntentResult
     */
    protected $result;
    protected $prompts;

    public function __construct($name) {
        parent::__construct($name);
        $this->type = 'intents';
    }

    public function provider($provider) {
        $this->provider = $provider;
        return $this;
    }

    public function content($text) {
        $this->content = $text;
        return $this;
    }

    public function result(IntentResult $result) {
        $this->result = $result;
        return $this;
    }

    /**
     * @param Block|Prompt[] $next
     * @return Block
     */
    public function next($next) {
        if ($next instanceof Block) {
            parent::next($next);
        } else {
            $this->prompts = $next;
        }

        return $this;
    }


    public function toArray() {
        $array = parent::toArray();
        $array['provider'] = $this->provider;
        $array['content'] = $this->content;

        if ($this->result) {
            $array['result'] = $this->result->toArray();
        }

        if ($this->prompts) {
            $array['next'] = [];
            foreach ($this->prompts as $prompt) {
                /** @var Prompt $prompt */
                $array['next'][$prompt->getText()] = $prompt->getNextBlock()->getName();
            }
        }

        return $array;
    }

}