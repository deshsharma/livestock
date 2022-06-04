<?php 
include_once('layouts/admin_header.php');
include_once('layouts/admin_nav.php');
?>

<style type="text/css">
         .error {
            margin: 27%;
            width: auto;
            color:red;
            display: inline;
            font-weight: 100;
        }  
</style>
<div class="content-wrapper" >

<div class="abc" ><h3>ADD API DETAILS</h3></div>

<div class="abc_1" >
      <?php if( $error = $this->session->flashdata('add_bank')){ ?>
        <diV class="col-md-3"></div>
        <div class="col-md-9 corm_nmset">
            <div class=" error" style="margin-left:0%;">
                <?= $error ?>
            </div>
        </div>
    <?php } ?>
        <?php echo form_open("admin/apis_edit/"+$details['id']);?>

            <?php echo form_error('description'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Description</strong>
            </div>
            <div class="col-md-9">
                <textarea value=" <?php echo $details[0]['description'] ?>" class="form-control ch_manset padd_set" name="description" id="description" rows="10" placeholder="Description ..."><?php echo $details[0]['description'] ?></textarea>
        	</div>

            <?php echo form_error('linkurl'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">API Url</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'linkurl', 'value'=>$details[0]['linkurl'], 'id'=>'linkurl','class'=>'ch_manset padd_set']) ?>
        	</div>

            <div class="col-md-3" > 
        	   <strong class="right_sre">Detail Params</strong>
            </div>
            <div class="col-md-9" id="details">
               Details for Params
        	</div>


            <div class="col-md-3" style="margin-bottom: 20px;"> 
        	   <strong class="right_sre">Method for API</strong>
            </div>
            <div class="col-md-9" style="margin-bottom: 20px;">
                <?php  if($details[0]['method'] == 'POST')  { ?>
                    POST <?php echo form_input(['checked'=>1,'type'=>'radio','name'=>'lom', 'value'=>'POST', 'id'=>'lom','class'=>'']) ?>
                    GET <?php echo form_input(['type'=>'radio','name'=>'lom', 'value'=>'GET', 'id'=>'lom','class'=>'']) ?>
                <?php } else { ?>
                    POST <?php echo form_input(['type'=>'radio','name'=>'lom', 'value'=>'POST', 'id'=>'lom','class'=>'']) ?>
                    GET <?php echo form_input(['checked'=>1, 'type'=>'radio','name'=>'lom', 'value'=>'GET', 'id'=>'lom','class'=>'']) ?>
                <?php } ?>
        	</div>
            
            <div class="col-md-3" > 
        	   <strong class="right_sre">Check API Response</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'button','name'=>'submit', 'value'=>'Check API Response', 'id'=>'submit','class'=>'btn btn-info but_set']) ?>
        	</div>

            <input type="hidden" name="jsonresponse" id='jsonresponse'>
            <input type="hidden" name="detailsjson" id='detailsjson'>

            <div style="margin-left: 31%;" >
            <?php 
                echo form_submit(['name'=>'submit','value'=>'Add', 'onkeyup'=>'check();', 'class'=>'btn btn-danger', 'style'=>'width:100px;']);
            ?>
            </div>

            <div class="col-md-9" id="message">
                
            </div>

            <div style="clear: left;"></div>
        </div>
        </form>
</div>
<script type="text/javascript">

$(document).ready(function (){
    //console.log(getUrlVars($('#linkurl').val()));
    //console.log($("input[name='lom']:checked").val());
    if($('#linkurl').val()!=''){
        var myObj = {};
        var valueParams = getUrlVars($('#linkurl').val());
        var methodType = $("input[name='lom']:checked").val();
        var table = $("<table><tr><th>URL PARAMS</th></tr>");
        for (var i = 0; i < valueParams.length; i++) {
            console.log(valueParams[i])
            console.log(valueParams[valueParams[i]]);
            table.append("<tr><td>" + valueParams[i] + ":</td><td>" + valueParams[valueParams[i]] + "</td></tr>");
            myObj[valueParams[i]]  = valueParams[valueParams[i]];
        }
        $("#details").html(table);
        $('#detailsjson').val(JSON.stringify(myObj));
        $.ajax({
            type: methodType,
            url: $('#linkurl').val(),
            dataType: "json",
            success: function (result) {
                var result = result;
                //console.log(result);
                jsonPretty = JSON.stringify(result, null, 4);
                //var jsonPretty = JSON.stringify(jsonPretty, null, "\t");
                var table = $("<table><tr><th>Response</th></tr>");
                table.append("<tr><td>City:</td><td><pre>" + jsonPretty + "</pre></td></tr>");
                $("#message").html(table);
                $('#jsonresponse').val(jsonPretty);
            },
            error: function (xhr, status, error) {
                alert("Result: " + status + " " + error + " " + xhr.status + " " + xhr.statusText)
            }
        });
    }else{
        alert('Please add url for API');
    }
});

function getUrlVars(urlAPI)
{
    var vars = [], hash;
    var hashes = urlAPI.slice(urlAPI.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}
 </script>
 <?php include_once('layouts/admin_footer.php'); ?>
