<?php

include 'view/layout/nav_2.php';
?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="col-md-12">
        <div class="">
            <?php foreach ($detail as $item): ?>
                <div class="col">
                    <h5 class="card-title">Borrow Information</h5>
                    <p>ID: <?php echo $item->idBorrow ?></p>
                    <p>Borrow Date: <?php echo $item->borrowDate ?></p>
                    <p>Return Date: <?php echo $item->returnDate ?></p>
                    <p>Pay Date: <?php echo $item->payDate ?></p>
                    <p>&nbsp;</p>
                </div>
                <div class="col">
                    <h5 class="card-title">Student Information</h5>
                    <p>ID: <?php echo $item->idStudent ?></p>
                    <p>Name: <?php echo $item->nameStudent ?></p>
                    <p>Email: <?php echo $item->emailStudent ?></p>
                    <p>Phone: <?php echo $item->phoneStudent ?></p>
                </div>
                <?php break ?>
            <?php endforeach; ?>
        </div>
        <div class="">
            <h5 class="card-title">Borrow Book List</h5>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Author</th>
                    <th scope="col">Price</th>
                    <th scope="col">Category</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($detail as $item): ?>
                    <tr>
                        <th scope="row"><?php echo $item->idBook ?></th>
                        <td><img height="140" width="100" src="images/<?php echo $item->imageBook ?>"</td>
                        <td><?php echo $item->nameBook ?></td>
                        <td><?php echo $item->authorBook ?></td>
                        <td><?php echo $item->priceBook ?></td>
                        <td><?php echo $item->nameCategory ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
