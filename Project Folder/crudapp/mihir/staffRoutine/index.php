<div class="scroll-bg">
    <div>
        <div class="scroll-object">

            <?php include("header.php");?>
            <?php include("dbcon.php");?>
                <div class="box-1">
                <h2>Routine</h2>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    ADD Routine
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
                            <th>ID</th>
                            <th>8am-10am</th>
                            <th>10am-12pm</th>
                            <th>12pm-2pm</th>
                            <th>2pm-4pm</th>
                            <th>4pm-6pm</th>
                            <!-- <th>View</th> -->
                            <!-- <th>Update</th> -->
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $query = "SELECT * FROM `staffRoutine`";

                        $result = mysqli_query($connection, $query);

                        if(!$result){
                            die("query failed".mysqli_error($connection));
                        }
                        else{
                            while($row = mysqli_fetch_assoc($result)){
                            ?>
                            
                            <tr>
                                <td><?php echo htmlspecialchars($row['Sta_ID']); ?></td>
                                <td><?php echo $row['TS_8_10'] ? '✔' : '✘'; ?></td>
                                <td><?php echo $row['TS_10_12'] ? '✔' : '✘'; ?></td>
                                <td><?php echo $row['TS_12_2'] ? '✔' : '✘'; ?></td>
                                <td><?php echo $row['TS_2_4'] ? '✔' : '✘'; ?></td>
                                <td><?php echo $row['TS_4_6'] ? '✔' : '✘'; ?></td>
                                <!-- <td><a href="view_page_2.php?id=<?php echo $row['Sta_ID']; ?>" class="btn btn-secondary"><i class="bi bi-eye" style="padding: 4px;"></i></a></td> -->
                                <!-- <td><a href="update_page_1.php?id=<?php echo $row['Sta_ID']; ?>" class="mybtn1 btn btn-light btn-small"><i class="bi bi-pencil" style="padding: 4px;"></i></a></td> -->
                                <td><a href="delete_page.php?id=<?php echo $row['Sta_ID']; ?>" class="mybtn2 btn btn-light btn-small"><i class="bi bi-trash" style="padding: 4px;"></i></a></td>
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">ADD Routine</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Sta_ID">Sta_ID</label>
                                <input type="text" name="Sta_ID" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="TS_8_10">8.00-10.00</label>
                                <!-- Hidden input to ensure 0 is sent if unchecked -->
                                <input type="hidden" name="TS_8_10" value="0">
                                <input type="checkbox" name="TS_8_10" value="1">
                            </div>
                        </div>
                        
                        <!-- Second Row -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="TS_10_12">10.00-12.00</label>
                                <!-- Hidden input to ensure 0 is sent if unchecked -->
                                <input type="hidden" name="TS_10_12" value="0">
                                <input type="checkbox" name="TS_10_12" value="1">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="TS_12_2">12.00-2.00</label>
                                <!-- Hidden input to ensure 0 is sent if unchecked -->
                                <input type="hidden" name="TS_12_2" value="0">
                                <input type="checkbox" name="TS_12_2" value="1">
                            </div>
                        </div>
                        
                        <!-- Third Row -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="TS_2_4">2.00-4.00</label>
                                <!-- Hidden input to ensure 0 is sent if unchecked -->
                                <input type="hidden" name="TS_2_4" value="0">
                                <input type="checkbox" name="TS_2_4" value="1">
                            </div>
                        </div>
                        <!-- Fourth Row -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="TS_4_6">4.00-6.00</label>
                                <!-- Hidden input to ensure 0 is sent if unchecked -->
                                <input type="hidden" name="TS_4_6" value="0">
                                <input type="checkbox" name="TS_4_6" value="1">
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-success" name="add_routine">
                </div>
            </div>
        </div>
    </div>
</form>

            
            <?php include("footer.php"); ?>

        </div>
    </div>
</div>