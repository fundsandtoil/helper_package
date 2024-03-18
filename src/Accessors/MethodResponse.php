<?php

namespace FAT\Helper\Accessors;

class MethodResponse {

    private bool $status;
    private string $message;
    private mixed $data;
    private string $code;

    public function getStatus(): bool {
        return $this->status;
    }

    public function getMessage(): string {
        return $this->message;
    }

    public function getData(string $keyStr = null, mixed $default = null): mixed {

        if (is_null($keyStr)) {
            return $this->data;
        }

        return data_get($this->data, $keyStr, $default);
    }

    public function getDataArr(string $keyStr = null, mixed $default = []): array {

        if (is_null($this->data)) {
            return [];
        }

        $data = json_decode(json_encode($this->data), true);

        if (is_null($keyStr)) {
            return $data;
        }

        return data_get($data, $keyStr, $default);
    }

    public function toArray(): array {
        return [
            "status" => $this->getStatus(),
            "message" => $this->getMessage(),
            "data" => $this->getDataArr(),
            "code" => $this->getCode()
        ];
    }

    public function getCode(): string {
        return $this->code;
    }

    public function setStatus(bool $status) {
        $this->status = $status;
        return $this;
    }

    public function setMessage(string $message) {
        $this->message = $message;
        return $this;
    }

    public function setData(mixed $data) {
        $this->data = $data;
        return $this;
    }

    public function setCode(string $code) {
        $this->code = $code;
        return $this;
    }

}
