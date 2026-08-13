<?php

namespace PishroPayamak\Sms\Methods;

trait PhonebookMethods
{
    /**
     * دریافت لیست دفترچه‌های تلفن
     */
    public function getPhonebooks(?string $name = null): array
    {
        $params = [];
        if ($name) $params['name'] = $name;

        return $this->sendRequest('/my/phonebook', $params);
    }

    /**
     * دریافت شماره‌های یک دفترچه
     */
    public function getPhonebookNumbers(int $bookId): array
    {
        return $this->sendRequest('/phonebook/number', [
            'book_id' => $bookId
        ]);
    }

    /**
     * ایجاد دفترچه تلفن جدید
     */
    public function createPhonebook(string $name, array $numbers, string $flag): array
    {
        return $this->sendRequest('/phonebook/new', [
            'name' => $name,
            'numbers' => $numbers,
            'flag' => $flag
        ]);
    }

    /**
     * حذف دفترچه تلفن
     */
    public function deletePhonebook(int $bookId): array
    {
        return $this->sendRequest('/phonebook/delete', [
            'book_id' => $bookId
        ], 'DELETE');
    }

    /**
     * افزودن شماره به دفترچه
     */
    public function addToPhonebook(int $bookId, array $numbers, ?string $flag = null): array
    {
        $params = ['book_id' => $bookId, 'numbers' => $numbers];
        if ($flag) $params['flag'] = $flag;

        return $this->sendRequest('/phonebook/number/add', $params);
    }

    /**
     * حذف شماره از دفترچه
     */
    public function removeFromPhonebook(int $bookId, array $numbers, ?string $flag = null): array
    {
        $params = ['book_id' => $bookId, 'numbers' => $numbers];
        if ($flag) $params['flag'] = $flag;

        return $this->sendRequest('/phonebook/number/delete', $params, 'DELETE');
    }
}