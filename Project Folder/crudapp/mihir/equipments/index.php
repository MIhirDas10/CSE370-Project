<div class="scroll-bg">
    <div>
        <div class="scroll-object">

            <?php include("header.php");?>
            <?php include("dbcon.php");?>
                <div class="box-1">
                <h2>Equipment</h2>
                <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    ADD Staffs
                </button> -->
                </div>

                <?php if (isset($_GET['insert_msg'])): ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert" style="text-align: center;">
                        <strong>Message: </strong> <?php echo htmlspecialchars($_GET['insert_msg']); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if (isset($_GET['message'])): ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert" style="text-align: center;">
                        <strong>Message: </strong> <?php echo htmlspecialchars($_GET['message']); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if (isset($_GET['update_msg'])): ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert" style="text-align: center;">
                        <strong>Message: </strong> <?php echo htmlspecialchars($_GET['update_msg']); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if (isset($_GET['delete_msg'])): ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert" style="background: #d65a44; color: azure; text-align: center;">
                        <strong>Message: </strong> <?php echo htmlspecialchars($_GET['delete_msg']); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                
                

                <table id="table-section" class="table table-hover table-bordered table-striped" style="text-align: center;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Quantity</th>
                            <th>Vendor</th>
                            <th>Description</th>
                            <th>Address</th>
                            <th>Contact</th>
                            <th>Date</th>
                            
                            <!-- <th>View</th> -->
                            <!-- <th>Update</th> -->
                            <!-- <th>Delete</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $query = "SELECT * FROM `equipment`";

                        $result = mysqli_query($connection, $query);

                        if(!$result){
                            die("query failed".mysqli_error($connection));
                        }
                        else{
                            while($row = mysqli_fetch_assoc($result)){
                            ?>
                            
                                <tr>
                                    <td><?php echo $row['id']?></td>
                                    <td><?php echo $row['name']?></td>
                                    <td><?php echo $row['amount']?></td>
                                    <td><?php echo $row['quantity']?></td>
                                    <td><?php echo $row['vendor']?></td>
                                    <td><?php echo $row['description']?></td>
                                    <td><?php echo $row['address']?></td>
                                    <td><?php echo $row['contact']?></td>
                                    <td><?php echo $row['date']?></td>
                                    <!-- <td><a href="view_page_2.php?id=<?php echo $row['id']?>" class="btn btn-secondary"><i class="bi bi-eye" style="padding: 4px;"></i></a></td> -->
                                    <!-- <td><a href="update_page_1.php?id=<?php echo $row['id']?>" class="mybtn1 btn btn-light btn-small"><i class="bi bi-pencil" style="padding: 4px;"></i></a></td>
                                    <td><a href="delete_page.php?id=<?php echo $row['id']?>" class="mybtn2 btn btn-light btn-small"><i class="bi bi-trash" style="padding: 4px;"></i></a></td> -->
                                </tr>
                            <?php
                            }
                        }
                        ?>
                        
                    </tbody>
                </table>
            

            <form action="insert_data.php" method="post">
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <h1 class="modal-title fs-5" id="exampleModalLabel">ADD Equipments</h1> -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                        </div>
                        
                        <!-- Second Row -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input type="text" name="amount" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="text" name="quantity" class="form-control">
                            </div>
                        </div>
                        
                        <!-- Third Row -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="vendor">Vendor</label>
                                <input type="text" name="vendor" class="form-control">
                            </div>
                        </div>
                        <!-- Fourth Row -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" name="description" class="form-control">
                            </div>
                        </div>
                        <!-- Fifth Row -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contact">Contact</label>
                                <input type="text" name="contact" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="text" name="date" class="form-control">
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <!-- <input type="submit" class="btn btn-success" name="add_staffs"> -->
                </div>
            </div>
        </div>
    </div>
</form>

            
            <?php include("footer.php"); ?>

        </div>
    </div>
</div>