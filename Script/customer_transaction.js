
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

var time = formatAMPM(today);

today = dd + '/' + mm + '/' + yyyy;


       
        var sql="INSERT INTO app_customer_account (`userid`, `customerid`, `in_account`, `out_account`, `balance`,transaction_date,transaction_time) VALUES ("+userid+",'"+cid+"','"+ina+"','"+outa+"','"+tbn+"','"+today+"','"+time+"')";
       
      
     
      
      saveWithoutMessage(sql);
     
      
      //SendSMS(ina,outa,tbn);
     
      alert('লেন দেন সম্পন্ন হয়েছে !');
      
        var sql="INSERT INTO app_sms ( `customerid`, `balance`, transaction_date,transaction_time,status) VALUES ('"+cid+"','"+tbn+"','"+today+"','"+time+"','"+2+"')"; 
        
      saveWithoutMessage(sql);
      
     
      
      
       id=0;
   
       location.reload();
   
}


function formatAMPM(date) {
  var hours = date.getHours();
  var minutes = date.getMinutes();
  var ampm = hours >= 12 ? 'pm' : 'am';
  hours = hours % 12;
  hours = hours ? hours : 12; // the hour '0' should be '12'
  minutes = minutes < 10 ? '0'+minutes : minutes;
  var strTime = hours + ':' + minutes + ' ' + ampm;
  return strTime;
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



function SendSMS(ina,outa,tb)
{
    
 var cname=$('#cname').text();
 var cmob=$('#cmob').text();
 var message="";
 if(ina==0){
 message="প্রিয় "+ cname +" আপনার নিকট আমিনুল স্টোরে আজকের বাকি "+outa+" এবং মোট  "+ tb +" টাকা বাকী রয়েছে, ধন্যবাদ ।";
 }
 else
 {
 message="প্রিয় "+ cname +" আপনার নিকট আমিনুল স্টোরে আজকের জমা "+ina+" এবং মোট  "+ tb +" টাকা বাকী রয়েছে, ধন্যবাদ ।"
 }
 
 var ApiUrl= "https://24smsbd.com/api/bulkSmsApi";
 
 var dataString="apiKey=TUtyb3c6TUtyb3cxMjM=&mobileNo="+cmob+"&message="+message+"&sender_id=90";  

 $.ajax({
  type: "POST",
  url: ApiUrl,
  data: dataString,
  cache: false,
  success: function(html) {
 
   
  }
  });

}
