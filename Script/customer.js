
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
        var sql = "UPDATE customer SET userid='"+userid+"',name='"+name+"', mobileno='"+mobileno+"', address='"+address+"',reference='"+reference+"' WHERE id="+id;
       }
      
       save(sql);

       id=0;

       ScrollToTop();
       
       //location.reload();
   
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
