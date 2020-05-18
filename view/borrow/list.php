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
            <form class="classNameHere" role="search">
                <input type="hidden" name="pages" value="borrow">
                <input type="hidden" name="actions" value="search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search" name="keyword" id="srch-term">
                    <div class="input-group-btn">
                        <button class="btn btn-success" type="submit"><i class="glyphicon glyphicon-search"></i>
                        </button>
                    </div>
                    <div class="input-group-btn">
                        <a href="index.php?pages=borrow&actions=add" class="btn btn-success btn-sm"
                           style="margin-left: 770px">Thêm mới</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="">
            <div class="card">
                <table class="table table-hover shopping-cart-wrap">
                    <thead class="text-muted">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">ID Student</th>
                        <th scope="col">Borrow Date</th>
                        <th scope="col">Return Date</th>
                        <th scope="col">Pay Date</th>
                        <th scope="col">Status</th>
                        <th scope="col" width="200" class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <a href="#">
                        <?php foreach ($borrows as $borrow): ?>
                        <?php if($borrow->status == 'Borrow'):?>
                            <tr>
                                <td><a href="index.php?pages=borrow&actions=detail&id=<?php echo $borrow->id ?>"><?php echo $borrow->id ?></a></td>
                                <td><?php echo $borrow->student_id ?></td>
                                <td><?php echo $borrow->borrow_date ?></td>
                                <td><?php echo $borrow->return_date ?></td>
                                <td><?php echo $borrow->pay_date ?></td>
                                <td><?php echo $borrow->status ?></td>
                                <td class="text-right">
                                    <a title=""
                                       href="index.php?pages=borrow&actions=edit&id=<?php echo $borrow->id; ?>"
                                       class="btn btn-success btn-sm">Edit</a>
                                </td>
                            </tr>
                        <?php else: ?>
                        <tr>
                            <td><a href="index.php?pages=borrow&actions=detail&id=<?php echo $borrow->id ?>"><?php echo $borrow->id ?></a></td>
                            <td><?php echo $borrow->student_id ?></td>
                            <td><?php echo $borrow->borrow_date ?></td>
                            <td><?php echo $borrow->return_date ?></td>
                            <td><?php echo $borrow->pay_date ?></td>
                            <td><?php echo $borrow->status ?></td>
                            <td class="text-right">
                                <a href="index.php?pages=borrow&actions=delete&id=<?php echo $borrow->id; ?>"
                                   class="btn btn-danger btn-sm"> × Remove</a>
                            </td>
                        </tr>
                        <?php endif;?>
                        <?php endforeach; ?>
                    </a>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
        if (isset($_REQUEST['keyword'])) {
            echo 'Tìm thấy ' . count($borrows) . ' kết quả';
        }
        ?>
    </div>
</div>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>