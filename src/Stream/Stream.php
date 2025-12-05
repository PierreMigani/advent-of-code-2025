<?php

namespace Stream;

use Psr\Http\Message\StreamInterface;

class Stream implements StreamInterface {
    public function __construct(
        private string $content = '',
    ) {}

    public function __toString(): string {
        return $this->content;
    }

    public function close(): void {
        $this->content = '';
    }

    public function detach(): mixed {
        $content = $this->content;
        $this->content = '';
        return $content;
    }

    public function getSize(): ?int {
        return strlen($this->content);
    }

    public function tell(): int {
        return 0;
    }

    public function eof(): bool {
        return true;
    }

    public function isSeekable(): bool {
        return false;
    }

    public function seek(int $offset, int $whence = SEEK_SET): void {
        // Not seekable
    }

    public function rewind(): void {
        // Not seekable
    }

    public function isWritable(): bool {
        return false;
    }

    public function write(string $string): int {
        return 0;
    }

    public function isReadable(): bool {
        return false;
    }

    public function read(int $length): string {
        return '';
    }

    public function getContents(): string {
        return $this->content;
    }

    public function getMetadata(?string $key = null): mixed {
        return $key === null ? [] : null;
    }
}
