<?php include_once 'helpers.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API calling Service</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    
<div class="container">
    <div class="row mt-4">
        <div class="col">
            <form action="submit.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="api">Select API</label>
                  <select class="form-control" id="api" name="api">
                    <option>--</option>
                    <option>Validifiv3-fi-risk-index</option>
                    <option>Validifiv3-account-validation</option>
                    <option>Validifiv3-pi-risk4-individual</option>
                  </select>
                </div>
                <button type="submit" class="btn btn-primary mt-2" name="submit">Submit</button>
              </form>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col">
        <?php echo display_response(); ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>
</html>