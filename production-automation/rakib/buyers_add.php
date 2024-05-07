<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">

            <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST">

                <div class="card-body">
                    <div class="row">
                        <input type="hidden" name="action" value="save_buyers">

                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Name : </label>
                                <input type="text" name="name" class="form-control" placeholder="name">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Email : </label>
                                <input type="text" name="email" class="form-control" placeholder="email">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Phone : </label>
                                <input type="text" name="phone" class="form-control" placeholder="Phone">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Address : </label>
                                <input type="text" name="address" class="form-control" placeholder="Address">
                            </div>
                        </div>

                    </div>
                </div><br><br>
                <div class="card-footer">
                <a href="<?php echo esc_url('admin.php?page=rakib_buyers') ?>" class="btn btn-primary">Cancle</a>
                <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </form>
        </div>
    </section>
</div>