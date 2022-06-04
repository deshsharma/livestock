<section class="news mt-5">
        <div class="container-fluid">
        <div class="row">
            <div class="col-12">    
                <h3 class="float-left"><span><?= $this->webLanguage['NEWS & Articles']?></span>  </h3>
                <a href="https://www.livestoc.com/webservices_new_dev/article/all?users_id=62903&category_id=1,8" class="viewall float-right"><?= $this->webLanguage['View All']?></a>    
            </div>
        </div>    
        <div class="row mt-3">
            <?php
            if(count($data['articles1']) > 0){
                foreach ($data['articles1'] as $key => $articles) { 
                    if($key == 0) {
                        ?>
                        <div class="col-md-6">
                            <div class="newsbg">
                            <a href="<?= $articles['link'] ?>" target="__blank"><img src="<?= $articles['image_thumb'] ?>" class="img-fluid" alt="image" ></a>
                                <p><span>Posted By</span><?= $articles['author_name'] ?></p>
                                <span class="date"><?php 
                                    $date=date_create($articles['created_on']);
                                    echo date_format($date,"M d");
                                    ?>
                                    </span>
                            </div>
                            <h3 class="mt-3"><?= $articles['title'] ?></h3>
                            <p class="mt-3"><?= $articles['sub_texts'] ?> </p>
                        </div> 
                        <?php } 
                        elseif($key <= 2) { 
                            if($key == 1) {
                            ?>
                            <div class="col-md-6 pl-md-5">
                                <div class="row">
                            <?php } ?>
                                     <div class="col-md-6 mt-5 mt-md-0">
                                        <div class="newsbg">
                                        <a href="<?= $articles['link'] ?>" target="__blank"><img src="<?= $articles['image_thumb'] ?>" class="img-fluid" alt="livestoc"></a>
                                            <p><span>Posted By</span> <?= $articles['author_name'] ?></p>
                                            <span class="date"><?php 
                                             $date=date_create($articles['created_on']);
                                             echo date_format($date,"M d");
                                            ?></span>
                                        </div>
                                        <h3 class="mt-4"><?= $articles['title'] ?></h3>
                                        <p class="mt-3"><?= $articles['sub_texts'] ?></p>
                                    </div>
                                 <?php  if($key == 2) { ?>  
                                </div>
                            </div> 
                        <?php } } 
                }
            }else{
            foreach ($data['articles1'] as $key => $articles) { 
                // echo  $articles->article_id;
                // echo $category;
            if($key == 0) {
            ?>
            <div class="col-md-6">
                <div class="newsbg">
                <a href="https://www.livestoc.com/webservices_new_dev/article/singleArticle?web_link=web_link?users_id='<?= $this->session->userdata("users_id") ?>'&category_id='<?= $category ?>'&article_id=<?= $articles->article_id ?>"><img src="<?php echo $data['articles'][$key]->image; ?>" class="img-fluid" alt="image" ></a>
                    <p><span>Posted By</span><?php echo $data['articles'][$key]->author_name; ?></p>
                    <span class="date"><?php 
                        $date=date_create($data['articles'][$key]->created_on);
                        echo date_format($date,"M d");
                        ?>
                        </span>
                </div>
                <h3 class="mt-3"><?php echo $data['articles'][$key]->title; ?></h3>
                <p class="mt-3"><?php echo $data['articles'][$key]->sub_texts; ?> </p>
            </div> 
            <?php } elseif($key <= 2) { 
                if($key == 1) {
                ?>
                <div class="col-md-6 pl-md-5">
                    <div class="row">
                <?php } ?>
                         <div class="col-md-6 mt-5 mt-md-0">
                            <div class="newsbg">
                            <a href="https://www.livestoc.com/webservices_new_dev/article/singleArticle?web_link=web_link?users_id='<?= $this->session->userdata("users_id") ?>'&category_id='<?= $category ?>'&article_id=<?= $articles->article_id ?>"><img src="<?php echo $data['articles'][$key]->image_thumb; ?>" class="img-fluid" alt="livestoc"></a>
                                <p><span>Posted By</span> <?php echo $data['articles'][$key]->author_name; ?></p>
                                <span class="date"><?php 
                                $date=date_create($data['articles'][$key]->created_on);
                                echo date_format($date,"M d"); 
                                ?></span>
                            </div>
                            <h3 class="mt-4"><?php echo $data['articles'][$key]->title; ?></h3>
                            <p class="mt-3"><?php echo $data['articles'][$key]->sub_texts; ?></p>
                        </div>
                     <?php  if($key == 2) { ?>  
                    </div>
                </div> 
            <?php } } ?> 

            <?php }} ?>   
        </div>
        </div>
    </section>  