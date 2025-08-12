<?php

namespace App\Http\Controllers;

use App\Http\Helpers\TransactionFilter;
use App\Http\Requests\AddTransactionsFileRequest;
use App\Models\Transaction;
use App\Providers\View;

class TransactionController
{
    use TransactionFilter;

    public function index()
    {
        $transactions = Transaction::all();
        View::render('index', compact('transactions'));
    }

    /*----------------------------------------------------------------------------------------------*/

    public function upload()
    {
        $request = new AddTransactionsFileRequest();
        $errors = $request->validate();

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            header('Location: /');
            exit;
        }

        // looping through the uploaded CSV file to extract transaction data
        $file = $_FILES['file']['tmp_name'];

        $transactions = [];
        if (($handle = fopen($file, 'r')) !== false) {
            $data = fgetcsv($handle);
            while (($data = fgetcsv($handle)) !== false) {
                $transactions[] = [
                    'check' => $data[1],
                    'description' => $data[2],
                    'amount' => $data[3],
                    'date' => $data[0],
                ];
            }
            fclose($handle);

            $transactions = $this->filterTransactions($transactions);
            Transaction::insert($transactions);
        } else {
            $_SESSION['errors'] = ['Failed to open uploaded file.'];
            header('Location: /');
            exit;
        }

        header('Location: /');
        exit;
    }
}
