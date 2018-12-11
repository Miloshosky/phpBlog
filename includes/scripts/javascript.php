<script type="text/javascript">
	$(function() {
  
  $('#rowPerPage').on('change', function() {
    var url = $(this).val(); 
    if (url) {
      window.location = url;
    }
    return false;
  });
});

</script>