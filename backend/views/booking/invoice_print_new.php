<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <link rel="stylesheet" href="css/style_print.css" media="all" />
  </head>
  <body>
    <header class="clearfix" style="background-color: #EEEEEE">
      <div id="logo">
        <img src="img/logo.png">
      </div>
      <div id="company">
        <h2 class="name">Panache Rental Boutique</h2>
        <div>C-52, Navshantiniketan Hsg.Soc., Akurdi, Pune</div>
        <div>+91 9881414990/8237703030</div>
        <div><a href="www.panachewears.in">www.panachewears.in</a></div>
      </div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to">INVOICE TO:</div>
          <h2 class="name"><?php echo $business_partner['name'] ?></h2>
          <div class="address"><?php echo $business_partner['contact_nos'];?></div>
          <div class="email"><a href=""><?php echo $business_partner['email_id'];?></a></div>
        </div>
        <div id="invoice">
          <h1>INVOICE <?php echo "#".str_pad($model['booking_id'],6,"0",0);; ?></h1>
          <div class="date">Booking Date: <?php echo Yii::$app->formatter->asDate($model['booking_date'], 'dd-MM-yyyy'); ?></div>
          <div class="date">Delivery Date: <?php echo Yii::$app->formatter->asDate($model['pickup_date'], 'dd-MM-yyyy'); ?></div>
          <div class="date">Return Date: <?php echo Yii::$app->formatter->asDate($model['return_date'], 'dd-MM-yyyy'); ?></div>
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no">#</th>
            <th class="desc" style="min-width: 250px" colspan="2">Item Details</th>
            <th class="unit">Rent Amount</th>
            <th class="qty">Deposite Amount</th> 
            <th class="qty">Discount</th>
            <th class="total">TOTAL</th>
          </tr>
        </thead>
        <tbody>
         <?php 

              $grand_total=0;
              $grand_deposite=0;
              $grand_rent=0;
              $grand_discount=0;
          
          foreach($item as $key => $data){ 
       
           
            $grand_total+=$data->net_value;
            $grand_deposite+=$data->deposit_amount;
            $grand_discount+=$data->discount;
            $grand_rent+=$data->amount;
            $image_path=$data->item['imageurl'];
            ?>
          <tr>
            <td class="no"><?php echo $key+1; ?></td>
            <!-- <td class="desc"><h3>Website Design</h3>Creating a recognizable design solution based on the company's existing visual identity</td> -->
            <td class="desc"><img src="<?= $image_path; ?>" style="height:80px" ></td>
            <td class="desc"> <?php echo  $data->item['name']; ?> </td>
            <td class="unit"><?php echo  number_format($data['amount'],2); ?></td>
            <td class="qty"><?php  echo number_format($data['deposit_amount'],2); ?></td>
            <td class="qty"><?php  echo number_format($data['discount'],2); ?></td>
            <td class="total">₹ <?php  echo number_format($data['net_value'],2); ?></td>
          </tr>
        <?php 
    } ?> 
        </tbody>
        <tfoot>
          <tr>
            <td colspan="4"></td>
            <td colspan="2">Total Rent</td>
            <td>₹ <?=number_format($grand_rent,2)?></td>
          </tr>
          <tr>
            <td colspan="4"></td>
            <td colspan="2">Deposite(Refundable)</td>
            <td>₹ <?=number_format($grand_deposite,2)?></td>
          </tr>
          <tr>
            <td colspan="4"></td>
            <td colspan="2">Total Discount</td>
            <td>₹ <?=number_format($grand_discount,2)?></td>
          </tr>
          <!-- <tr>
            <td colspan="3"></td>
            <td colspan="2">TAX 25%</td>
            <td>$1,300.00</td>
          </tr> -->
          <tr>
            <td colspan="4"></td>
            <td colspan="2">GRAND TOTAL</td>
            <td>₹ <?= number_format($grand_total,2) ?></td>
          </tr>
        </tfoot>
      </table>
      <div id="thanks">Thank you!</div>
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
      </div>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html>