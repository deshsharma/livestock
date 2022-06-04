<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Livestock Business Invoice</title>
    <style>
        @font-face {
        font-family: SourceSansPro;
        src: url(<?= base_url('assets/livestoc/SourceSansPro-Regular.ttf') ?>);
        }
        .clearfix:after {
        content: "";
        display: table;
        clear: both;
        }
        a {
        color: #0087C3;
        text-decoration: none;
        }
        body {
        position: relative;
        width: 21cm;  
        height: 29.7cm; 
        margin: 0 auto; 
        color: #555555;
        background: #FFFFFF; 
        font-family: Arial, sans-serif; 
        font-size: 14px; 
        font-family: SourceSansPro;
        }
        header {
        padding: 10px 0;
        margin-bottom: 20px;
        border-bottom: 1px solid #AAAAAA;
        }
        #logo {
        float: left;
        margin-top: 8px;
        }
        #logo img {
        height: 70px;
        }
        #company {
        float: right;
        text-align: right;
        }
        #details {
        margin-bottom: 50px;
        }
        #client {
        padding-left: 6px;
        border-left: 6px solid #0087C3;
        float: left;
        }
        #client .to {
        color: #777777;
        }
        h2.name {
        font-size: 1.4em;
        font-weight: normal;
        margin: 0;
        }
        #invoice {
        float: right;
        text-align: right;
        }
        #invoice h1 {
        color: #0087C3;
        font-size: 2.4em;
        line-height: 1em;
        font-weight: normal;
        margin: 0  0 10px 0;
        }
        #invoice .date {
        font-size: 1.1em;
        color: #777777;
        }
        table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 20px;
        }
        table th,
        table td {
        padding: 20px;
        background: #EEEEEE;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;
        }
        table th {
        white-space: nowrap;        
        font-weight: normal;
        }
        table td {
        text-align: right;
        }
        table td h3{
        color: #4ba5af;
        font-size: 1.2em;
        font-weight: normal;
        margin: 0 0 0.2em 0;
        }
        table .no {
        color: #FFFFFF;
        font-size: 1.6em;
        background: #4ba5af;
        }
        table .desc {
        text-align: left;
        }
        table .unit {
        background: #DDDDDD;
        }
        table .qty {
        }
        table .total {
        background: #4ba5af;
        color: #FFFFFF;
        }
        table td.unit,
        table td.qty,
        table td.total {
        font-size: 1.2em;
        }
        table tbody tr:last-child td {
        border: none;
        }
        table tfoot td {
        padding: 10px 20px;
        background: #FFFFFF;
        border-bottom: none;
        font-size: 1.2em;
        white-space: nowrap; 
        border-top: 1px solid #AAAAAA; 
        }
        table tfoot tr:first-child td {
        border-top: none; 
        }
        table tfoot tr:last-child td {
        color: #4ba5af;
        font-size: 1.4em;
        border-top: 1px solid #4ba5af; 
        }
        table tfoot tr td:first-child {
        border: none;
        }
        #thanks{
        font-size: 2em;
        margin-bottom: 50px;
        }
        #notices{
        padding-left: 6px;
        border-left: 6px solid #0087C3;  
        }
        #notices .notice {
        font-size: 1.2em;
        }
        footer {
        color: #777777;
        width: 100%;
        height: 30px;
        position: absolute;
        bottom: 0;
        border-top: 1px solid #AAAAAA;
        padding: 8px 0;
        text-align: center;
        }
    </style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="https://www.livestoc.com/uploads/logo/logolivestoc.png">
      </div>
      <div id="company">
        <h2 class="name">Amaze Brandlance Pvt.Ltd</h2>
        <!-- <div>C -86,Industrial Area Phase -VII SAS nagar<br>Mohali-160055, Punjab, India </div> -->
        <div>1800 102 0379</div>
        <div><a href="mailto:support@livestoc.com">support@livestoc.com</a></div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
        <?php 
        $type = 0;
        if($data[0]['type'] == 3){
          $doc =$this->api_model->get_user_detail($data[0]['users_id']);
          $user_name = $doc[0]['fullname'];
          $address = $doc[0]['address'];
          $email = $doc[0]['email'];
        }else{
          $doc = $this->api_model->get_doc_detail_id($data[0]['users_id']);
          $user_name = $doc[0]['username'];
          $address = $doc[0]['address_full'];
          $email =  $doc[0]['email'];
          $type = 1;
        }
        ?>
          <div class="to">INVOICE TO:</div>
          <h2 class="name"><?= $user_name; ?></h2>
          <div class="address"><?= $address ?></div>
          <div class="email"><a href="mailto:<?= $email ?>"><?= $email ?></a></div>
        </div>
        <div id="invoice">
          <h1>INVOICE #<?= $data[0]['id'] ?></h1>
          <div class="date">Date of Invoice: <?php $date = explode(' ', $data[0]['date']); echo $date[0]; ?></div>
          <!-- <div class="date">Due Date: 30/06/2020</div> -->
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <!-- <th class="no">#</th> -->
            <th class="desc">DESCRIPTION</th>
            <th class="unit">UNIT PRICE</th>
            <th class="qty">QUANTITY</th>
            <th class="total">TOTAL</th>
          </tr>
        </thead>
        <tbody>
        <?php 
        // echo "<pre>";
        // print_r($data);
        if($data[0]['log_id'] != '' &&  $data[0]['log_id'] != '0'){
          $wallet = $this->api_model->get_data('log_id = "'.$data[0]['log_id'].'" AND status = "Dr"', 'livestoc_wallets', '', 'sum(amount) as amount');
          $wallet_cr = $this->api_model->get_data('log_id = "'.$data[0]['log_id'].'" AND status = "Cr"', 'livestoc_wallets', '', 'sum(amount) as amount');
        }
        $log_data = $this->api_model->get_data('id = '.$data[0]['log_id'].'', 'log_file', '', '*');
        $stock = explode(',',$data[0]['semen_stock_id']); 
        $stock_price = explode(',',$data[0]['semen_stock_price']);
        $old_semen_stock_price = explode(',',$data[0]['old_semen_stock_price']);
        $stock_qty = explode(',',$data[0]['semen_stock_qty']);
        $discount = explode(',',$data[0]['discount']);
        $discount_per = explode(',',$data[0]['discount_per']);
        $total_discount = $data[0]['total_discount'];
        $i =0;
        $total = 0;
        $lenth = sizeof($stock);
        foreach($stock as $st){
          $stock_detail = $this->api_model->get_semen_stock_id($st);
          $semen = $this->api_model->get_seman_detail($stock_detail[0]['bull_id']);
          if(!empty($log_data)){
            //echo "this is test";
            // exit;
                $request = $this->api_model->get_data('log_id = "'.$data[0]['log_id'].'"' , 'vt_requests', '', '*');
                // $bull = $this->api_model->get_data('id = "'.$data[0]['bull_id'].'"' , 'bull_table', '', '*');
                // $semen_price = $this->api_model->get_data('id ="'.$bull[0]['groups'].'"','semen_group','','*');
                // $old_bull = $this->api_model->get_data('id = "'.$data[0]['old_bull_id'].'"' , 'bull_table', '', '*');
                // $semen_old_price = $this->api_model->get_data('id ="'.$old_bull[0]['groups'].'"','semen_group','','*');
                // if($request[0]['premium_type'] ==  '1'){
                //   echo "this is test";
                 $per = $stock_price[$i];
                // }else{
                //   $per = $semen_price[0]['farmer_price'];
                // }
                if($stock_price[$i] != ''){
                ?>
                <tr>
                          <!-- <td class="no"><?= $i+1 ?></td> -->
                          <td class="desc"><h3>AI Price (<?= $semen[0]['bull_id']?>)</h3></td>
                          <td class="unit">₹<?= $stock_price[$i] ?></td>
                          <td class="qty"><?= $stock_qty[$i] ?></td>
                          <td class="total">₹<?php $total +=$stock_price[$i] * $stock_qty[$i]; echo $stock_price[$i] * $stock_qty[$i];  
                          ?></td>
              </tr>
              <?php if($discount_per[$i] != '0'){ ?>
              <tr>
                          <!-- <td class="no"><?= $i+1 ?></td> -->
                          <td class="desc"><h3>Discount</h3></td>
                          <td class="unit"></td>
                          <td class="qty">%<?= $discount_per[$i] ?></td>
                          <td class="total">₹<?php $total -=$discount[$i]; echo $discount[$i];  
                          ?></td>
              </tr>
              <?php } ?>
              <?php if($data[0]['purchased_breeding_record'] > 0   && $i == $lenth -1){ ?>
                <tr>
                          <!-- <td class="no"><?= $i+1 ?></td> -->
                          <td class="desc"><h3>Breeding Record Charges</h3></td>
                          <td class="unit">₹<?= BREADING_RECORD_PRICE ?></td>
                          <td class="qty"><?= $data[0]['purchased_breeding_record'] ?></td>
                          <td class="total">₹<?php $total +=$data[0]['purchased_breeding_record'] * BREADING_RECORD_PRICE; echo $data[0]['purchased_breeding_record'] * BREADING_RECORD_PRICE;    
                          //if($data[0]['symble'] == '-')
                          //$grand_total = $grand_total - $total;
                          //if($data[0]['symble'] == '+')
                          //$grand_total = $grand_total + $total;
                          ?></td>
              </tr>
              <?php } ?>
              <?php 
            if($data[0]['bull_id'] != $data[0]['old_bull_id']){
              if( $data[0]['old_bull_id'] != '0' && $data[0]['old_bull_id'] != ''){
                $semen1 = $this->api_model->get_seman_detail($data[0]['old_bull_id']);
                // $request = $this->api_model->get_data('log_id = "'.$data[0]['log_id'].'"' , 'vt_requests', '', '*');
                // $bull = $this->api_model->get_data('id = "'.$data[0]['bull_id'].'"' , 'bull_table', '', '*');
                // $semen_price = $this->api_model->get_data('id ="'.$bull[0]['groups'].'"','semen_group','','*');
                // $old_bull = $this->api_model->get_data('id = "'.$data[0]['old_bull_id'].'"' , 'bull_table', '', '*');
                // $semen_old_price = $this->api_model->get_data('id ="'.$old_bull[0]['groups'].'"','semen_group','','*');
                // if($request[0]['premium_type'] ==  '1'){
                //   $old_per = $semen_old_price[0]['farmer_offer_price'];
                // }else{
                //   $old_per = $semen_old_price[0]['farmer_price'];
                // }
              ?>
                 <tr>
                          <!-- <td class="no"><?= $i+1 ?></td> -->
                          <td class="desc"><h3>Requested AI Price (<?= $semen1[0]['bull_id']?>)</h3></td>
                          <td class="unit">₹<?= $old_semen_stock_price[$i] ?></td>
                          <td class="qty"><?= $stock_qty[$i] ?></td>
                          <td class="total">₹<?php $total_old =$stock_qty[$i] * $old_semen_stock_price[$i]; echo $total_old; 
                          //if($data[0]['symble'] == '-')
                          //$grand_total = $grand_total - $total;
                          //if($data[0]['symble'] == '+')
                          //$grand_total = $grand_total + $total;
                          ?></td>
                </tr>
              <?php
              }
            }
               } if($data[0]['addtional_charges'] != '0' && $i == $lenth -1){ ?>
                <tr>
                          <!-- <td class="no"><?= $i+1 ?></td> -->
                          <td class="desc"><h3>Addtional charges</h3></td>
                          <td class="unit"></td>
                          <td class="qty"></td>
                          <td class="total">₹<?php $total +=$data[0]['addtional_charges']; echo $data[0]['addtional_charges'];  
                          //if($data[0]['symble'] == '-')
                          //$grand_total = $grand_total - $total;
                          //if($data[0]['symble'] == '+')
                          //$grand_total = $grand_total + $total;
                          ?></td>
              </tr>
              <?php } ?>
              <?php if($data[0]['sheath_qty'] != '0' && $i == $lenth -1){ ?>
                <tr>
                  <!-- <td class="no"><?= $i+1 ?></td> -->
                  <td class="desc"><h3># Sheath</h3></td>
                  <td class="unit">₹<?= SHEATH_PRICE ?></td>
                  <td class="qty"><?= $data[0]['sheath_qty'] ?></td>
                  <td class="total">₹<?php echo $data[0]['sheath_qty'] * SHEATH_PRICE;  $total +=  $data[0]['sheath_qty'] * SHEATH_PRICE; ?></td>
                </tr>
              <?php } if($data[0]['gas_qty'] != '0' && $i == $lenth -1){ ?>
                <tr>
                  <!-- <td class="no"><?= $i+2 ?></td> -->
                  <td class="desc"><h3># Gas</h3></td>
                  <td class="unit">₹<?= GAS_PRICE ?></td>
                  <td class="qty"><?= $data[0]['gas_qty'] ?></td>
                  <td class="total">₹<?php $gas = $data[0]['gas_qty'] * GAS_PRICE + (($data[0]['gas_qty'] * GAS_PRICE)*GAS_TAX/100);
                  echo $gas;
                  $total += $gas;  ?></td>
                </tr>
              <?php } if($data[0]['gloves_qty'] != '0' && $i == $lenth -1){ ?>
                <tr>
                  <!-- <td class="no"><?= $i+3 ?></td> -->
                  <td class="desc"><h3># Gloves</h3></td>
                  <td class="unit">₹<?= GLOVES_PRICE ?></td>
                  <td class="qty"><?= $data[0]['gloves_qty'] ?></td>
                  <td class="total">₹<?php echo $data[0]['gloves_qty'] * GLOVES_PRICE;  $total += $data[0]['gloves_qty'] * GLOVES_PRICE; ?></td>
                </tr>
              <?php } 
            $wal = 0;
            if($wallet[0]['amount'] != '' || !is_null($wallet[0]['amount'])){
              ?>
               <tr>
                          <!-- <td class="no"><?= $i+1 ?></td> -->
                          <td class="desc"><h3>Paid(Online)</h3></td>
                          <td class="unit"></td>
                          <td class="qty"></td>
                          <td class="total">₹<?php $wal =$wallet[0]['amount']; echo $wal; 
                          //if($data[0]['symble'] == '-')
                          //$grand_total = $grand_total - $total;
                          //if($data[0]['symble'] == '+')
                          //$grand_total = $grand_total + $total;
                          ?></td>
                </tr>
              <?php
            }
            
            $wal_cr = 0;
            if($wallet_cr[0]['amount'] != '' || !is_null($wallet_cr[0]['amount'])){
              ?>
               <tr>
                          <!-- <td class="no"><?= $i+1 ?></td> -->
                          <td class="desc"><h3>Refunded to Wallet</h3></td>
                          <td class="unit"></td>
                          <td class="qty"></td>
                          <td class="total">₹<?php $wal_cr =$wallet_cr[0]['amount']; echo $wal_cr; 
                          //if($data[0]['symble'] == '-')
                          //$grand_total = $grand_total - $total;
                          //if($data[0]['symble'] == '+')
                          //$grand_total = $grand_total + $total;
                          ?></td>
                </tr>
              <?php
            }
            // print_r($wallet);
            // echo $wal;
            // echo "------------";
            // echo $old_per;
            // //exit;
            // //if($log_data[0]['request_status'] != '2'){
            //   print_r($data);

            //     if($old_per != '0' && $old_per != ''){
            //       echo "this is test";
            //       exit;
            //     }
              //}
            }else{
              // print_r($stock_price[$i]);
              $request = $this->api_model->get_data('log_id = "'.$data[0]['log_id'].'"' , 'vt_requests', '', '*');
              // $bull = $this->api_model->get_data('id = "'.$data[0]['bull_id'].'"' , 'bull_table', '', '*');
              // $semen_price = $this->api_model->get_data('id ="'.$bull[0]['groups'].'"','semen_group','','*');
              // $old_bull = $this->api_model->get_data('id = "'.$data[0]['old_bull_id'].'"' , 'bull_table', '', '*');
              // $semen_old_price = $this->api_model->get_data('id ="'.$old_bull[0]['groups'].'"','semen_group','','*');
              // if($request[0]['premium_type'] ==  '1'){
              //   // echo "this is test";
              //   $per = $semen_price[0]['farmer_offer_price'];
              // }else{
              //   $per = $semen_price[0]['farmer_price'];
              // }
              if($stock_price[$i] != ''){
              ?>
              <tr>
                        <!-- <td class="no"><?= $i+1 ?></td> -->
                        <td class="desc"><h3>AI Price (<?= $semen[0]['bull_id']?>)</h3></td>
                        <td class="unit">₹<?= $stock_price[$i] ?></td>
                        <td class="qty"><?= $stock_qty[$i] ?></td>
                        <td class="total">₹<?php $total +=$stock_price[$i] * $stock_qty[$i]; echo $stock_price[$i] * $stock_qty[$i]; 
                        //if($data[0]['symble'] == '-')
                        //$grand_total = $grand_total - $total;
                        //if($data[0]['symble'] == '+')
                        //$grand_total = $grand_total + $total;
                        ?></td>
              </tr>
              <?php if($discount_per[$i] != '0'){ ?>
              <tr>
                          <!-- <td class="no"><?= $i+1 ?></td> -->
                          <td class="desc"><h3>Discount On (<?= $semen[0]['bull_id']?>)</h3></td>
                          <td class="unit"></td>
                          <td class="qty">%<?= $discount_per[$i] ?></td>
                          <td class="total">₹<?php $total -=$discount[$i]; echo $discount[$i];  
                          ?></td>
              </tr>
              <?php } ?>
            <?php if($data[0]['purchased_breeding_record'] != '0' && $i == $lenth -1 ){ ?>
              <tr>
                        <!-- <td class="no"><?= $i+1 ?></td> -->
                        <td class="desc"><h3>Breeding Record Charges</h3></td>
                        <td class="unit">₹<?= BREADING_RECORD_PRICE ?></td>
                        <td class="qty"><?= $data[0]['purchased_breeding_record'] ?></td>
                        <td class="total">₹<?php $total +=$data[0]['purchased_breeding_record'] * BREADING_RECORD_PRICE; echo $data[0]['purchased_breeding_record'] * BREADING_RECORD_PRICE;  
                        //if($data[0]['symble'] == '-')
                        //$grand_total = $grand_total - $total;
                        //if($data[0]['symble'] == '+')
                        //$grand_total = $grand_total + $total;
                        ?></td>
            </tr>
            <?php } 
            ?>
            <?php 
              }
            if($data[0]['addtional_charges'] != '0' && $i == $lenth -1){ ?>
              <tr>
                        <!-- <td class="no"><?= $i+1 ?></td> -->
                        <td class="desc"><h3>Addtional charges</h3></td>
                        <td class="unit"></td>
                        <td class="qty"></td>
                        <td class="total">₹<?php $total +=$data[0]['addtional_charges']; echo $data[0]['addtional_charges'];  
                        //if($data[0]['symble'] == '-')
                        //$grand_total = $grand_total - $total;
                        //if($data[0]['symble'] == '+')
                        //$grand_total = $grand_total + $total;
                        ?></td>
            </tr>
            <?php } ?>
            <?php //if($data[0]['type'] == 0){ ?>
              <?php if($data[0]['sheath_qty'] != '0'  && $i == $lenth -1){ ?>
                <tr>
                  <!-- <td class="no"><?= $i+1 ?></td> -->
                  <td class="desc"><h3># Sheath</h3></td>
                  <td class="unit">₹<?= SHEATH_PRICE ?></td>
                  <td class="qty"><?= $data[0]['sheath_qty'] ?></td>
                  <td class="total">₹<?php echo $data[0]['sheath_qty'] * SHEATH_PRICE;  $total +=  $data[0]['sheath_qty'] * SHEATH_PRICE; ?></td>
                </tr>
              <?php } if($data[0]['gas_qty'] != '0'  && $i == $lenth -1){ ?>
                <tr>
                  <!-- <td class="no"><?= $i+2 ?></td> -->
                  <td class="desc"><h3># Gas</h3></td>
                  <td class="unit">₹<?= GAS_PRICE ?></td>
                  <td class="qty"><?= $data[0]['gas_qty'] ?></td>
                  <td class="total">₹<?php $gas = $data[0]['gas_qty'] * GAS_PRICE + (($data[0]['gas_qty'] * GAS_PRICE)*GAS_TAX/100);
                  echo $gas;
                  $total += $gas;  ?></td>
                </tr>
              <?php } if($data[0]['gloves_qty'] != '0' && $i == $lenth -1){ ?>
                <tr>
                  <!-- <td class="no"><?= $i+3 ?></td> -->
                  <td class="desc"><h3># Gloves</h3></td>
                  <td class="unit">₹<?= GLOVES_PRICE ?></td>
                  <td class="qty"><?= $data[0]['gloves_qty'] ?></td>
                  <td class="total">₹<?php echo $data[0]['gloves_qty'] * GLOVES_PRICE;  $total += $data[0]['gloves_qty'] * GLOVES_PRICE; ?></td>
                </tr>
              <?php }
            }
            ?>
              <tr>
                          <!-- <td class="no"><?= $i+1 ?></td> -->
                         
                          <?php if($total < ($wal - $wal_cr)){ 
                           
                            ?>
                             <td class="desc"><h3>Transfered to Wallet</h3></td>
                            <td class="unit"></td>
                            <td class="qty"></td>
                            <td class="total">₹<?php echo $total =  ($wal - $wal_cr) - $total ; 
                            $total = 0;
                            //if($data[0]['symble'] == '-')
                            //$grand_total = $grand_total - $total;
                            //if($data[0]['symble'] == '+')
                            //$grand_total = $grand_total + $total;
                            ?></td> <?php
                          }else{ 
                           // echo $total;
                            if(($lenth - 1) == $i){
                              // echo $wal;
                              // if($wal_cr){
                              //   echo "this is test";
                              // }
                            ?>
                            <td class="desc"><h3>Total</h3></td>
                            <td class="unit"></td>
                            <td class="qty"></td>
                            <td class="total">₹<?php echo $total = $total - ($wal - $wal_cr);?></td>
                            <?php }
                          } ?>
                </tr>
            <?php 
           //echo $total;
            $i++;
          }
        ?>

        <!-- </tbody>
        <tfoot> -->
          <!-- <tr>
            <td colspan="2"></td>
            <td colspan="2">SUBTOTAL</td>
            <td>₹1000.00</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">TAX 25%</td>
            <td>₹1,300.00</td>
          </tr>-->
          <tr> 
            <td colspan="2"></td>
            <td colspan="1">Pay</td>
            <td>₹<?= $total ?></td>
          </tr>
        </tfoot>
      </table>
      <div id="thanks">Thank you!</div>
      <div id="notices">
        <!-- <div>NOTICE:</div>
        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div> -->
      </div>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html>