<?php

namespace App\Http\Helpers;

trait TransactionFilter
{
    private function filterTransactions(array $data): array
    {
        return array_map(function ($item) {
            $item['check'] = ($item['check'] == "") ? null : trim($item['check']);
            $item['description'] = trim($item['description']);
            $item['amount'] = (float) str_replace(['-$', '$', ','], ['-', '', ''], $item['amount']);
            $item['date'] = date('Y-m-d', strtotime($item['date']));
            return $item;
        }, $data);
    }
}
