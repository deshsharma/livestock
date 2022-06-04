<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Share Happiness</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/74d90de4f1.js"></script>
    <style>
         body{font-family: 'Poppins', sans-serif;margin:0%;}
        .wrap{margin:0 auto; width:80%}
        .top_image{width:100%;}
        .top_image img{width:100%; height:auto}
        .content{padding:3%;width:91%;}
        .content h3{color: #48ade4;font-size: 20px;font-weight: 600;letter-spacing: 0.5px;}
        .content ul{padding-left:4%; color:#153547;list-style: none;}
        .content ul li{margin-bottom:4%; color:#153547; font-size:17px;position:relative;}
        .content ul li span{margin-bottom:4%; color:#153547; font-weight:600;}
        .content ul li:before {content: "•";font-size: 300%;padding-right: 5px;position: absolute;left: -27px;top: -26px;}
        .mb40{margin-bottom:40px;}
        @media (max-width: 767px){
            .wrap{width:100%}
            .content ul{padding-left:8%;}
            .mb40{margin-bottom:0px;}
        }
    </style>
</head>

<body>
    <div class="wrap">
        <div class="top_image">
            <?php if($id == 0){?>
        <img src="https://www.livestoc.com/assets/images/share_happiness.jpg" alt="image">
        <?php }else{?>
        <img src="https://www.livestoc.com/assets/images/share_happiness.jpg" alt="image">
        <?php }?>
    </div>
        <div class="content">
        <?php if($id == 0){ ?>
       
        <ul>
            <li>Post your Animals for Sale completely <span>FREE in Smart Display at Livestoc</span></li>
            <li>Showcase your Animals impressively through Videos and Photos to Millions of potential buyers in <span>Smart Display at Livestoc</span></li>
            <li>Sell QUICK &amp; <span>FAST</span> at a <span>BETTER PRICE</span>. Time to earn the profits you’ve been waiting for all these years.</li>
            <li>Post Multiple Images and Videos of Your Animal to get more eyes- <span>MORE VIEWS, MORE LIKES, MORE SALES</span></li>
            <li>Post relevant information in our <span>Smart Display for buyers</span> to see and respond quickly like category, breed, yield, price, lactation number, pregnancy status, parentage, calf at foot etc</li>
            <li>Maximize you reach, sales and profits through Smart Display by using its unique feature that allows you to <span>share the animals from Smart Display</span> at Livestoc to all other Social Media Handles like Whatsapp, Facebook,Instagram, etc from click of a button.</li>
            <li><span>Sell Directly</span> to Millions of Buyers from across the country</li>
            <li>No Brokerage Fee</li>
            <li>No Mandi Fee</li>
            <li>No Travelling Expense</li>
            <li>Do Everything from the Comfort of your Home.</li>
            <h3>Featured Animal Kingdom- Ultimate Panacea</h3>
            <li>Showcase your Animals in Featured Animal Kingdom to Sell at a Better Price</li>
            <li>Find Premium Buyers through Premium Listing</li>
            <li>Sell Fastest here as Buyers first Check the Premium Animals at Featured Animal Kingdom</li>
            <li>Pay only Rs 500 and Showcase your Animal in Featured Animal Kingdom</li>
        </ul>
    <?php }else{ ?>
        
        <h3>Millions of Animals Available Here in our Smart Display at Livestoc</h3>
        <ul>
            <li>Free and Direct Access to Million of Sellers and Animals from Across the Country- Find the Happiness you are looking for at Livestoc.</li>
            <li>Get Free Access to Top Breeders and Dealers across the Country- Reap Quality Benefits without Spending a Penny.</li>
            <li>See High Definition Photos and Videos of Animals posted by Sellers, Breeders, Traders at our Smart Display Listings from the convenience of your Home.</li>
            <li>You are at a Better Bargaining Position, Save Money and Buy Better Stock at Livestoc as we offer More Sellers, More Breeders, More Animals. YOU WIN </li>
            <li>Have your pick from the widest range of finest Bred Animals Sat Smart Display- Plenty of Options to Choose From</li>
            <li>Quickly surf through the Smart Display as it offers you all the relevant information at a glance like Breed, Yield, Lactation, Price, Pregnancy Status etc.</li>
            <li>Conveniently Narrow Down your Search as per your requirement using Smart Filters at our Smart Display Listings</li>
            <li>Save Mandi Fee</li>
            <li>Save Brokerage Fee</li>
            <li>Save Travelling Costs </li>
        </ul>
       
    <?php } ?>
        <form action="" method="post">
            <div class="col-md-6 pl-md-5 pl-4 mt-2 mt-md-0">
               <button type="submit" class="btn btn-primary"><a herf="<?= base_url('homenew/sell_animals')?>">SELL ANIMAL</a></button>
           </div>
        </form>
    </div>
    </div>
</body>
