
<!-- JavaScript files-->
<script src="../assets/assets/vendor/jquery/jquery.min.js"></script>
<script src="../assets/assets/vendor/popper.js/umd/popper.min.js"> </script>
<script src="../assets/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/assets/vendor/jquery.cookie/jquery.cookie.js"> </script>
<script src="../assets/assets/vendor/jquery-validation/jquery.validate.min.js"></script>
<script src="../assets/assets/js/main.js"></script>



<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap.min.js"></script>
<script>
    $(function() {
        $(document).ready(function () {
            $('#parent_table').DataTable();
            $('#users_table').DataTable();
            $('#driver_table').DataTable();
            $('#teacher_table').DataTable();
            $('#admin_table').DataTable();
            $('#transport_table').DataTable();
        });

    });
</script>

<script>
$(function(){
	/** add active class and stay opened when selected */
	var url = window.location;
  
	// for sidebar menu entirely but not cover treeview
	$('ul.sidebar-menu a').filter(function() {
	    return this.href == url;
	}).parent().addClass('active');

	// for treeview
	$('ul.treeview-menu a').filter(function() {
	    return this.href == url;
	}).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');

});
</script>
<!-- Data Table Initialize -->
<script>
  $(function () {
    $('#example1').DataTable({
      responsive: true
    })
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<script>
  $(function(){
    //Initialize Select2 Elements
    $('.select2').select2()

    //CK Editor
    CKEDITOR.replace('editor1')
    CKEDITOR.replace('editor2')
  });
</script>


