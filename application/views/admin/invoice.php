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
        <img src="<?= base_url('assets/livestoc/logo.png') ?>">
      </div>
      <div id="company">
        <h2 class="name">Amaze Brandlance Pvt.Ltd</h2>
        <div>C -86,Industrial Area Phase -VII SAS nagar<br>Mohali-160055, Punjab, India </div>
        <div>180-010-315-41</div>
        <div><a href="mailto:support@livestoc.com">support@livestoc.com</a></div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
        <?php //print_r($data); 
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
        }
        // print_r($doc);
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
            <th class="no">#</th>
            <th class="desc">DESCRIPTION</th>
            <th class="unit">UNIT PRICE</th>
            <th class="qty">QUANTITY</th>
            <th class="total">TOTAL</th>
          </tr>
        </thead>
        <tbody>
        <?php 
        $stock = explode(',',$data[0]['semen_stock_id']); 
        $stock_price = explode(',',$data[0]['semen_stock_price']);
        $stock_qty = explode(',',$data[0]['semen_stock_qty']);
        $i =0;
        foreach($stock as $st){
          $stock_detail = $this->api_model->get_semen_stock_id($stock[$i]);
          $semen = $this->api_model->get_seman_detail($stock_detail[0]['bull_id']);
        ?>
          <tr>
            <td class="no"><?= $i+1 ?></td>
            <td class="desc"><h3>Semen Price (#<?= $semen[0]['id']?>)</h3></td>
            <td class="unit">₹<?= $stock_price[$i] ?></td>
            <td class="qty"><?= $stock_qty[$i] ?></td>
            <td class="total">₹<?php $total =$stock_price[$i] * $stock_qty[$i]; echo $total; $grand_total += $total;?></td>
          </tr>
          <?php if($data[0]['type'] == 3){ ?>
          <tr>
            <td class="no"><?= $i+1+1 ?></td>
            <td class="desc"><h3># AI & Breading Record Management</h3></td>
            <td class="unit">₹ <?= AI_PRICE ?></td>
            <td class="qty"><?= $stock_qty[$i] ?></td>
            <td class="total">₹<?php $total = AI_PRICE * $stock_qty[$i]; echo $total; $grand_total += $total; ?></td>
          </tr>
          <?php } ?>
        <?php 
        $i++;
        }
        ?>
        </tbody>
        <tfoot>
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
            <td colspan="2">GRAND TOTAL</td>
            <td>₹<?= $grand_total ?></td>
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