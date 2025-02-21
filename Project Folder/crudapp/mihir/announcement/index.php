<div class="scroll-bg">
    <div>
        <div class="scroll-object">

            <?php include("header.php");?>
            <?php include("dbcon.php");?>
                <div class="box-1">
                <h2>Announcements</h2>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    ADD
                </button>
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
                
                

                <table class="table table-hover table-bordered table-striped" style="text-align: center;">
                    <thead>
                        <tr>
                            <th>Serial No.</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $query = "SELECT * FROM `announcements`";

                        $result = mysqli_query($connection, $query);

                        if(!$result){
                            die("query failed".mysqli_error($connection));
                        }
                        else{
                            while($row = mysqli_fetch_assoc($result)){
                            ?>
                            
                                <tr>
                                    <td><?php echo $row['id']?></td>
                                    <td><?php echo $row['message']?></td>
                                    <td><?php echo $row['date']?></td>
                                    <td><a href="update_page_1.php?id=<?php echo $row['id']?>" class="mybtn1 btn btn-light btn-small"><i class="bi bi-pencil" style="padding: 4px;"></i></a></td>
                                    <td><a href="delete_page.php?id=<?php echo $row['id']?>" class="mybtn2 btn btn-light btn-small"><i class="bi bi-trash" style="padding: 4px;"></i></a></td>
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">ADD Announcement</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- First Row -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="message">Message</label>
                                <input type="text" name="message" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" name="date" class="form-control">
                            </div>
                        </div>
                        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-success" name="add_announcements">
                </div>
            </div>
        </div>
    </div>
</form>




            
            <?php include("footer.php"); ?>

        </div>
    </div>
</div>