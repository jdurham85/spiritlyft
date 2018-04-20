<?php 
session_start();

function who_did_I_send_gift_to()
{
	include 'config.php';
	include 'core.inc.php';
	$sql = mysqli_query($db_con, "select * from member_gift where FromMember = '".$_SESSION['SessionMemberID']."'");

	if(mysqli_num_rows($sql) > 0)
	{
		while($rg = mysqli_fetch_array($sql))
		{
			$TOMemberid = $rg['ToMember'];
			$Giftid = $rg['Giftid'];
			$Message = $rg['Message'];
			?>
			<tr align="center" style="font-family: Arial; background-color: white;">
				<td><strong><?php echo MemberFullName($TOMemberid); ?></strong></td>
				<td><img src="gifts/<?php echo getGiftIMG($Giftid); ?>" width="80" /></td>
				<td><?php echo $Message; ?></td>
			</tr>
			<?php
		}
	}
}

function add_receipt($giftid, $cost, $qty)
{
	date_default_timezone_set(getMemberTimezone($_SESSION['SessionMemberID']));

	$date = time();
	include 'config.php';
	$sql = mysqli_query($db_con, "INSERT INTO `member_gift_receipt`(`id`, `Memberid`, `Giftid`, `Purchase_Date`, `Qty`, `Cost`) VALUES (NULL, '".$_SESSION['SessionMemberID']."', '$giftid', '$date', '$qty', '$cost')");		
}

function add_to_treasurly($giftid, $qty)
{
	include 'config.php';
	
	if(mytreasurly_checkif_gift_exist($giftid) > 0)
	{
		$oldQty = getTreasurelyGiftQty($giftid);
		$newQty = $oldQty + $qty;
		$sql = mysqli_query($db_con, "update `member_treasurely` set Qty = '$newQty' where Memberid = '".$_SESSION['SessionMemberID']."' && Giftid = '$giftid'");	
	}
	else
	{
		$sql = mysqli_query($db_con, "INSERT INTO `member_treasurely`(`id`, `Memberid`, `Giftid`, `Qty`) VALUES (NULL,'".$_SESSION['SessionMemberID']."','$giftid', '$qty')");	
	}
}

function mytreasurly_checkif_gift_exist($giftid)
{
	include 'config.php';
	$sql = mysqli_query($db_con, "select * from `member_treasurely` where Memberid = '".$_SESSION['SessionMemberID']."' && Giftid = '$giftid'");	
	
	return mysqli_num_rows($sql);
}

function getTreasurelyGiftQty($giftid)
{
	include 'config.php';
	$sql = mysqli_query($db_con, "SELECT * FROM `member_treasurely` WHERE Memberid = '".$_SESSION['SessionMemberID']."' && Giftid = '$giftid'");
	
	if(mysqli_num_rows($sql) > 0)
	{
		while($q = mysqli_fetch_array($sql))
		{
			return $q['Qty'];	
		}	
	}
	else
	{
		return 0;
	}
}

function my_cart_to_mytreasurly()
{
	include 'config.php';
	$sql = mysqli_query($db_con, "SELECT * FROM `mycart` WHERE Memberid = '".$_SESSION['SessionMemberID']."'");
	
	while($g = mysqli_fetch_array($sql))
	{
		add_to_treasurly($g['giftid'], $g['qty']);	
		add_receipt($g['giftid'], ($g['cost'] * $g['qty']), $g['qty']);
	}
		
	//sleep(1);	
	clear_mycart();
}

function mytreasuly_show()
{
	include 'config.php';
	?>
    <tr class="treasure_title">
    	<td>Pic</td><td>Qty</td><td></td>
    </tr>
    <?php
	$sql = mysqli_query($db_con, "select * from member_treasurely where Memberid = '".$_SESSION['SessionMemberID']."'");
	
	while($t = mysqli_fetch_array($sql))
	{
		if(!$t['Qty'] == 0)
		{
			echo "<tr class='treasure_row'>";
			echo "<td><img id='giftimg".$t['Giftid']."' src='../gifts/".getGiftIMG($t['Giftid'])."' width='100'/></td><td id='giftqty".$t['Giftid']."'>".$t['Qty']."</td><td><button onClick='send_giftbox_show(".$t['Giftid'].");'>Send Gift</button></td>";
			echo "</tr>";
		}
	}
		
}

function send_gift_to_connection($giftid, $toMemberid, $message)
{
	include 'config.php';
	include 'core.inc.php';
	include 'mail.inc.php';
	$oldQty = getTreasurelyGiftQty($giftid) - 1;
	
	//Update member_treasurely QTY
	$sql = mysqli_query($db_con, "update member_treasurely set Qty = '$oldQty' where Memberid = '".$_SESSION['SessionMemberID']."' && Giftid = '$giftid'") or die(0);
	
	sleep(1);
	
	//Send to Member
	$sql1 = mysqli_query($db_con, "INSERT INTO `member_gift`(`id`, `ToMember`, `FromMember`, `Giftid`, `Message`, `vStatus`) VALUES (NULL, '$toMemberid', '".$_SESSION['SessionMemberID']."', '$giftid', '$message', '1')") or die(0);
	
	sleep(1);
	
	///SET MEMBER ALERT	
	$sql = mysqli_query($db_con, "INSERT INTO `member_notification`(`id`, `Wallid`, `toMember`, `fromMember`, `Mode`, `vStatus`) VALUES (NULL, '0', '$toMemberid', '".$_SESSION['SessionMemberID']."', '3' , '1')");

	if(check_if_member_active($toMemberid) == 0) //Checking if member not online
	{
		if(MemberPhoneNumber_Exist($toMemberid) > 0)
		{
			$Message = MemberFullName($_SESSION['SessionMemberID'])."has sent you a gift \r\n https://www.spiritlyft.com/mygift.php";
			send_text_message($toMemberid, $Message);
		}

		//send_connection_request_email($toMemberid, $_SESSION['SessionMemberID']);
	}

	echo 0;	
}

function clear_mycart()
{
	include 'config.php';
	mysqli_query($db_con, "delete from mycart where Memberid = '".$_SESSION['SessionMemberID']."'");	
	
	return 0;
}

function getGiftName($giftid)
{
	include 'config.php';
	
	$sql = mysqli_query($db_con, "select * from giftshop where Giftid = '$giftid'");
	
	while($g = mysqli_fetch_array($sql))
	{
		return $g[''];	
	}	
}

function getGiftIMG($giftid)
{
	include 'config.php';
	
	$sql = mysqli_query($db_con, "select * from giftshop where Giftid = '$giftid'");
	
	while($g = mysqli_fetch_array($sql))
	{
		return $g['Filename'];	
	}	
}

function mygift_show()
{
	?>
    <tr>
    	<td>Image</td><td>From</td><td>Message</td><td></td>
    </tr>
    <?php
	include 'config.php';
	include 'core.inc.php';
	$sql = mysqli_query($db_con, "select * from member_gift where ToMember = '".$_SESSION['SessionMemberID']."'");
	
	
	while($g = mysqli_fetch_array($sql))
	{	echo "<tr class='mygift_data'>";
		echo "<td><img src='../gifts/".getGiftIMG($g['Giftid'])."' width='100' /></td><td><strong>".MemberFullName($g['FromMember'])."</strong></td><td style='background-color:white;'>".$g['Message']."</td>";
		echo "</tr>";	
	}
	
}

function add_to_mycart($memberid, $giftid, $filename, $point)
{
	include 'config.php';
	$sql = mysqli_query($db_con, "INSERT INTO `mycart`(`id`, `memberid`, `giftid`, `qty`, `filename`, `point`) VALUES (NULL, '$memberid', '$giftid', '1', '$filename', '$point')") or die(mysqli_error($db_con));
}

function getOrderTotal()
{
	include 'config.php';
	$MAINMEMBER = $_SESSION['SessionMemberID'];
	$sql = mysqli_query($db_con, "select * from mycart where memberid = '$MAINMEMBER'") or die(mysqli_error($db_con));
	$total = '';
	
	while($g = mysqli_fetch_array($sql))
	{
		$id = $g['id'];
		$giftid = $g['giftid'];
		$qty = $g['qty'];
		$gift_filename = $g['filename'];
		$gift_point = number_format(($g['point']/1), 2);
		$total += $gift_point * $qty;
	}
	
	return $total;
}

function check_mycart($memberid, $giftid)
{
	include 'config.php';
	$sql = mysqli_query($db_con, "select * from mycart where memberid = '$memberid' && giftid = '$giftid'") or die(mysqli_error($db_con));
	
	return mysqli_num_rows($sql);	
}

function update_mycart($cartid, $newqty)
{
	include 'config.php';
	$sql = mysqli_query($db_con, "update mycart set qty = '$newqty' where id = '$cartid'");
}

function remove_item_mycart($id)
{
	include 'config.php';
	$sql = mysqli_query($db_con, "delete from mycart where id = '$id'");	
}

function paypal_buynow($price)
{
	$ppcode = '<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
	<input type="hidden" name="cmd" value="_xclick">
	<input type="hidden" name="business" value="3D4ZS6DNHSLNC">
	<input type="hidden" name="lc" value="US">
	<input type="hidden" name="item_name" value="Giftshop">
	<input type="hidden" name="amount" value='.$price.'>
	<input type="hidden" name="currency_code" value="USD">
	<input type="hidden" name="button_subtype" value="services">
	<input type="hidden" name="no_note" value="1">
	<input type="hidden" name="no_shipping" value="1">
	<input type="hidden" name="rm" value="1">
	<input type="hidden" name="return" value="https://www.spiritlyft.com/gift_success.php">
	<input type="hidden" name="cancel_return" value="https://www.spiritlyft.com/revieworder.php">
	<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHosted">
	<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
	<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
	</form>';
	
	echo $ppcode;
}

function revieworder()
{
	include 'config.php';
	$MAINMEMBER = $_SESSION['SessionMemberID'];
	$sql = mysqli_query($db_con, "select * from mycart where memberid = '$MAINMEMBER'") or die(mysqli_error($db_con));
	$total = '';
	//id`, `memberid`, `giftid`, `filename`, `point`
	
	?>
    	<tr align="center">
        	<td width="200" style="font-weight:bolder; font-family:Arial;">
            	Item
            </td>
            <td width="200" style="font-weight:bolder; font-family:Arial;">
            	Qty
            </td>
            <td width="200" style="font-weight:bolder; font-family:Arial;">
            	Price
            </td>
        </tr>
    <?php
	
	while($g = mysqli_fetch_array($sql))
	{
		$id = $g['id'];
		$giftid = $g['giftid'];
		$qty = $g['qty'];
		$gift_filename = $g['filename'];
		$gift_point = number_format(($g['point']/1), 2);
		
		$total += $gift_point * $qty;
		
		?>
        	<tr style="font-family:Arial;">
            	<td align="center">
                	<img src="gifts/<?php echo $gift_filename; ?>" style="width: 80px;" />
                </td>
                <td align="center">
                	<?php echo $qty; ?>
                </td>
                <td align="center">
                	<?php echo "$".$gift_point * $qty; ?>
                </td>
            </tr>
        <?php
	}
	
	if(mysqli_num_rows($sql) > 0)
	{
		?>
        <tr align="center">
            <td></td>
            <td></td>
            <td>
            	<table style="font-family:Arial; font-weight:bold;">
                    <tr align="center" height="30">
                        <td>Total:</td>
                        <td><?php echo "$".$total; ?></td>
                    </tr>
                    <tr align="center">
                    	<td colspan="2" height="30">
                        	<?php echo paypal_buynow($total); ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <?php	
	}
}

function show_mycart()
{
	include 'config.php';
	$MAINMEMBER = $_SESSION['SessionMemberID'];
	$sql = mysqli_query($db_con, "select * from mycart where memberid = '$MAINMEMBER'") or die(mysqli_error($db_con));
	
	if(mysqli_num_rows($sql) == 0)
	{
		?>
			<tr>
				<td colspan="4" align="center">
					Your Cart is empty <a target="_parent" href="giftshop.php">Click here to the GiftShop</a>
				</td>
			</tr>
		<?php	
	}
	else
	{
	?>
          <tr align="center">
              <td width="25%" align="center">
                  Item
              </td>
              <td width="25%" align="center">
                  Qty
              </td>
              <td width="25%" align="center">
                  Price
              </td>
              <td width="25%" align="center">
                  Options
              </td>
          </tr>
    <?php	
	}
	
	while($g = mysqli_fetch_array($sql))
	{
		$id = $g['id'];
		$giftid = $g['giftid'];
		$qty = $g['qty'];
		$gift_filename = $g['filename'];
		$gift_point = number_format(($g['point']/1), 2);
		?>
        	<tr class="mycart_style">
            	<td width="25%" align="center">
                	<img src="gifts/<?php echo $gift_filename; ?>" style="width: 80px;" />
                </td>
                <td width="25%" align="center">
                	<input type="text" value="<?php echo $qty; ?>" maxlength="2" id="myorderqty<?php echo $id; ?>" onKeyPress="return check_qty_input(event);" /><button id="cartqty_btn<?php echo $id; ?>" onClick="update_cart_qty(<?php echo $id; ?>);">Update</button>
                    
                </td>
                <td width="25%" align="center">
                	<?php echo "$".$gift_point * $qty; ?><input type="hidden" value="<?php echo $gift_point; ?>" class="cartsubtotal" id="cartsubtotal<?php echo $id; ?>" />
                </td>
                <td width="25%" align="center">
                	<a href="javascript:void(0);" onClick="remove_product(<?php echo $id; ?>);">Remove</a>
                </td>
            </tr>
        <?php
	}
	
	?>
    	<tr>
        	<td>
        	</td>
            
            <td>
        	</td>
            
            <td align="right">
            	<a target="_parent" href="giftshop.php"><button class="style_button1">GiftShop</button></a>
            </td>
            
        	<td align="right">
            	<button class="style_button1" onClick="go_to_reviewOrder();">Review Order</button>
            </td>
        </tr>
    <?php
}

function get_Selected_GiftsCategory($categoryid)
{
	include 'config.php';

	$sql = mysqli_query($db_con, "SELECT * FROM `gifts_category`");
	echo '<option value="">All</option>';
	if(mysqli_num_rows($sql) > 0)
	{
		while($c = mysqli_fetch_array($sql))
		{
			if($c['id'] == $categoryid)
			{
				echo '<option value="'.$c['id'].'" selected="selected">'.$c['Name'].'</option>';
			}
			else
			{
				echo '<option value="'.$c['id'].'">'.$c['Name'].'</option>';		
			}
		}	
	}	
}

function getGiftsCategory()
{
	include 'config.php';

	$sql = mysqli_query($db_con, "SELECT * FROM `gifts_category`");
	
	echo '<option value="0">select a category</option>';
	
	if(mysqli_num_rows($sql) > 0)
	{
		while($c = mysqli_fetch_array($sql))
		{
			echo '<option value='.$c['id'].'>'.$c['Name'].'</option>';
		}	
	}		
}

function getGiftsCategory2()
{
	include 'config.php';

	$sql = mysqli_query($db_con, "SELECT * FROM `gifts_category`");
	echo "<tr><td><a href='javascript:void(0);' onClick='show_gifts2(0, 1);'>All</a></td></tr>";
	
	
	if(mysqli_num_rows($sql) > 0)
	{
		while($c = mysqli_fetch_array($sql))
		{
			//echo '<option value='.$c['id'].'>'.$c['Name'].'</option>';
			?>
			<?php echo "<tr><td><a href='javascript:void(0);' onClick='show_gifts2(".$c['id'].", 1);'>".$c['Name']."</a></td></tr>" ?>
			<?php
		}	
	}		
}

function show_gifts_by_category($category, $page)
{
	include 'config.php';
	$MAINMEMBER = $_SESSION['SessionMemberID'];
	?>
        <div style="float: left; width: 100%;">
        	<div colspan="" align="center" colspan="">
            <button style="" onClick="go_to_mycart();">My Cart <span id="mycart_alert"></span></button>
            </div>
            <div>
            	<img onClick="giftshopborder_toggle();" src="image/question-mark-in-a-circle-outline_318-53407.png" style="float: right; width: 50px;" />
            	<a target="_parent" href="mytreasure.php"><img src="../image/chest.png" style="width:50px; height:50px; float:right;" /></a>
                <a target="_parent" href="mygift.php"><img src="../image/vgift_icon.png" style="width:50px; height:50px; float:right;" /></a>
            </div>
        </div>
        <div style="width: 100%; float: left;" align="center">
        	<select id="gcategory" onChange="show_gifts_by_category();">
					<?php get_Selected_GiftsCategory($category); ?>
            </select>
        </div>
   <?php
   
   		$sql = mysqli_query($db_con, "select * from giftshop where Categoryid = '$category'");	
		while($g = mysqli_fetch_array($sql))
		{
			$Giftid = $g['Giftid'];
			$GiftName = $g['Name'];
			$GiftFileName = $g['Filename'];
			$GiftCategoryid = $g['Categoryid'];
			$GiftDescription = $g['Description'];
			$GiftCost = number_format(($g['Cost']/1), 2);
			
			if($GiftCategoryid != 0)
			{
			?>
            <div style="float: left; margin-top: 20px; margin-left: 1px; padding-left: 2px; border:1px black solid; width: 84px;">
	            	<div style="width: 100%; height: 50px;" align="center">
	                	<img src="gifts/<?php echo $GiftFileName; ?>" style="width: 50px; height: 50px;" />
		            </div>
		                <div style="font-family:arial; height: 50px; margin-top: 20px;">
		                    <strong>Cost:</strong> <?php echo "$".$GiftCost; ?>
		                </div>
		                <div style="width:100%; height:50px;">
		                    		
		                <?php
						if(check_mycart($MAINMEMBER, $Giftid) > 0)
						{
						?>
		                <button id="gift_btn<?php echo $Giftid; ?>" onClick="">Added to Cart</button>
		                <?php		
						}
						else
						{
						?>
		                <button id="gift_btn<?php echo $Giftid; ?>" onClick="add_to_mycart(<?php echo $Giftid . ", '" . $GiftFileName . "', " . $GiftCost; ?>);">Add to Cart</button>
		                <?php	
						}					
						?>
		                </div>
	            </div>
            <?php	
		}	
		
		}
		
}

function show_gifts($category, $page) //For Mobile Only
{
	include 'config.php';
	$MAINMEMBER = $_SESSION['SessionMemberID'];
	?>
        <div style="float: left; width: 100%;">
        	<div colspan="" align="center" colspan="">
            <button style="" onClick="go_to_mycart();">My Cart <span id="mycart_alert"></span></button>
            </div>
            <div>
            	<img onClick="giftshopborder_toggle();" src="image/question-mark-in-a-circle-outline_318-53407.png" style="float: right; width: 50px;" />
            	<a target="_parent" href="mytreasure.php"><img src="../image/chest.png" style="width:50px; height:50px; float:right;" /></a>
                <a target="_parent" href="mygift.php"><img src="../image/vgift_icon.png" style="width:50px; height:50px; float:right;" /></a>
            </div>
        </div>
        <div style="width: 100%; float: left;" align="center">
        	<select id="gcategory" onChange="show_gifts_by_category();">
				<?php echo getGiftsCategory(); ?>
            </select>
        </div>
   <?php
   
   		$sql = mysqli_query($db_con, "select * from giftshop");	
		while($g = mysqli_fetch_array($sql))
		{
			$Giftid = $g['Giftid'];
			$GiftName = $g['Name'];
			$GiftFileName = $g['Filename'];
			$GiftCategoryid = $g['Categoryid'];
			$GiftDescription = $g['Description'];
			$GiftCost = number_format(($g['Cost']/1), 2);
			
			if($GiftCategoryid != 0)
			{
			?>
            <div style="float: left; margin-top: 20px; margin-left: 1px; padding-left: 2px; border:1px black solid; width: 84px;">
	            	<div style="width: 100%; height: 50px;" align="center">
	                	<img src="gifts/<?php echo $GiftFileName; ?>" style="width: 50px; height: 50px;" />
		            </div>
		                <div style="font-family:arial; height: 50px; margin-top: 20px;">
		                    <strong>Cost:</strong> <?php echo "$".$GiftCost; ?>
		                </div>
		                <div style="width:100%; height:50px;">
		                    		
		                <?php
						if(check_mycart($MAINMEMBER, $Giftid) > 0)
						{
						?>
		                <button id="gift_btn<?php echo $Giftid; ?>" onClick="">Added to Cart</button>
		                <?php		
						}
						else
						{
						?>
		                <button id="gift_btn<?php echo $Giftid; ?>" onClick="add_to_mycart(<?php echo $Giftid . ", '" . $GiftFileName . "', " . $GiftCost; ?>);">Add to Cart</button>
		                <?php	
						}					
						?>
		                </div>
	            </div>
            <?php	
		}	
		
		}
		
}

function total_gifts()
{
	include 'config.php';
	$sql = mysqli_query($db_con, "SELECT * FROM `giftshop` where `Categoryid` > 0");	

	return mysqli_num_rows($sql);
}

function total_gifts_selected_by_category($category)
{
	include 'config.php';
	$sql = mysqli_query($db_con, "SELECT * FROM `giftshop` where `Categoryid` = '$category'");	

	return mysqli_num_rows($sql);
}

function show_gifts2($category, $page)
{
	include 'config.php';
	$MAINMEMBER = $_SESSION['SessionMemberID'];
	$items_per_page = 10;

	$page--;

	$offset = ($page * $items_per_page);
	?>
        <div style="float: left; width: 100%;">
        	<div colspan="" align="center" colspan="">
            <button style="" onClick="go_to_mycart();">My Cart <span id="mycart_alert"></span></button>
            </div>
            <div>
            	<img onClick="giftshopborder_toggle();" src="image/question-mark-in-a-circle-outline_318-53407.png" style="float: right; width: 50px;" />
            	<a target="_parent" href="mytreasure.php"><img src="../image/chest.png" style="width:50px; height:50px; float:right;" /></a>
                <a target="_parent" href="mygift.php"><img src="../image/vgift_icon.png" style="width:50px; height:50px; float:right;" /></a>
            </div>
        </div>
   <?php
   		if($category > 0)
   		{
   			$sql = mysqli_query($db_con, "select * from giftshop where `Categoryid` = $category limit $items_per_page offset $offset");	
   			?>
   			<input type="hidden" id="total_item" value="<?php 
   			if(ceil(total_gifts_selected_by_category($category) / $items_per_page) == 0)
   				{
   					echo 1;
   				}
   				else
   				{
   					echo (int)ceil(total_gifts_selected_by_category($category) / $items_per_page); 
   				}

   			?>">
	   			<div style="width: 100%; float: left;" align="left">
	   				<span style="float: left; margin-top: 8px; padding-right: 10px;"><?php echo "Page ".(int)($page + 1)." of " . (int)ceil(total_gifts_selected_by_category($category) / $items_per_page) . "	"; ?></span>
	   				<button onclick="show_gifts2_back(<?php echo $category; ?>);">Back</button><button onclick="show_gifts2_next(<?php echo $category; ?>);">Next</button>
	   			</div>
   			<?php
			while($g = mysqli_fetch_array($sql))
			{
				$Giftid = $g['Giftid'];
				$GiftName = $g['Name'];
				$GiftFileName = $g['Filename'];
				$GiftCategoryid = $g['Categoryid'];
				$GiftDescription = $g['Description'];
				$GiftCost = number_format(($g['Cost']/1), 2);
				
				?>
	            <div style="float: left; margin-top: 20px; margin-left: 1px; border:1px black solid; padding-left: 12px; width: 120px;">
	            	<div style="width: 100%; height: 100px;">
	                	<img src="gifts/<?php echo $GiftFileName; ?>" style="width: 100px; height: 100px;" />
		            </div>
		                <div style="font-family:arial; height: 50px; margin-top: 20px;">
		                    <strong>Cost:</strong> <?php echo "$".$GiftCost; ?>
		                </div>
		                <div style="width:100%; height:50px;">
		                    		
		                <?php
						if(check_mycart($MAINMEMBER, $Giftid) > 0)
						{
						?>
		                <button id="gift_btn<?php echo $Giftid; ?>" onClick="">Added to Cart</button>
		                <?php		
						}
						else
						{
						?>
		                <button id="gift_btn<?php echo $Giftid; ?>" onClick="add_to_mycart(<?php echo $Giftid . ", '" . $GiftFileName . "', " . $GiftCost; ?>);">Add to Cart</button>
		                <?php	
						}					
						?>
		                </div>
	            </div>
	            <?php	
			}
   		}
   		else
   		{
   			$sql = mysqli_query($db_con, "select * from giftshop where `Categoryid` !=0 limit $items_per_page offset $offset") or die(mysqli_error($db_con));
   			?>
   			<input type="hidden" id="total_item" value="<?php echo (int)ceil(total_gifts() / $items_per_page); ?>">
   			<div style="width: 100%; float: left;" align="left">
   				<span style="float: left; margin-top: 8px; padding-right: 10px;"><?php echo "Page ".(int)($page + 1)." of " . (int)(total_gifts() / $items_per_page); ?></span>
   				<button onclick="show_gifts2_back(0);">Back</button><button onclick="show_gifts2_next(0);">Next</button>
   			</div>
   			<?php

			while($g = mysqli_fetch_array($sql))
			{
				$Giftid = $g['Giftid'];
				$GiftName = $g['Name'];
				$GiftFileName = $g['Filename'];
				$GiftCategoryid = $g['Categoryid'];
				$GiftDescription = $g['Description'];
				$GiftCost = number_format(($g['Cost']/1), 2);
				
				
				?>
	            <div style="float: left; margin-top: 20px; margin-left: 1px; border:1px black solid; padding-left: 12px; width: 120px;">
	            	<div style="width: 100%; height: 100px;">
	                	<img src="gifts/<?php echo $GiftFileName; ?>" style="width: 100px; height: 100px;" />
		            </div>
		                <div style="font-family:arial; height: 50px; margin-top: 20px;">
		                    <strong>Cost:</strong> <?php echo "$".$GiftCost; ?>
		                </div>
		                <div style="width:100%; height:50px;">
		                    		
		                <?php
						if(check_mycart($MAINMEMBER, $Giftid) > 0)
						{
						?>
		                <button id="gift_btn<?php echo $Giftid; ?>" onClick="">Added to Cart</button>
		                <?php		
						}
						else
						{
						?>
		                <button id="gift_btn<?php echo $Giftid; ?>" onClick="add_to_mycart(<?php echo $Giftid . ", '" . $GiftFileName . "', " . $GiftCost; ?>);">Add to Cart</button>
		                <?php	
						}					
						?>
		                </div>
	            </div>
	            <?php		
			}
   		}	
		
}

//////////////////////////////////////////

//Show MyGift
if(isset($_POST['mygift_show']))
{
	echo mygift_show();
}

//Sending Gift to Connections
if(isset($_POST['send_gift_to_connection']) && $_POST['send_gift_to_connection'] == 1)
{
	echo send_gift_to_connection($_POST['giftid'], $_POST['toMember'], $_POST['message']);	
}

//Show MyTreasure
if(isset($_POST['mytreasure']))
{
	echo mytreasuly_show();	
}

//adding to my cart
if(isset($_POST['giftid']) && isset($_POST['point']))
{
	$MAINMEMBER = $_SESSION['SessionMemberID'];
	echo add_to_mycart($MAINMEMBER, $_POST['giftid'], $_POST['filename'], $_POST['point']);	
}

//show mycart
if(isset($_POST['mycart']))
{
	echo show_mycart();	
}

//show order review
if(isset($_POST['revieworder']))
{
	echo revieworder();	
}

//Remove Item from my cart
if(isset($_POST['mycartremove']))
{
	remove_item_mycart($_POST['cartid']);
}

//Updating Cart QTY
if(isset($_POST['mycartqty']))
{
	update_mycart($_POST['cartid'], $_POST['cartqty']);	
}

//show_gifts_by_category
if(isset($_POST['show_gifts_by_category']))
{
	show_gifts_by_category($_POST['categoryid'], $_POST['page']);
}

//pagingnation, show_gifts, sort by category GIFTSHOP
if(isset($_POST['show_gifts']) && isset($_POST['category']))
{
	$category = $_POST['category'];
	$page = $_POST['page'];
	echo show_gifts($category, $page);	
}
?>