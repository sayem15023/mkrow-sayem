
function savedata()
{ 
       var userid=$('#userid').val();

       var cid=$('#cid').val();
       var tb=$('#tb').val();
       var ina=$('#in').val()==''?0:$('#in').val();
       var outa=$('#out').val()==''?0:$('#out').val();
       
       var tbn=tb*1+outa*1-ina;

var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();

today = dd + '/' + mm + '/' + yyyy;

       
        var sql="INSERT INTO app_customer_account (`userid`, `customerid`, `in_account`, `out_account`, `balance`,transaction_date) VALUES ("+userid+",'"+cid+"','"+ina+"','"+outa+"','"+tbn+"','"+today+"')";
       
      
      saveWithoutMessage(sql);
      alert('লেন দেন সম্পন্ন হয়েছে !');
       id=0;
   
       location.reload();
   
}

function updatedata(updateid,e)
{
  
  id=updateid;

  var row=$(e).closest('tr');

  $name=row.find('.name').text();
  $mobileno=row.find('.mobileno').text();
  $address=row.find('.address').text();
  $reference=row.find('.reference').text();

  $('#name').val($name);
  $('#mobileno').val($mobileno);
  $('#address').val($address);
  $('#reference').val($reference);

  ScrollToBottom();

}
