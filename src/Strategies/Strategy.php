<?php

namespace BotTemplateFramework\Strategies;

use \BotMan\BotMan\BotMan;

abstract class Strategy implements IStrategy, IComponentsStrategy {
    /** @var BotMan IComponentsStrategy */
    protected $bot;
    /** @var  IComponentsStrategy */
    protected $componentsStrategy;

    public function __construct(BotMan $bot) {
        $this->bot = $bot;
    }

    /**
     * @return BotMan
     */
    public function getBot() {
        return $this->bot;
    }

    public function setComponentsStrategy(IComponentsStrategy $componentsStrategy) {
        $this->componentsStrategy = $componentsStrategy;
        return $this;
    }

    /**
     * @param $message
     * @param array $additionalParameters
     * @return mixed
     */
    public function reply($message, $additionalParameters = []) {
        return $this->bot->reply($message, $additionalParameters);
    }

    //-------------Components

    public function sendImage($imageUrl, $text = null) {
        $this->componentsStrategy->sendImage($imageUrl, $text);
    }

    public function sendMenu($text, array $markup) {
        $this->componentsStrategy->sendMenu($text, $markup);
    }

    public function sendMenuAndImage($imageUrl, $text, array $markup) {
        $this->componentsStrategy->sendMenuAndImage($imageUrl, $text, $markup);
    }

    public function sendText($text) {
        $this->componentsStrategy->sendText($text);
    }

    public function sendList(array $elements, array $globalButton = null) {
        $this->componentsStrategy->sendList($elements, $globalButton);
    }

    public function sendCarousel(array $elements) {
        $this->componentsStrategy->sendCarousel($elements);
    }

    public function sendQuickButtons($text, array $markup) {
        $this->componentsStrategy->sendQuickButtons($text, $markup);
    }

    public function sendAudio($url, $text = null) {
        $this->componentsStrategy->sendAudio($url, $text);
    }

    public function sendVideo($url, $text = null) {
        $this->componentsStrategy->sendVideo($url, $text);
    }

    public function sendFile($url, $text = null) {
        $this->componentsStrategy->sendFile($url, $text);
    }

    public function requireLocation($text) {
        $this->componentsStrategy->requireLocation($text);
    }

    public function requirePhonePayload($text) {
        // TODO: Implement requirePhonePayload() method.
        return null;
    }

    public function requireEmailPayload($text) {
        // TODO: Implement requireEmailPayload() method.
        return null;
    }


    /**
     * This method needed for Telegram Carousel component. When override Telegram Strategy with custom one,
     * this method should be present in there.
     *
     * @param BotMan $bot
     * @param $messageId
     * @param $element
     */
    public function carouselSwitch(BotMan $bot, $messageId, $element) {
        if ($this->bot->getDriver() instanceof \BotMan\Drivers\Telegram\TelegramDriver) {
            $this->componentsStrategy->carouselSwitch($bot, $messageId, $element);
        }
    }

}