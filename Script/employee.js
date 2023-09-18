
function savedata()
{ 
  console.log(id);
       var userid=$('#userid').val();

       var employee_name=$('#employee_name').val();
       var mobileno=$('#mobileno').val();
       var permanent_address=$('#permanent_address').val();
       var temporary_address=$('#temporary_address').val();

       var father_name=$('#father_name').val();
       var mother_name=$('#mother_name').val();
       var nationality=$('#nationality').val();
       var religion=$('#religion').val();

       var previous_workspace_details=$('#previous_workspace_details').val();
       var guarantor_name=$('#guarantor_name').val();
       var guarantor_mobileno=$('#guarantor_mobileno').val();
       var relation=$('#relation').val();

       var designation=$('#designation').val();
       var working_area=$('#working_area').val();
       var investore_name=$('#investore_name').val();

       if(id==0){
        var sql="INSERT INTO employee (userid,employee_name,mobileno,permanent_address,temporary_address,father_name,mother_name,nationality,religion,previous_workspace_details,guarantor_name,guarantor_mobileno,relation,designation,working_area,investore_name) VALUES ("+userid+",'"+employee_name+"','"+mobileno+"','"+permanent_address+"','"+temporary_address+"','"+father_name+"','"+mother_name+"','"+nationality+"','"+religion+"','"+previous_workspace_details+"','"+guarantor_name+"','"+guarantor_mobileno+"','"+relation+"','"+designation+"','"+working_area+"','"+investore_name+"')";
       }
       else{
        var sql="UPDATE employee SET userid='"+userid+"',employee_name='"+employee_name+"', mobileno='"+mobileno+"', permanent_address='"+permanent_address+"',temporary_address='"+temporary_address+"',father_name='"+father_name+"',mother_name='"+mother_name+"',nationality='"+nationality+"',religion='"+religion+"',previous_workspace_details='"+previous_workspace_details+"',guarantor_name='"+guarantor_name+"',guarantor_mobileno='"+guarantor_mobileno+"',relation='"+relation+"',designation='"+designation+"',working_area='"+working_area+"',investore_name='"+investore_name+"' WHERE id="+id;
        // var sql = "UPDATE supplier SET userid='"+userid+"',name='"+name+"', mobileno='"+mobileno+"', address='"+address+"',reference='"+reference+"' WHERE id="+id;
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
    var sql = "DELETE from employee where id="+id;
  }
  save(sql);
  id=0;
  
}

function updatedata(updateid,e)
{
  
  id=updateid;

  var row=$(e).closest('tr');

  $employee_name=row.find('.employee_name').text();
  $mobileno=row.find('.mobileno').text();
  $permanent_address=row.find('.permanent_address').text();
  $temporary_address=row.find('.temporary_address').text();

  $father_name=row.find('.father_name').text();
  $mother_name=row.find('.mother_name').text();
  $nationality=row.find('.nationality').text();
  $religion=row.find('.religion').text();

  $previous_workspace_details=row.find('.previous_workspace_details').text();
  $guarantor_name=row.find('.guarantor_name').text();
  $guarantor_mobileno=row.find('.guarantor_mobileno').text();
  $relation=row.find('.relation').text();

  $designation=row.find('.designation').text();
  $working_area=row.find('.working_area').text();
  $investore_name=row.find('.investore_name').text();






  employee_name=$('#employee_name').val($employee_name);
  mobileno=$('#mobileno').val($mobileno);
  permanent_address=$('#permanent_address').val($permanent_address);
  temporary_address=$('#temporary_address').val($temporary_address);

  father_name=$('#father_name').val($father_name);
  mother_name=$('#mother_name').val($mother_name);
  nationality=$('#nationality').val($nationality);
  religion=$('#religion').val($religion);

  previous_workspace_details=$('#previous_workspace_details').val($previous_workspace_details);
  guarantor_name=$('#guarantor_name').val($guarantor_name);
  guarantor_mobileno=$('#guarantor_mobileno').val($guarantor_mobileno);
  relation=$('#relation').val($relation);

  designation=$('#designation').val($designation);
  working_area=$('#working_area').val($working_area);
  investore_name=$('#investore_name').val($investore_name);

  ScrollToBottom();

}
