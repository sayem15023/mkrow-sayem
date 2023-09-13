
function savedata()
{ 
       var userid=$('#userid').val();

       var name=$('#name').val();
       var mobileno=$('#mobileno').val();
       var address=$('#address').val();
       var reference=$('#reference').val();

       if(id==0){
        var sql="INSERT INTO customer (userid,name,mobileno,address,reference) VALUES ("+userid+",'"+name+"','"+mobileno+"','"+address+"','"+reference+"')";
       }
       else{
        var sql = "UPDATE customer SET name='"+name+"', mobileno='"+mobileno+"', address='"+address+"',reference='"+reference+"' WHERE id="+id;
       }
      
       save(sql);

       id=0;

       ScrollToTop();
   
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



$("#customercode").change(function(){

  var custcode=$("#customercode").val();
  var dataString="code="+custcode;
  
  $.ajax({
    type: "POST",
    url: "Model/getCustomerIdByCode.php",
    data: dataString,
    cache: false,
    success: function(html) {
      var custid=html*1;
      if(custid!=0){
      $("#customer").val(custid).change();
      }
    }
    });
  
});


$("#customer").change(function(){

  var customer=$("#customer").val();
  
  if(customer=="")
  {
    getViewWithParam('customer_account','customerid=0');
  }
  else{
    getViewWithParam('customer_account','customerid='+customer);
  }
  
});