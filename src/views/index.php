<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light py-4">

    <div class="container">
        <h1 class="mb-4 text-center">Transactions</h1>

        <!-- Upload Form -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data" class="d-flex gap-2">
                    <input type="file" name="file" id="file" class="form-control">
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
        </div>

        <!-- Transactions Table -->
        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Check</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($safeParams->transactions)): ?>
                            <tr>
                                <td colspan="5" class="text-center py-4">No transactions available.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($safeParams->transactions as $transaction): ?>
                                <tr>
                                    <td><?= htmlspecialchars($transaction->id) ?></td>
                                    <td><?= ($transaction->check) ? htmlspecialchars($transaction->check) : 'N/A' ?></td>
                                    <td><?= htmlspecialchars($transaction->description) ?></td>
                                    <td class="text-end <?= ($transaction->amount < 0) ? 'text-danger' : 'text-success' ?>"><?= number_format((float)$transaction->amount, 2) ?></td>
                                    <td><?= htmlspecialchars(date('M j, Y', strtotime($transaction->date))) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>