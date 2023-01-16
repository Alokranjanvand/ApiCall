<?php
include_once('config.php');
$business_number=$_REQUEST['agent_oto_did'];
$requestedter=json_encode($_REQUEST);
$query_request="INSERT INTO `wa_request` (`requested`, `created_date`) VALUES ('{$requestedter}', now())";
$result_request=mysqli_query($conn,$query_request);
$phone=$_REQUEST['phone'];
if(!empty($_REQUEST['phone']))
{
	$query_business1="SELECT cust_phone,cust_name FROM `wa_notify` where cust_phone='{$phone}' and business_number ='{$business_number}' and `body` != '' group by cust_phone order by cust_name ";
	$result_business1=mysqli_query($conn,$query_business1);
	$query_business="SELECT cust_phone,cust_name FROM `wa_notify` where cust_phone !='{$phone}' and business_number ='{$business_number}' and `body` != '' group by cust_phone order by cust_name ";
	$result_business=mysqli_query($conn,$query_business);
	$row_business1=mysqli_fetch_assoc($result_business1);
}
else
{
	$query_business="SELECT cust_phone,cust_name FROM `wa_notify` where  business_number ='{$business_number}' and `body` != '' group by cust_phone order by cust_name ";
	$result_business=mysqli_query($conn,$query_business);
}

$num_rows=mysqli_num_rows($result_business);
$query_pic = "select id,img from wa_picture";
$result_pic = mysqli_query($conn,$query_pic);
$pic_name = array();
while($pic = mysqli_fetch_assoc($result_pic))
{
	$pic_name[$pic['id']] = array($pic['img']);
}

//die;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Whatsapp Chat Page</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700,300">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.1.2/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

</head>

<body>
    <div class="page">
        <div class="marvel-device nexus5">
            <div class="screen">
                <div class="screen-container">

                    <div class="chat">
                        <div class="chat-container">
                            <div class="user-bar">

                                <div class="avatar">
                                    <img src="img/g-lite logo-02.jpg" alt="Avatar">
                                </div>
                                <!--<div class="name">
                                    <span>Whatsapp</span>
                                    <span class="status">Online</span>
                                </div>--->

                            </div>

                            <div class="conversation-leftpanel">

                                <!-- SearchBox -->
                                <div class="row searchBox">
                                    <div class="col-sm-12 searchBox-inner">
                                        <div class="form-group has-feedback">
                                            <input id="searchText" type="text" class="form-control" name="searchText"
                                                placeholder="Search">
												<input id="business_number" value="<?php echo $business_number; ?>" type="hidden" class="form-control" name="business_number">
                                            <span style="float: right; position: relative; top: -30px;
    right: 12px;"><a href="#"><i class="zmdi zmdi-search"></i></a></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Search Box End -->

                                <!-- sideBar -->
                                <div class="row sideBar" id="res_sidebar">
								<?php if(!empty($_REQUEST['phone']) && ($_REQUEST['phone']==$row_business1['cust_phone'])){?>
								<div class="row sideBar-body" style="width: 100% !important; <?php if(!empty($_REQUEST['phone']) && ($_REQUEST['phone']==$row_business1['cust_phone'])){?> background-color: #f2f2f2<?php } ?>">
                                    <div class="col-sm-12 col-xs-12 sideBar-main">
                                            <div class="row">
                                                <div class="col-sm-12 col-xs-12 sideBar-name" style="margin-top:-8px;" onclick="getChat(<?php echo $row_business1['cust_phone'];?>)">
                                                    <span class="name-meta">
													<?php 
													if(!empty($row_business1['cust_name']))
													{
														echo $row_business1['cust_name'];
													}else
													{
														echo $row_business1['cust_phone'];
													}
													?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
								<?php } ?>
									<?php
								while($row_business=mysqli_fetch_assoc($result_business))
								{
									$i++;
								?>
                                    <div class="row sideBar-body" style="width: 100% !important; <?php if(!empty($_REQUEST['phone']) && ($_REQUEST['phone']==$row_business['cust_phone'])){?> background-color: #f2f2f2<?php } ?>">
                                        <!--<div class="col-sm-2 col-xs-2 sideBar-avatar">
                                            <div class="avatar-icon">
                                                <img src="img/<?php //echo $pic_name[$i][0];?>">
                                            </div>
                                        </div>-->
										
                                        <div class="col-sm-12 col-xs-12 sideBar-main">
                                            <div class="row">
                                                <div class="col-sm-12 col-xs-12 sideBar-name" style="margin-top:-8px;" onclick="getChat(<?php echo $row_business['cust_phone'];?>)">
                                                    <span class="name-meta">
													<?php 
													if(!empty($row_business['cust_name']))
													{
													echo $row_business['cust_name'];
													}else
													{
														echo $row_business['cust_phone'];
													}
													?>
                                                    </span>
                                                    <div class="time-meta"><?php //echo $row_business['cust_phone'];?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
									<?php } ?>
								</div>
                                <!-- Sidebar End -->
                            </div>

                            <div class="conversation">
                                <div class="conversation-container">
								<input type="hidden" id="agent_number" value="<?php echo $business_number;?>">
								<input type="hidden" id="cust_number" value="<?php if(!empty($_REQUEST['phone'])){ echo $_REQUEST['phone'];  }?>">
								<div id="conference_div">
								
								</div>
								<div id="chat_res">
								<?php
								if(!empty($_REQUEST['phone']))
								{
								$phone=$_REQUEST['phone'];
								$query="select * from wa_notify where business_number='{$business_number}' and cust_phone='{$phone}'  and `body` != '' order by id ASC";
								$result=mysqli_query($conn,$query);
								$num_rows=mysqli_num_rows($result);
								if($num_rows>0){
								while($rows_sms=mysqli_fetch_assoc($result))
								{
								?>
									<div class="message received">
                                        <div class="senderno"><?php echo $rows_sms['cust_name'];?><br/>
										<?php/*+91-<?php echo $rows_sms['cust_phone'];?>*/?></div>
                                        <?php echo $rows_sms['body'];?>
										<span class="metadata">
                                            <span class="time"><?php echo date('h:i A',strtotime($rows_sms['date']));?></span>
											
                                        </span>
                                    </div>
                                    <div class="message sent">
                                        <div class="senderno">+91-<?php echo $rows_sms['business_number'];?></div>
                                        Agent's Reply
                                        <span class="metadata">
                                            <span class="time"><?php echo date('h:i A',strtotime($rows_sms['date']));?></span>
											<?php if($rows_sms['status']=='read'){?>
											<span class="tick"><img src="img/blue-tick.png"
                                                    width="16" height="15"></span>
											<?php } else if($rows_sms['status']=='delivered'){?>
													<span class="time"></span><span class="tick"><img src="img/grey-tick.png"
                                                    width="16" height="15"></span>
											<?php } else { ?>
													<span class="time"></span><span class="tick"><img src="img/single-tick.png"
                                                    width="16" height="15"></span>
											<?php } ?>
                                        </span>
                                    </div>
                                    
									<?php } ?>
								<?php } } ?>
								
                                    
                                    </div>
									
                                </div>
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $('#searchText').on( 'keyup click', function () {
		search=$('#searchText').val();
		business_number=$('#business_number').val();
		$.post('loadSidebar.php', {search: search,business_number:business_number}, function (data) {
		//alert(data);
		$("#res_sidebar").html(data);
	});
    });
});
</script>
<script>

function getChat(id)
	{
	$("#chat_res").html("loading...");
	business_number=$('#business_number').val();
	
	$("#cust_number").val(id);
	 $(".sideBar-main").addClass("activesidebar");
	
	$.post('loadChat.php', {id: id,business_number:business_number}, function (data) {
		//alert(data);
		$("#chat_res").html(data);
	});
	}
	
	
	setInterval(function(){                                   
	business_number=$('#business_number').val();
	cust_number=$('#cust_number').val();
	$.ajax({
		type:'POST',
		url:'loadChat.php',
		data:{ id: cust_number,business_number:business_number},
		success:function(responce){
		$("#chat_res").html(data);
	//console.log("result"+responce);
	}
	});
	},3000);
</script>

</body>

</html>
