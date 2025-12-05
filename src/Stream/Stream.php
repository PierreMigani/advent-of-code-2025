<?php

namespace Stream;

use Psr\Http\Message\StreamInterface;

class Stream implements StreamInterface {
    public function __construct(
        private string $content = '',
    ) {}

    public function __toString() {
        return $this->content;
    }

    public function close() {
        $this->content = '';
    }

    public function detach() {
        $content = $this->content;
        $this->content = '';
        return $content;
    }

    public function getSize() {
        return strlen($this->content);
    }

    public function tell() {
        return 0;
    }

    public function eof() {
        return true;
    }

    public function isSeekable() {
        return false;
    }

    public function seek($offset, $whence = SEEK_SET) {
        return false;
    }

    public function rewind() {
        return false;
    }

    public function isWritable() {
        return false;
    }

    public function write($string) {
        return false;
    }

    public function isReadable() {
        return false;
    }

    public function read($length) {
        return false;
    }

    public function getContents() {
        return $this->content;
    }

    public function getMetadata($key = null) {
        return [];
    }
}
