<?php 
function searchinquery_length($ColumnResult, $searchResults)
{
	include 'config.php';
	
	$sql = mysqli_query($db_con, $ColumnResult) or die(mysqli_error($db_con));
	
	return mysqli_num_rows($sql);
}

$ColumnValue = '';
$ColumnValueKey = '';
function searchinquery1($searchInQuery)
{
	include 'config.php';
	$row_length = 0;

	$ColumnResults = array();
	$searchQuery = array();
	$SelectedColumn = '';
	$searchResults = '';
	$mode = 0;
	
	//$number_item_per_page = 4;
	
	//$limit = " limit $number_item_per_page offset 0";

	$searchInquery = str_replace(" ", ",", $searchInQuery);

	$word_count = explode(',', $searchInquery);

	try {
		if(strlen($word_count[0]) >= 3)
		{
			$searchQuery[] = "`First` = '$word_count[0]'";

			$searchQuery[] = "`First` Like '%$word_count[0]%'";

			$searchQuery[] = "`First` Like '%$word_count[0]% %$word_count[1]%'";

			$searchQuery[] = "`Last` = '$word_count[0]'";

			$searchQuery[] = "`Last` = '$word_count[0] $word_count[1]'";

			$searchQuery[] = "`Email` = '$word_count[0]'";
			
			$searchQuery[] = "`First` = '$word_count[0]' && `Last` = '$word_count[1]'";

			$searchQuery[] = "`First` = '$word_count[1]' && `Last` = '$word_count[0]'";

			$searchQuery[] = "`First` = '$word_count[1]' && `Last` = '$word_count[0]' && `City` = '$word_count[2]' && `State` = '$word_count[3]'";

			$searchQuery[] = "`First` = '$word_count[0]' && `Last` = '$word_count[1]' && `City` = '$word_count[2]' && `State` = '$word_count[3]'";
			
			$searchQuery[] = "`First` = '$word_count[0]' && `Last` = '$word_count[1]' && `City` = '$word_count[2] $word_count[3]' && `State` = '$word_count[4]'";
			
			$searchQuery[] = "`First` = '$word_count[0]' && `Last` = '$word_count[1]' && `City` = '$word_count[2]' && `State` = '$word_count[3] $word_count[4]'";
			
			$searchQuery[] = "`First` = '$word_count[0]' && `Last` = '$word_count[1]' && `City` = '$word_count[2] $word_count[3]' && `State` = '$word_count[4] $word_count[5]'";
			
			$searchQuery[] = "`First` = '$word_count[0]' && `Last` = '$word_count[1]' && `City` = '$word_count[2] $word_count[3] $word_count[4]' && `State` = '$word_count[5] $word_count[6]'";
			
			$searchQuery[] = "`First` = '$word_count[0]' && `Last` = '$word_count[1]' && `City` = '$word_count[2] $word_count[3]' && `State` = '$word_count[4] $word_count[5] $word_count[6]'";
			
			$searchQuery[] = "`First` = '$word_count[0]' && `Last` = '$word_count[1]' && `City` = '$word_count[2] $word_count[3] $word_count[4]' && `State` = '$word_count[5] $word_count[6] $word_count[7]'";
			
			$searchQuery[] = "`First` = '$word_count[0]' && `Last` = '$word_count[1]' && `City` = '$word_count[2] $word_count[3]' && `State` = '$word_count[4] $word_count[5]'";
			$searchQuery[] = "`First` = '$word_count[0]' && `Last` = '$word_count[1]' && `City` = '$word_count[2] $word_count[3]' && `State` = '$word_count[4] $word_count[5]'";
		}
	} catch(Exception $e){}
	
	foreach($searchQuery as $key => $value)
	{
		$sql = mysqli_query($db_con, "select * from member where " . $value) or die(mysqli_error($db_con));

		if(mysqli_num_rows($sql) > 0)
		{
			$ColumnResults = "select * from member where " . $value;
			break;
		}
	}


	if(mysqli_num_rows($sql) > 0)
	{
		while($p = mysqli_fetch_array($sql))
		{
			$id = $p['Memberid'];
			$FirstName = $p['First'];
			$LastName = $p['Last'];
			$City = $p['City'];
			$State = $p['State'];

			$row_length++;
			
			?>
            <a href="profile.php?profileid=<?php echo $id; ?>" style="color:black;"><table class="searchquerybox_sub">
            	<tr>
                	<td width="5%">
                    	<img src="<?php echo MemberMainProfilePic($id); ?>" style="width: 64px; float: left;" />
                    </td>
                    <td width="95%" align="center">
                    	<?php echo $FirstName . " " . $LastName . " " . $City . " " . $State . " "; ?>
                    </td>
                </tr>
            </table></a>
            <?php	
		}
		/*
		if((searchinquery_length($ColumnResults, $searchResults) - $row_length) > 0) //(searchinquery_length($SelectedColumn, $searchResults) - $row_length)
		{
			?>
				<a href="search.php?searchInquery='<?php echo $searchInQuery; ?>'" style="color:black;">
				<table class="searchquerybox_sub">
					<tr>
						<td width="100%" align="center">
							<?php echo "Their are more <strong>'". $searchInQuery ."'</strong> results listed here.";  ?>
						</td>
					</tr>
				</table>
				</a>
			<?php
		}*/
	}
	else
	{	?>
		<table class="searchquerybox_sub">
				<tr>
					<td width="100%">
						<?php echo "Their are no " . $searchInQuery . " listed.";  ?>
					</td>
				</tr>
			</table>
		<?php
	}		
}

//search.php page only from usearch input
function searchinquery2($searchInQuery, $page)
{
	include 'config.php';
	$row_length = 0;

	$ColumnResults = array();
	$searchQuery = array();
	$SelectedColumn = '';
	$searchResults = '';
	$mode = 0;

	$searchInquery = str_replace(" ", ",", $searchInQuery);

	$word_count = explode(',', $searchInquery);

	try {
	if(strlen($word_count[0]) >= 3)
		{
			$searchQuery[] = "`First` = '$word_count[0]'";

			$searchQuery[] = "`First` Like '%$word_count[0]%'";

			$searchQuery[] = "`First` Like '%$word_count[0]% %$word_count[1]%'";

			$searchQuery[] = "`Last` = '$word_count[0]'";

			$searchQuery[] = "`Last` = '$word_count[0] $word_count[1]'";

			$searchQuery[] = "`Email` = '$word_count[0]'";
			
			$searchQuery[] = "`First` = '$word_count[0]' && `Last` = '$word_count[1]'";

			$searchQuery[] = "`First` = '$word_count[1]' && `Last` = '$word_count[0]'";

			$searchQuery[] = "`First` = '$word_count[1]' && `Last` = '$word_count[0]' && `City` = '$word_count[2]' && `State` = '$word_count[3]'";

			$searchQuery[] = "`First` = '$word_count[0]' && `Last` = '$word_count[1]' && `City` = '$word_count[2]' && `State` = '$word_count[3]'";
			
			$searchQuery[] = "`First` = '$word_count[0]' && `Last` = '$word_count[1]' && `City` = '$word_count[2] $word_count[3]' && `State` = '$word_count[4]'";
			
			$searchQuery[] = "`First` = '$word_count[0]' && `Last` = '$word_count[1]' && `City` = '$word_count[2]' && `State` = '$word_count[3] $word_count[4]'";
			
			$searchQuery[] = "`First` = '$word_count[0]' && `Last` = '$word_count[1]' && `City` = '$word_count[2] $word_count[3]' && `State` = '$word_count[4] $word_count[5]'";
			
			$searchQuery[] = "`First` = '$word_count[0]' && `Last` = '$word_count[1]' && `City` = '$word_count[2] $word_count[3] $word_count[4]' && `State` = '$word_count[5] $word_count[6]'";
			
			$searchQuery[] = "`First` = '$word_count[0]' && `Last` = '$word_count[1]' && `City` = '$word_count[2] $word_count[3]' && `State` = '$word_count[4] $word_count[5] $word_count[6]'";
			
			$searchQuery[] = "`First` = '$word_count[0]' && `Last` = '$word_count[1]' && `City` = '$word_count[2] $word_count[3] $word_count[4]' && `State` = '$word_count[5] $word_count[6] $word_count[7]'";
			
			$searchQuery[] = "`First` = '$word_count[0]' && `Last` = '$word_count[1]' && `City` = '$word_count[2] $word_count[3]' && `State` = '$word_count[4] $word_count[5]'";
			$searchQuery[] = "`First` = '$word_count[0]' && `Last` = '$word_count[1]' && `City` = '$word_count[2] $word_count[3]' && `State` = '$word_count[4] $word_count[5]'";
		}
	} catch(Exception $e){}
	
	foreach($searchQuery as $key => $value)
	{
		$sql = mysqli_query($db_con, "select * from member where " . $value) or die(mysqli_error($db_con));

		if(mysqli_num_rows($sql) > 0)
		{
			//$ColumnResults = "select * from member where " . $value;
			break;
		}
	}


	if(mysqli_num_rows($sql) > 0)
	{
		while($p = mysqli_fetch_array($sql))
		{
			$id = $p['Memberid'];
			$FirstName = $p['First'];
			$LastName = $p['Last'];
			$row_length++;
			
			connection_tb($id);	
		}	

	}
}

function searchinquery3_length($searchInQuery, $country, $state, $city)
{
	include 'config.php';
	
	//Search by name only
	if($searchInQuery != "" && $country == "" && $state == "" && $city == "")
	{
		$sql = mysqli_query($db_con, "select * from member where first like '%$searchInQuery%' || last like '%$searchInQuery%'") or die(mysqli_error($db_con));
	  	return mysqli_num_rows($sql);
	}
	
	//Search by country only
	if($searchInQuery == "" && $country != "" && $state == "" && $city == "")
	{
		$sql = mysqli_query($db_con, "select * from member where Country = '$country'") or die(mysqli_error($db_con));
	  	return mysqli_num_rows($sql);
	}
	
	//Search by country and state only
	if($searchInQuery == "" && $country != "" && $state != "" && $city == "")
	{
		$sql = mysqli_query($db_con, "select * from member where Country = '$country' && State = '$state'") or die(mysqli_error($db_con));
	  	return mysqli_num_rows($sql);
	}
	
	//Search by country, state, and city only
	if($searchInQuery == "" && $country != "" && $state != "" && $city != "")
	{
		$sql = mysqli_query($db_con, "select * from member where Country = '$searchInQuery' && State = '$searchInQuery' && like '%$city%'") or die(mysqli_error($db_con));
	  return mysqli_num_rows($sql);
	}
	
	//Search by name, country, state, and city only
	if($searchInQuery == "" && $country != "" && $state != "" && $city != "")
	{
		$sql = mysqli_query($db_con, "select * from member where Country = '$searchInQuery' && State = '$searchInQuery' && Country = '$country' && State = '$state' && like '%$city%'") or die(mysqli_error($db_con));
	  return mysqli_num_rows($sql);
	}
}

function connection_tb($id)
{
	?>
    	<table class="connection_style">
            <tr>
            	<td style="width:10;" class="connection_style_img">
                	<img src="<?php echo MemberMainProfilePic($id); ?>" style="border-radius:5%; width:80px;" />
                </td>
                <td class="connection_style_info" style="font-family:Arial; text-align:center; font-size:20px; font-weight:bold; float:left; color:black; margin-top:25px; padding-left:15px;">
                	<?php echo MemberFullName($id); ?><br>
                    <?php 
                    
						if(check_connection_request_status($id, $_SESSION['SessionMemberID']) == 1)
						{
							?><button id="connection_btn<?php echo $id; ?>" onClick="">Connection Pending</button><?php
						}

						if(check_connection_request_status($id, $_SESSION['SessionMemberID']) == 2)
						{
							?><a href="#">Connected</a>&nbsp;&nbsp;<button onClick="gotoProfile(<?php echo $id ?>);">View Profile</button><?php
						}

					if($id != $_SESSION['SessionMemberID'])
					{ 	
						if(check_connection_request_status($id, $_SESSION['SessionMemberID']) == 0)
						{
							?><a href="#">Not Connected</a>&nbsp;&nbsp;<button id="connection_btn<?php echo $id; ?>" onClick="send_connection_request(<?php echo $id; ?>)">Add Connection</button><?php
						}
					}
					else
					{
						?>
							<a href="myprofile.php"><button>My Profile</button></a>
						<?php
					}
					?>
                </td>
            </tr>
            </table>
    <?php
}

function searchinquery3($searchInQuery, $page)
{
	include 'config.php';
	$row_length = 0;

	$ColumnResults = '';
	$searchQuery = array();
	$SelectedColumn = '';
	$searchResults = '';
	$mode = 0;
	
	$number_item_per_page = 4;
	
	$limit = " limit $number_item_per_page offset 0";

	$searchInquery = str_replace(" ", ",", $searchInQuery);

	$word_count = explode(',', $searchInquery);
	
	try {
		if(strlen($word_count[0]) >= 3)
		{
			$searchQuery[] = "`First` = '$word_count[0]'";

			$searchQuery[] = "`First` Like '%$word_count[0]%'";

			$searchQuery[] = "`First` Like '%$word_count[0]% %$word_count[1]%'";

			$searchQuery[] = "`Last` = '$word_count[0]'";

			$searchQuery[] = "`Last` = '$word_count[0] $word_count[1]'";

			$searchQuery[] = "`Email` = '$word_count[0]'";
			
			$searchQuery[] = "`First` = '$word_count[0]' && `Last` = '$word_count[1]'";

			$searchQuery[] = "`First` = '$word_count[1]' && `Last` = '$word_count[0]'";

			$searchQuery[] = "`First` = '$word_count[1]' && `Last` = '$word_count[0]' && `City` = '$word_count[2]' && `State` = '$word_count[3]'";

			$searchQuery[] = "`First` = '$word_count[0]' && `Last` = '$word_count[1]' && `City` = '$word_count[2]' && `State` = '$word_count[3]'";
			
			$searchQuery[] = "`First` = '$word_count[0]' && `Last` = '$word_count[1]' && `City` = '$word_count[2] $word_count[3]' && `State` = '$word_count[4]'";
			
			$searchQuery[] = "`First` = '$word_count[0]' && `Last` = '$word_count[1]' && `City` = '$word_count[2]' && `State` = '$word_count[3] $word_count[4]'";
			
			$searchQuery[] = "`First` = '$word_count[0]' && `Last` = '$word_count[1]' && `City` = '$word_count[2] $word_count[3]' && `State` = '$word_count[4] $word_count[5]'";
			
			$searchQuery[] = "`First` = '$word_count[0]' && `Last` = '$word_count[1]' && `City` = '$word_count[2] $word_count[3] $word_count[4]' && `State` = '$word_count[5] $word_count[6]'";
			
			$searchQuery[] = "`First` = '$word_count[0]' && `Last` = '$word_count[1]' && `City` = '$word_count[2] $word_count[3]' && `State` = '$word_count[4] $word_count[5] $word_count[6]'";
			
			$searchQuery[] = "`First` = '$word_count[0]' && `Last` = '$word_count[1]' && `City` = '$word_count[2] $word_count[3] $word_count[4]' && `State` = '$word_count[5] $word_count[6] $word_count[7]'";
			
			$searchQuery[] = "`First` = '$word_count[0]' && `Last` = '$word_count[1]' && `City` = '$word_count[2] $word_count[3]' && `State` = '$word_count[4] $word_count[5]'";
			$searchQuery[] = "`First` = '$word_count[0]' && `Last` = '$word_count[1]' && `City` = '$word_count[2] $word_count[3]' && `State` = '$word_count[4] $word_count[5]'";
		}
	} catch(Exception $e){}


	foreach($searchQuery as $key => $value)
	{
		$sql = mysqli_query($db_con, "select * from member where " . $value) or die(mysqli_error($db_con));

		if(mysqli_num_rows($sql) > 0)
		{
			while($p = mysqli_fetch_array($sql))
			  {
				  $id = $p['Memberid'];
				  $FirstName = $p['First'];
				  $LastName = $p['Last'];
				  
				  echo connection_tb($id);
			   }	
			break;
		}
	}
	
	/*foreach ($ColumnResults as $key => $value) {
				
		foreach ($word_count as $key1 => $value1) {
			$sql = mysqli_query($db_con, "select * from member where $value like '%$value1%' limit 5") or die(mysqli_error($db_con));
				if(mysqli_num_rows($sql) > 0)
				{
					$SelectedColumn = $value;
					$searchResults = $value1;
					$mode = 1;
					break;//Break Foreach
				}
				else
				{
					$mode = 0;
				}
			}

			if($mode == 1)
			{
				break;//Break Foreach
			}
	}*/

	//$sqlquery = "select * from member where ";

	/*switch(count($word_count))
	{
		case 1:
		{
			//unset($searchQuery);

			//$searchQuery = array();

			$searchQuery[] = "`First` Like '%$word_count[0]%'";
			$searchQuery[] = "`Last` Like '%$word_count[0]%'";
			//$searchQuery[] = "`Email` Like '%$word_count[0]%'";
			$searchQuery[] = "`State` Like '%$word_count[0]%'";
			$searchQuery[] = "`City` Like '%$word_count[0]%'";
			$searchQuery[] = "`Country` Like '%$word_count[0]%'";


			foreach($searchQuery as $key => $value)
			{
				$sql = mysqli_query($db_con, "select * from member where " . $value . $limit) or die(mysqli_error($db_con));

				if(mysqli_num_rows($sql) > 0)
				{
					$ColumnResults = "select * from member where " . $value;
					break;
				}
			}

			break;
		}

		case 2: //First and Lastname or Country, State, City
		{
			unset($searchQuery);

			$searchQuery = array();

			$searchQuery[] =  "First Like '%$word_count[0]%' || Last Like '%$word_count[1]%' ";
			$searchQuery[] = "First Like '%$word_count[1]%' || Last Like '%$word_count[0]%' ";
			$searchQuery[] =  "`State` Like '%$word_count[0]%' || State Like '%$word_count[1]%' ";
			$searchQuery[] = "`City` Like '%$word_count[0]%' || City Like '%$word_count[1]%'' ";

			foreach($searchQuery as $key => $value)
			{
				$sql = mysqli_query($db_con, "select * from member where " . $value . $limit) or die(mysqli_error($db_con));

				if(mysqli_num_rows($sql) > 0)
				{
					$ColumnResults = "select * from member where " . $value;
					break;
				}
			}

			break;
		}

		case 3: //First, Lastname, City | State, Country, Email
		{
			unset($searchQuery);

			$searchQuery = array();

			$searchQuery[] = "First like '%$word_count[0]%' || Last like '%$word_count[1]%' || First like '%$word_count[1]%' || Last like '%$word_count[0]%' || City like '%$word_count[2]%'";
			$searchQuery[] = "City like '%$word_count[0]%' || State like '%$word_count[1]%' || State like '%$word_count[1] $word_count[2]%'";
			//$searchQuery[] = "Email like %$word_count[0]% || Email like %$word_count[1]% || Email like %$word_count[2]% || ";
			//$searchQuery[] = "Country like %$word_count[0]% || Country like %$word_count[1]% || Country like %$word_count[2]% || ";
			//$searchQuery[] = "State like %$word_count[0]% || State %$word_count[1]% || State like %$word_count[2]% || ";
			//$searchQuery[] = "City like %$word_count[0]% || City like %$word_count[1]% || City like %$word_count[2]% ";

			foreach($searchQuery as $key => $value)
			{
				$sql = mysqli_query($db_con, "select * from member where " . $value . $limit);

				if(mysqli_num_rows($sql) > 0)
				{
					$ColumnResults = "select * from member where " . $value;
					break;
				}
			}
			break;
		}

		case 4: // First, Last, City, State
		{
			unset($searchQuery);

			$searchQuery = array();

			$searchQuery[] = "First like '%$word_count[0]%' || Last like '%$word_count[1]%' || First like '%$word_count[1]%' || Last like '%$word_count[0]%' || City like '%$word_count[2]%' || State Like '%$word_count[3]%'";
			//$searchQuery[] = "Last like %$word_count[0]% || Last like %$word_count[1]% || Last like %$word_count[2]% || Last like %$word_count[3]% || ";
			//$searchQuery[] = "Email like %$word_count[0]% || Email like %$word_count[1]% || Email like %$word_count[2]% || Email like %$word_count[3]% || ";
			//$searchQuery[] = "Country like %$word_count[0]% || Country like %$word_count[1]% || Country like %$word_count[2]% || Country like %$word_count[3]% || ";
			//$searchQuery[] = "State like %$word_count[0]% || State %$word_count[1]% || State like %$word_count[2]% || State like %$word_count[3]% || ";
			//$searchQuery[] = "City like %$word_count[0]% || City like %$word_count[1]% || City like %$word_count[2]% || City like %$word_count[3]% ";

			foreach($searchQuery as $key => $value)
			{
				$sql = mysqli_query($db_con, "select * from member where " . $value . $limit);

				if(mysqli_num_rows($sql) > 0)
				{
					$ColumnResults = "select * from member where " . $value;
					break;
				}
			}
			break;
		}

		case 5:// First, Last, State, City
		{
			unset($searchQuery);

			$searchQuery = array();

			$searchQuery[] = "First like '%$word_count[0]%' || Last like '%$word_count[1]%' || First like '%$word_count[1]%' || Last like '%$word_count[0]%' || City like '%$word_count[2]%' || State Like '%$word_count[3]%  $word_count[4]%'";

			foreach($searchQuery as $key => $value)
			{
				$sql = mysqli_query($db_con, "select * from member where " . $value . $limit);

				if(mysqli_num_rows($sql) > 0)
				{
					$ColumnResults = "select * from member where " . $value;
					break;
				}
			}
			break;
		}
	}


	if(mysqli_num_rows($sql) > 0)
	{
		while($p = mysqli_fetch_array($sql))
		{
			$id = $p['Memberid'];
			$FirstName = $p['First'];
			$LastName = $p['Last'];
			$row_length++;
			
			connection_tb($id);	
		}	

	}*/
	
	/*
	$item_per_page = 20;
	
	//Search all
	if($searchInQuery == "" && $country == "" && $state == "" && $city == "")
	{
		$sql = mysqli_query($db_con, "select * from member where First like '%$searchInQuery%' || Last like '%$searchInQuery%' limit $page, $item_per_page") or die(mysqli_error($db_con));
	
	  while($p = mysqli_fetch_array($sql))
	  {
		  $id = $p['Memberid'];
		  $FirstName = $p['First'];
		  $LastName = $p['Last'];
		  
		  if($id != $_SESSION['SessionMemberID'])
		  {
			echo connection_tb($id);
		  }
	   }	
	}
	
	//Search by name only
	if($searchInQuery != "" && $country == "" && $state == "" && $city == "")
	{
		$sql = mysqli_query($db_con, "select * from member where First like '%$searchInQuery%' || Last like '%$searchInQuery%' limit $page, $item_per_page") or die(mysqli_error($db_con));
	
	  while($p = mysqli_fetch_array($sql))
	  {
		  $id = $p['Memberid'];
		  $FirstName = $p['First'];
		  $LastName = $p['Last'];
		  
		  if($id != $_SESSION['SessionMemberID'])
		  {
		  	echo connection_tb($id);
		  }
	   }	
	}
	
	//Search by name, and country only
	if($searchInQuery != "" && $country != "" && $state == "" && $city == "")
	{
		$sql = mysqli_query($db_con, "select * from member where First like  '%$searchInQuery%' || Last like '%$searchInQuery%' && Country = '$country' limit $page, $item_per_page") or die(mysqli_error($db_con));
	
	  while($p = mysqli_fetch_array($sql))
	  {
		  $id = $p['Memberid'];
		  $FirstName = $p['First'];
		  $LastName = $p['Last'];
		  
		  if($id != $_SESSION['SessionMemberID'])
		  {
		 	 echo connection_tb($id);
		  }
	  }	
	}
	
	//Search by name, country, and state only
	if($searchInQuery != "" && $country != "" && $state != "" && $city == "")
	{
		$sql = mysqli_query($db_con, "select * from member where First like  '%$searchInQuery%' || Last like '%$searchInQuery%' && Country = '$country' && State = '$state' limit $page, $item_per_page") or die(mysqli_error($db_con));
	
	  while($p = mysqli_fetch_array($sql))
	  {
		  $id = $p['Memberid'];
		  $FirstName = $p['First'];
		  $LastName = $p['Last'];
		  
		  if($id != $_SESSION['SessionMemberID'])
		  {
			echo connection_tb($id);
		  }
	  }	
	}
	
	//Search by name, country, state, city only
	if($searchInQuery != "" && $country != "" && $state != "" && $city != "")
	{
		$sql = mysqli_query($db_con, "select * from member where First like  '%$searchInQuery%' || Last like '%$searchInQuery%' && Country = '$country' && State = '$state' && City = '$city' limit $page, $item_per_page") or die(mysqli_error($db_con));
	
	  while($p = mysqli_fetch_array($sql))
	  {
		  $id = $p['Memberid'];
		  $FirstName = $p['First'];
		  $LastName = $p['Last'];
		  
		  if($id != $_SESSION['SessionMemberID'])
		  {
		  	echo connection_tb($id);
		  }
	  }	
	}
	
	//Search by country only
	if($searchInQuery == "" && $country != "" && $state == "" && $city == "")
	{
		$sql = mysqli_query($db_con, "select * from member where Country = '$country' limit $page, $item_per_page") or die(mysqli_error($db_con));
	
	  while($p = mysqli_fetch_array($sql))
	  {
		  $id = $p['Memberid'];
		  $FirstName = $p['First'];
		  $LastName = $p['Last'];
		  
		  if($id != $_SESSION['SessionMemberID'])
		  {
		  		echo connection_tb($id);
		  }
	  }	
	}
	
	//Search by country and state only
	if($searchInQuery == "" && $country != "" && $state != "" && $city == "")
	{
		$sql = mysqli_query($db_con, "select * from member where Country = '$country' && State = '$state' limit $page, $item_per_page") or die(mysqli_error($db_con));
	
	  while($p = mysqli_fetch_array($sql))
	  {
		  $id = $p['Memberid'];
		  $FirstName = $p['First'];
		  $LastName = $p['Last'];
		  
		  if($id != $_SESSION['SessionMemberID'])
		  {
		  		echo connection_tb($id);
		  }
	  }	
	}
	
	//Search by country, state, and city only
	if($searchInQuery == "" && $country != "" && $state != "" && $city != "")
	{
		$sql = mysqli_query($db_con, "select * from member where Country = '$searchInQuery' && State = '$searchInQuery' && like '%$city%' limit $page, $item_per_page") or die(mysqli_error($db_con));
	
	  while($p = mysqli_fetch_array($sql))
	  {
		  $id = $p['Memberid'];
		  $FirstName = $p['First'];
		  $LastName = $p['Last'];
		  
		  if($id != $_SESSION['SessionMemberID'])
		  {
		  		echo connection_tb($id);
		  }
	  }	
	}
	
	//Search by name, country, state, and city only
	if($searchInQuery == "" && $country != "" && $state != "" && $city != "")
	{
		$sql = mysqli_query($db_con, "select * from member where Country = '$searchInQuery' && State = '$searchInQuery' && Country = '$country' && State = '$state' && like '%$city%' limit $page, $item_per_page") or die(mysqli_error($db_con));
	
	  while($p = mysqli_fetch_array($sql))
	  {
		  $id = $p['Memberid'];
		  $FirstName = $p['First'];
		  $LastName = $p['Last'];
		  
		  if($id != $_SESSION['SessionMemberID'])
		  {
		  		echo connection_tb($id);
		  }
	  }	
	}*/
}
?>