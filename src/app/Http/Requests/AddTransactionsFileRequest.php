<?php

namespace App\Http\Requests;

class AddTransactionsFileRequest
{
    public function validate(): array
    {
        $errors = [];

        if (empty($_FILES['file']['name'])) {
            $errors[] = 'File is required.';
        } elseif ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            $errors[] = 'File upload error: ' . $_FILES['file']['error'];
        } elseif ($_FILES['file']['size'] > 5000000) {
            $errors[] = 'File size exceeds limit of 5MB.';
        } elseif (!in_array($_FILES['file']['type'], ['text/csv'])) {
            $errors[] = 'Invalid file type. Only CSV files are allowed.';
        }

        return $errors;
    }
}