<?php 
    //calculate the total paid and due amount
    $total_paid_sum=0;
    foreach($payments as $pay)
        $total_paid_sum+=$pay['paid_amount'];
?>

<div id="printable_div" align="center" style="margin-top:-2% ">
    <span align="left"><font size="1">Regd No: 114505</font></span>
    <span align="right"><font size="1">PAN: 302580943</font></span><br/>

    <div align="center" style="margin-top:2%;">
        <span><b><font size="2">Kirtipur Valley Institute</font></b></span><br/>
        <span><i><font size="2">Near Kirtipur Gate</font></i></span><br/>
        <span><i><font size="2">Phone: 014332509</font></i></span><br/>
    </div>
    <span><b><font size="2">Cash Receipt</font></b></span><br/>
    <div>
        <span align="left"><b><font size="2">Bill No:</b> <?php echo $current_pay['bill_no']; ?></font></span><br/>
        <span align="right"><font size="2">Date: <?php echo $current_pay['entry_timestamp']; ?></font></span>
    </div>
    
    <div>
        <table border= "1">
            <tr>
                <td><font size="2">Name: </font></td>
                <td><font size="2"><?php echo $student['student_name']; ?></font></td>
            </tr>
            <tr>
                <td><font size="2">Contact:</font></td>
                <td><font size="2"><?php echo $student['contact_no']; ?></font></td>
            </tr>
        </table>
        <span><font size="2">Sec: <?php echo $subsection['name']; ?></font></span>
        <span><font size="2">Group: <?php echo $group['name']; ?></font></span>
        
        <div style="margin-top:2%;margin-bottom:2%;">
            <table border="1">
                <tr>
                    <td><font size="2">S.N.</font></td>
                    <td><font size="2">Course</font></td>
                    <td><font size="2">Amount</font></td>
                </tr>
                <?php $sn=1; ?>
                <?php $total=0; ?>
                <?php foreach ($courses as $course) { ?>
                    <tr><font size="2">
                    <td><font size="2"><?php echo $sn; ?></font></td>
                        <td><font size="2"><?php echo $course['subject']; ?></font></td>
                        <td><font size="2"><?php echo $course['amount']; ?></font></td>
                    </tr>
                    <?php $sn++; ?>
                    <?php $total+=$course['amount']; ?>
                <?php } ?>
                    <tr>
                        <td></td>
                        <td><font size="2">Total</font></td>
                        <td><font size="2"><?php echo $total; ?></font></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><font size="2">Payment</font></td>
                        <td><font size="2"><?php echo $current_pay['paid_amount']; ?></font></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><font size="2">Total Due</font></td>
                        <td><font size="2"><?php echo ($total-$total_paid_sum); ?></font></td>
                    </tr>

            </table>
        </div>
        <span><font size="2">In Words: <?php echo convert_number_to_words($current_pay['paid_amount'])." Rupees Only"; ?></font></span></br>
        <span><b><font size="2">Received By: <?php echo $username; ?></font></b></span></br>
        <span><font size="2">Thank You !</font></span>
</div>