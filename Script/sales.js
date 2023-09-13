

function savedata()
{ 
     
       var userid=$('#userid').val();

       var customerid=$('#customer').val();

       var today = new Date();
       var dd = String(today.getDate()).padStart(2, '0');
       var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
       var yyyy = today.getFullYear();
       var sales_date= dd + '-' + mm + '-' + yyyy;
     
       var total=$('#totalprice').text();
       var paid=$('#paid').text();
       var due=$('#due').text();

       var flag=true;

       if(paid=="")
       {
        alert('পরিশোধের পরিমান দিন  ! !');
        flag=false;
       }

       $('#example2 tbody tr').each(function (i, row) {
        
        var $row = $(row);   
        var name=$row.find('.name').text();
        var quantity=$row.find('.quantity').text();
        var price=$row.find('.price').text();

        if(name=="" || quantity=="" || price=="")
        {
          alert('পণ্যের নাম,পরিমান,দাম সঠিকভাবে দিন  ! !');
          flag=false;
        }
    
      });



       if(customerid=="0")
       {
            var customername=$('#customername').val();
            var customermobileno=$('#customermobileno').val();
            if(customername=="")
            {
              alert('গ্রাহকের তথ্য দিন  ! !');
              flag=false;
            }
            else{
            var custSql="INSERT INTO customer (userid,name,mobileno) VALUES ("+userid+",'"+customername+"','"+customermobileno+"')";
            var custReturnSql="SELECT max(id) as id FROM customer WHERE userid="+userid;
            saveCustomer(custSql,custReturnSql);
            }
       }      

       if(customerid=="")
       {
           alert('গ্রাহকের তথ্য দিন  ! !');
           flag=false;
       }

       if(flag)
       {

        var sql="INSERT INTO khata_sales_master (userid,customerid,salesdate,totalprice,paid,due) VALUES ("+userid+",'"+customerid+"','"+sales_date+"','"+total+"','"+paid+"','"+due+"')";
      
         var returnsql="SELECT max(id) as id FROM khata_sales_master WHERE userid="+userid;
        
         savemaster(sql,returnsql);
  
        
       }

   
}


function savemaster(sql,returnsql)
{
   
var dataString="sql="+sql+"&returnsql="+returnsql;

//alert(dataString);
      
$.ajax({
type: "POST",
url: "Model/savemaster.php",
data: dataString,
cache: false,
async:false,
success: function(html) {

customerid=html;

}
});

}


function savemaster(sql,returnsql)
{
   
var dataString="sql="+sql+"&returnsql="+returnsql;

//alert(dataString);
      
$.ajax({
type: "POST",
url: "Model/savemaster.php",
data: dataString,
cache: false,
success: function(html) {

savedetail(html);

}
});

}


function savedetail(masterid)
{


  $('#example2 tbody tr').each(function (i, row) {

    var $row = $(row);   

    var userid=$('#userid').val();
        var name=$row.find('.name').text();
        var quantity=$row.find('.quantity').text();
        var price=$row.find('.price').text();

    //alert(detailid);

     if(name!="" && quantity>0) {
      var sql="INSERT INTO khata_sales_detail (userid,masterid,productname,quantity,price) VALUES ("+userid+",'"+masterid+"','"+name+"','"+quantity+"','"+price+"')";
     }  
     else
     {
      
      // No chance to update . . . . . . . . . . . . . . . 
      //var sql="INSERT INTO sales_detail (userid,salesid,productid,quantity,unitprice,total_price) VALUES ("+userid+",'"+id+"','"+productid+"','"+qty+"','"+unitprice+"','"+amount+"')";

     }


     // Ajax To Save Data .......
 //alert(sql);      
       
var dataString="sql="+sql;

//alert(dataString);
      
$.ajax({
type: "POST",
url: "Model/savedetail.php",
data: dataString,
cache: false,
async:false,
success: function(html) {
    //alert(html);
}
});

    
  });

  

  //PrintReceipt(masterid,'');
  alert('বিক্রয় সম্পন্ন হয়েছে ');
  getcontent('sales');
  id=0;

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

$('#customername').hide();
$('#customermobileno').hide();

$("#customer").change(function(){

  var customer=$("#customer").val();
  
  if(customer=="0")
  {
    $('#customername').show();
    $('#customermobileno').show();

  }
  else{
    $('#customername').hide();
    $('#customermobileno').hide();
  }
  
});


$(".addrow").click(function(){
  
  var tabledata="<tr contentEditable='true'>"
  +"<td class='slno' style='text-align:center;'></td>"
  +"<td class='name'></td>"
  +"<td class='quantity' style='text-align:right;'></td>"
  +"<td class='price' style='text-align:right;'></td>"
  +"</tr>";
 
  $('#example2 tbody').append(tabledata);

  $("#example2 tbody tr").blur(function(){
    calculate_total();
  });

  addslno();

});



function addslno()
{
  $('#example2 tbody tr').each(function (i, row) {

    var $row = $(row);
    $row.find('.slno').text(i+1*1);

  });
}

$("#example2 tbody tr").blur(function(){
  calculate_total();
});

function calculate_total()
{

  var totalqty=0;
  var totalprice=0;

  $('#example2 tbody tr').each(function (i, row) {
    var $row = $(row);   
    
     var qty=$row.find('.quantity').text();
    if(qty!=''){
      totalqty=totalqty+qty*1;
    }

    var price=$row.find('.price').text();
    if(price!=''){
      totalprice=totalprice+price*1;
    }

  });
 
  $('#totalqty').text(totalqty);
  $('#totalprice').text(totalprice);

// Due Calculation . . . . . .  . .

  
DueCalculation();

}


$("#paid").blur(function(){

  DueCalculation();

});


function DueCalculation()
{
  var paid=$('#paid').text();
  var totalprice=$('#totalprice').text();
  
 if(paid!="" && totalprice!=""){

 if(paid*1>totalprice*1)
 {
   alert("পরিশোধের পরিমান মোট  দামের চেয়ে বেশি হয়েছে   ! !");
   $('#paid').text('0');
   $('#due').text(total);
 }
 else{
   $('#due').text(totalprice-paid*1);
 }

 }
}