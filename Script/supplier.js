
function savedata()
{ 
       var userid=$('#userid').val();

       var name=$('#name').val();
       var mobileno=$('#mobileno').val();
       var address=$('#address').val();
       var product_category_id=$('#product_category_id').val();

       if(id==0){
        var sql="INSERT INTO supplier (userid,name,mobileno,address,product_category_id) VALUES ("+userid+",'"+name+"','"+mobileno+"','"+address+"','"+product_category_id+"')";
       }
       else{
        var sql = "UPDATE supplier SET userid='"+userid+"',name='"+name+"', mobileno='"+mobileno+"', address='"+address+"',product_category_id='"+product_category_id+"' WHERE id="+id;
       }
      
       save(sql);

       id=0;

       ScrollToTop();
       
       //location.reload();
   
}
function deletedata(deleteId,e){
  id = deleteId;
  console.log(id);
  if(id != 0){
    var sql = "DELETE from supplier where id="+id;
  }
  save(sql);
  id=0;
  
}

function updatedata(updateid,e)
{
  
  id=updateid;

  var row=$(e).closest('tr');

  $name=row.find('.name').text();
  $mobileno=row.find('.mobileno').text();
  $address=row.find('.address').text();
  $product_category_id=row.find('.product_category_id').text();

  $('#name').val($name);
  $('#mobileno').val($mobileno);
  $('#address').val($address);
  $('#product_category_id').val($product_category_id);

  ScrollToBottom();

}
