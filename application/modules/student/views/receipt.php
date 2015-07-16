<?php 
    //calculate the total paid and due amount
    $total_paid_sum=0;
    foreach($payments as $pay)
        $total_paid_sum+=$pay['paid_amount'];
?>

<div id="printable_div" align="center" style="font-size:6px;">
    <span align="left">Regd No: 520030003</span>
    <span align="right">PAN: 560010010</span><br/>
    <div align="center" style="margin-top:2%;">
        <span><b>Kirtipur Valley Institute</b></span><br/>
        <span><i>Near Kirtipur Gate</i></span><br/>
        <span><i>Phone: 014332509</i></span><br/>
    </div>
    <br/>
    <span style="margin-top:3%;"><b>Cash Receipt</b></span><br/>
    <div style="margin-top:2%;">
        <span align="left">Bill No: <?php echo $current_pay['bill_no']; ?></span><br/>
        <span align="right">Date: <?php echo $current_pay['entry_timestamp']; ?></span>
    </div>
    
    <div style="margin-top:3%;">
        <table border= "1">
            <tr>
                <td>Name: </td>
                <td><?php echo $student['student_name']; ?></td>
            </tr>
            <tr>
                <td>Contact Number:</td>
                <td><?php echo $student['contact_no']; ?></td>
            </tr>
        </table>
        <br/>
        
        <span>Sub-section: <?php echo $subsection['name']; ?></span><br/>
        <span>Group: <?php echo $group['name']; ?></span>
        
        <div style="margin-top:3%;margin-bottom:3%;">
            <span><b>Courses</b></span>
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
        <br/>
        <span>Received: <?php echo convert_number_to_words($current_pay['paid_amount'])." Rupees"; ?></span>
        <br/><br/>
        <span><b>Received By: <?php echo $username; ?></b></span>
</div>