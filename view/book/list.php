<?php

include 'view/layout/nav_2.php';
?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<div class="container">
    <div class="col-md-12">
        <div class="">
            <form class="classNameHere" role="search">
                <input type="hidden" name="pages" value="book">
                <input type="hidden" name="actions" value="search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search" name="keyword" id="srch-term">
                    <div class="input-group-btn">
                        <button class="btn btn-success" type="submit"><i class="glyphicon glyphicon-search"></i>
                        </button>
                    </div>
                    <div class="input-group-btn">
                        <a href="index.php?pages=book&actions=add" class="btn btn-success btn-sm"
                           style="margin-left: 590px">Thêm mới</a>
                    </div>
                </div>
            </form>
        </div>

        <div class="">
            <div class="card">
                <table class="table table-hover shopping-cart-wrap">
                    <thead class="text-muted">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Author</th>
                        <th scope="col">Category</th>
                        <th scope="col">Amount</th>
                        <th scope="col" width="200" class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <a href="#">
                        <?php foreach ($books as $book): ?>
                            <tr>
                                <td><?php echo $book->id ?></td>
                                <td>
                                    <h6 class="title text-truncate"><img width="70" height="100" src="images/<?php echo $book->image ?>"></h6>
                                </td>
                                <td>
                                    <div class="price-wrap">
                                        <var class="price"><?php echo $book->name ?></var>
                                    </div>
                                </td>
                                <td>
                                    <div class="price-wrap">
                                        <var class="price"><?php echo $book->author ?></var>
                                    </div>
                                </td>
                                <td>
                                    <div class="price-wrap">
                                        <var class="price"><?php echo $book->nameCategory ?></var>
                                    </div>
                                </td>
                                <td>
                                    <div class="price-wrap">
                                        <var class="price"><?php echo $book->number_of_books ?></var>
                                    </div>
                                </td>
                                <td class="text-right">
                                    <a title="" href="index.php?pages=book&actions=edit&id=<?php echo $book->id; ?>"
                                       class="btn btn-success btn-sm">Edit</a>
                                    <a href="index.php?pages=book&actions=delete&id=<?php echo $book->id; ?>"
                                       class="btn btn-danger btn-sm"> × Remove</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </a>
                    </tbody>
                </table>
                <?php
                if (isset($_REQUEST['keyword'])) {
                    echo 'Tìm thấy ' . count($books) . ' kết quả';
                }
                ?>
            </div>
        </div> <!-- card.// -->
    </div>
</div>
<!--container end.//-->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>