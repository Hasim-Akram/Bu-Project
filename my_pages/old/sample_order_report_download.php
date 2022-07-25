<?php
        header("Content-Type: application/vnd.ms-excel");
        header("Expires: 0");
        $date = date('Y-m-d');
        header("content-disposition: attachment;filename=Order_Report_$date.xls");
    
	
	session_start();
    include '../class/connection.php';
    include '../class/order2.class.php';
    $odr = new Order;
?>

<html>
        <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        </head>
        <body>
		
                <table border="1" cellpadding="2">
                    <thead>
                        <tr>
                            <th>Region</th>
                            <th>Area</th>
                            <th>Territory</th>
                            <th>House</th>
                            <th>Brand</th>
                            <th>Pack</th>
                            <th><?php echo date('d-M-Y'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
						<?php $odr->GenerateOrderReport(); ?>
                    </tbody>
                  </table>
        </body>
</html>