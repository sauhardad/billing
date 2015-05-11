<!-- CUSTOM STYLE CSS -->
    <style type="text/css">
               .btn-social {
            color: white;
            opacity: 0.8;
        }

            .btn-social:hover {
                color: white;
                opacity: 1;
                text-decoration: none;
            }

        .btn-facebook {
            background-color: #3b5998;
        }

        .btn-twitter {
            background-color: #00aced;
        }

        .btn-linkedin {
            background-color: #0e76a8;
        }

        .btn-google {
            background-color: #c32f10;
        }
    </style>
    
     <div class="container">
        <section style="padding-bottom: 50px; padding-top: 50px;">
            <div class="row">
                <div class="col-md-4">
                    <img src="http://localhost/billing/assets/img/user_uploads/ppl.png">
                    <br />
                    <br />
                    <label>Name :<?php echo $student['student_name']; ?></label><br>
                    <label>Address :<?php echo $student['address']; ?></label><br>
                    <label>Contact No :<?php echo $student['contact_no']; ?></label><br>
                    <label>Date of Birth :<?php echo $student['dob']; ?></label><br>
                    
                    <br>
                    
                    <br /><br/>
                </div>
               <div class="col-md-8">
                   <a href="#" class="btn btn-success">Billing Details</a><br></br>
                <table class="table table-bordered table-striped">
                    <thead>
                        <th>S.N.</th>
                        <th>Bill Amount</th>
                        <th>Paid</th>
                        <th>Due</th>
                        <th>Date</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php if(isset($sections)){ ?>
                        <?php $sn=1; ?>
                        <?php foreach($sections as $section){ ?>
                            <tr>
                                <td><?php echo $sn; ?></td>
                                <td><?php echo $section['code']; ?></td>
                                <td><?php echo $section['name']; ?></td>
                                <td>
                                    <a class="btn btn-success" href="<?php echo base_url('section/view/'.$section['id']); ?>"><span class="glyphicon glyphicon-list glyphicon-margin-right-5"></span>View</a>
                                    <button class="btn btn-primary edit_section_btn" data-id="<?php echo $section['id']; ?>" data-code="<?php echo $section['code']; ?>" data-name="<?php echo $section['name']; ?>" data-toggle="modal" data-target="#edit_section_modal"><span class="glyphicon glyphicon-edit glyphicon-margin-right-5"></span>Edit</button>
                                    <button class="btn btn-danger" onclick="return deleteData('<?php echo $section['id']; ?>','section/delete',this)"><span class="glyphicon glyphicon-trash glyphicon-margin-right-5"></span>Delete</button>
                                </td>
                            </tr> 
                            <?php $sn++; ?>
                        <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
            </div>
            <!-- ROW END -->


        </section>
        <!-- SECTION END -->
    </div>
    <!-- CONATINER END -->

    <!-- REQUIRED SCRIPTS FILES -->
    <!-- CORE JQUERY FILE -->
    <script src="assets/js/jquery-1.11.1.js"></script>
    <!-- REQUIRED BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.js"></script>
</body>
