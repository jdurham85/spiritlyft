<?php 
session_start();
include 'config.php';
include 'core.inc.php';
include 'connections.core.inc.php';
?>
<script type="text/javascript">
function send_connection_request(mem1)
{   
  $.post("include/send_connection_request.php", {mem1: mem1}, function(result){
    
      if(result == 0)
      {
        document.getElementById("connection_btn"+mem1).innerHTML = "Connection Request Sent"; 
        document.getElementById("connection_btn"+mem1).setAttribute("OnClick", "");
      }
      
      if(result == 1)
      {
        document.getElementById("connection_btn"+mem1).innerHTML = "Connection Pending";  
        document.getElementById("connection_btn"+mem1).setAttribute("OnClick", "");
      }
    });
}

function connection_suggestion_hide_box(memid)
{
    $.post("include/connection_suggestion_hide.php", {memid: memid}, function(){
        $("#connection"+memid).fadeOut('fast', function(){
          $(this).remove();
      });
    });
}
</script>
<style>
.connection_suggestion_btn_tb{
  float: right;
  position: relative;
}

.connection_suggestion_btn_tb button
{
  height: 25px;
  width: 25px;
}
</style>
<div class="connection_box">
<?php 
echo getConnectionSuggestions();
?>
</div>