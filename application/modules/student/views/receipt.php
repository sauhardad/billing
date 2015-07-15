<?php 
    //calculate the total paid and due amount
    $total_paid_sum=0;
    foreach($payments as $pay)
        $total_paid_sum+=$pay['paid_amount'];
?>

<div id="printable_div">
    <span style="">Valley Institute</span><br/>
    <div style="margin-top:3%;">
        <table border= "1">
            <tr>
                <td>Name: </td>
                <td><?php echo $student['student_name']; ?></td>
            </tr>
            <tr>
                <td>Address:</td>
                <td><?php echo $student['address']; ?></td>
            </tr>
            <tr>
                <td>Contact Number:</td>
                <td><?php echo $student['contact_no']; ?></td>
            </tr>
        </table>
        <br/>
        <div style="margin-top:3%;margin-bottom:3%;">
            <span>Courses</span>
            <table border="1">
                <tr>
                    <td>S.N.</td>
                    <td>Course</td>
                    <td>Amount</td>
                </tr>
                <?php $sn=1; ?>
                <?php $total=0; ?>
                <?php foreach ($courses as $course) { ?>
                    <tr>
                        <td><?php echo $sn; ?></td>
                        <td><?php echo $course['subject']; ?></td>
                        <td><?php echo $course['amount']; ?></td>
                    </tr>
                    <?php $sn++; ?>
                    <?php $total+=$course['amount']; ?>
                <?php } ?>
                    <tr>
                        <td></td>
                        <td>Total Amount</td>
                        <td><?php echo $total; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Payment</td>
                        <td><?php echo $current_pay['paid_amount']; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Total Due</td>
                        <td><?php echo ($total-$total_paid_sum); ?></td>
                    </tr>

            </table>
        </div>
    <span>Received By: <?php echo $username; ?></span>
</div>