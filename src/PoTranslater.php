<?php


namespace PoTranslater;
use Sepia\FileHandler;
use Sepia\PoParser;
use Stichoza\GoogleTranslate\TranslateClient;

class PoTranslater {
    public $source;
    public $target;
    public $poFile;
    public $poParser;
    public $entries;

    public function setEntries($entries) {
        $this->entries = $entries;
        return $this;
    }
    public function setSource($source) {
        $this->source = $source;
        return $this;
    }
    public function getSource() {
        return $this->source;
    }
    public function setTarget($target) {
        $this->target = $target;
        return $this;
    }
    public function getTarget() {
        return $this->target;
    }

    public function getEntries() {
        return $this->entries;
    }

    public function setPoFile($file) {
        $this->poFile = $file;
        return $this;
    }

    public function getPoFile() {
        return $this->poFile;
    }

    public function parse() {
        $fileHandler    = new FileHandler($this->getPoFile());
        $this->poParser = new PoParser($fileHandler);
        $this->setEntries($this->poParser->parse());
        return $this;
    }

    public function translate() {
        $entries = $this->getEntries();
        foreach ($entries as $msgid => $value) {
            $text                      = current($value['msgstr']);
            $msgstr                    = $this->_translate($text);
            $entries[$msgid]['msgstr'] = $msgstr;
            $this->poParser->setEntry($msgid, $entries[$msgid]);
        }
        return $this;
    }

    public function save($output = 'temp') {
        $this->poParser->writeFile($output . '.po');
        return $this;
    }

    public function _translate($text) {
        $tr = new TranslateClient();
        $tr->setSource($this->getSource());
        $tr->setTarget($this->getTarget());
        return $tr->translate($text);
    }
}