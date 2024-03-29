<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Basic CRUD Application - jQuery EasyUI CRUD Demo</title>
  <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/default/easyui.css">
  <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/icon.css">
  <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/color.css">
  <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/demo/demo.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="utils/toastr.min.css">
  <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.min.js"></script>
  <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
  <script src="utils/toastr.min.js"></script>
  <style>
    .datagrid-header, #toolbar a {font-weight: bold;}
    .datagrid-header {text-align: center;}
  </style>
</head>
<body>
  <h2>Basic CRUD Application</h2>
  <p>Click the buttons on datagrid toolbar to do crud actions.</p>
  
  <table id="dg" title="My Users" class="easyui-datagrid" style="width:100%;height:100%"
          url="getInventories.php"
          toolbar="#toolbar" pagination="true"
          rownumbers="true" fitColumns="true" singleSelect="true">
    <thead>
      <tr>
        <th field="org">ORG</th>
        <th field="plant">PLANT</th>
        <th field="sold_to">SOLD TO</th>
        <th field="ship_to">SHIP TO</th>
        <th field="material">MATERIAL</th>
        <th field="distrik">DISTRIK</th>
        <th field="qty_minimum">QTY MINIMUM</th>
        <th field="qty_bonus">QTY BONUS</th>
        <th field="qty_status">QTY STATUS</th>
        <th field="created_by">CREATED BY</th>
        <th field="created_at">CREATED AT</th>
        <th field="updated_by">UPDATED BY</th>
        <th field="updated_at">UPDATED AT</th>
      </tr>
    </thead>
  </table>
  <div id="toolbar">
    <!-- <a href="databaseSeeder.php">Tambah Data</a> -->
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">New User</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Edit User</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Remove User</a>
  </div>
  
  <div id="dlg" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
    <form id="fm" method="post" novalidate style="margin:0;padding:20px 50px">
      <h3>User Information</h3>
      <div style="margin-bottom:10px">
        <input name="firstname" class="easyui-textbox" required="true" label="First Name:" style="width:100%">
      </div>
      <div style="margin-bottom:10px">
        <input name="lastname" class="easyui-textbox" required="true" label="Last Name:" style="width:100%">
      </div>
      <div style="margin-bottom:10px">
        <input name="phone" class="easyui-textbox" required="true" label="Phone:" style="width:100%">
      </div>
      <div style="margin-bottom:10px">
        <input name="email" class="easyui-textbox" required="true" validType="email" label="Email:" style="width:100%">
      </div>
    </form>
  </div>
  <div id="dlg-buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancel</a>
  </div>

  <script type="text/javascript">
    var url;
    const toastrOptions = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": false,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }

    $('#dg').datagrid({
      pageSize: 20,
      pageList: [20, 40, 60, 80, 100]
    })

    function newUser(){
      $('#dlg').dialog('open').dialog('center').dialog('setTitle','New User');
      $('#fm').form('clear');
      url = 'save_user.php';
    }

    function editUser(){
      let row = $('#dg').datagrid('getSelected');
      if (row){
        $('#dlg').dialog('open').dialog('center').dialog('setTitle','Edit User');
        $('#fm').form('load',row);
        url = 'update_user.php?id='+row.id;
      }
    }

    function saveUser(){
      $('#fm').form('submit',{
        url: url,
        iframe: false,
        onSubmit: function(){
          return $(this).form('validate');
        },
        success: function(result){
          let result = eval('('+result+')');
          if (result.errorMsg){
            toastr.options = toastrOptions;
            toastr["error"](result.errorMsg, "Error");
          } else {
            $('#dlg').dialog('close');        
            $('#dg').datagrid('reload');
            toastr.options = toastrOptions;
            toastr["success"](result.successMsg, "Success");
          }
        }
      });
    }

    function deleteItem() {
      var row = $('#dg').datagrid('getSelected');
      if (row) {
        $.messager.confirm('Confirm', 'Are you sure you want to delete this item?', function(r) {
          if (r) {
            $.post('deleteItem.php', {id: row.id}, function(result) {
              if (result.success) {
                $('#dg').datagrid('reload');
                toastr.options = toastrOptions;
                toastr["info"](result.successMsg, "Success");
              } else {
                toastr.options = toastrOptions;
                toastr["error"](result.errorMsg, "Error");
              }
            },'json');
          }
        });
      }
    }
  </script>
</body>
</html>